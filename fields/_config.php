<?php

/*
 * Custom Fields Config File
 * Description: This is custom fields config file. Require your custom field's "main" file here.
 *
*/

// require_once 'uabb-fields.php';

require_once 'uabb-simplify/uabb-simplify.php';
require_once 'uabb-spacing/uabb-spacing.php';
require_once 'uabb-toggle-switch/uabb-toggle-switch.php';
require_once 'uabb-blank-spacer/uabb-blank-spacer.php';
require_once 'uabb-msg-box/uabb-msg-box.php';
require_once 'uabb-gradient/uabb-gradient.php';

if( !class_exists('UABB_Custom_Field_Scripts') ) {
	class UABB_Custom_Field_Scripts
	{
		function __construct() {	
			add_action( 'wp_enqueue_scripts', array( $this, 'custom_field_scripts' ) );
		}
	

		function custom_field_scripts() {
		    if ( class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_active() ) {
		    
		    	/* uabb-simplyfy field */
		    	wp_enqueue_style( 'uabb-simplify', BB_ULTIMATE_ADDON_URL . 'fields/uabb-simplify/css/uabb-simplify.css', array(), '' );
				wp_enqueue_script( 'uabb-simplify', BB_ULTIMATE_ADDON_URL . 'fields/uabb-simplify/js/uabb-simplify.js', array(), '', true );

		    	/* uabb-spacing field */
				wp_enqueue_style( 'uabb-spacing', BB_ULTIMATE_ADDON_URL . 'fields/uabb-spacing/css/uabb-spacing.css', array(), '' );
				wp_enqueue_script( 'uabb-spacing', BB_ULTIMATE_ADDON_URL . 'fields/uabb-spacing/js/uabb-spacing.js', array(), '', true );
		        
		        /* uabb-toggle-switch field */
		        wp_enqueue_style( 'toggle_switch-styles', BB_ULTIMATE_ADDON_URL . 'fields/uabb-toggle-switch/css/uabb-toggle-switch.css' );
		        wp_enqueue_script( 'toggle_switch-scripts', BB_ULTIMATE_ADDON_URL . 'fields/uabb-toggle-switch/js/uabb-toggle-switch.js', array('jquery'), '', true );

		        /* uabb-blank-spacer field */
		   		wp_enqueue_style( 'blank_spacer-styles', BB_ULTIMATE_ADDON_URL . 'fields/uabb-blank-spacer/css/uabb-blank-spacer.css' );

		        /* uabb-hide-field field */
			    wp_enqueue_style( 'hide_field-styles', BB_ULTIMATE_ADDON_URL . 'fields/uabb-hide-field/css/uabb-hide-field.css' );

		        /* uabb-msgbox field */
		   		wp_enqueue_style( 'msg_field-styles', BB_ULTIMATE_ADDON_URL . 'fields/uabb-msg-box/css/uabb-msg-field.css' );

		        /* uabb-gradient field */
				wp_enqueue_style( 'uabb-gradient', BB_ULTIMATE_ADDON_URL . 'fields/uabb-gradient/css/uabb-gradient.css', array(), '' );
				wp_enqueue_script( 'uabb-gradient', BB_ULTIMATE_ADDON_URL . 'fields/uabb-gradient/js/uabb-gradient.js', array(), '', true );
			}
		}
	}

	$UABB_Custom_Field_Scripts = new UABB_Custom_Field_Scripts();
}