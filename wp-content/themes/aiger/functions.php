<?php
//Add Theme Support
add_theme_support( 'title-tag' );
//Add menus
add_theme_support( 'menus' );
//Add Featured Image
add_theme_support( 'post-thumbnails' );
//Add Custom Logo
add_theme_support( 'custom-logo', array(
        'flex-width'	=> true
    )
);
add_filter( 'wp_title', 'wpdocs_hack_wp_title_for_home' );

// Title
function wpdocs_hack_wp_title_for_home( $title )
{
    if (empty($title) && (is_home() || is_front_page())) {
        $title = __('Home', 'textdomain') . ' | ' . get_bloginfo('description');
    }
    return $title;
}


//Add CSS Files
function webix_theme_styles() {
    //Bootstrap CSS
    wp_enqueue_style( 'bootstrap_css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' );
    //Main CSS
    wp_enqueue_style( 'main_css', get_template_directory_uri() . '/assets/css/style.css' );
    //Google Fonts
    wp_enqueue_style( 'google_font', 'https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i' );
    //Font Awesome
    wp_enqueue_style( 'fontawesome_css', 'https://use.fontawesome.com/releases/v5.3.1/css/all.css' );
}
add_action( 'wp_enqueue_scripts' , 'webix_theme_styles' );


//Add JavaScript Files
function webix_theme_js() {
    //Bootstrap
    wp_enqueue_script( 'bootstrap_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array('jquery'), '', true );
    //Main JS
    wp_enqueue_script( 'main_js', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), '', true );
}
add_action( 'wp_enqueue_scripts', 'webix_theme_js' );


//Register Theme Menus
function register_theme_menus() {
    register_nav_menus(array(
            'primary-menu' => __( 'Primary Menu' ),
            'footer-menu' => __( 'Footer Menu' ),
            'top-menu'   => __('Top Menu')
        )
    );
}
add_action( 'init', 'register_theme_menus' );

// ACF Google Maps API
function my_acf_init() {
    acf_update_setting('google_api_key', 'AIzaSyACZ0Pn9cczciffEc9zGN0ufinSFxIdlZo');
}
add_action('acf/init', 'my_acf_init');


// Register Widgets
function webix_create_widget( $name, $id, $description ) {
    register_sidebar(array(
            'name' => __($name),
            'id' => $id,
            'description' => __($description),
            'before_widget' => '<div class="widgte">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="module_heading">',
            'after_title' => '</h2>'
        )
    );
}
webix_create_widget( 'Blog Sidebar', 'blog', 'Displays on the side of blogs' );
webix_create_widget( 'Footer First Column', 'footer', 'Display on footer' );
webix_create_widget( 'Footer Second Column', 'footer-second', 'Display on footer second column' );
webix_create_widget( 'Footer Third Column', 'footer-third', 'Display on footer third column' );
webix_create_widget( 'Footer Fourth Column', 'footer-fourth', 'Display on footer fourth column' );
?>