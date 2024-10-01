<?php
/**
 *  UABB Info List file for WMPL
 *
 *  @package UABB Info List WPML Compatibility
 */

/**
 * Here WPML_UABB_Infolist extends WPML_Beaver_Builder_Module_With_Items
 *
 * @class WPML_UABB_Infolist
 */
class WPML_UABB_Infolist extends WPML_Beaver_Builder_Module_With_Items {
	/**
	 * Function that renders Info List values
	 *
	 * @since 1.6.7
	 * @param object $settings an object to get values of Info List.
	 * @return object
	 */
	public function &get_items( $settings ) {
		return $settings->add_list_item;
	}

	/**
	 * Function that renders Info List's fields value
	 *
	 * @since 1.6.7
	 * @return array
	 */
	public function get_fields() {
		return array( 'list_item_title', 'list_item_url', 'list_item_description' );
	}

	/**
	 * Function that renders title of the Info List module
	 *
	 * @since 1.6.7
	 * @param array $field gets the translated field values of the Info List.
	 * @return string
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'list_item_title':
				return esc_html__( 'Info List : Title', 'uabb' );

			case 'list_item_url':
				return esc_html__( 'Info List : Link', 'uabb' );

			case 'list_item_description':
				return esc_html__( 'Info List : Description', 'uabb' );

			default:
				return '';
		}
	}

	/**
	 * Function that renders editor type of the Info List fields values
	 *
	 * @since 1.6.7
	 * @param array $field gets an field type of the WPML editor.
	 * @return string
	 */
	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'list_item_title':
				return 'LINE';

			case 'list_item_url':
				return 'LINK';

			case 'list_item_description':
				return 'VISUAL';

			default:
				return '';
		}
	}
}
