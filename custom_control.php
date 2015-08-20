<?php

if (class_exists('WP_Customize_Control')){

/* Custom checkbox switch */

/* Be sure to include your custom_controls.css file. Modify the path of the css file according to where you put your custom controls and customizer settings */

	class Toggle_Checkbox_Custom_control extends WP_Customize_Control{
		public $type = 'toogle_checkbox';
		public function enqueue(){
			wp_enqueue_style( 'custom_controls_css', get_template_directory_uri().'/custom_controls_css.css');
		}
		public function render_content(){
			?>
			<div class="checkbox_switch">
				<div class="onoffswitch">
				    <input type="checkbox" id="<?php echo $this->id; ?>" name="<?php echo $this->id; ?>" class="onoffswitch-checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?>>
				    <label class="onoffswitch-label" for="<?php echo $this->id; ?>"></label>
				</div>
				<span class="customize-control-title onoffswitch_label"><?php echo esc_html( $this->label ); ?></span>
				<p><?php echo $this->description; ?></p>
			</div>
			<?php
		}
	}

/* Custom Info */

	class Info_Custom_control extends WP_Customize_Control{
		public $type = 'info';
		public function render_content(){
			?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<p><?php echo $this->description; ?></p>
			<?php
		}
	}

/* Custom Separator */

	class Separator_Custom_control extends WP_Customize_Control{
		public $type = 'separator';
		public function render_content(){
			?>
			<p><hr></p>
			<?php
		}
	}


}