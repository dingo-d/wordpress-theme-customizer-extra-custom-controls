jQuery( document ).ready(function($) {
	"use strict";

	mytheme_control_description();
	
	function mytheme_control_description() {
		$( 'li.customize-control' ).each(function() {
			var $this = $( this );
			if ( $this.find( 'p' ).html() !== '' ) {
				$this.find( 'p' ).replaceWith( '<span class="description customize-control-description">' + $this.find( 'p' ).text() + '</span>' );
			}
		});
	}

	$( document ).on( 'click', '.customize_multi_add_field', mytheme_customize_multi_add_field )
	 	.on( 'change', '.customize_multi_single_field', mytheme_customize_multi_single_field )
		.on( 'click', '.customize_multi_remove_field', mytheme_customize_multi_remove_field )
		.on( 'keyup', '.box-model-field', mytheme_box_model_change )
		.on( 'change keyup', '.slider_input', mytheme_slider_input_change );

	/********* Multi Input Custom control ***********/
	$( '.customize_multi_input' ).each(function() {
		var $this = $( this );
		var multi_saved_value = $this.find( '.customize_multi_value_field' ).val();
		if (multi_saved_value.length > 0) {
			var multi_saved_values = multi_saved_value.split( "|" );
			$this.find( '.customize_multi_fields' ).empty();
			$.each(multi_saved_values, function( index, value ) {
				$this.find( '.customize_multi_fields' ).append( '<div class="set"><input type="text" value="' + value + '" class="customize_multi_single_field" /><span class="customize_multi_remove_field"><span class="dashicons dashicons-no-alt"></span></span></div>' );
			});
		}
	});

	function mytheme_customize_multi_add_field(e) {
		var $this = $( e.currentTarget );
		e.preventDefault();
		if ( ! $this.data( 'lockedAt' ) || + new Date() - $this.data( 'lockedAt' ) > 300 ) {
			var $control = $this.parents( '.customize_multi_input' );
			$control.find( '.customize_multi_fields' ).append( '<div class="set"><input type="text" value="" class="customize_multi_single_field" /><span class="customize_multi_remove_field"><span class="dashicons dashicons-no-alt"></span></span></div>' );
			mytheme_customize_multi_write( $control );
		}
		$this.data( 'lockedAt', + new Date() );
	}

	function mytheme_customize_multi_single_field() {
		var $control = $( this ).parents( '.customize_multi_input' );
		mytheme_customize_multi_write( $control );
	}

	function mytheme_customize_multi_remove_field(e) {
		e.preventDefault();
		var $this = $( this );
		var $control = $this.parents( '.customize_multi_input' );
		$this.parent().remove();
		mytheme_customize_multi_write( $control );
	}

	function mytheme_customize_multi_write( $element) {
		var customize_multi_val = '';
		$element.find( '.customize_multi_fields .customize_multi_single_field' ).each(function() {
			customize_multi_val += $( this ).val() + '|';
		});
		$element.find( '.customize_multi_value_field' ).val( customize_multi_val.slice( 0, -1 ) ).change();
	}

	/********* Slider Custom control ***********/

	$('.slider-range').each(function(){
		var $slider = $(this);
		var saved_value = $slider.parent().find('.slider_input').val();
		$slider.slider({
			range: 'min',
			value: ( saved_value > 0 ) ? saved_value : 0,
			step: 1,
			min: 0,
			max: 100,
			slide: function(event, ui) {
				var $this = $(this);
				$this.parent().find('.slider_input').attr('value', ui.value)
					 .trigger('change');
				$this.parent().find('.slider_value').html(ui.value);
			}
		});
	});

	function mytheme_slider_input_change(){
		var $this = $(this);
		var value = $this.val();
    	$this.parent().find('.slider-range').slider('value', parseInt(value));
    	$this.parent().find('.slider_value').html(value);
	}

	/********* Box Model Custom control ***********/

	function mytheme_box_model_change() {
		var $parent = $(this).parents('.box-model-wrapper'),
			$save_field = $parent.find('.box-model-saved'),
			$input_fields = $parent.find('.box-model-field'),
			saved_string = '';

		$input_fields.each(function() {
			var $field = $(this);
			var field_value = $.isNumeric($field.val()) ? parseInt( $field.val(), 10 ) : '-';
			if ($.isNumeric(field_value) || '-' === field_value) {
				saved_string += field_value+', ';
			}
		});

		$save_field.val(saved_string.replace(/,\s*$/, "")).trigger('change');
	}

});
