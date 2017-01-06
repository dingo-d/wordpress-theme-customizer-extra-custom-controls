( function( api ) {
	'use strict';

	api.bind( 'ready', function() {

		api( 'boxed_body', function(setting) {
			var linkSettingValueToControlActiveState;

			/**
			 * Update a control's active state according to the boxed_body setting's value.
			 *
			 * @param {api.Control} control Boxed body control.
			 */
			linkSettingValueToControlActiveState = function( control ) {
				var visibility = function() {
					if ( true === setting.get() || 1 === setting.get() ) {
						control.container.slideDown( 180 );
					} else {
						control.container.slideUp( 180 );
					}
				};

				// Set initial active state.
				visibility();
				// Update activate state whenever the setting is changed.
				setting.bind( visibility );
			};

			// Call linkSettingValueToControlActiveState on the border controls when they exist.
			api.control( 'boxed_body_border_width', linkSettingValueToControlActiveState );
			api.control( 'boxed_body_border_color', linkSettingValueToControlActiveState );
			api.control( 'boxed_body_border_style', linkSettingValueToControlActiveState );
		});

	});

}( wp.customize ) );
