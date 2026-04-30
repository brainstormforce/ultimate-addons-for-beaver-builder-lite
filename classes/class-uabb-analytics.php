<?php
/**
 * UABB Analytics.
 *
 * @package UABB
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'UABB_Analytics' ) ) {

	/**
	 * Class UABB_Analytics
	 *
	 * Handles analytics-related functionality for the Ultimate Addons for Beaver Builder Lite plugin.
	 *
	 * @since 1.6.7
	 */
	class UABB_Analytics {

		/**
		 * Cached BSF_Analytics_Events instance (null until the library class is loaded).
		 *
		 * @var BSF_Analytics_Events|null
		 */
		private static $events = null;

		/**
		 * UABB Analytics constructor.
		 *
		 * Initializing UABB Analytics.
		 *
		 * @since 1.6.7
		 * @access public
		 */
		public function __construct() {

			// BSF Analytics Tracker.
			if ( ! class_exists( 'BSF_Analytics_Loader' ) ) {
				require_once BB_ULTIMATE_ADDON_DIR . 'admin/bsf-analytics/class-bsf-analytics-loader.php';
			}

			$bsf_analytics = BSF_Analytics_Loader::get_instance();

			$bsf_analytics->set_entity(
				array(
					'uabb' => array(
						'product_name'        => 'Ultimate Addons for Beaver Builder Lite',
						'path'                => BB_ULTIMATE_ADDON_DIR . 'admin/bsf-analytics',
						'author'              => 'Brainstorm Force',
						'time_to_display'     => '+24 hours',
						'deactivation_survey' => array(
							array(
								'id'                => 'deactivation-survey-ultimate-addons-for-beaver-builder-lite',
								'popup_logo'        => BB_ULTIMATE_ADDON_URL . 'assets/images/uabb_notice.svg',
								'plugin_slug'       => 'ultimate-addons-for-beaver-builder-lite',
								'plugin_version'    => BB_ULTIMATE_ADDON_LITE_VERSION,
								'popup_title'       => 'Quick Feedback',
								'support_url'       => 'https://www.ultimatebeaver.com/contact/',
								'popup_description' => 'If you have a moment, please share why you are deactivating Ultimate Addons for Beaver Builder Lite:',
								'show_on_screens'   => array( 'plugins' ),
							),
						),
						'hide_optin_checkbox' => true,
					),
				)
			);

			add_filter( 'bsf_core_stats', array( $this, 'add_uabb_analytics_data' ) );

			// State-event detection (admin-only; throttled via transient).
			add_action( 'admin_init', array( $this, 'detect_state_events' ) );

			// Activation-event: first time a BB post containing a UABB module is published.
			add_action( 'save_post', array( $this, 'maybe_track_first_module_published' ), 20, 2 );
		}

		/**
		 * Lazy-load the BSF_Analytics_Events instance once the library class is available.
		 *
		 * @since 1.6.8
		 * @return BSF_Analytics_Events|null
		 */
		private static function events() {
			if ( null === self::$events && class_exists( 'BSF_Analytics_Events' ) ) {
				self::$events = new BSF_Analytics_Events( 'uabb' );
			}
			return self::$events;
		}

		/**
		 * Detect one-time milestone events on every admin page load.
		 *
		 * Throttle the check via a transient. The transient is set AFTER the null-check on
		 * the Events instance so that retries still happen until the library is loaded.
		 *
		 * @since 1.6.8
		 * @return void
		 */
		public function detect_state_events() {
			if ( false !== get_transient( 'uabb_analytics_state_check' ) ) {
				return;
			}

			$events = self::events();
			if ( null === $events ) {
				return;
			}

			set_transient( 'uabb_analytics_state_check', '1', HOUR_IN_SECONDS );

			$this->detect_plugin_activated( $events );
			$this->detect_plugin_updated( $events );
		}

		/**
		 * Track `plugin_activated` once per site lifetime.
		 *
		 * @param BSF_Analytics_Events $events Events instance.
		 * @since 1.6.8
		 * @return void
		 */
		private function detect_plugin_activated( $events ) {
			if ( $events->is_tracked( 'plugin_activated' ) ) {
				return;
			}

			$events->track(
				'plugin_activated',
				BB_ULTIMATE_ADDON_LITE_VERSION,
				array(
					'days_since_install'    => self::days_since_install(),
					'beaver_builder_active' => defined( 'FL_BUILDER_VERSION' ),
					'is_multisite'          => is_multisite(),
				)
			);
		}

		/**
		 * Track `plugin_updated` on each version bump.
		 *
		 * Uses a dedicated option (`uabb_analytics_last_tracked_version`) so the event fires
		 * exactly once per upgrade. A fresh install does not fire this event — only the
		 * first observed version-delta afterwards does.
		 *
		 * @param BSF_Analytics_Events $events Events instance.
		 * @since 1.6.8
		 * @return void
		 */
		private function detect_plugin_updated( $events ) {
			$last_tracked = (string) get_option( 'uabb_analytics_last_tracked_version', '' );

			if ( BB_ULTIMATE_ADDON_LITE_VERSION === $last_tracked ) {
				return;
			}

			if ( '' === $last_tracked ) {
				// First run after installing this analytics code — seed the marker, don't fire.
				update_option( 'uabb_analytics_last_tracked_version', BB_ULTIMATE_ADDON_LITE_VERSION );
				return;
			}

			$events->flush_pushed( array( 'plugin_updated' ) );
			$events->track(
				'plugin_updated',
				BB_ULTIMATE_ADDON_LITE_VERSION,
				array(
					'previous_version'   => $last_tracked,
					'new_version'        => BB_ULTIMATE_ADDON_LITE_VERSION,
					'days_since_install' => self::days_since_install(),
				)
			);

			update_option( 'uabb_analytics_last_tracked_version', BB_ULTIMATE_ADDON_LITE_VERSION );
		}

		/**
		 * Fire `first_uabb_module_published` the first time a published BB post containing
		 * a UABB module is saved. A site-wide option flag (`_uabb_first_module_published`)
		 * is checked first so once the event has fired, subsequent saves skip the meta scan
		 * entirely — the flag is not per-post.
		 *
		 * @param int     $post_id Post ID.
		 * @param WP_Post $post    Post object.
		 * @since 1.6.8
		 * @return void
		 */
		public function maybe_track_first_module_published( $post_id, $post ) {
			if ( get_option( '_uabb_first_module_published', false ) ) {
				return;
			}
			if ( ! ( $post instanceof WP_Post ) || 'publish' !== $post->post_status ) {
				return;
			}
			if ( wp_is_post_autosave( $post_id ) || wp_is_post_revision( $post_id ) ) {
				return;
			}
			if ( '1' !== (string) get_post_meta( $post_id, '_fl_builder_enabled', true ) ) {
				return;
			}

			$events = self::events();
			if ( null === $events || $events->is_tracked( 'first_uabb_module_published' ) ) {
				return;
			}

			$meta = get_post_meta( $post_id, '_fl_builder_data', true );
			if ( ! is_array( $meta ) && ! is_object( $meta ) ) {
				return;
			}

			$first_uabb = '';
			foreach ( (array) $meta as $node ) {
				if ( ! isset( $node->type ) || 'module' !== $node->type ) {
					continue;
				}
				if ( ! isset( $node->settings->type ) ) {
					continue;
				}
				if ( self::is_uabb_module( (string) $node->settings->type ) ) {
					$first_uabb = (string) $node->settings->type;
					break; // First match is enough — the weekly cron already aggregates per-site counts.
				}
			}

			if ( '' === $first_uabb ) {
				return;
			}

			update_option( '_uabb_first_module_published', 1 );

			$events->track(
				'first_uabb_module_published',
				$first_uabb,
				array(
					'days_since_install' => self::days_since_install(),
					'module_slug'        => $first_uabb,
				)
			);
		}

		/**
		 * Check whether a BB module slug belongs to UABB. Mirrors the check used by
		 * UABBBuilderAdminSettings::is_uabb_module() (which is private).
		 *
		 * @param string $module_type BB module slug from `_fl_builder_data` nodes.
		 * @since 1.6.8
		 * @return bool
		 */
		private static function is_uabb_module( $module_type ) {
			if ( ! class_exists( 'BB_Ultimate_Addon_Helper' ) ) {
				return false;
			}

			$all_modules = BB_Ultimate_Addon_Helper::get_all_modules();
			if ( ! is_array( $all_modules ) ) {
				return false;
			}

			foreach ( $all_modules as $pattern => $module_data ) {
				if ( 0 === strpos( $module_type, (string) $pattern ) ) {
					return true;
				}
			}

			return false;
		}

		/**
		 * Callback function to add specific analytics data.
		 *
		 * `events_record` flushes on every send (library per-event-name dedup).
		 * `numeric_values` + `kpi_records` ship on every send using whatever the
		 * weekly cron last wrote — ClickHouse dedupes on `(date, kpi_name)`, so
		 * re-shipping the same week's snapshot across 24h sends is a no-op
		 * server-side while keeping KPI delivery resilient to transport failures
		 * or missed sends without paying the weekly scan cost more than once.
		 *
		 * @param array $stats_data Existing stats data.
		 * @return array
		 */
		public function add_uabb_analytics_data( $stats_data ) {

			$stats_data['plugin_data']['uabb'] = array(
				'lite_version'           => BB_ULTIMATE_ADDON_LITE_VERSION,
				'site_language'          => get_locale(),
				'beaverbuilder_version'  => defined( 'FL_BUILDER_VERSION' ) ? FL_BUILDER_VERSION : '',
				'beaver_builder_edition' => self::get_beaver_builder_edition(),
				'theme_name'             => self::get_theme_name(),
			);

			// One-time events: flush on every send; library handles dedup.
			$events = self::events();
			if ( null !== $events ) {
				$stats_data['plugin_data']['uabb']['events_record'] = $events->flush_pending();
			}

			$fetch_uabb_data = $this->uabb_get_module_usage();
			if ( ! empty( $fetch_uabb_data ) ) {
				foreach ( $fetch_uabb_data as $key => $value ) {
					$stats_data['plugin_data']['uabb']['numeric_values'][ $key ] = $value;
				}
			}

			$kpi_records = $this->get_kpi_tracking_data();
			if ( ! empty( $kpi_records ) ) {
				$stats_data['plugin_data']['uabb']['kpi_records'] = $kpi_records;
			}

			return $stats_data;
		}

		/**
		 * Build the KPI payload from the latest snapshot written by the weekly
		 * module-usage cron.
		 *
		 * The cron stores exactly one record — the most recent week's calculation
		 * — keyed by that cron-tick's date. Analytics reshapes it into the
		 * `kpi_records` wire format. Empty (fresh install / opted out before first
		 * cron tick) returns an empty array.
		 *
		 * Shape: `[ 'Y-m-d' => [ [ 'kpi_name' => ..., 'kpi_value' => (float) ... ] ] ]`.
		 *
		 * @since 1.6.8
		 * @return array<string, array<int, array{kpi_name:string, kpi_value:float}>>
		 */
		private function get_kpi_tracking_data() {
			$snapshots = get_option( 'uabb_kpi_daily_snapshots', array() );
			if ( ! is_array( $snapshots ) || empty( $snapshots ) ) {
				return array();
			}

			$records = array();
			foreach ( $snapshots as $date => $snapshot ) {
				if ( ! is_array( $snapshot ) || empty( $snapshot['numeric_values'] ) ) {
					continue;
				}

				$day_records = array();
				foreach ( (array) $snapshot['numeric_values'] as $kpi_name => $kpi_value ) {
					$day_records[] = array(
						'kpi_name'  => (string) $kpi_name,
						'kpi_value' => (float) $kpi_value,
					);
				}

				if ( ! empty( $day_records ) ) {
					$records[ (string) $date ] = $day_records;
				}
			}

			return $records;
		}

		/**
		 * Detect Beaver Builder edition.
		 *
		 * The paid edition ships `FLUpdater` for license-aware updates; Lite does not.
		 * We can't distinguish Standard / Pro / Agency purely from class presence on a
		 * single site, so those are grouped as `paid`.
		 *
		 * @since 1.6.8
		 * @return string One of: `none`, `lite`, `paid`.
		 */
		private static function get_beaver_builder_edition() {
			if ( ! defined( 'FL_BUILDER_VERSION' ) ) {
				return 'none';
			}

			// The paid edition ships FLUpdater for license-aware updates; Lite does not.
			if ( class_exists( 'FLUpdater' ) ) {
				return 'paid';
			}

			return 'lite';
		}

		/**
		 * Active theme name — public metadata, safe to send.
		 *
		 * @since 1.6.8
		 * @return string
		 */
		private static function get_theme_name() {
			$theme = wp_get_theme();
			return $theme instanceof WP_Theme ? (string) $theme->get( 'Name' ) : '';
		}

		/**
		 * Days elapsed since the site first opted into analytics (or first library load).
		 *
		 * The BSF Analytics library persists this via `update_site_option`, but the legacy
		 * opt-in migration path in `UABB_Init` writes the same key via `update_option`.
		 * On multisite those target different stores, so we check both.
		 *
		 * @since 1.6.8
		 * @return int
		 */
		private static function days_since_install() {
			$installed = (int) get_site_option( 'uabb_usage_installed_time', 0 );
			if ( 0 === $installed ) {
				$installed = (int) get_option( 'uabb_usage_installed_time', 0 );
			}
			if ( 0 === $installed ) {
				return 0;
			}
			return (int) floor( ( time() - $installed ) / DAY_IN_SECONDS );
		}

		/**
		 * Fetch module usage data.
		 *
		 * @return array
		 */
		private function uabb_get_module_usage() {
			return get_option( 'uabblite_module_usage_data_option', array() );
		}
	}
}

new UABB_Analytics();
