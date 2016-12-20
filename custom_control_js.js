jQuery( document ).ready(function($) {
	"use strict";

	utter_control_description();

	$( document ).on( 'click', '.customize_multi_add_field', utter_customize_multi_add_field )
		.on( 'click', '.customize_multi_remove_field', utter_customize_multi_remove_field )
		.on( 'click', '.customize_multi_remove_field', utter_customize_multi_remove_field )
		.on( 'change keyup', '.slider_input', utter_slider_input_change );

	/********* Multi_Input_Custom_control ***********/
	$( '.customize_multi_input' ).each(function() {
		var $this = $( this );
		var multi_saved_value = $this.find( '.customize_multi_value_field' ).val();
		if (multi_saved_value.length > 0) {
			var multi_saved_values = multi_saved_value.split( "|" );
			$this.find( '.customize_multi_fields' ).empty();
			$.each(multi_saved_values, function( index, value ) {
				$this.find( '.customize_multi_fields' ).append( '<div class="set"><input type="text" value="' + value + '" class="customize_multi_single_field" /><a href="#" class="customize_multi_remove_field">X</a></div>' );
			});
		}
	});

	function utter_customize_multi_add_field(e) {
		e.preventDefault();
		var $control = $( this ).parents( '.customize_multi_input' );
		$control.find( '.customize_multi_fields' ).append( '<div class="set"><input type="text" value="" class="customize_multi_single_field" /><a href="#" class="customize_multi_remove_field">X</a></div>' );
	}

	function utter_customize_multi_single_field() {
		var $control = $( this ).parents( '.customize_multi_input' );
		utter_customize_multi_write( $control );
	}

	function utter_customize_multi_remove_field(e) {
		e.preventDefault();
		var $this = $( this );
		var $control = $this.parents( '.customize_multi_input' );
		$this.parent().remove();
		utter_customize_multi_write( $control );
	}

	function utter_customize_multi_write( $element) {
		var customize_multi_val = '';
		$element.find( '.customize_multi_fields .customize_multi_single_field' ).each(function() {
			customize_multi_val += $( this ).val() + '|';
		});
		$element.find( '.customize_multi_value_field' ).val( customize_multi_val.slice( 0, -1 ) ).change();
	}

	function utter_control_description() {
		$( 'li.customize-control' ).each(function() {
			var $this = $( this );
			if ( $this.find( 'p' ).html() !== '' ) {
				$this.find( 'p' ).replaceWith( '<span class="description customize-control-description">' + $this.find( 'p' ).text() + '</span>' );
			}
		});
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

	function utter_slider_input_change(){
		var $this = $(this);
		var value = $this.val();
    	$this.parent().find('.slider-range').slider('value', parseInt(value));
    	$this.parent().find('.slider_value').html(value);
	}

});
