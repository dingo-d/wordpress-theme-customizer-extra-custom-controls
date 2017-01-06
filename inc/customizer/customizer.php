<?php
/**
 * Customizer
 *
 * This is a full working example of the customizer and custom controls
 * from this repo.
 *
 * @package WordPress
 * @subpackage inc/customizer
 * @version 1.1.0
 * @author  Denis Žoljom <http://madebydenis.com/>
 * @license https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link https://github.com/dingo-d/wordpress-theme-customizer-extra-custom-controls
 * @since  1.0.0
 */

/**
 * Including custom controls
 */

require_once( get_template_directory() . '/inc/customizer/custom-controls.php' );

add_action( 'customize_register', 'mytheme_customize_register', 11 );
/**
 * Register customizer settings
 *
 * @see add_action('customize_register',$func)
 * @param  \WP_Customize_Manager $wp_customize WP Customize object.
 * @since 1.0.0
 */
function mytheme_customize_register( WP_Customize_Manager $wp_customize ) {

	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	// Add postMessage support for site title and description.
	$wp_customize->get_setting( 'blogname' )->transport            = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport     = 'postMessage';

	// Selective refreshes.
	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector'        => '.site-title',
		'render_callback' => function() {
			return get_bloginfo( 'name', 'display' );
		},
	) );

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector'        => '.site-description',
		'render_callback' => function() {
			return get_bloginfo( 'description', 'display' );
		},
	) );

	/**
	 * Separator Control
	 *
	 * @param  object $wp_customize WP Customize object.
	 * @param  string $section      Name of the section.
	 * @param  int    $priority      Priority number.
	 * @since 1.0.0
	 */
	function mytheme_customizer_separator_control( $wp_customize, $section, $priority = null ) {
		$id = uniqid();
		$sep_var = 'general_sep_' . $id;
		$wp_customize->add_setting( $sep_var, array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		) );
		$wp_customize->add_control( new Separator_Custom_Control( $wp_customize, $sep_var, array(
			'settings' => $sep_var,
			'section'  => $section,
			'priority' => $priority,
		) ) );
	}

	/**
	------------------------------------------------------------
	SECTION: General
	------------------------------------------------------------
	*/
	$wp_customize->add_section( 'section_general', array(
		'title'	   => esc_html__( 'General', 'mytheme' ),
		'priority' => 0,
	) );

	/**
	Grid Width
	*/
	$wp_customize->add_setting( 'grid_width', array(
		'default'           => '1170',
		'transport'	        => 'postMessage',
		'sanitize_callback' => 'mytheme_sanitize_integer',
	) );
	$wp_customize->add_control( 'grid_width', array(
		'label'   => esc_html__( 'Grid Width (px)', 'mytheme' ),
		'section' => 'section_general',
		'type'    => 'select',
		'choices' => array(
			'1200' => esc_html__( '1200', 'mytheme' ),
			'1170' => esc_html__( '1170', 'mytheme' ),
			'1140' => esc_html__( '1140', 'mytheme' ),
			'1080' => esc_html__( '1080', 'mytheme' ),
			'1040' => esc_html__( '1040', 'mytheme' ),
			'980'  => esc_html__( '980', 'mytheme' ),
			'960'  => esc_html__( '960', 'mytheme' ),
		),
	) );

	/**
	------------------------------------------------------------
	SECTION: Body Settings
	------------------------------------------------------------
	*/
	$wp_customize->add_section( 'background_image', array(
		'title'	   => esc_html__( 'Body Settings', 'mytheme' ),
		'priority' => 0,
	) );

	/**
	Boxed Body
	*/
	$wp_customize->add_setting( 'boxed_body', array(
		'default'           => false,
		'transport'	        => 'postMessage',
		'sanitize_callback' => 'mytheme_checkbox_sanitization',
	) );
	$wp_customize->add_control( new Checkbox_Custom_Control( $wp_customize, 'boxed_body', array(
		'label'    	  => esc_html__( 'Boxed Body', 'mytheme' ),
		'description' => esc_html__( 'Check this to enable boxed body layout', 'mytheme' ),
		'type'        => 'checkbox',
		'section'  	  => 'background_image',
		'priority' 	  => 0,
	) ) );

	/**
	Boxed Body Border Width
	*/
	$wp_customize->add_setting( 'boxed_body_border_width', array(
		'default'           => '0',
		'transport'	        => 'postMessage',
		'sanitize_callback' => 'mytheme_sanitize_integer',
	) );
	$wp_customize->add_control( new Slider_Control( $wp_customize, 'boxed_body_border_width', array(
		'label'    	      => esc_html__( 'Boxed Body Border Width (px)', 'mytheme' ),
		'settings' 	      => 'boxed_body_border_width',
		'section'  	      => 'background_image',
		'priority' 	  	  => 0,
	) ) );

	/**
	Boxed Body Border Color
	*/
	$wp_customize->add_setting( 'boxed_body_border_color', array(
		'default'           => '',
		'transport'	        => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boxed_body_border_color', array(
		'label'           => esc_html__( 'Boxed Body Border Color', 'mytheme' ),
		'settings'        => 'boxed_body_border_color',
		'section'         => 'background_image',
		'priority' 	  	  => 0,
	) ) );

	/**
	Boxed Body Border Style
	*/
	$wp_customize->add_setting( 'boxed_body_border_style', array(
		'default'           => 'solid',
		'transport'	        => 'postMessage',
		'sanitize_callback' => 'mytheme_text_sanitization',
	) );
	$wp_customize->add_control( 'boxed_body_border_style', array(
		'label'   => esc_html__( 'Boxed Body Border Style', 'mytheme' ),
		'section' => 'background_image',
		'type'    => 'select',
		'choices' => array(
			'dotted' => esc_html__( 'Dotted', 'mytheme' ),
			'dashed' => esc_html__( 'Dashed', 'mytheme' ),
			'solid'  => esc_html__( 'Solid', 'mytheme' ),
			'double' => esc_html__( 'Double', 'mytheme' ),
			'groove' => esc_html__( 'Groove', 'mytheme' ),
			'ridge'  => esc_html__( 'Ridge', 'mytheme' ),
			'inset'  => esc_html__( 'Inset', 'mytheme' ),
			'outset' => esc_html__( 'Outset', 'mytheme' ),
			),
		'priority' 	  	  => 0,
	) );

	/**
	Separator
	*/
	mytheme_customizer_separator_control( $wp_customize, 'background_image', 1 );

	/**
	------------------------------------------------------------
	SECTION: Sidebars
	------------------------------------------------------------
	*/
	$wp_customize->add_section( 'section_sidebars', array(
		'title'		=> esc_html__( 'Sidebars', 'mytheme' ),
		'priority'	=> 0,
	) );

	/**
	Sidebars
	*/
	$wp_customize->add_setting( 'sidebars', array(
		'default'           => '',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'mytheme_text_sanitization',
	) );
	$wp_customize->add_control( new Multi_Input_Custom_Control( $wp_customize, 'sidebars', array(
		'label'       => esc_html__( 'Sidebars', 'mytheme' ),
		'description' => esc_html__( 'Add as many custom sidebars as you need', 'mytheme' ),
		'type'   	  => 'multi_input',
		'settings'    => 'sidebars',
		'section'     => 'section_sidebars',
	) ) );

	/**
	------------------------------------------------------------
	SECTION: Posts and Page
	------------------------------------------------------------
	*/

	$wp_customize->add_panel( 'posts', array(
		'priority'    => 10,
		'title'       => esc_html__( 'Posts And Pages', 'mytheme' ),
		'description' => esc_html__( 'This panel contains options for blogs and single posts.', 'mytheme' ),
	) );

	/**
	Section: Pages
	*/
	$wp_customize->add_section( 'section_pages', array(
		'title'	   => esc_html__( 'Pages', 'mytheme' ),
		'priority' => 0,
		'panel'    => 'posts',
	) );

	/**
	Page Margin and Padding
	*/

	$wp_customize->add_setting( 'page_box_model', array(
		'default'           => '',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'mytheme_text_sanitization',
	) );

	$wp_customize->add_control( new Box_Model( $wp_customize, 'page_box_model', array(
		'label'       => esc_html__( 'Page Margin and Padding', 'mytheme' ),
		'description' => esc_html__( 'Set the default margin and padding on the default page section.', 'mytheme' ),
		'choices'    => array(
			'margin' => array(
				'margin-top'     => '',
				'margin-right'   => '',
				'margin-bottom'  => '',
				'margin-left'    => '',
			),
			'padding' => array(
				'padding-top'    => '',
				'padding-right'  => '',
				'padding-bottom' => '',
				'padding-left'   => '',
			),
		),
		'section'     => 'section_pages',
	) ) );

	/**
	Section: Blog
	*/
	$wp_customize->add_section( 'section_blog', array(
		'title'	   => esc_html__( 'Blog', 'mytheme' ),
		'priority' => 0,
		'panel'    => 'posts',
	) );

	/**
	Page After Category
	*/
	$wp_customize->add_setting( 'content_after_category', array(
		'default'           => 0,
		'sanitize_callback' => 'mytheme_sanitize_integer',
	) );
	$wp_customize->add_control( 'content_after_category', array(
		'label'       => esc_html__( 'Page After Category', 'mytheme' ),
		'description' => esc_html__( 'Content of the selected page will be shown on Blog Page after all posts.', 'mytheme' ),
		'type'        => 'dropdown-pages',
		'section'     => 'section_blog',
	) );

	/**
	Section: Single Post
	*/
	$wp_customize->add_section( 'section_post', array(
		'title'	   => esc_html__( 'Single Post', 'mytheme' ),
		'priority' => 0,
		'panel'    => 'posts',
	) );

	/**
	Single Post Sidebar
	*/
	$wp_customize->add_setting( 'single_post_sidebar', array(
		'default'           => '',
		'sanitize_callback' => 'mytheme_text_sanitization',
	) );
	$wp_customize->add_control( new Sidebar_Dropdown_Custom_Control( $wp_customize, 'single_post_sidebar', array(
		'label'       => esc_html__( 'Single Post Sidebar', 'mytheme' ),
		'description' => esc_html__( 'Choose the sidebar you wish to appear on single post pages.', 'mytheme' ),
		'settings'    => 'single_post_sidebar',
		'section'     => 'section_post',
	) ) );

	/**
	Page After Single Post
	*/
	$wp_customize->add_setting( 'content_after_single_post', array(
		'default'           => 0,
		'sanitize_callback' => 'mytheme_sanitize_integer',
	) );
	$wp_customize->add_control( 'content_after_single_post', array(
		'label'       => esc_html__( 'Page After Single Post', 'mytheme' ),
		'description' => esc_html__( 'Content of the selected page will be shown on every Single Post Page after post.', 'mytheme' ),
		'type'        => 'dropdown-pages',
		'section'     => 'section_post',
	) );

	/**
	------------------------------------------------------------
	SECTION: Colors
	------------------------------------------------------------
	*/
	$wp_customize->add_section( 'colors', array(
		'title'	   => esc_html__( 'Colors', 'mytheme' ),
		'priority' => 0,
	) );

	/**
	Main Color
	*/
	$wp_customize->add_setting( 'main_color', array(
		'default'           => '#bbbbbb',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_color', array(
		'label'    => esc_html__( 'Main Color', 'mytheme' ),
		'settings' => 'main_color',
		'section'  => 'colors',
	) ) );

	/**
	Body Text Color
	*/
	$wp_customize->add_setting( 'body_text_color', array(
		'default'           => '#333333',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'body_text_color', array(
		'label'    => esc_html__( 'Body Text Color', 'mytheme' ),
		'settings' => 'body_text_color',
		'section'  => 'colors',
	) ));

	/**
	Headings Color
	*/
	$wp_customize->add_setting( 'heading_color', array(
		'default'           => '#333333',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'heading_color', array(
		'label'    => esc_html__( 'Heading Color', 'mytheme' ),
		'settings' => 'heading_color',
		'section'  => 'colors',
	) ) );

	/**
	Links Color
	*/
	$wp_customize->add_setting( 'links_color', array(
		'default'           => '#bbbbbb',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'links_color', array(
		'label'    => esc_html__( 'Links Color', 'mytheme' ),
		'settings' => 'links_color',
		'section'  => 'colors',
	) ) );

	/**
	Links Hover
	*/
	$wp_customize->add_setting( 'links_hover', array(
		'default'           => '#333333',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'links_hover', array(
		'label'    => esc_html__( 'Links Hover', 'mytheme' ),
		'settings' => 'links_hover',
		'section'  => 'colors',
	) ) );
}

add_action( 'customize_controls_enqueue_scripts', 'mytheme_customizer_control_toggle' );
add_action( 'customize_preview_init', 'mytheme_customizer_live_preview' );
/**
 * Live preview script enqueue
 *
 * @since 1.0.0
 */
function mytheme_customizer_live_preview() {
	wp_enqueue_script( 'mytheme-themecustomizer', get_template_directory_uri() . '/inc/customizer/js/customizer.js?v=' . rand(), array( 'jquery', 'customize-preview' ), false );
}

/**
 * Custom contextual controls
 *
 * @since 1.0.0
 */
function mytheme_customizer_control_toggle() {
	wp_enqueue_script( 'mytheme-contextualcontrols', get_template_directory_uri() . '/inc/customizer/js/customizer-contextual.js?v=' . rand(), array( 'customize-controls' ), false );
	wp_add_inline_style( 'customize-controls', '.wp-full-overlay-sidebar { background: #fff }' );
}

