(function($, api) {
	'use strict';

	// Every control is linked to a certain class that can change with the theme, be sure to change that out.
	// For instance: page_box_model control will toggle .page_main_section element, but this can be reused for other elements.

	function mytheme_dynamic_css_targets( value ) {
		var css_styles_targets = '<style id="customizer_dynamic_color_css_' + value + '" type="text/css"></style>';
		if ( ! $( '#customizer_dynamic_color_css_' + value ).length) {
			$( '#mytheme_main_css-inline-css' ).after( css_styles_targets );
		}
	}

	/********* Sidebars ***********/
	api( 'sidebars', function(value) {
		value.bind(function(newval) {
		});
	});

	/********* Dynamcic Colors ***********/

	// Main element color.
	api( 'main_color', function(value) {
		value.bind(function(newval) {
			mytheme_dynamic_css_targets( 'main_color' );
			var new_colors = 'hr{ background-color: ' + newval + ' !important; } ::selection{ background: ' + newval + ' !important; } ::-moz-selection{ background: ' + newval + ' !important; } button,input,select,textarea{ border: 1px solid ' + newval + ' !important; } .highlighted, .search-highlight{ background: ' + newval + ' !important; } .placeholder{ color: ' + newval + ' !important; }';
			$( '#customizer_dynamic_color_css_main_color' ).text( new_colors );
		});
	});

	// Heading color.
	api( 'heading_color', function(value) {
		value.bind(function(newval) {
			mytheme_dynamic_css_targets( 'heading_color' );
			var new_colors = 'h1, h2, h3, h4, h5, h6{ color: ' + newval + '!important; }';
			$( '#customizer_dynamic_color_css_heading_color' ).text( new_colors );
		});
	});

	api( 'body_text_color', function(value) {
		value.bind(function(newval) {
			mytheme_dynamic_css_targets( 'body_text_color' );
			var new_colors = 'body{color:' + newval + ';}';
			$( '#customizer_dynamic_color_css_body_text_color' ).text( new_colors );
		});
	});

	// Boxed Body Toggle.
	api( 'boxed_body', function(value) {
		value.bind(function(newval) {
			if (newval) {
				$( 'body' ).wrapInner( '<div class="boxed_body_wrapper" />' );
			} else {
				$( '.boxed_body_wrapper' ).contents().unwrap();
			}
		});
	});

	// Boxed Body Border color.
	api( 'boxed_body_border_color', function(value) {
		value.bind(function(newval) {
			mytheme_dynamic_css_targets( 'boxed_body_border_color' );
			var new_colors = '.boxed_body_wrapper{border-right-color: ' + newval + '; border-left-color: ' + newval + ';}';
			$( '#customizer_dynamic_color_css_boxed_body_border_color' ).text( new_colors );

		});
	});

	// Boxed Body Border width.
	api( 'boxed_body_border_width', function(value) {
		value.bind(function(newval) {
			mytheme_dynamic_css_targets( 'boxed_body_border_width' );
			var width = '.boxed_body_wrapper{border-right-width: ' + newval + 'px; border-left-width: ' + newval + 'px;}';
			$( '#customizer_dynamic_color_css_boxed_body_border_width' ).text( width );

		});
	});

	// Boxed Body Border style.
	api( 'boxed_body_border_style', function(value) {
		value.bind(function(newval) {
			mytheme_dynamic_css_targets( 'boxed_body_border_style' );
			var style = '.boxed_body_wrapper{border-style: ' + newval + ';}';
			$( '#customizer_dynamic_color_css_boxed_body_border_style' ).text( style );

		});
	});

	// Page section margin and padding.
	api( 'page_box_model', function(value) {
		value.bind(function(newval) {
			mytheme_dynamic_css_targets( 'page_box_model' );
			var values_array = newval.split(', ');
			values_array = values_array.map(function(item) { // Replaces '-' with '0'
				return '-' === item ? '0' : item;
			});
			var style = '.page_main_section{margin: ' + values_array[0] + 'px ' + values_array[1] + 'px ' + values_array[2] + 'px ' + values_array[3] + 'px' + '; padding: ' + values_array[4] + 'px ' + values_array[5] + 'px ' + values_array[6] + 'px ' + values_array[7] + 'px' + ' ;}';
			$( '#customizer_dynamic_color_css_page_box_model' ).text( style );

		});
	});

	// Grid Width.
	api( 'grid_width', function(value) {
		value.bind(function(newval) {
			mytheme_dynamic_css_targets( 'grid_width' );
			var width;
			switch ( newval ) {
				case '1200':
					width = '.container, .sf-mega{width: ' + newval + 'px;}';
					$( '#customizer_dynamic_color_css_grid_width' ).text( width );
					break;
				case '1170':
					width = '.container, .sf-mega{width: ' + newval + 'px;}';
					$( '#customizer_dynamic_color_css_grid_width' ).text( width );
					break;
				case '1140':
					width = '.container, .sf-mega{width: ' + newval + 'px;}';
					$( '#customizer_dynamic_color_css_grid_width' ).text( width );
					break;
				case '1080':
					width = '.container, .sf-mega{width: ' + newval + 'px;}';
					$( '#customizer_dynamic_color_css_grid_width' ).text( width );
					break;
				case '1040':
					width = '.container, .sf-mega{width: ' + newval + 'px;}';
					$( '#customizer_dynamic_color_css_grid_width' ).text( width );
					break;
				case '980':
					width = '.container, .sf-mega{width: ' + newval + 'px;}';
					$( '#customizer_dynamic_color_css_grid_width' ).text( width );
					break;
				case '960':
					width = '.container, .sf-mega{width: ' + newval + 'px;}';
					$( '#customizer_dynamic_color_css_grid_width' ).text( width );
					break;
				default:
					$( '#customizer_dynamic_color_css_grid_width' ).text( '.container, .sf-mega{width: 1170px;}' );
			}
		});
	});

	// Links Color.
	api( 'links_color', function(value) {
		value.bind(function(newval) {
			mytheme_dynamic_css_targets( 'links_color' );
			var new_colors = 'a{color: ' + newval + ';}';
			$( '#customizer_dynamic_color_css_links_color' ).text( new_colors );
		});
	});

	api( 'links_hover', function(value) {
		value.bind(function(newval) {
			mytheme_dynamic_css_targets( 'links_hover' );
			var new_colors = 'a:hover {color: ' + newval + ';}';
			$( '#customizer_dynamic_color_css_links_hover' ).text( new_colors );
		});
	});

	api('blogname', function(value){
		value.bind(function(newval){
			$( '#main_logo_textual' ).html( newval );
		});
	});

	api('blogdescription', function(value){
		value.bind(function(newval){
			$( '#main_logo_tagline' ).html( newval );
		});
	});

})(jQuery, wp.customize);
