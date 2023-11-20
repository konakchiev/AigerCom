<?php

use Joomunited\WPSOL\Configuration;
use Joomunited\WPSOL\MobileDetect;

defined('ABSPATH') || exit;

// Don't cache robots.txt or htacesss
if (strpos($_SERVER['REQUEST_URI'], 'robots.txt') !== false || strpos($_SERVER['REQUEST_URI'], '.htaccess') !== false) {
    return;
}

// Don't cache non-GET requests
if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'GET') {
    return;
}

include_once(__DIR__ . '/../../vendor/autoload.php');

$file_extension = pathinfo($_SERVER['REQUEST_URI'], PATHINFO_EXTENSION);

// Don't cache disallowed extensions. Prevents wp-cron.php, xmlrpc.php, etc.
if (!preg_match('#index\.php$#i', $_SERVER['REQUEST_URI']) && in_array($file_extension, array('php', 'xml', 'xsl'))) {
    return;
}

$url_path = wpsolGetUrlPath();
$user_logged = false;
$filename = $url_path . 'guest';
// Don't cache
if (!empty($_COOKIE)) {
    $wp_cookies = array('wordpressuser_', 'wordpresspass_', 'wordpress_sec_', 'wordpress_logged_in_');

    foreach ($_COOKIE as $key => $value) {
        // Logged in!
        if (strpos($key, 'wordpress_logged_in_') !== false) {
            $user_logged = true;
        }
    }

    if ($user_logged) {
        foreach ($_COOKIE as $k => $v) {
            if (strpos($k, 'wordpress_logged_in_') !== false) {
                $nameuser = substr($v, 0, strpos($v, '|'));
                $filename = $url_path . strtolower($nameuser);
            }
        }
    }

    if (!empty($_COOKIE['wpsol_commented_posts'])) {
        foreach ($_COOKIE['wpsol_commented_posts'] as $path_url) {
            if (rtrim($path_url, '/') === rtrim($_SERVER['REQUEST_URI'], '/')) {
                // User commented on this post
                return;
            }
        }
    }
}

$preload_check = false;
// Check for preload
if (isset($_SERVER['HTTP_AUTHORPRELOAD']) && $_SERVER['HTTP_AUTHORPRELOAD'] === 'WPSOL_PRELOAD') {
    $preload_check = true;
}

//check disable cache for page
$opts_config = $GLOBALS['wpsol_config'];
$check_exclude = check_exclude_page($opts_config, $url_path);

// Page excluded, nothing more to do
if ($check_exclude) {
    return;
}

// Load cache
if (!$preload_check) {
    $devices = $opts_config['speed_optimization']['devices'];

    if ($devices['cache_desktop'] === 1 && $devices['cache_tablet'] === 1 && $devices['cache_mobile'] === 1) {
        $X1 = 'D';
        $filename .= '_wpsol_cache_desktop';
    } else {
        // Include and instantiate the class.
        $detect = new MobileDetect();

        $X1 = '';
        // Detect devices
        if ($detect->isMobile() && !$detect->isTablet()) {
            //        The first X will be D for Desktop cache
            //                                  M for Mobile cache
            //                                  T for Tablet cache
            if ($devices['cache_mobile'] === 1) {
                $X1 = 'D';
                $filename .= '_wpsol_cache_desktop';
            }
            if ($devices['cache_mobile'] === 2) {
                $X1 = 'M';
                $filename .= '_wpsol_cache_mobile';
            }
        } elseif ($detect->isTablet()) {
            if ($devices['cache_tablet'] === 1) {
                $X1 = 'D';
                $filename .= '_wpsol_cache_desktop';
            }
            if ($devices['cache_tablet'] === 2) {
                $X1 = 'T';
                $filename .= '_wpsol_cache_tablet';
            }
        } else {
            if ($devices['cache_desktop'] === 1) {
                $X1 = 'D';
                $filename .= '_wpsol_cache_desktop';
            }
        }
    }

    // Generate a different cache foreach http,https
    if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] === 443) {
        $filename .= '_scache_';
    } else {
        $filename .= '_cache_';
    }

    wpsol_serve_cache($filename, $url_path, $X1);
}

// No cache available yet, open buffer to cache creation
ob_start('wpsol_cache');

/**
 * Cache output before it goes to the browser
 *
 * @param string  $buffer HTML raw
 * @param integer $flags  Flag of buffer
 *
 * @return string
 */
