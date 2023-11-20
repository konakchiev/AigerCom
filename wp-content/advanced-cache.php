<?php 
defined( 'ABSPATH' ) || exit;
define( 'WPSOL_ADVANCED_CACHE', true );
if ( is_admin() ) { return; }
if ( ! @file_exists( '/Applications/XAMPP/xamppfiles/htdocs/AigerCom/wp-content/plugins/wp-speed-of-light/wp-speed-of-light.php' ) ) { return; }
if ( ! @file_exists( '/Applications/XAMPP/xamppfiles/htdocs/AigerCom/wp-content/wpsol-config/speed-of-light-config.php' ) ) { return; }
$GLOBALS['wpsol_config'] = include( '/Applications/XAMPP/xamppfiles/htdocs/AigerCom/wp-content/wpsol-config/speed-of-light-config.php' );
if ( empty( $GLOBALS['wpsol_config'] ) ||
                 empty( $GLOBALS['wpsol_config']['speed_optimization']['act_cache'] ) ) { return; }
if ( @file_exists( '/Applications/XAMPP/xamppfiles/htdocs/AigerCom/wp-content/plugins/wp-speed-of-light/src/Cache/file-page-cache.php' ) ) { include_once( '/Applications/XAMPP/xamppfiles/htdocs/AigerCom/wp-content/plugins/wp-speed-of-light/src/Cache/file-page-cache.php' ); }
