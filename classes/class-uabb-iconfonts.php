<?php
/**
 * UABB_IconFonts setup
 *
 * @since 1.0
 * @package UABB Iconfonts
 */

/**
 * This class initializes UABB IconFonts
 *
 * @class UABB_IconFonts
 */
class UABB_IconFonts {

	/**
	 *  Constructor
	 */
	public function __construct() {
		$this->register_icons();
	}

	/**
	 * Function that initializes UABB reload Icons
	 *
	 * @since 1.0
	 * @return void
	 */
	public function init() {
		add_action( 'wp_ajax_uabb_reload_icons', array( $this, 'reload_icons' ) );
	}

	/**
	 * Function that renders reload Icons
	 *
	 * @since 1.0
	 * @return void
	 */
	public function reload_icons() {

		if ( ! wp_verify_nonce( $_POST['nonce'], 'uabb-reload-icons' ) || ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error(
				array(
					'success' => false,
					'message' => __( 'You are not authorized to perform this action.', 'uabb' ),
				)
			);
		}

		delete_option( '_uabb_enabled_icons' );
		wp_send_json_success();
	}

	/**
	 * Function that registers UABB Icons
	 *
	 * @since 1.0
	 * @return void
	 */
	public function register_icons() {

		// Update initially.
		$uabb_icons = get_option( '_uabb_enabled_icons', 0 );

		if ( 0 === $uabb_icons ) {

			// Copy IconFonts from UABB to BB.
			$dir = FLBuilderModel::get_cache_dir( 'icons' );
			$src = BB_ULTIMATE_ADDON_DIR . 'includes/icons/';
			$dst = $dir['path'];
			$this->recurse_copy( $src, $dst );

			$enabled_icons = FLBuilderModel::get_enabled_icons();

			$folders = glob( BB_ULTIMATE_ADDON_DIR . 'includes/icons/' . '*' );
			foreach ( $folders as $folder ) {
				$folder = trailingslashit( $folder );
				$key    = basename( $folder );
				if ( is_array( $enabled_icons ) && ! in_array( $key, $enabled_icons ) ) { //phpcs:ignore WordPress.PHP.StrictInArray.MissingTrueStrict
					$enabled_icons[] = $key;
				}
			}
			FLBuilderModel::update_admin_settings_option( '_fl_builder_enabled_icons', $enabled_icons, true );

			// Trigger false.
			update_option( '_uabb_enabled_icons', 1 );
		}
	}

	/**
	 * Function that renders recurse copy for Icons
	 *
	 * @since 1.0
	 * @param array $src an array to get the src.
	 * @param array $dst an object to get destination of the file.
	 */
	public function recurse_copy( $src, $dst ) {
		$dir = opendir( $src );

		// Create directory if not exist.
		if ( ! is_dir( $dst ) ) {
			@mkdir( $dst ); //phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_mkdir
		}

		// phpcs:ignore Generic.CodeAnalysis.AssignmentInCondition.FoundInWhileCondition
		while ( false !== ( $file = readdir( $dir ) ) ) {
			if ( ( '.' !== $file ) && ( '..' !== $file ) ) {
				if ( is_dir( $src . '/' . $file ) ) {
					$this->recurse_copy( $src . '/' . $file, $dst . '/' . $file );
				} else {
					copy( $src . '/' . $file, $dst . '/' . $file );
				}
			}
		}
		closedir( $dir );
	}
}

$UABB_IconFonts = new UABB_IconFonts(); // @codingStandardsIgnoreLine.
$UABB_IconFonts->init(); // @codingStandardsIgnoreLine.
