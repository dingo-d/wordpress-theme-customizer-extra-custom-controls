<?php

if (class_exists('WP_Customize_Control')){

/* Custom checkbox switch */

/* Be sure to include your custom_controls.css file. Modify the path of the css file according to where you put your custom controls and customizer settings */

	class Toggle_Checkbox_Custom_control extends WP_Customize_Control{
		public $type = 'toogle_checkbox';
		public function enqueue(){
			wp_enqueue_style( 'custom_controls_css', get_template_directory().'/custom_controls_css.css');
		}
		public function render_content(){
			?>
			<div class="checkbox_switch">
				<div class="onoffswitch">
				    <input type="checkbox" id="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>" class="onoffswitch-checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?>>
				    <label class="onoffswitch-label" for="<?php echo esc_attr($this->id); ?>"></label>
				</div>
				<span class="customize-control-title onoffswitch_label"><?php echo esc_html( $this->label ); ?></span>
				<p><?php echo wp_kses_post($this->description); ?></p>
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
			<p><?php echo wp_kses_post($this->description); ?></p>
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

/* Multi Input field */

	class Multi_Input_Custom_control extends WP_Customize_Control{
		public $type = 'multi_input';
		public function enqueue(){
			wp_enqueue_script( 'custom_controls', get_template_directory().'/custom_controls_js.js', array( 'jquery' ),'', true );
			wp_enqueue_style( 'custom_controls_css', get_template_directory().'/custom_controls_css.css');
		}
		public function render_content(){
			?>
			<label class="customize_multi_input">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<p><?php echo wp_kses_post($this->description); ?></p>
				<input type="hidden" id="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>" value="<?php echo esc_attr($this->value()); ?>" class="customize_multi_value_field" data-customize-setting-link="<?php echo esc_attr($this->id); ?>"/>
				<div class="customize_multi_fields">
					<div class="set">
						<input type="text" value="" class="customize_multi_single_field"/>
						<a href="#" class="customize_multi_remove_field">X</a>
					</div>
				</div>
				<a href="#" class="button button-primary customize_multi_add_field"><?php esc_attr_e('Add More', 'your_theme') ?></a>
			</label>
			<?php
		}
	}

/* Sidebar Dropdown field */

	class Sidebar_Dropdown_Custom_Control extends WP_Customize_Control{
		public $type = 'sidebar_dropdown';
		public function enqueue(){
			wp_enqueue_script( 'custom_controls', get_template_directory().'/custom_controls_js.js', array( 'jquery' ),'', true );
			wp_enqueue_style( 'custom_controls_css', get_template_directory().'/custom_controls_css.css');
		}
	    public function render_content(){
		?>
			<label class="customize_dropdown_input">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<p><?php echo wp_kses_post($this->description); ?></p>
				<?php
				global $wp_registered_sidebars;
				 ?>
				<select id="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>" data-customize-setting-link="<?php echo esc_attr($this->id); ?>">
				<?php
				$sidebar_shop = $wp_registered_sidebars;
				if(is_array($sidebar_shop) && !empty($sidebar_shop)){
					foreach($sidebar_shop as $sidebar){
						echo '<option value="'.$sidebar['name'].'" ' . selected( $this->value(), $sidebar['name'], false ) . '>'.$sidebar['name'].'</option>';
					}
				}
				?>
				</select>
				<br>
			</label>
		<?php
	    }
	}

/* Image Select field */

/* You need to include the images you want to select. Add as many as you want to. In this example there are 3 images, that are supposed to go in 3 columns in one row.*/

	class Image_Select_Custom_Control extends WP_Customize_Control{
		public $type = 'image_select';
		public function enqueue(){
			wp_enqueue_style( 'custom_controls_css', get_template_directory().'/custom_controls_css.css');
		}
		public function render_content(){
		?>
			<div class="customize_image_select">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<p><?php echo wp_kses_post($this->description); ?></p>
					<label>
						<input type="radio" name="<?php echo esc_attr($this->id); ?>" value="1" data-customize-setting-link="<?php echo esc_attr($this->id); ?>" <?php checked('1', esc_attr($this->value()) );?>/>
						<img src="<?php echo get_template_directory().'/images/image_1.png'?>" alt="<?php esc_attr_e('Option 1', 'your_theme'); ?>" title="<?php esc_attr_e('Option 1', 'your_theme'); ?>" />
					</label>
					<label>
						<input type="radio" name="<?php echo esc_attr($this->id); ?>" value="2" data-customize-setting-link="<?php echo esc_attr($this->id); ?>" <?php checked('2', esc_attr($this->value()) );?>/>
						<img src="<?php echo get_template_directory().'/images/image_2.png'?>" alt="<?php esc_attr_e('Option 2', 'your_theme'); ?>" title="<?php esc_attr_e('Option 2', 'your_theme'); ?>" />
					</label>
					<label>
						<input type="radio" name="<?php echo esc_attr($this->id); ?>" value="3" data-customize-setting-link="<?php echo esc_attr($this->id); ?>" <?php checked('3', esc_attr($this->value()) );?>/>
						<img src="<?php echo get_template_directory().'/images/image_3.png'?>" alt="<?php esc_attr_e('Option 3', 'your_theme'); ?>"  title="<?php esc_attr_e('Option 3', 'your_theme'); ?>" />
					</label>
			</div>
		<?php
		}
	}


}