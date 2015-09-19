<?php

if( !function_exists( 'vs_display_media_select' ) ){
	function vs_display_media_select( $value, $setting, $args ) {
		return Voce_Media_Setting::display_media_select( $value, $setting, $args );
	}
}

if( !function_exists( 'vs_sanitize_media_select' ) ){
	function vs_sanitize_media_select( $value, $setting, $args ) {
		return Voce_Media_Setting::sanitize_media_select( $value, $setting, $args );
	}
}