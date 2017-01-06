# Wordpress Theme Customizer Extra Custom controls

Contributors: Denis Žoljom (dingo-d)

Requires at least: 3.9

Tested up to: 4.7

Stable tag: 1.3.0

License: GPLv2 or later

License URI: http://www.gnu.org/licenses/gpl-2.0.html

======

Customizer usage example for WordPress with added custom controls.

This is all GPL, so you're free to use it, but if you use it in your theme or plugin, don't forget to attribute where you've got this from :)

======

## Description

This is a working example of the customizer settings for WordPress theme. You can use it, test it, expand it etc. What ever works for you.

This is a work in progress, so new stuff will be added as time goes on.

## How to use

You can download or clone this repo and then just paste the `\inc` folder inside your theme. Or the `\customizer` folder wherever you want in your theme.

After that be sure to include it in your `functions.php` file

```
require_once( get_template_directory() . '/inc/customizer/customizer.php' );
```

Also if you want to use selective refresh for widgets, and background settings you can use

```
add_action( 'after_setup_theme', 'mytheme_theme_setup' );

if ( ! function_exists( 'mytheme_theme_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since  1.0.0
	 */
	function mytheme_theme_setup() {
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'custom-background' );
	}
}
```

Some of the used sanitization functions, that you can also put in your `functions.php` file are

```
/********* Sanitization Functions ***********/
if ( ! function_exists( 'mytheme_allowed_tags' ) ) {
	/**
	 * Allowed tags function for wp_kses()
	 *
	 * @return array Array of allowed HTML tags
	 * @since 1.0.0
	 */
	function mytheme_allowed_tags() {
		return array(
			'a' => array(
				'href' => array(),
				'title' => array(),
			),
			'br' => array(),
			'span' => array(
				'class' => array(),
			),
			'em' => array(),
			'ul' => array(),
			'ol' => array(),
			'li' => array(),
			'strong' => array(),
			'pre' => array(),
			'code' => array(),
			'blockquote' => array(
				'cite' => true,
			),
			'i' => array(
				'class' => array(),
			),
			'cite' => array(
				'title' => array(),
			),
			'abbr' => array(
				'title' => true,
			),
			'select' => array(
				'id'   => array(),
				'name' => array(),
			),
			'option' => array(
				'value' => array(),
			),
		);
	}
}

if ( ! function_exists( 'mytheme_text_sanitization' ) ) {
	/**
	 * Text sanitization function for Customize API
	 *
	 * @param  string $input Input to be sanitized.
	 * @return string        Sanitized input.
	 * @since 1.0.0
	 */
	function mytheme_text_sanitization( $input ) {
		return wp_kses_post( force_balance_tags( $input ) );
	}
}

if ( ! function_exists( 'mytheme_checkbox_sanitization' ) ) {
	/**
	 * Checkbox sanitization function for Customize API
	 *
	 * @param  string $input Checkbox value.
	 * @return integer       Sanitized value.
	 * @since 1.0.0
	 */
	function mytheme_checkbox_sanitization( $input ) {
		if ( true === $input ) {
			return 1;
		} else {
			return '';
		}
	}
}

if ( ! function_exists( 'mytheme_sanitize_integer' ) ) {
	/**
	 * Integer sanitization function for Customize API
	 *
	 * @param  string $input Input value to check.
	 * @return integer        Returned integer value.
	 * @since 1.0.0
	 */
	function mytheme_sanitize_integer( $input ) {
		if ( is_numeric( $input ) ) {
			return intval( $input );
		}
	}
}
```

![Box Model Custom Control](https://github.com/dingo-d/wordpress-theme-customizer-extra-custom-controls/blob/master/images/customizer-box.jpg)
![Multi Input Custom Control](https://github.com/dingo-d/wordpress-theme-customizer-extra-custom-controls/blob/master/images/customizer-multi-input.jpg)
![Checkbox and Slider Custom Control](https://github.com/dingo-d/wordpress-theme-customizer-extra-custom-controls/blob/master/images/customizer-check-slider.jpg)


## Changelog

### Ver 1.3.0

Added Box Model Custom control

### Ver 1.2.0

* Added Slider Custom control
* Fixed Code

### Ver 1.0.1

* Added Multi Input Custom control
* Added Sidebar Dropdown Custom control
* Added Image Select Custom control
* Sanitized few inputs
* Added .js file for custom controls and updated .css file

### Ver 1.0

* Added Checkbox Switch custom control
- css taken from: https://proto.io/freebies/onoff/
* Added Custom Info control
* Added Custom Separator control
