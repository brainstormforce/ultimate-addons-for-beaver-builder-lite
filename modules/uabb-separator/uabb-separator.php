<?php
/**
 *  UABB Separator Module file
 *
 *  @package UABB Separator Module
 */

/**
 * Function that initializes UABB Separator Module
 *
 * @class UABBSeparatorModule
 */
class UABBSeparatorModule extends FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the Separator module.
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Simple Separator', 'uabb' ),
				'description'     => __( 'A divider line to separate content.', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$basic_modules ),
				'group'           => defined( 'UABB_CAT' ) ? UABB_CAT : '', // Define the constant before use.
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-separator/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-separator/',
				'editor_export'   => false,
				'partial_refresh' => true,
				'icon'            => 'minus.svg',

			)
		);
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 */

if ( UABB_Lite_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-separator/uabb-separator-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-separator/uabb-separator-bb-less-than-2-2-compatibility.php';
}
