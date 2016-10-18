<?php
/**
 * Twenty Sixteen Customizer functionality
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

function twentysixteen_customize_register_two( $wp_customize ) {
	$color_scheme = twentysixteen_get_color_scheme();

	// Add header background color setting and control.
	$wp_customize->add_setting( 'header_background_color', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background_color', array(
		'label'       => __( 'Header Background Color', 'twentysixteen' ),
		'section'     => 'colors',
	) ) );

	// Add header text color setting and control.
	$wp_customize->add_setting( 'header_text_color', array(
		'default'           => '#333333',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_text_color', array(
		'label'       => __( 'Header Text Color', 'twentysixteen' ),
		'section'     => 'colors',
	) ) );
	
	// Add inner background color setting and control.
	$wp_customize->add_setting( 'inner_background_color', array(
		'default'           => 'transparent',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inner_background_color', array(
		'label'       => __( 'Inner Background Color', 'twentysixteen' ),
		'section'     => 'colors',
	) ) );
}
add_action( 'customize_register', 'twentysixteen_customize_register_two', 11 );

/**
 * Enqueues front-end CSS for the header background color.
 *
 * @since Twenty Sixteen 1.0
 *
 * @see wp_add_inline_style()
 */
function twentysixteen_header_background_color_css() {
	$default_color         = '#ffffff';
	$header_background_color = get_theme_mod( 'header_background_color', $default_color );

	$css = '
		/* Custom Header Background Color */
		.site-header {
			background-color: %s;
		}
	';

	wp_add_inline_style( 'twentysixteen-style', sprintf( $css, $header_background_color ) );
}
add_action( 'wp_enqueue_scripts', 'twentysixteen_header_background_color_css', 11 );



/**
 * Enqueues front-end CSS for the header text color.
 *
 * @since Twenty Sixteen 1.0
 *
 * @see wp_add_inline_style()
 */
function twentysixteen_header_text_color_css() {
	$default_color   = '#333333';
	$header_text_color = get_theme_mod( 'header_text_color', $default_color );

	$css = '
		/* Custom Header Text Color */
		.site-header,
		.site-header div,
		.site-header a,
		.site-header button,
		.site-header p {
    			color: %s !important;
		}
	';

	wp_add_inline_style( 'twentysixteen-style', sprintf( $css, $header_text_color ) );
}
add_action( 'wp_enqueue_scripts', 'twentysixteen_header_text_color_css', 11 );

/**
 * Enqueues front-end CSS for the inner background color.
 *
 * @since Twenty Sixteen 1.0
 *
 * @see wp_add_inline_style()
 */
function twentysixteen_inner_background_color_css() {
	$default_color         = 'transparent';
	$inner_background_color = get_theme_mod( 'inner_background_color', $default_color );
	$page_background_color = get_theme_mod( 'page_background_color', $default_color );
	
	if ( $inner_background_color && $inner_background_color !== $default_color && $inner_background_color !== $page_background_color ):

		$css = '
			/* Custom Inner Background Color */
			div#primary,
			aside#secondary > section,
			aside#primary > section {
			    background-color: %s;
			}
			
			div#primary,
			aside#secondary > section,
			aside#primary > section {
    			    box-shadow: 0 2px 6px -2px #ccc;
    			    border-radius: 4px;
			}

			div#primary {
			    padding: 60px;
			}

			aside#secondary > section,
			aside#primary > section {
			    padding: 40px;
			}
		';
	
	endif;

	wp_add_inline_style( 'twentysixteen-style', sprintf( $css, $inner_background_color ) );
}
add_action( 'wp_enqueue_scripts', 'twentysixteen_inner_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the widget title borders to take on secondary text color.
 *
 * @since Twenty Sixteen 1.0
 *
 * @see wp_add_inline_style()
 */
function twentysixteen_secondary_text_color_to_border_css() {
	$color_scheme    = twentysixteen_get_color_scheme();
	$default_color   = $color_scheme[4];
	$secondary_text_color = get_theme_mod( 'secondary_text_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $secondary_text_color === $default_color ) {
		return;
	}

	$css = '
		/* Add Secondary Text Color to Widget Title Borders */

		h2.widget-title {
    			border-color: %1$s;
		}
	';

	wp_add_inline_style( 'twentysixteen-style', sprintf( $css, $secondary_text_color ) );
}
add_action( 'wp_enqueue_scripts', 'twentysixteen_secondary_text_color_to_border_css', 11 );