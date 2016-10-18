<?php

remove_theme_support( 'custom-header' );
add_theme_support( 'custom-header', apply_filters( 'twentysixteen_custom_header_args', array(
		'width'                  => 1320,
		'height'                 => 280,
		'flex-height'            => true,
) ) );

/**
 * Customizer additions.
 */
require get_stylesheet_directory() . '/inc/customizer.php';

//* ACF
add_filter('acf/settings/path', 'my_acf_settings_path');
 
function my_acf_settings_path( $path ) {
    $path = get_stylesheet_directory() . '/inc/acf/';
    return $path;
    
}

add_filter('acf/settings/dir', 'my_acf_settings_dir');
 
function my_acf_settings_dir( $dir ) {
 
    // update path
    $dir = get_stylesheet_directory_uri() . '/inc/acf/';
    
    // return
    return $dir;
    
}
/*
add_filter('acf/settings/show_admin', '__return_false');
*/
include_once( get_stylesheet_directory() . '/inc/acf/acf.php' );

function arphabet_widgets_init() {

	register_sidebar( array(
		'name'          => 'Header Left',
		'id'            => 'header_left',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );

		register_sidebar( array(
		'name'          => 'Header Right',
		'description'   => 'This is the section in the top right of the header. If you assign a menu to the "Primary" location, this will disappear.',
		'id'            => 'header_right',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="header-widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => 'Below Header',
		'id'            => 'below_header',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="header-widget-title">',
		'after_title'   => '</h2>',
	) );

}

add_action( 'widgets_init', 'arphabet_widgets_init' );