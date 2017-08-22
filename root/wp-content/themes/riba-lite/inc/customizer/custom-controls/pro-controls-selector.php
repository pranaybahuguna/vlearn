<?php

/**
 * Customize for disabled HTML elements, extend the WP customizer
 *
 * @since Riba Lite 1.0.3
 */
if( !class_exists('Riba_lite_Disabled_Custom_Control') ) {
	class Riba_lite_Disabled_Custom_Control extends WP_Customize_Control
	{

		public function render_content()
		{

			switch($this->type) {

				case 'textarea':
					echo '<div class="'.$this->type.'-pro-feature">';
					echo '<span class="pro-badge">'.__('PRO', 'riba-lite').'</span>';
					?>
					<label>
						<span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
		                  <textarea class="large-text" cols="20" rows="5" <?php $this->link(); ?> disabled >
		                    <?php echo esc_textarea($this->value()); ?>
		                  </textarea>
					</label>
					<?php echo '</div><!--/pro-feature-->';
				break;

				case 'text':
					echo '<div class="'.$this->type.'-pro-feature">';
					echo '<span class="pro-badge">'.__('PRO', 'riba-lite').'</span>';
					?>
					<label>
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
						<input type="text" value="<?php echo esc_html( $this->value() ); ?>" class="large-text" <?php $this->link(); ?> disabled >
					</label>


					<?php echo '</div><!--/pro-feature-->';
				break;

				case 'checkbox':
					echo '<div class="'.$this->type.'-pro-feature">';
					echo '<span class="pro-badge">'.__('PRO', 'riba-lite').'</span>';
					?>
					<label>
						<input type="checkbox" value="<?php echo esc_html( $this->value() ); ?>" <?php $this->link(); ?> disabled >
						<?php echo esc_html( $this->label ); ?>
					</label>


					<?php echo '</div><!--/pro-feature-->';
				break;

				case 'radio':
					echo '<div class="'.$this->type.'-pro-feature">';
					echo '<span class="pro-badge">'.__('PRO', 'riba-lite').'</span>';
					?>
					<label>
						<input type="radio" value="<?php echo esc_html( $this->value() ); ?>" <?php $this->link(); ?> disabled >
						<div><?php echo esc_html( $this->label ); ?></div>
					</label>


					<?php echo '</div><!--/pro-feature-->';
				break;

			} // end SWITCH statement
		}
	}
}


/**
 * Customize for premium features, extend the WP Customizer
 *
 * @since Riba Lite 1.0.8
 */
if( !class_exists( 'Riba_Lite_Theme_Support_Typography' ) ) {
    class Riba_Lite_Theme_Support_Typography extends WP_Customize_Control
    {
         public function render_content()
        { ?>

            <div class="pro-version">
                <?php _e('In order to be able to change the fonts, you need to upgrade to the PRO version.', 'riba-lite'); ?>
            </div>

            <div class="pro-box">
                <a href="<?php echo esc_url('http://www.machothemes.com/themes/riba-pro/');?>" target="_blank" class="upgrade" id="review_pro"><?php _e( 'View PRO version','riba-lite' ); ?></a>
            </div>

       <?php }
    }
}

/**
 * Customize for premium features, extend the WP Customizer
 *
 * @since Riba Lite 1.0.8
 */
if( !class_exists( 'Riba_Lite_Theme_Support_Ads' ) ) {
    class Riba_Lite_Theme_Support_Ads extends WP_Customize_Control
    {
         public function render_content()
        { ?>

            <div class="pro-version">
                <?php _e('In order to be able to use the advertising feature, you need to upgrade to the PRO version', 'riba-lite'); ?>
            </div>

            <div class="pro-box">
                <a href="<?php echo esc_url('http://www.machothemes.com/themes/riba-pro/');?>" target="_blank" class="upgrade" id="review_pro"><?php _e( 'View PRO version','riba-lite' ); ?></a>
            </div>

       <?php }
    }
}