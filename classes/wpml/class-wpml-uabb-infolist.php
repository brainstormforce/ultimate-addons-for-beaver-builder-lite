<?php
class WPML_UABB_Infolist extends WPML_Beaver_Builder_Module_With_Items {

	public function &get_items( $settings ) {
		return $settings->add_list_item;
	}

	public function get_fields() {
		return array( 'list_item_title', 'list_item_url', 'list_item_description' );
	}

	protected function get_title( $field ) {
		switch( $field ) {
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
?>