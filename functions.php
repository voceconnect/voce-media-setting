<?php 

function vs_display_media_select( $value, $setting, $args ) {
	return Voce_Media_Setting::display_media_select( $value, $setting, $args );
}

function vs_sanitize_media_select( $value, $setting, $args ) {
	return Voce_Media_Setting::sanitize_media_select( $value, $setting, $args );
}