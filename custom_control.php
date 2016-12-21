<?php
/**
 * Customizer custom controls
 *
 * @package WordPress
 * @subpackage /inc/customizer
 * @version 1.1.0
 * @author  Denis Žoljom <http://madebydenis.com/>
 * @license https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link https://github.com/dingo-d/wordpress-theme-customizer-extra-custom-controls
 * @since  1.0.0
 *
 * Be sure to include your custom-controls.css file and
 * custom-control.js file.
 * Modify the path of the css and js files according to where
 * you put your custom controls and customizer settings.
 */

$my_theme = wp_get_theme();
$theme_version = $my_theme->get( 'Version' );

if ( class_exists( 'WP_Customize_Control' ) ) {

	/**
	 * Checkbox toggle custom control
	 *
	 * @package WordPress
	 * @subpackage inc/customizer
	 * @version 1.1.0
	 * @author  Denis Žoljom <http://madebydenis.com/>
	 * @license https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
	 * @link https://github.com/dingo-d/wordpress-theme-customizer-extra-custom-controls
	 * @since  1.0.0
	 */
	class Checkbox_Custom_Control extends WP_Customize_Control {
		/**
		 * Control type
		 *
		 * @var string
		 */
		public $type = 'toogle_checkbox';
		/**
		 * Control scripts and styles enqueue
		 *
		 * @since 1.0.0
		 */
		public function enqueue() {
			wp_enqueue_script( 'custom_controls', get_template_directory_uri() . '/inc/customizer/js/custom-controls.js', array( 'jquery' ), $theme_version, true );
			wp_enqueue_style( 'custom_controls_css', get_template_directory_uri() . '/inc/customizer/css/custom-controls.css' );
		}
		/**
		 * Control method
		 *
		 * @since 1.0.0
		 */
		public function render_content() {
			?>
			<div class="checkbox_switch">
				<div class="onoffswitch">
				    <input type="checkbox" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" class="onoffswitch-checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> <?php $this->link() . checked( $this->value() ); ?>>
				    <label class="onoffswitch-label" for="<?php echo esc_attr( $this->id ); ?>"></label>
				</div>
				<span class="customize-control-title onoffswitch_label"><?php echo esc_html( $this->label ); ?></span>
				<p><?php echo esc_html( $this->description ); ?></p>
			</div>
			<?php
		}
	}

	/**
	 * Info custom control
	 *
	 * @package WordPress
	 * @subpackage inc/customizer
	 * @version 1.1.0
	 * @author  Denis Žoljom <http://madebydenis.com/>
	 * @license https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
	 * @link https://github.com/dingo-d/wordpress-theme-customizer-extra-custom-controls
	 * @since  1.0.0
	 */
	class Info_Custom_Control extends WP_Customize_Control {
		/**
		 * Control type
		 *
		 * @var string
		 */
		public $type = 'info';
		/**
		 * Control method
		 *
		 * @since 1.0.0
		 */
		public function render_content() {
			?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<p><?php echo esc_html( $this->description ); ?></p>
			<?php
		}
	}

	/**
	 * Separator custom control
	 *
	 * @package WordPress
	 * @subpackage inc/customizer
	 * @version 1.1.0
	 * @author  Denis Žoljom <http://madebydenis.com/>
	 * @license https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
	 * @link https://github.com/dingo-d/wordpress-theme-customizer-extra-custom-controls
	 * @since  1.0.0
	 */
	class Separator_Custom_Control extends WP_Customize_Control {
		/**
		 * Control type
		 *
		 * @var string
		 */
		public $type = 'separator';
		/**
		 * Control method
		 *
		 * @since 1.0.0
		 */
		public function render_content() {
			?>
			<p><hr></p>
			<?php
		}
	}

	/**
	 * Multi input custom control
	 *
	 * @package WordPress
	 * @subpackage inc/customizer
	 * @version 1.1.0
	 * @author  Denis Žoljom <http://madebydenis.com/>
	 * @license https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
	 * @link https://github.com/dingo-d/wordpress-theme-customizer-extra-custom-controls
	 * @since  1.0.0
	 */
	class Multi_Input_Custom_Control extends WP_Customize_Control {
		/**
		 * Control type
		 *
		 * @var string
		 */
		public $type = 'multi_input';
		/**
		 * Control scripts and styles enqueue
		 *
		 * @since 1.0.0
		 */
		public function enqueue() {
			wp_enqueue_script( 'custom_controls', get_template_directory_uri() . '/inc/customizer/js/custom-controls.js', array( 'jquery' ), $theme_version, true );
			wp_enqueue_style( 'custom_controls_css', get_template_directory_uri() . '/inc/customizer/css/custom-controls.css' );
		}
		/**
		 * Control method
		 *
		 * @since 1.0.0
		 */
		public function render_content() {
			?>
			<label class="customize_multi_input">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<p><?php echo esc_html( $this->description ); ?></p>
				<input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize_multi_value_field" <?php $this->link(); ?> />
				<div class="customize_multi_fields">
					<div class="set">
						<input type="text" value="" class="customize_multi_single_field"/>
						<a href="#" class="customize_multi_remove_field"><span class="dashicons dashicons-no-alt"></span></a>
					</div>
				</div>
				<a href="#" class="button button-primary customize_multi_add_field"><?php esc_html_e( 'Add More', 'utter' ) ?></a>
			</label>
			<?php
		}
	}

	/**
	 * Sidebar dropdown custom control
	 *
	 * @package WordPress
	 * @subpackage inc/customizer
	 * @version 1.1.0
	 * @author  Denis Žoljom <http://madebydenis.com/>
	 * @license https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
	 * @link https://github.com/dingo-d/wordpress-theme-customizer-extra-custom-controls
	 * @since  1.0.0
	 */
	class Sidebar_Dropdown_Custom_Control extends WP_Customize_Control {
		/**
		 * Control type
		 *
		 * @var string
		 */
		public $type = 'sidebar_dropdown';
		/**
		 * Control scripts and styles enqueue
		 *
		 * @since 1.0.0
		 */
		public function enqueue() {
			wp_enqueue_script( 'custom_controls', get_template_directory_uri() . '/inc/customizer/js/custom-controls.js', array( 'jquery' ), $theme_version, true );
			wp_enqueue_style( 'custom_controls_css', get_template_directory_uri() . '/inc/customizer/css/custom-controls.css' );
		}
		/**
		 * Control method
		 *
		 * @since 1.0.0
		 */
		public function render_content() {
		?>
			<label class="customize_dropdown_input">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<p><?php echo esc_html( $this->description ); ?></p>
				<?php
				global $wp_registered_sidebars;
					?>
				<select id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" <?php $this->link(); ?> >
				<?php
				$sidebar_shop = $wp_registered_sidebars;
				if ( is_array( $sidebar_shop ) && ! empty( $sidebar_shop ) ) {
					foreach ( $sidebar_shop as $sidebar ) {
						echo '<option value="' . esc_attr( $sidebar['name'] ) . '" ' . selected( $this->value(), $sidebar['name'], false ) . '>' . esc_html( $sidebar['name'] ) . '</option>';
					}
				}
				?>
				</select>
				<br>
			</label>
		<?php
		}
	}

	/**
	 * Image layout picker custom control
	 *
	 * @package WordPress
	 * @subpackage inc/customizer
	 * @version 1.1.0
	 * @author  Denis Žoljom <http://madebydenis.com/>
	 * @license https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
	 * @link https://github.com/dingo-d/wordpress-theme-customizer-extra-custom-controls
	 * @since  1.0.0
	 */
	class Image_Radio_Buttons extends WP_Customize_Control {
		/**
		 * Control type
		 *
		 * @var string
		 */
		public $type = 'image_radio_buttons';
		/**
		 * Control scripts and styles enqueue
		 *
		 * @since 1.0.0
		 */
		public function enqueue() {
			wp_enqueue_style( 'custom_controls_css', get_template_directory_uri() . '/inc/customizer/css/custom-controls.css' );
		}
		/**
		 * Control method
		 *
		 * @since 1.0.0
		 */
		public function render_content() {
		?>
			<div class="image_radio_buttons">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<p><?php echo esc_html( $this->description ); ?></p>
				<?php
				foreach ( $this->choices as $choices_key => $choices_value ) {
					?>
					<label>
						<input type="radio" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $choices_key ); ?>" <?php $this->link(); ?> <?php checked( esc_attr( $choices_key ), $this->value() ); ?>/>
						<img src="<?php echo esc_attr( $choices_value['image'] ); ?>" alt="<?php echo esc_attr( $choices_value['name'] ); ?>" title="<?php echo esc_attr( $choices_value['name'] ); ?>" />
					</label>
					<?php
				}
				?>
			</div>
		<?php
		}
	}

	/**
	 * Slider custom control
	 *
	 * @package WordPress
	 * @subpackage inc/customizer
	 * @version 1.1.0
	 * @author  Denis Žoljom <http://madebydenis.com/>
	 * @license https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
	 * @link https://github.com/dingo-d/wordpress-theme-customizer-extra-custom-controls
	 * @since  1.0.0
	 */
	class Slider_Control extends WP_Customize_Control {
		/**
		 * Control type
		 *
		 * @var string
		 */
		public $type = 'slider_control';
		/**
		 * Control scripts and styles enqueue
		 *
		 * @since 1.0.0
		 */
		public function enqueue() {
			wp_enqueue_script( 'custom_controls', get_template_directory_uri() . '/inc/customizer/js/custom-controls.js', array( 'jquery', 'jquery-ui-slider' ), $theme_version, true );
			wp_enqueue_style( 'custom_controls_css', get_template_directory_uri() . '/inc/customizer/css/custom-controls.css' );
		}
		/**
		 * Control method
		 *
		 * @since 1.0.0
		 */
		public function render_content() {
		?>
			<div class="slider_control">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?><span class="slider_value"><?php echo esc_attr( $this->value() ); ?></span></span>
				<p><?php echo esc_html( $this->description ); ?></p>
				<input class="slider_input" type="hidden" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?>  />
				<div class="slider-range"></div>
			</div>
		<?php
		}
	}

}