function wpsol_cache($buffer, $flags)
{
    $detect = new MobileDetect();

    $url = wpsolGetUrlPath();
    /**
     * Should we cache the specified url
     * The filter should return true to cache the page or false if it should not be cached
     *
     * @param true Cache the page by default
     * @param string  Url of the page
     *
     * @return boolean
     */
    $check_cache_this_page = apply_filters('wpsol_page_url_do_cache', true, $url);

    if (!$check_cache_this_page) {
        return $buffer;
    }

    //not cache per administrator if option disable optimization for admin users clicked
    $check_admin = Configuration::checkAdminRole();

    $check_roles = false;
    if (class_exists('\Joomunited\WPSOLADDON\Configuration')) {
        $check_roles = \Joomunited\WPSOLADDON\Configuration::checkUserRoles();
    }

    if ($check_admin || $check_roles) {
        return $buffer;
    }

    if (strlen($buffer) < 255) {
        return $buffer;
    }
    // Check if it is not html, dont need cache
    if (!preg_match('#</html>#i', $buffer)) {
        return $buffer;
    }

    // Don't cache search, 404, or password protected
    if ((function_exists('is_404') && is_404()) ||
        (function_exists('is_search') && is_search()) ||
        (function_exists('post_password_required') && post_password_required())) {
        return $buffer;
    }
    global $wp_filesystem;
    if (empty($wp_filesystem)) {
        require_once(ABSPATH . '/wp-admin/includes/file.php');
        WP_Filesystem();
    }

    // Make sure we can read/write files and that proper folders exist
    if (!$wp_filesystem->exists(untrailingslashit(WP_CONTENT_DIR) . '/cache')) {
        if (!$wp_filesystem->mkdir(untrailingslashit(WP_CONTENT_DIR) . '/cache')) {
            // Can not cache!
            return $buffer;
        }
    }

    if (!$wp_filesystem->exists(untrailingslashit(WP_CONTENT_DIR) . '/cache/wpsol-cache')) {
        if (!$wp_filesystem->mkdir(untrailingslashit(WP_CONTENT_DIR) . '/cache/wpsol-cache')) {
            // Can not cache!
            return $buffer;
        }
        $wp_filesystem->put_contents(untrailingslashit(WP_CONTENT_DIR) . '/cache/wpsol-cache/.htaccess', 'deny from all');
    }

    if (!$wp_filesystem->exists(untrailingslashit(WP_CONTENT_DIR) . '/cache/wpsol-cache/' . md5($url))) {
        if (!$wp_filesystem->mkdir(untrailingslashit(WP_CONTENT_DIR) . '/cache/wpsol-cache/' . md5($url))) {
            // Can not cache!
            return $buffer;
        }
    }

    $path = untrailingslashit(WP_CONTENT_DIR) . '/cache/wpsol-cache/' . md5($url) . '/';

    $modified_time = time(); // Make sure modified time is consistent

    if (preg_match('#</html>#i', $buffer)) {
        $buffer .= "\n<!-- Cache served by WPSOL CACHE - Last modified: " .
            gmdate('D, d M Y H:i:s', $modified_time) . " GMT -->\n";
    }

    /**
     *  Filter html content before put it to cache file.
     *  You can modify the content of the page before it is saved in the cache file
     *
     * @param string Content of page
     *
     * @return string
     */
    $buffer = apply_filters('wpsol_before_cache', $buffer);

    $headers = array(
        array(
            'name' => 'Content-Type',
            'value' => 'text/html; charset=utf-8'
        ),
        array(
            'name' => 'Expires',
            'value' => 'Wed, 17 Aug 2005 00:00:00 GMT'
        ),
        array(
            'name' => 'Last-Modified',
            'value' => gmdate('D, d M Y H:i:s', $modified_time) . ' GMT'
        ),
        array(
            'name' => 'Cache-Control',
            'value' => 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0'
        ),
        array(
            'name' => 'Pragma',
            'value' => 'no-cache'
        ),
    );

    $data = array('body' => $buffer, 'headers' => $headers);
    $url_path = $url;
    $data = serialize($data);
    //cache per users
    if (is_user_logged_in()) {
        $current_user = wp_get_current_user();
        if ($current_user->user_login) {
            $url_path .= $current_user->user_login;
        }
    } else {
        $url_path .= 'guest';
    }
    $devices = $GLOBALS['wpsol_config']['speed_optimization']['devices'];
    // Detect devices
    if ($detect->isMobile() && !$detect->isTablet()) {
        if ($devices['cache_mobile'] === 1) {
            $X1 = 'D';
            $url_path .= '_wpsol_cache_desktop';
        }
        if ($devices['cache_mobile'] === 2) {
            $X1 = 'M';
            $url_path .= '_wpsol_cache_mobile';
        }
    } elseif ($detect->isTablet()) {
        if ($devices['cache_tablet'] === 1) {
            $X1 = 'D';
            $url_path .= '_wpsol_cache_desktop';
        }
        if ($devices['cache_tablet'] === 2) {
            $X1 = 'T';
            $url_path .= '_wpsol_cache_tablet';
        }
    } else {
        if ($devices['cache_desktop'] === 1) {
            $X1 = 'D';
            $url_path .= '_wpsol_cache_desktop';
        }
    }

    // Generate a different cache foreach http,https
    if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] === 443) {
        $url_path .= '_scache_';
    } else {
        $url_path .= '_cache_';
    }

    if (strpos($url_path, '_wpsol_cache_') !== false) {
        $wp_filesystem->put_contents($path . md5($url_path) . '.php', '<?php die(); ?>'.$data);
        $wp_filesystem->touch($path . md5($url_path) . '.php', $modified_time);
    } else {
        return $buffer;
    }
    //set cache provider header if not exists cache file
    header('Cache-Provider:WPSL-' . $X1 . 'C');

    header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $modified_time) . ' GMT');

    return $buffer;
}

