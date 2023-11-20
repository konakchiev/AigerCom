<?php
namespace Joomunited\WPSOL;

use DOMDocument;
use Joomunited\WPSOL\Cache\Ecommerce;
use mysql_xdevapi\Exception;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class Cache
 */
class Cache
{
    /**
     * Cache constructor.
     */
    public function __construct()
    {
    }

    /**
     * Create advanced-cache file
     *
     * @return boolean
     */
    public static function write()
    {
        global $wp_filesystem;

        $file = untrailingslashit(WP_CONTENT_DIR) . '/advanced-cache.php';

        $config = get_option('wpsol_optimization_settings');

        $file_string = '';

        if (!empty($config) && !empty($config['speed_optimization']['act_cache'])) {
            $file_string = '<?php ' .
                "\n\r" . 'defined( \'ABSPATH\' ) || exit;' .
                "\n\r" . 'define( \'WPSOL_ADVANCED_CACHE\', true );' .
                "\n\r" . 'if ( is_admin() ) { return; }' .
                "\n\r" . 'if ( ! @file_exists( \'' . WPSOL_PLUGIN_DIR . 'wp-speed-of-light.php\' ) ) { return; }' .
                "\n\r" . 'if ( ! @file_exists( \'' .
                WP_CONTENT_DIR . "/wpsol-config/speed-of-light-config.php' ) ) { return; }" .
                "\n\r" . '$GLOBALS[\'wpsol_config\'] = include( \'' .
                WP_CONTENT_DIR . "/wpsol-config/speed-of-light-config.php' );" .
                "\n\r" . 'if ( empty( $GLOBALS[\'wpsol_config\'] ) ||
                 empty( $GLOBALS[\'wpsol_config\'][\'speed_optimization\'][\'act_cache\'] ) ) { return; }' .
                "\n\r" . 'if ( @file_exists( \'' .
                WPSOL_PLUGIN_DIR . 'src/Cache/file-page-cache.php\' ) ) { include_once( \'' .
                WPSOL_PLUGIN_DIR . 'src/Cache/file-page-cache.php\' ); }' . "\n\r";
        }

        if (!$wp_filesystem->put_contents($file, $file_string)) {
            return false;
        }

        return true;
    }

    /**
     * Create file config
     *
     * @param array $config Config to write
     *
     * @return boolean
     */
    public static function writeConfig($config)
    {

        global $wp_filesystem;

        $config_dir = WP_CONTENT_DIR . '/wpsol-config';

        $config_file = $config_dir . '/speed-of-light-config.php';

        $wp_filesystem->mkdir($config_dir);

        $config_file_string = '<?php ' . "\n\r" . 'defined( \'ABSPATH\' ) || exit;' .
            "\n\r" . 'return ' . var_export($config, true) . '; ' . "\n\r"; //phpcs:ignore
        // WordPress.PHP.DevelopmentFunctions.error_log_var_export -- Parse string representation of config to wpsol-config file

        if (!$wp_filesystem->put_contents($config_file, $config_file_string)) {
            return false;
        }

        return true;
    }

    /**
     * Turn on / of wp cahe
     *
     * @param boolean $status Status to toggle
     *
     * @return boolean
     */
    public static function toggleCaching($status)
    {

        global $wp_filesystem;

        if (defined('WP_CACHE') && WP_CACHE === $status) {
            return false;
        }

        // Lets look 4 levels deep for wp-config.php
        $levels = 4;

        $file = '/wp-config.php';
        $config_path = false;

        for ($i = 1; $i <= 3; $i++) {
            if ($i > 1) {
                $file = '/..' . $file;
            }

            if ($wp_filesystem->exists(untrailingslashit(ABSPATH) . $file)) {
                $config_path = untrailingslashit(ABSPATH) . $file;
                break;
            }
        }

        // Couldn't find wp-config.php
        if (!$config_path) {
            return false;
        }

        $config_file_string = $wp_filesystem->get_contents($config_path);

        // Config file is empty. Maybe couldn't read it?
        if (empty($config_file_string)) {
            return false;
        }

        $config_file = preg_split("#(\n|\r)#", $config_file_string);
        $line_key = false;

        foreach ($config_file as $key => $line) {
            if (!preg_match('/^\s*define\(\s*(\'|")([A-Z_]+)(\'|")(.*)/', $line, $match)) {
                continue;
            }

            if ($match[2] === 'WP_CACHE') {
                $line_key = $key;
            }
        }

        if ($line_key !== false) {
            unset($config_file[$line_key]);
        }

        $status_string = ($status) ? 'true' : 'false';

        array_shift($config_file);
        array_unshift($config_file, '<?php', 'define( \'WP_CACHE\','. $status_string .'); ');

        foreach ($config_file as $key => $line) {
            if ('' === $line) {
                unset($config_file[$key]);
            }
        }

        if (!$wp_filesystem->put_contents($config_path, implode(PHP_EOL, $config_file))) {
            return false;
        }

        return true;
    }

    /**
     * Clean cache
     *
     * @return boolean
     */
    public static function wpsolCacheFlush()
    {
        global $wp_filesystem;

        require_once(ABSPATH . 'wp-admin/includes/file.php');

        WP_Filesystem();

        $cacheFolfer = untrailingslashit(WP_CONTENT_DIR) . '/cache/wpsol-cache';

        $wp_filesystem->rmdir($cacheFolfer, true);

        if (function_exists('wp_cache_flush')) {
            wp_cache_flush();
        }

        return true;
    }

    /**
     * Delete file for clean up
     *
     * @return boolean
     */
    public static function cleanUp()
    {

        global $wp_filesystem;
        $file = untrailingslashit(WP_CONTENT_DIR) . '/advanced-cache.php';

        $ret = true;

        if (!$wp_filesystem->delete($file)) {
            $ret = false;
        }

        $folder = untrailingslashit(WP_CONTENT_DIR) . '/cache/wpsol-cache';

        if (!$wp_filesystem->delete($folder, true)) {
            $ret = false;
        }

        return $ret;
    }

    /**
     * Delete config file
     *
     * @return boolean
     */
    public function cleanConfig()
    {

        global $wp_filesystem;

        $folder = untrailingslashit(WP_CONTENT_DIR) . '/wpsol-config';
        if (!$wp_filesystem->delete($folder, true)) {
            return false;
        }

        return true;
    }

    /**
     * Function write config to wpsol-config
     *
     * @return boolean
     */
    public static function writeConfigCache()
    {
        $ecommerce_exclude_urls = array();
        $config = array();
        $optimization = get_option('wpsol_optimization_settings');

        if (empty($optimization)) {
            $optimization = array(
                'speed_optimization' => array(
                    'act_cache' => 1,
                    'clean_cache' => 40,
                    'clean_cache_each_params' => 2,
                    'devices' => array(
                        'cache_desktop' => 1,
                        'cache_tablet' => 1,
                        'cache_mobile' => 1,
                    ),
                    'query_strings' => 1,
                    'add_expires' => 1,
                    'disable_page' => array()
                )
            );
        }

        $config['speed_optimization'] = $optimization['speed_optimization'];

        //get parameter config
        $opt_config = get_option('wpsol_configuration');

        if (class_exists('WooCommerce')) {
            $ecommerce_exclude_urls = Ecommerce::factory()->wpsolEcommerceExcludePages();
        }
        $config['disable_page'] = array_merge(
            $ecommerce_exclude_urls,
            $optimization['speed_optimization']['disable_page']
        );

        $config['homepage'] = get_site_url();
        $config['disable_per_adminuser'] = 0;
        $config['disable_roles'] = array();
        if (!empty($opt_config['disable_user'])) {
            $config['disable_per_adminuser'] = 1;
        }
        if (!empty($opt_config['disable_roles'])) {
            $config['disable_roles'] = $opt_config['disable_roles'];
        }

        if (!self::writeConfig($config)) {
            return false;
        }
        return true;
    }

    /**
     * WPSOL automatically preload cache from home page
     *
     * @return boolean
     */
    public static function cacheHomePage()
    {
        ignore_user_abort(true);

        while (ob_get_level() !== 0) {
            ob_end_clean();
        }

        header('Connection: close', true);
        header("Content-Encoding: none\r\n");

        $args = array(
            'timeout'     => 30,
            'httpversion' => '1.1',
            'headers' => array('Authorpreload' => 'WPSOL_PRELOAD'),
        );

        //Preload for guest
        $response = wp_remote_get(home_url(), $args);
        if (!is_wp_error($response)) {
            $body = wp_remote_retrieve_body($response);
            // scan links from home page to preload them
            $urls = self::scanLinks($body);
            if ($urls) {
                foreach ($urls as $url) {
                    sleep(4);
                    wp_remote_get($url, $args);
                }
            }
            return true;
        }

        return false;
    }

    /**
     * Scan all links in post/page content
     *
     * @param string $content Page content to scan links
     *
     * @return array|false
     */
    public static function scanLinks($content)
    {
        if (!empty($content)) {
            $htmlDom = new DOMDocument;
            //phpcs:ignore Generic.PHP.NoSilencedErrors.Discouraged -- load DOM document
            @$htmlDom->loadHTML($content);
            $anchorTags = $htmlDom->getElementsByTagName('a');
            $urls = array();
            foreach ($anchorTags as $tag) {
                $url = $tag->getAttribute('href');
                if (filter_var($url, FILTER_VALIDATE_URL) !== false) {
                    $urls[] = $url;
                }
            }

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

            // detect and check urls
            $urls = array_unique($urls);
            $return = array();
            foreach ($urls as $url) {
                $url = rtrim($url, '/');
                $parsed = parse_url($url);
                $urlDomain = '';
                if (isset($parsed['scheme']) && isset($parsed['host'])) {
                    $urlDomain = $parsed['scheme'] . '://' . $parsed['host'];
                }
                if (!($urlDomain !== $domain || $url === home_url() || strlen($urlDomain) > 2048)) {
                    $return[] = $url;
                }
            }

            if (!empty($return)) {
                return $return;
            }
        }

        return false;
    }
}
