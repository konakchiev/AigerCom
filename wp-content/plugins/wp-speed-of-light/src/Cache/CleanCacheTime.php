<?php
namespace Joomunited\WPSOL\Cache;

use Joomunited\WPSOL\Cache;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Class CleanCacheTime
 */
class CleanCacheTime
{
    /**
     * CleanCacheTime constructor.
     *
     * Create action - init cron schedules
     */
    public function __construct()
    {
        add_action('wpsol_auto_purge_cache', array($this, 'purgeCache'));
        add_action('init', array($this, 'scheduleClearCache'));
        add_filter('cron_schedules', array($this, 'filterCronSchedules'));
    }

    /**
     * Set up schedule_events
     *
     * @return void
     */
    public static function scheduleClearCache()
    {
        $config = get_option('wpsol_optimization_settings');
        $timestamp = wp_next_scheduled('wpsol_auto_purge_cache');
        // Expire cache never
        if (isset($config['speed_optimization']['clean_cache']) && (int)$config['speed_optimization']['clean_cache'] === 0) {
            wp_unschedule_event($timestamp, 'wpsol_auto_purge_cache');
            return;
        }
        if (!$timestamp) {
            wp_schedule_event(time(), 'wpsol_cache', 'wpsol_auto_purge_cache');
        }
    }

    /**
     *  Unschedule events
     *
     * @return void
     */
    public static function unscheduleClearCache()
    {
        $timestamp = wp_next_scheduled('wpsol_auto_purge_cache');
        wp_unschedule_event($timestamp, 'wpsol_auto_purge_cache');
    }

    /**
     * Add custom cron schedule
     *
     * @param array $schedules Time to schedules
     *
     * @return array
     */
    public function filterCronSchedules($schedules)
    {
        $config = get_option('wpsol_optimization_settings');
        $cache_frequency = $config['speed_optimization']['clean_cache'];
        $params = $config['speed_optimization']['clean_cache_each_params'];
        $interval = HOUR_IN_SECONDS;
        if (!empty($cache_frequency) && $cache_frequency > 0) {
            // check parameter
            if ($params === 0) {
                $interval = $cache_frequency * DAY_IN_SECONDS;
            } elseif ($params === 1) {
                $interval = $cache_frequency * HOUR_IN_SECONDS;
            } else {
                $interval = $cache_frequency * MINUTE_IN_SECONDS;
            }
        }

        /**
         * Filter time interval that automatically runs the cache cleaner.
         *
         * @param integer Html raw and header
         *
         * @return integer
         */
        $interval = apply_filters('wpsol_cache_purge_interval', $interval);

        $schedules['wpsol_cache'] = array(
            'interval' => $interval,
            'display' => esc_html__('WPSOL Cache Purge Interval', 'wp-speed-of-light'),
        );

        return $schedules;
    }

    /**
     *   A Cache purse
     *
     * @return void
     */
    public function purgeCache()
    {
        $config = get_option('wpsol_optimization_settings');
        // Do nothing, caching is turned off
        if (empty($config['speed_optimization']['act_cache'])) {
            return;
        }
        /**
         * Automatic delete cache.
         *
         * This hook is also used to automatically delete the cache directory according to a schedule
         *
         * @param array Type of action
         *
         * @ignore Hook already documented
         */
        do_action('wpsol_purge_cache', array('type' => 'automatic'));

        Cache::wpsolCacheFlush();
        \Joomunited\WPSOL\Minification\Cache::clearMinification();
    }
}
