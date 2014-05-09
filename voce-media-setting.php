<?php

if ( !class_exists( 'Voce_Media_Setting' ) ){

	class Voce_Media_Setting {
		public static function initialize(){
			add_action( 'vs_admin_enqueue_scripts', function( $vs_page ){
				foreach( $vs_page->groups as $group ){
					foreach( $group->settings as $setting ){
						if( $setting->args['display_callback'] == 'vs_display_media_select' ){
							wp_enqueue_media();
							wp_enqueue_script('voce-media-setting-js', self::plugins_url( '/js/voce-media-setting.js', __FILE__ ), array( 'jquery' ) );
							wp_enqueue_style( 'voce-media-setting-css', self::plugins_url( '/css/voce-media-setting.css', __FILE__ ) );
							break 2;
						}
					}
				}
			} );

		}

		public static function display_media_select( $value, $setting, $args ){
			self::render_html( $value, $setting, $args );
			if(!empty($args['description']))
				printf('<span class="description">%s</span>', $args['description']);
		}

		public static function render_html( $value, $setting, $args, $return = false ){

			$default_args = array(
				'mime_types'      => array( 'image' ),
				'multiple_select' => false,
				'thumb_size'      => 'medium'
			);
			$args = shortcode_atts( $default_args, $args );
			extract($args);

			// Html content vars
			$field_id     = $setting->get_field_id();
			$field_name   = $setting->get_field_name();
			$label_add    = 'Set ' . $setting->title;
			$label_remove = 'Remove ' . $setting->title;
			$link_content = '';
			$value_string = '';
			$hide_remove  = true;

			// If value is set get thumbnails to display and show remove button
			if ( $value ) {
				if ( !is_array( $value ) ) {
					$value = array( $value );
				}
				$value_string = implode(',', $value);
				foreach ( $value as $attachment ) {
					$value_post = get_post($attachment);
					if ( $value_post ) {
						$mime_type = $value_post->post_mime_type;
						$icon = ( strpos( $mime_type, 'image' ) ) ? false : true;
						$thumbnail_html = wp_get_attachment_image( $attachment, $thumb_size, $icon );
						if ( ! empty( $thumbnail_html ) ) {
							$link_content .= $thumbnail_html;
							$hide_remove = false;
						}
					}
				}
			}

			// If no thumbnails then use link text and hide remove
			if ( empty($link_content) ) {
				$link_content = esc_html($label_add);
				$hide_remove = true;
			}

			// Settings for the the js object
			$field_settings = array(
				'thumbSize' => $thumb_size,
				'modalOptions' => array(
					'multiple' => $multiple_select,
					'title' => $label_add,
					'button' => array(
						'text' => $label_add
					),
					'library' => array(
						'type' => $mime_types
					)
				)
			);

		?>
			<div class="voce-media-setting hide-if-no-js" data-field-settings="<?php echo esc_attr(json_encode($field_settings)); ?>" >
				<p>
					<input class="hidden vpm-id" type="hidden" id="<?php echo esc_attr( $field_id ); ?>" name="<?php echo esc_attr( $field_name ); ?>" value="<?php echo esc_attr( $value_string ); ?>" />
					<a title="<?php echo esc_attr( $label_add ); ?>" href="#" class="vpm-add <?php echo ( $hide_remove ) ? 'button' : ''; ?>">
						<?php echo $link_content; ?>
					</a>
				</p>
				<p>
					<a href="#" class="button vpm-remove" <?php echo ( $hide_remove ) ? 'style="display:none;"' : ''; ?>>
						<?php echo esc_html( $label_remove ); ?>
					</a>
				</p>
			</div>
		<?php
		}

		public static function sanitize_media_select($value, $setting, $args){
			$values = explode(',', $value);
			$values = array_map( 'intval', $values);
			return array_filter( $values );
		}


        /**
         * @method plugins_url
         * @param type $relative_path
         * @param type $plugin_path
         * @return string
         */
        public static function plugins_url($relative_path, $plugin_path) {
            $template_dir = get_template_directory();

            foreach (array('template_dir', 'plugin_path') as $var) {
                $$var = str_replace('\\', '/', $$var); // sanitize for Win32 installs
                $$var = preg_replace('|/+|', '/', $$var);
            }
            if (0 === strpos($plugin_path, $template_dir)) {
                $url = get_template_directory_uri();
                $folder = str_replace($template_dir, '', dirname($plugin_path));
                if ('.' != $folder) {
                    $url .= '/' . ltrim($folder, '/');
                }
                if (!empty($relative_path) && is_string($relative_path) && strpos($relative_path, '..') === false) {
                    $url .= '/' . ltrim($relative_path, '/');
                }
                return $url;
            } else {
                return plugins_url($relative_path, $plugin_path);
            }
        }

    }
	add_action( 'admin_init', array( 'Voce_Media_Setting', 'initialize' ) );

	function vs_display_media_select( $value, $setting, $args ) {
		return Voce_Media_Setting::display_media_select( $value, $setting, $args );
	}

	function vs_sanitize_media_select( $value, $setting, $args ) {
		return Voce_Media_Setting::sanitize_media_select( $value, $setting, $args );
	}

}// End Class Check