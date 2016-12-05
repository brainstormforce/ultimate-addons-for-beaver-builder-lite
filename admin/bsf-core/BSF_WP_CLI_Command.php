<?php

class BSF_WP_CLI_Command extends WP_CLI_Command {

	private $license_manager = '';

	public function __construct() {
		$this->license_manager = new BSF_License_Manager();
	}

	/**
	 * WP CLI Command to activate and deactivate licenses for brainstormforce products.
	 *
	 * ## OPTIONS
	 *
	 * <action>
	 *      activate or deactivate
	 *
	 * <priduct-id>
	 *      Product id is unique for each brainstorm product, it can be found in the file <product-root-directory>/admin/.bsf.yml
	 *
	 * <license-key>
	 *      Your purchase key.
	 *
	 * ## EXAMPLES
	 *
	 *  1. wp brainstormforce activate uabb <purchase-key>
	 *      - This will activate the license for plugin Ultimate Addons for beaver builder with purchase key <purchase-key>
	 *  2. wp brainstormforce deactivate uabb <purchase-key>
	 *      - This will deactivate the license for plugin Ultimate Addons for beaver builder with purchase key <purchase-key>
	 *
	 */
	public function license( $args, $assoc_args ) {

		if ( isset( $args[0] ) && $args[0] == 'activate' || $args[0] == 'deactivate' ) {
			$action = $args[0];
		} else {
			WP_CLI::error( 'Please enter the correct action.' );
		}

		if ( isset( $args[1] ) ) {
			$poduct_id = $args[1];
		} else {
			WP_CLI::error( 'Please enter a product id.' );
		}

		if ( isset( $args[2] ) ) {
			$purchase_key = $args[2];
		} else {
			WP_CLI::error( 'Please enter the purchase key.' );
		}

		$_POST = array(
			'bsf_license_manager' => array(
				'license_key' => $purchase_key,
				'product_id'  => $poduct_id
			)
		);

		if ( $action == 'activate' ) {

			$_POST['bsf_activate_license'] = true;
			$this->license_manager->bsf_activate_license();
		} else {

			$_POST['bsf_deactivate_license'] = true;
			$this->license_manager->bsf_deactivate_license();
		}

		if ( isset( $_POST['bsf_license_activation']['success'] ) && $_POST['bsf_license_activation']['success'] == true ) {

			$success_message = esc_attr( $_POST['bsf_license_activation']['message'] );

			WP_CLI::success( $success_message );
		} else {
			$error_message = esc_attr( $_POST['bsf_license_activation']['message'] );

			WP_CLI::error( $error_message );
		}
	}
}

if ( class_exists( 'WP_CLI' ) ) {
	WP_CLI::add_command( 'brainstormforce', 'BSF_WP_CLI_Command' );
}