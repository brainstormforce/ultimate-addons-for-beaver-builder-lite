<?php
/**
 *  UABB Spacer Gap Module file.
 *
 *  @package UABB Spacer Gap Module
 */

/**
 * Function that initializes UABB Spacer Gap Module.
 *
 * @class UABBSpacerGap
 */
class UABBSpacerGap extends FLBuilderModule {
	/**
	 * Constructor function that constructs default values for the Spacer Gap Module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Spacer / Gap', 'uabb' ),
				'description'     => __( 'A totally awesome module!', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$basic_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/spacer-gap/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/spacer-gap/',
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => false, // Defaults to false and can be omitted.
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
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/spacer-gap/spacer-gap-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/spacer-gap/spacer-gap-bb-less-than-2-2-compatibility.php';
}