/**
 * Get URL path for caching
 *
 * @since  1.0
 * @return string
 */
function wpsolGetUrlPath()
{
    $host = (isset($_SERVER['HTTP_HOST'])) ? $_SERVER['HTTP_HOST'] : '';

    // flexible ssl
    if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
        $protocol = $_SERVER['HTTP_X_FORWARDED_PROTO'];
    } elseif ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] === 443) {
        $protocol = 'https';
    } else {
        $protocol = 'http';
    }

    $domain = $protocol . '://' . rtrim($host, '/');

    //decode url with russian language
    return $domain . rawurldecode($_SERVER['REQUEST_URI']);
}

/**
 * Optionally serve cache and exit
 *
 * @param string $filename Name of file cache
 * @param string $url_path Path of file cache
 * @param string $X1       Name devices
 *
 * @return void
 */
function wpsol_serve_cache($filename, $url_path, $X1)
{
    if (strpos($filename, '_wpsol_cache_') === false) {
        return;
    }

    $file_name = md5($filename) . '.php';

    $path = rtrim(WP_CONTENT_DIR, '/') . '/cache/wpsol-cache/' . md5($url_path) . '/' . $file_name;

    if (!file_exists($path)) {
        return;
    }

    $modified_time = (int) filemtime($path);
    if (!empty($modified_time) && !empty($_SERVER['HTTP_IF_MODIFIED_SINCE'])
        && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) === $modified_time) {
        header($_SERVER['SERVER_PROTOCOL'] . ' 304 Not Modified', true, 304);
        exit;
    }

    $cacheFile = file_get_contents($path);


    if ($cacheFile !== false) {
        // Remove security header
        $cacheFile = substr($cacheFile, 15);

        $datas = unserialize($cacheFile);
        $cache_data = $datas['body'];
        foreach ($datas['headers'] as $data) {
            header($data['name'] . ': ' . $data['value']);
        }
        //set cache provider header
        header('Cache-Provider:WPSL-' . $X1 . 'E');

        $gzip = wpsol_gzip_allowed();

        if ($gzip && function_exists('gzencode')) {
            $cache_data = gzencode($cache_data, 6, FORCE_GZIP);
            header('Content-Encoding: ' . $gzip);
        }
        $size = function_exists('mb_strlen') ? mb_strlen($cache_data, '8bit') : strlen($cache_data);
        // Set content-length header
        header('Content-Length: ' . $size);

        //Render page cache
        //phpcs:ignore WordPress.Security.EscapeOutput -- Echo content
        echo $cache_data;

        exit;
    }
}

/**
 * Check gzip accepted in site
 *
 * @return mixed
 */
function wpsol_gzip_allowed()
{
    if (1 === ini_get('zlib.output_compression') || 'on' === strtolower(ini_get('zlib.output_compression'))) {
        // don't compress WP-Cache data files when PHP is already doing it
        return false;
    }

    if (!isset($_SERVER['HTTP_ACCEPT_ENCODING']) || (isset($_SERVER['HTTP_ACCEPT_ENCODING']) && strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') === false)) {
        return false;
    }
    return 'gzip';
}


/**
 * Check url to exclude cache from option
 *
 * @param array  $opts_config Option configuration
 * @param string $current_url Current url to check
 *
 * @return boolean
 */
function check_exclude_page($opts_config, $current_url)
{
    //check disable cache for page
    if (!empty($opts_config['disable_page'])) {
        foreach ($opts_config['disable_page'] as $v) {
            if (empty($v)) {
                continue;
            }
            // Clear blank character
            $v = trim($v);
            if (preg_match('/(\/?\&?\(\.?\*\)|\/\*|\*)$/', $v, $matches)) {
                // End of rules is /*, /(*) , /(.*)
                $pattent = substr($v, 0, strpos($v, $matches[0]));
                if ($v[0] === '/') {
                    // A path of exclude url with regex
                    if ((preg_match('@' . $pattent . '@', $current_url, $matches) > 0)) {
                        return true;
                    }
                } else {
                    if (!empty($pattent)) {
                        // Full exclude url with regex
                        if (strpos($current_url, $pattent) !== false) {
                            return true;
                        }
                    }
                }
            } else {
                if ($v[0] === '/') {
                    // A path of exclude
                    if ((preg_match('@' . $v . '@', $current_url, $matches) > 0)) {
                        return true;
                    }
                } else {
                    // Whole path
                    if ($v === $current_url) {
                        return true;
                    }
                }
            }
        }
    }

    return false;
}
