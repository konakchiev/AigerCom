<?php
if (!defined('ABSPATH')) {
    exit;
}
if (!defined('IFRAME_REQUEST') && isset($_GET['action']) &&
    //phpcs:disable -- ignore WordPress.Security.NonceVerification, WordPress.WP.GlobalVariablesOverride.Prohibited
    in_array($_GET['action'], array('update-selected', 'activate-plugin', 'update-selected-themes'))) {
    define('IFRAME_REQUEST', true);
}


require_once(ABSPATH . 'wp-admin/admin.php');
include_once(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');

$slug = 'imagerecycle-pdf-image-compression';
$plugin_file = 'imagerecycle-pdf-image-compression/wp-image-recycle.php';

if (isset($_GET['action'])) {
    //phpcs:ignore WordPress.Security.NonceVerification -- Check request, no action
    $plugin = isset($_REQUEST['plugin']) ? trim($_REQUEST['plugin']) : '';
    //phpcs:ignore WordPress.Security.NonceVerification -- Check request, no action
    $request_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
    if ('install-plugin' === $request_action) {
        if (!current_user_can('install_plugins')) {
            wp_die(esc_html__('You do not have sufficient permissions to install plugins on this site.', 'wp-speed-of-light'));
        }
        include_once(ABSPATH . 'wp-admin/includes/plugin-install.php'); //for plugins_api..
        check_admin_referer('install-plugin_' . $plugin);
        $api = plugins_api('plugin_information', array(
            'slug' => $plugin,
            'fields' => array(
                'short_description' => false,
                'sections' => false,
                'requires' => false,
                'rating' => false,
                'ratings' => false,
                'downloaded' => false,
                'last_updated' => false,
                'added' => false,
                'tags' => false,
                'compatibility' => false,
                'homepage' => false,
                'donate_link' => false,
            ),
        ));
        if (is_wp_error($api)) {
            wp_die(esc_html($api));
        }
        $plugin_title = __('Plugin Install', 'wp-speed-of-light');
        $plugin_parent_file = 'plugins.php';
        $plugin_submenu_file = 'plugin-install.php';

        $plugin_title = sprintf(__('Installing Plugin: %s', 'wp-speed-of-light'), $api->name . ' ' . $api->version);
        $nonce = 'install-plugin_' . $plugin;
        $url = 'update.php?action=install-plugin&plugin=' . urlencode($plugin);
        if (isset($_GET['from'])) {
            $url .= '&from=' . urlencode(stripslashes($_GET['from']));
        }
        $plugin_type = 'web'; //Install plugin type, From Web or an Upload.

        $upgrader = new Plugin_Upgrader(new Plugin_Installer_Skin(compact('plugin_title', 'url', 'nonce', 'plugin', 'api')));
        $upgrader->install($api->download_link);
    } elseif ('activate' === $request_action) {
        if (!current_user_can('activate_plugins')) {
            wp_die(esc_html__('You do not have sufficient permissions to
             activate plugins for this site.', 'wp-speed-of-light'));
        }


        if (is_multisite() && !is_network_admin() && is_network_only_plugin($plugin)) {
            wp_redirect(self_admin_url('plugins.php?plugin_status='.$status.'&paged='.$page.'&s='.$s));
            exit;
        }

        check_admin_referer('activate-plugin_' . $plugin);
        $self_admin = self_admin_url('plugins.php?error=true&plugin=' . $plugin);
        $result = activate_plugin($plugin, $self_admin, is_network_admin());
        if (is_wp_error($result)) {
            if ('unexpected_output' === $result->get_error_code()) {
                $redirect = self_admin_url('plugins.php?error=true&charsout=' . strlen($result->get_error_data()) .
                                           '&plugin=' . $plugin . '&plugin_status='.$status.'&paged='.$page.'&s='.$s);
                $c_nonce = wp_create_nonce('plugin-activation-error_' . $plugin);
                wp_redirect(add_query_arg('_error_nonce', $c_nonce, $redirect));
                exit;
            } else {
                wp_die(esc_html($result));
            }
        }

        if (!is_network_admin()) {
            $recent = (array)get_option('recently_activated');
            unset($recent[$plugin]);
            update_option('recently_activated', $recent);
        } else {
            $recent = (array)get_site_option('recently_activated');
            unset($recent[$plugin]);
            update_site_option('recently_activated', $recent);
        }

        if (isset($_GET['from']) && 'import' === $_GET['from']) {
            wp_redirect(self_admin_url('import.php?import=' . str_replace('-importer', '', dirname($plugin)))); // overrides the ?error=true one above and redirects to the Imports page, stripping the -importer suffix
        } else {
            $image_compression_url = 'admin.php?page=wpsol_image_compression&wpmsactive=imagerecycle';
            wp_redirect(self_admin_url($image_compression_url)); // overrides the ?error=true one above
        }
    }
}
$button = '';
$check_install = false;
if (!file_exists(WP_PLUGIN_DIR . '/imagerecycle-pdf-image-compression')) {
    $slug_url = 'admin.php?page=wpsol_image_compression&action=install-plugin&plugin=' . $slug;
    $url = wp_nonce_url(self_admin_url($slug_url), 'install-plugin_' . $slug);
    if (is_multisite()) {
        if (current_user_can('manage_network_plugins')) {
            $button = '<a style="float: right; background: #554766;
             line-height: 18px; text-align: center; color: #fff;font-size: 14px;text-decoration: none;
              text-transform: uppercase; padding: 5px 20px; font-weight:bold;" target="_blank"
               class="edit" data-slug="imagerecycle-pdf-image-compression" href="' . $url . '" 
               aria-label="Install ImageRecycle pdf &amp; image compression 2.1.1 now" 
               data-name="ImageRecycle pdf &amp; image compression 2.1.1">'
                      . __('Install ImageRecycle plugin', 'wp-speed-of-light') . '</a>';
        }
    } else {
        $button = '<a style="float: right; background: #554766;line-height: 18px;
         text-align: center;color: #fff;font-size: 14px;text-decoration: none; text-transform: uppercase;
          padding: 5px 20px; font-weight:bold;" target="_blank" class="edit"
           data-slug="imagerecycle-pdf-image-compression"
           href="' . $url . '" aria-label="Install ImageRecycle pdf &amp; image compression 2.1.1 now"
            data-name="ImageRecycle pdf &amp; image compression 2.1.1">' .
                  __('Install ImageRecycle plugin', 'wp-speed-of-light') . '</a>';
    }
} else {
    if (!is_plugin_active($plugin_file)) {
        $plugin_url ='admin.php?page=wpsol_image_compression&action=activate&amp;plugin=' . $plugin_file;
        $url = wp_nonce_url($plugin_url, 'activate-plugin_' . $plugin_file);
        if (is_multisite()) {
            if (current_user_can('manage_network_plugins')) {
                $button = '<a style="float: right; background: #554766; line-height: 18px;
                 text-align: center;  color: #fff;font-size: 14px;text-decoration: none; text-transform: uppercase;
                 padding: 5px 20px; font-weight:bold;" href="' . $url . '" class="edit"
                 aria-label="Activate ImageRecycle pdf &amp; image compression">' .
                          __('Activate Plugin', 'wp-speed-of-light') . '</a>';
            }
        } else {
            $button = '<a style="float: right; background: #554766; line-height: 18px;
              text-align: center;color: #fff;font-size: 14px;text-decoration: none; text-transform: uppercase;
              padding: 5px 20px; font-weight:bold;" href="' . $url . '" class="edit"
              aria-label="Activate ImageRecycle pdf &amp; image compression">' .
                      __('Activate Plugin', 'wp-speed-of-light') . '</a>';
        }
    } else {
        $check_install = true;
        $button = '<a style="width: 250px; float: right; background: #554766;
        line-height: 18px; text-align: center;  margin-left:4px;color: #fff;font-size: 14px;
        text-decoration: none; text-transform: uppercase; padding: 8px 20px; font-weight:bold;" class="edit"
        href="upload.php?page=wp-image-recycle-page" aria-label="Activate ImageRecycle pdf &amp; image compression">' .
                  __('ImageRecycle is properly installed: manage images', 'wp-speed-of-light') . '</a>';
    }
}
?>

<?php if ($check_install === true) : ?>
    <div class="main-presentation"
         style="margin: 0 auto; max-width: 1200px; background-color:#f0f1f4;font-family: helvetica,arial,sans-serif;">
        <div class="main-textcontent"
             style="margin: 0 auto; min-height: 400px; border-left: 1px dotted #d2d3d5;
              border-right: 1px dotted #d2d3d5; width: 840px; background-color:#fff;border-top: 5px solid #544766;"
             cellspacing="0" cellpadding="0" align="center">
            <a href="https://www.imagerecycle.com/" target="_blank"> <img
                        src="https://www.imagerecycle.com/images/Notification-mail/logo-image-recycle.png"
                        alt="logo image recycle" width="500" height="84" class="CToWUd"
                        style="display: block; outline: medium none; text-decoration: none; margin-left: auto;
                         margin-right: auto; margin-top:15px;">
            </a>
            <p style="background-color: #ffffff; color: #445566; font-family: helvetica,arial,sans-serif;
             font-size: 24px; line-height: 24px; padding-right: 10px; padding-left: 10px;"
               align="center"><strong>Great! ImageRecycle is installed<br></strong></p>
            <p style="background-color: #ffffff; color: #445566; font-family: helvetica,arial,sans-serif;
             font-size: 14px; line-height: 22px; padding-left: 20px; padding-right: 20px; text-align: center;">
                <strong>Speed optimization of your WordPress website is highly recommended for SEO. The image
                    compression is one of the tools that help to reduce your page size significantly while preserving
                    the image quality.<br/><br/>You can now manage all you images and compression from the ImageRecycle
                    plugin, menu Media > ImageRecycle.<br/><br/></strong> ImageRecycle got a dedicated plugin for
                WordPress that run the images optimization automatically on your website &amp; PDF
                <br/>In order to start the optimization process, please install the WordPress plugin. Enjoy!</p>
            <p></p>
            <p>
            <?php
            //phpcs:ignore WordPress.Security.EscapeOutput -- Render button imagerecycle
            echo $button;
            ?>
            </p>
        </div>
    </div>
<?php else : ?>
    <div class="main-presentation"
         style="margin: 0 auto; max-width: 1200px; background-color:#f0f1f4;font-family: helvetica,arial,sans-serif;">
        <div class="main-presentation"
             style="margin: 0 auto; max-width: 1200px; background-color:#f0f1f4;
             font-family: helvetica,arial,sans-serif;">
            <div class="main-textcontent"
                 style="margin: 0 auto; min-height: 400px; border-left: 1px dotted #d2d3d5;
                  border-right: 1px dotted #d2d3d5; width: 840px; background-color:#fff;border-top: 5px solid #544766;"
                 cellspacing="0" cellpadding="0" align="center">
                <a href="https://www.imagerecycle.com/" target="_blank"> <img
                            src="https://www.imagerecycle.com/images/Notification-mail/logo-image-recycle.png"
                            alt="logo image recycle" width="500" height="84"
                            style="display: block; outline: medium none; text-decoration: none; margin-left: auto;
                            margin-right: auto; margin-top:15px;">
                </a>
                <p style="background-color: #ffffff; color: #445566; font-family: helvetica,arial,sans-serif;
                 font-size: 24px; line-height: 24px; padding-right: 10px; padding-left: 10px;"
                   align="center"><strong>Get faster with lightweight images!<br></strong></p>
                <p style="background-color: #ffffff; color: #445566; font-family: helvetica,arial,sans-serif;
                 font-size: 14px; line-height: 22px; padding:20px; text-align: center;">
                    <strong>Speed optimization of your WordPress website is highly recommended for SEO. The image
                        compression is one of the tools that help to reduce your page size significantly while
                        preserving the image quality.<br><img
                                src="https://www.imagerecycle.com/images/No-compress/Optimization.gif"
                                alt="optimization"
                                style="display: block; outline: medium none; text-decoration: none; margin-left: auto;
                                 margin-right: auto; margin-top:15px;"><br>WP
                        Speed of Light is fully integrated with ImageRecycle service, you have a free trial with no
                        engagement and we provide a 20% OFF coupon! Use the coupon here: <a
                                href="https://www.imagerecycle.com/" target="_blank">www.imagerecycle.com</a></strong>
                </p>
                <div style="background-color:#fafafa; border: 2px dashed #ccc; border-left: 5px solid #A1B660;
                 font-size: 30px; padding: 20px; line-height: 40px;">
                    ImageRecycle 20% OFF, apply on all memberships: WPSPEED-20
                </div>
                <p style="background-color: #ffffff; color: #445566; font-family: helvetica,arial,sans-serif;
                font-size: 12px; line-height: 22px; padding-left: 20px; padding-right: 20px;
                text-align: center;  font-style: italic;">
                    ImageRecycle got a dedicated plugin for WordPress that run the images and PDF optimization
                    automatically on your website.
                    <br>In order to start the optimization process, please install the WordPress plugin. Enjoy!</p>
                <p></p>
                <p>
                    <a style="float: right; background: #554766;line-height: 18px; text-align: center;
                    color: #fff;font-size: 14px;text-decoration: none;
                     text-transform: uppercase; padding: 8px 30px; font-weight:bold;
                    letter-spacing: 0.8px;box-shadow: 1px 1px 12px #ccc;"
                       target="_blank" class="edit" data-slug="imagerecycle-pdf-image-compression"
                       href="https://www.imagerecycle.com/cms/wordpress">Install ImageRecycle plugin</a></p>
            </div>
        </div>
    </div>

<?php endif; ?>
