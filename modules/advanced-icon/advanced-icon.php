<?php
/**
 *  UABB Advanced Icon Module file
 *
 *  @package UABB Advanced Icon Module
 */

/**
 * Function that initializes UABB Advanced Icon Module
 *
 * @class UABBAdvancedIconModule
 */
class UABBAdvancedIconModule extends FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the Advanced Icon module.
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Advanced Icons', 'uabb' ),
				'description'     => __( 'Display a group of Image / Icons.', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$basic_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/advanced-icon/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/advanced-icon/',
				'editor_export'   => false,
				'partial_refresh' => true,
				'icon'            => 'star-filled.svg',
			)
		);
	}


}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 *
 */
if ( UABB_Compatibility::$version_bb_check ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/advanced-icon/advanced-icon-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/advanced-icon/advanced-icon-bb-less-than-2-2-compatibility.php';
}
