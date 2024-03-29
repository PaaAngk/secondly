<?php
/**
 * framer Theme Customizer
 *
 * @package framer
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function framer_customize_register( $wp_customize )
{
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	

	function framer_sanitize_textarea( $text )
	{
		return strip_tags( $text, '<p><a><i><br><strong><b><em><ul><li><ol><span><h1><h2><h3><h4>' );
	}

	function framer_sanitize_integer( $text )
	{
		return ( int )$text;
	}
}

add_action( 'customize_register', 'framer_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function framer_customize_preview_js()
{
	wp_enqueue_script( 'framer_customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), '20130515', true );
}

add_action( 'customize_preview_init', 'framer_customize_preview_js' );

function framer_sanitize_color_hex( $value )
{
	if ( !preg_match( '/\#[a-fA-F0-9]{6}/', $value ) ) {
		$value = '#ffffff';
	}

	return $value;
}

function framer_sanitize_int( $value )
{
	return (int)$value;
}

function framer_customizer( $wp_customize )
{

	$wp_customize->add_panel( 'framer_homepage', array(
		'title'    => esc_html__( 'Homepage Setup', 'framer' ),
		'priority' => 10,
	) );

	
	

	// hero banner
	$wp_customize->add_section( 'framer_hero', array(
		'title'       => esc_html__( 'Hero Banner', 'framer' ),
		'priority'    => 50,
		'description' => esc_html__( 'Big banner section on the front page - background image', 'framer' ),
		'panel'       => 'framer_homepage',
	) );



	$wp_customize->add_setting( 'framer_hero_bg_image', array(
		'default'           => get_template_directory_uri() . '/images/header.jpg',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'framer_hero_bg_image', array(
		'label'    => esc_html__( 'Background image', 'framer' ),
		'section'  => 'framer_hero',
		'settings' => 'framer_hero_bg_image',
	) ) );

	$wp_customize->add_setting( 'framer_hero_title', array(
		'default'           => esc_html__( 'Im a Designer.', 'framer' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'framer_hero_title', array(
		'label'   => esc_html__( 'Title', 'framer' ),
		'section' => 'framer_hero',
	) );

	$wp_customize->add_setting( 'framer_hero_text', array(
		'default'           => 'framer is a light-weight and simple WordPress portfolio theme for showing off your latest photos and designs. It works with the Free WooCommerce plugin to create your own eCommerce site. It is super simple to setup with some nice options controlled using the Live Customizer.',
		'sanitize_callback' => 'framer_sanitize_textarea',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'framer_hero_text', array(
		'label'    => esc_html__( 'Main text', 'framer' ),
		'section'  => 'framer_hero',
		'settings' => 'framer_hero_text',
		'type'     => 'textarea',
	) );

	$wp_customize->add_setting( 'framer_hero_button1_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'framer_hero_button1_show', array(
		'label'    => esc_html__( 'Show button 1', 'framer' ),
		'section'  => 'framer_hero',
		'settings' => 'framer_hero_button1_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => esc_html__( 'Yes', 'framer' ), 'no' => esc_html__( 'No', 'framer' ) ),
	) );

	$wp_customize->add_setting( 'framer_hero_button1_text', array(
		'default'           => esc_html__( 'About us', 'framer' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'framer_hero_button1_text', array(
		'label'    => esc_html__( 'Button 1 text', 'framer' ),
		'section'  => 'framer_hero',
		'settings' => 'framer_hero_button1_text',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'framer_hero_button1_link', array(
		'default'           => home_url(),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'framer_hero_button1_link', array(
		'label'    => esc_html__( 'Button 1 link', 'framer' ),
		'section'  => 'framer_hero',
		'settings' => 'framer_hero_button1_link',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'framer_hero_button2_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'framer_hero_button2_show', array(
		'label'    => esc_html__( 'Show button 2', 'framer' ),
		'section'  => 'framer_hero',
		'settings' => 'framer_hero_button2_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => esc_html__( 'Yes', 'framer' ), 'no' => esc_html__( 'No', 'framer' ) ),
	) );

	$wp_customize->add_setting( 'framer_hero_button2_text', array(
		'default'           => esc_html__( 'Contact', 'framer' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'framer_hero_button2_text', array(
		'label'    => esc_html__( 'Button 2 text', 'framer' ),
		'section'  => 'framer_hero',
		'settings' => 'framer_hero_button2_text',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'framer_hero_button2_link', array(
		'default'           => home_url(),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'framer_hero_button2_link', array(
		'label'    => esc_html__( 'Button 2 link', 'framer' ),
		'section'  => 'framer_hero',
		'settings' => 'framer_hero_button2_link',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'framer_hero_blur_enabled', array(
		'default'           => 0,
		'sanitize_callback' => 'framer_sanitize_int',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'framer_hero_blur_enabled', array(
		'label'    => esc_html__( 'Blur amount (pixels)', 'framer' ),
		'section'  => 'framer_hero',
		'settings' => 'framer_hero_blur_enabled',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'framer_hero_overlay_enabled', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'framer_hero_overlay_enabled', array(
		'label'    => esc_html__( 'Overlay the image with color', 'framer' ),
		'section'  => 'framer_hero',
		'settings' => 'framer_hero_overlay_enabled',
		'type'     => 'select',
		'choices'  => array( 'yes' => esc_html__( 'Yes', 'framer' ), 'no' => esc_html__( 'No', 'framer' ) ),
	) );

	$wp_customize->add_setting( 'framer_hero_overlay_color', array(
		'default'           => '#000',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'framer_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hero_overlay', array(
		'label'    => esc_html__( 'Hero image overlay color', 'framer' ),
		'section'  => 'framer_hero',
		'settings' => 'framer_hero_overlay_color',
	) ) );


	$wp_customize->add_setting( 'framer_hero_overlay_opacity', array(
		'default'           => '80',
		'sanitize_callback' => 'framer_sanitize_int',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'framer_hero_overlay_opacity', array(
		'label'    => esc_html__( 'Overlay opacity (between 0 and 100)', 'framer' ),
		'section'  => 'framer_hero',
		'settings' => 'framer_hero_overlay_opacity',
		'type'     => 'text',
	) );

	// end hero banner
	

	// social
	$wp_customize->add_section( 'framer_header_social', array(
		'title'    => esc_html__( 'Social', 'framer' ),
		'priority' => 50,
		'panel'    => 'framer_homepage',
	) );
	$wp_customize->add_setting( 'framer_header_social_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'framer_header_social_show', array(
		'label'    => esc_html__( 'Show social icons below the hero banner text', 'framer' ),
		'section'  => 'framer_header_social',
		'settings' => 'framer_header_social_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => esc_html__( 'Yes', 'framer' ), 'no' => esc_html__( 'No', 'framer' ) ),
	) );

	$wp_customize->add_setting( 'framer_header_social_twitter', array(
		'default'           => esc_html__( 'http://twitter.com', 'framer' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'framer_header_social_twitter', array(
		'label'   => esc_html__( 'Twitter URL', 'framer' ),
		'section' => 'framer_header_social',
	) );

	$wp_customize->add_setting( 'framer_header_social_facebook', array(
		'default'           => esc_html__( 'http://facebook.com', 'framer' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'framer_header_social_facebook', array(
		'label'   => esc_html__( 'Facebook URL', 'framer' ),
		'section' => 'framer_header_social',
	) );

	$wp_customize->add_setting( 'framer_header_social_pinterest', array(
		'default'           => esc_html__( 'http://pinterest.com', 'framer' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'framer_header_social_pinterest', array(
		'label'   => esc_html__( 'Pinterest URL', 'framer' ),
		'section' => 'framer_header_social',
	) );

	$wp_customize->add_setting( 'framer_header_social_linkedin', array(
		'default'           => esc_html__( 'http://linkedin.com', 'framer' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'framer_header_social_linkedin', array(
		'label'   => esc_html__( 'LinkedIn URL', 'framer' ),
		'section' => 'framer_header_social',
	) );

	$wp_customize->add_setting( 'framer_header_social_gplus', array(
		'default'           => esc_html__( 'http://plus.google.com', 'framer' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'framer_header_social_gplus', array(
		'label'   => esc_html__( 'Google+ URL', 'framer' ),
		'section' => 'framer_header_social',
	) );

	$wp_customize->add_setting( 'framer_header_social_behance', array(
		'default'           => esc_html__( 'http://behance.net', 'framer' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'framer_header_social_behance', array(
		'label'   => esc_html__( 'Behance URL', 'framer' ),
		'section' => 'framer_header_social',
	) );

	$wp_customize->add_setting( 'framer_header_social_dribbble', array(
		'default'           => esc_html__( 'http://dribbble.com', 'framer' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'framer_header_social_dribbble', array(
		'label'   => esc_html__( 'Dribbble URL', 'framer' ),
		'section' => 'framer_header_social',
	) );

	$wp_customize->add_setting( 'framer_header_social_dribbble', array(
		'default'           => esc_html__( 'http://dribbble.com', 'framer' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'framer_header_social_dribbble', array(
		'label'   => esc_html__( 'Dribbble URL', 'framer' ),
		'section' => 'framer_header_social',
	) );

	$wp_customize->add_setting( 'framer_header_social_flickr', array(
		'default'           => esc_html__( 'http://flickr.com', 'framer' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'framer_header_social_flickr', array(
		'label'   => esc_html__( 'Flickr URL', 'framer' ),
		'section' => 'framer_header_social',
	) );

	$wp_customize->add_setting( 'framer_header_social_500px', array(
		'default'           => esc_html__( 'http://500px.com', 'framer' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'framer_header_social_500px', array(
		'label'   => esc_html__( '500px URL', 'framer' ),
		'section' => 'framer_header_social',
	) );

	$wp_customize->add_setting( 'framer_header_social_reddit', array(
		'default'           => esc_html__( 'http://reddit.com', 'framer' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'framer_header_social_reddit', array(
		'label'   => esc_html__( 'Reddit URL', 'framer' ),
		'section' => 'framer_header_social',
	) );

	$wp_customize->add_setting( 'framer_header_social_wordpress', array(
		'default'           => esc_html__( 'http://wordpress.com', 'framer' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'framer_header_social_wordpress', array(
		'label'   => esc_html__( 'Wordpress URL', 'framer' ),
		'section' => 'framer_header_social',
	) );

	$wp_customize->add_setting( 'framer_header_social_youtube', array(
		'default'           => esc_html__( 'http://youtube.com', 'framer' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'framer_header_social_youtube', array(
		'label'   => esc_html__( 'Youtube URL', 'framer' ),
		'section' => 'framer_header_social',
	) );

	$wp_customize->add_setting( 'framer_header_social_soundcloud', array(
		'default'           => esc_html__( 'http://soundcloud.com', 'framer' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'framer_header_social_soundcloud', array(
		'label'   => esc_html__( 'Soundcloud URL', 'framer' ),
		'section' => 'framer_header_social',
	) );

	$wp_customize->add_setting( 'framer_header_social_medium', array(
		'default'           => esc_html__( 'http://medium.com', 'framer' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'framer_header_social_medium', array(
		'label'   => esc_html__( 'Medium URL', 'framer' ),
		'section' => 'framer_header_social',
	) );
	// end social

	
		// Latest Text
	$wp_customize->add_section( 'Latest_Text', array(
		'title'       => esc_html__( 'Latest Work', 'framer' ),
		'priority'    => 51,
		'description' => esc_html__( 'Latest Work Text', 'framer' ),
		'panel'       => 'framer_homepage',
	) );

	
		$wp_customize->add_setting( 'framer_latest_title_l', array(
		'default'           => esc_html__( 'Check out My Latest Work', 'framer' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'framer_latest_title_l', array(
		'label'   => esc_html__( 'Latest Work Title', 'framer' ),
		'section' => 'Latest_Text',
	) );

	$wp_customize->add_setting( 'framer_latest_text_l', array(
		'default'           => 'Here is a selection of images, photographs and designs I have created.',
		'sanitize_callback' => 'framer_sanitize_textarea',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'framer_latest_text_l', array(
		'label'    => esc_html__( 'Latest Work Text', 'framer' ),
		'section'  => 'Latest_Text',
		'settings' => 'framer_latest_text_l',
		'type'     => 'textarea',
	) );


	
	//End footer feature

	// google fonts
	require_once( dirname( __FILE__ ) . '/google-fonts/fonts.php' );


	$wp_customize->add_section( 'framer_google_fonts', array(
		'title'    => esc_html__( 'Fonts', 'framer' ),
		'priority' => 50,
	) );

	$wp_customize->add_setting( 'framer_google_fonts_heading_font', array(
		'default'           => 'none',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'framer_google_fonts_heading_font', array(
		'label'    => esc_html__( 'Header Font', 'framer' ),
		'section'  => 'framer_google_fonts',
		'settings' => 'framer_google_fonts_heading_font',
		'type'     => 'select',
		'choices'  => $font_choices,
	) );

	$wp_customize->add_setting( 'framer_google_fonts_body_font', array(
		'default'           => 'none',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'framer_google_fonts_body_font', array(
		'label'    => esc_html__( 'Body Font', 'framer' ),
		'section'  => 'framer_google_fonts',
		'settings' => 'framer_google_fonts_body_font',
		'type'     => 'select',
		'choices'  => $font_choices,
	) );
	// end google fonts

	// colors

	$wp_customize->add_setting( 'framer_accent_color', array(
		'default'           => '#57c66d',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'framer_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent', array(
		'label'    => esc_html__( 'Accent color', 'framer' ),
		'section'  => 'colors',
		'settings' => 'framer_accent_color',
	) ) );

	// end colors

}

add_action( 'customize_register', 'framer_customizer', 11 );