<?php
namespace Joomunited\WPSOL\Install;

use Joomunited\WPSOL\Cache;
use Joomunited\WPSOL\SpeedOptimization;

if (!defined('ABSPATH')) {
    exit;
}


/**
 * Class Wizard
 */
class Wizard
{
    /**
     * Wizard constructor.
     */
    public function __construct()
    {
    }

    /**
     * Save Environment handle
     *
     * @param string $current_step Current step
     *
     * @return void
     */
    public static function saveEvironment($current_step)
    {
        check_admin_referer('wpsol-setup-wizard', 'wizard_nonce');
        /*
         * Do no thing
         */
        $wizard = new InstallWizard();
        wp_safe_redirect(esc_url_raw($wizard->getNextLink($current_step)));
        exit;
    }

    /**
     * Save Quick configuration handle
     *
     * @param string $current_step Current step
     *
     * @return void
     */
    public static function saveQuickConfig($current_step)
    {
        check_admin_referer('wpsol-setup-wizard', 'wizard_nonce');

        WP_Filesystem();
        /*
         * Install default config
         */
        $default_opts = array(
            'speed_optimization' => array(
                'act_cache' => 1,
                'add_expires' => 1,
                'clean_cache' => 40,
                'clean_cache_each_params' => 2,
                'devices' => array(
                    'cache_desktop' => 1,
                    'cache_tablet' => 1,
                    'cache_mobile' => 1,
                ),
                'query_strings' => 1,
                'remove_rest_api' => 0,
                'remove_rss_feed' => 0,
                'cache_external_script' => 0,
                'disable_page' => array(),
            ),
            'advanced_features' => array(
                'html_minification' => 0,
                'css_minification' => 0,
                'js_minification' => 0,
                'cssgroup_minification' => 0,
                'jsgroup_minification' => 0
            )
        );
        if (file_exists(ABSPATH . 'wp-config.php') && is_writable(ABSPATH . 'wp-config.php')) {
            /**
             * The config file resides in ABSPATH
             */
            $config_is_writeable = true;
        } elseif (file_exists(dirname(ABSPATH) . '/wp-config.php') && is_writable(dirname(ABSPATH) . '/wp-config.php')) {
            /**
             * The config file resides one level above ABSPATH but is not part of another installation
             */
            $config_is_writeable = true;
        } else {
            // A config file doesn't exist or isn't writeable
            $config_is_writeable = false;
        }

        if ($config_is_writeable) {
            $default_opts['speed_optimization']['act_cache'] = 1;
        } else {
            $default_opts['speed_optimization']['act_cache'] = 0;
        }

        update_option('wpsol_optimization_settings', $default_opts);

        //config by default
        $default_config = array(
            'disable_user' => 0,
            'display_clean' => 1
        );
        update_option('wpsol_configuration', $default_config);

        // default cdn
        $default_cdn = array(
            'cdn_active' => 0,
            'cdn_url' => '',
            'cdn_content' => array('wp-content', 'wp-includes'),
            'cdn_exclude_content' => array('.php'),
            'cdn_relative_path' => 1
        );
        update_option('wpsol_cdn_integration', $default_cdn);

        //add header to htaccess by default
        SpeedOptimization::addExpiresHeader(true);
        SpeedOptimization::addGzipHtacess(true);
        //automatic config start cache
        Cache::write();
        Cache::writeConfigCache();

        Cache::toggleCaching(true);

        wp_safe_redirect(esc_url_raw(admin_url('admin.php?page=wpsol_dashboard')));
        exit;
    }

    /**
     * Save Main optimization handle
     *
     * @param string $current_step Current step
     *
     * @return void
     */
    public static function saveMainOptimization($current_step)
    {
        WP_Filesystem();
        check_admin_referer('wpsol-setup-wizard', 'wizard_nonce');
        /*
         * Get option
         */
        $opts = get_option('wpsol_optimization_settings');
        // Set option
        if (isset($opts['speed_optimization'])) {
            if (file_exists(ABSPATH . 'wp-config.php') && is_writable(ABSPATH . 'wp-config.php')) {
                /**
                 * The config file resides in ABSPATH
                 */
                $config_is_writeable = true;
            } elseif (file_exists(dirname(ABSPATH) . '/wp-config.php') && is_writable(dirname(ABSPATH) . '/wp-config.php')) {
                /**
                 * The config file resides one level above ABSPATH but is not part of another installation
                 */
                $config_is_writeable = true;
            } else {
                // A config file doesn't exist or isn't writeable
                $config_is_writeable = false;
            }
            if ($config_is_writeable) {
                $opts['speed_optimization']['act_cache'] = isset($_POST['active_cache']) ? 1 : 0 ;
            } else {
                $opts['speed_optimization']['act_cache'] = 0;
            }
            $opts['speed_optimization']['clean_cache'] = isset($_POST['clean_each']) ? (int)$_POST['clean_each'] : 40 ;
            $opts['speed_optimization']['clean_cache_each_params'] = isset($_POST['clean_each_params']) ? (int)$_POST['clean_each_params'] : 2 ;
            $opts['speed_optimization']['query_strings'] = isset($_POST['remove_query']) ? 1 : 0 ;
            $opts['speed_optimization']['add_expires'] = isset($_POST['add_expired']) ? 1 : 0 ;
            $opts['speed_optimization']['remove_rest_api'] = isset($_POST['disable_rest']) ? 1 : 0 ;
            $opts['speed_optimization']['remove_rss_feed'] = isset($_POST['disable_rss']) ? 1 : 0 ;
        }
        // Update option
        update_option('wpsol_optimization_settings', $opts);

        //add expire header
        if (isset($_POST['add_expired'])) {
            SpeedOptimization::addExpiresHeader(true);
        } else {
            SpeedOptimization::addExpiresHeader(false);
        }

        if (isset($_POST['active_cache'])) {
            //automatic config start cache
            Cache::write();
            Cache::writeConfigCache();
            Cache::toggleCaching(true);
        }

        $wizard = new InstallWizard();
        wp_safe_redirect(esc_url_raw($wizard->getNextLink($current_step)));
        exit;
    }

    /**
     * Save Advanced configuration handle
     *
     * @param string $current_step Current step
     *
     * @return void
     */
    public static function saveAdvancedConfig($current_step)
    {
        check_admin_referer('wpsol-setup-wizard', 'wizard_nonce');
        /*
         * Get option
         */
        $opts = get_option('wpsol_optimization_settings');
        // Set option
        if (isset($opts['advanced_features'])) {
            $opts['advanced_features']['html_minification'] = isset($_POST['minify_html']) ? 1 : 0 ;
            $opts['advanced_features']['css_minification'] = isset($_POST['minify_css']) ? 1 : 0 ;
            $opts['advanced_features']['js_minification'] = isset($_POST['minify_js']) ? 1: 0 ;
            $opts['advanced_features']['cssgroup_minification'] = isset($_POST['group_css']) ? 1 : 0 ;
            $opts['advanced_features']['jsgroup_minification'] = isset($_POST['group_js']) ? 1 : 0 ;
        }
        // Update option
        update_option('wpsol_optimization_settings', $opts);

        $wizard = new InstallWizard();
        wp_safe_redirect(esc_url_raw($wizard->getNextLink($current_step)));
        exit;
    }
}
