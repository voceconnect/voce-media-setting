<?php

if( defined( 'ABSPATH' ) && function_exists('add_action') ) {
	add_action( 'admin_init', array( 'Voce_Media_Setting', 'initialize' ) );
}