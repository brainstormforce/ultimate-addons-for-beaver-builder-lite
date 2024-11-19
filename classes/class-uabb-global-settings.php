<?php
/**
 *  Global Styling.
 *
 *  @package Global Styling.
 */

/**
 * This class initializes UABB Global Styling.
 *
 * @class UABBGlobalSetting.
 */
final class UABBGlobalSetting {

	/**
	 * Function that initializes actions for UABB Global Settings.
	 *
	 * @since 1.0
	 * @return void
	 */
	public static function init() {
		add_filter( 'fl_builder_ui_js_strings', __CLASS__ . '::add_js_string' );
	}

	/**
	 * Function that initializes actions for UABB Global Settings.
	 *
	 * @param  String $js_strings slug.
	 * @since 1.0
	 * @return string
	 */
	public static function add_js_string( $js_strings ) {

		if ( 'UABB' === UABB_PREFIX ) {
			$js_strings['uabbGlobalSettings'] = esc_attr__( 'UABB - Global Settings', 'uabb' );
			$js_strings['uabbKnowledgeBase']  = esc_attr__( 'UABB - Knowledge Base', 'uabb' );
			$js_strings['uabbContactSupport'] = esc_attr__( 'UABB - Contact Support', 'uabb' );
		} else {
			$js_strings['uabbGlobalSettings'] = sprintf(
				esc_attr__( '%s - Global Settings', 'uabb' ), // @codingStandardsIgnoreLine.
				UABB_PREFIX
			);

			$js_strings['uabbKnowledgeBase'] = sprintf(
				esc_attr__( '%s - Knowledge Base', 'uabb' ), // @codingStandardsIgnoreLine.
				UABB_PREFIX
			);

			$js_strings['uabbContactSupport'] = sprintf(
				esc_attr__( '%s - Contact Support', 'uabb' ), // @codingStandardsIgnoreLine.
				UABB_PREFIX
			); // @codingStandardsIgnoreLine.
		}

		$uabb = BB_Ultimate_Addon_Helper::get_builder_uabb_branding();
		if ( is_array( $uabb ) ) {
			$uabb_knowledge_base_url             = ( array_key_exists( 'uabb-knowledge-base-url', $uabb ) && '' !== $uabb['uabb-knowledge-base-url'] ) ? $uabb['uabb-knowledge-base-url'] : 'https://www.ultimatebeaver.com/docs/';
			$uabb_contact_support_url            = ( array_key_exists( 'uabb-contact-support-url', $uabb ) && '' !== $uabb['uabb-contact-support-url'] ) ? $uabb['uabb-contact-support-url'] : 'https://www.ultimatebeaver.com/contact/';
			$js_strings['uabbKnowledgeBaseUrl']  = $uabb_knowledge_base_url;
			$js_strings['uabbContactSupportUrl'] = $uabb_contact_support_url;
		} else {
			$js_strings['uabbKnowledgeBaseUrl']  = 'https://www.ultimatebeaver.com/docs/';
			$js_strings['uabbContactSupportUrl'] = 'https://www.ultimatebeaver.com/contact/';
		}
		return $js_strings;
	}
}

UABBGlobalSetting::init();
