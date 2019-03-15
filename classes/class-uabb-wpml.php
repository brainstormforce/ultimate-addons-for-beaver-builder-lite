<?php
/**
 * UABB WPML Translatable File
 *
 * @since 1.6.7
 * @package UABB WPML Tranlatable
 */

if ( ! class_exists( 'UABBLite_WPML_Translatable' ) ) {
	/**
	 * Class UABBLite_WPML_Translatable.
	 *
	 * @since 1.2.2
	 */
	final class UABBLite_WPML_Translatable {

		/**
		 * Call nodes.
		 *
		 * @since 1.2.2
		 * @return void
		 */
		static public function init() {
			add_filter( 'wpml_beaver_builder_modules_to_translate', __CLASS__ . '::wpml_uabb_modules_translate' );
			UABBLite_WPML_Translatable::load_files();
		}

		/**
		 * Load files.
		 *
		 * @since 1.2.2
		 */
		static public function load_files() {
			if ( class_exists( 'WPML_Page_Builders_Defined' ) ) {
				require_once BB_ULTIMATE_ADDON_DIR . 'classes/wpml/class-wpml-uabb-infolist.php';
			}

		}

		/**
		 * Initialize nodes to translate
		 *
		 * @since 1.2.2
		 * @param array $form gets the forms array to be resolved.
		 * @return array
		 */
		static public function wpml_uabb_modules_translate( $form ) {

			// Button Module.
			$form['uabb-button'] = array(
				'conditions' => array( 'type' => 'uabb-button' ),
				'fields'     => array(
					array(
						'field'       => 'text',
						'type'        => __( 'Button', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'link',
						'type'        => __( 'Link', 'uabb' ),
						'editor_type' => 'LINK',
					),
				),
			);

			// Flip Box.
			$form['flip-box'] = array(
				'conditions' => array( 'type' => 'flip-box' ),
				'fields'     => array(
					array(
						'field'       => 'title_front',
						'type'        => __( 'Flip Box: Title on Front', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'desc_front',
						'type'        => __( 'Flip Box: Description', 'uabb' ),
						'editor_type' => 'VISUAL',
					),
					array(
						'field'       => 'title_back',
						'type'        => __( 'Flip Box: Title on Back', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'desc_back',
						'type'        => __( 'Flip Box: Description', 'uabb' ),
						'editor_type' => 'VISUAL',
					),
				),
			);

			// Slide Box.
			$form['slide-box'] = array(
				'conditions' => array( 'type' => 'slide-box' ),
				'fields'     => array(
					array(
						'field'       => 'title_front',
						'type'        => __( 'Slide Box: Front Slide Title', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'desc_front',
						'type'        => __( 'Slide Box: Front Description', 'uabb' ),
						'editor_type' => 'VISUAL',
					),
					array(
						'field'       => 'title_back',
						'type'        => __( 'Slide Box: Back Slide Title', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'desc_back',
						'type'        => __( 'Slide Box: Back Description', 'uabb' ),
						'editor_type' => 'VISUAL',
					),
					array(
						'field'       => 'link',
						'type'        => __( 'Slide Box: Link', 'uabb' ),
						'editor_type' => 'LINK',
					),
					array(
						'field'       => 'cta_text',
						'type'        => __( 'Slide Box: Call to action text', 'uabb' ),
						'editor_type' => 'LINE',
					),
				),
			);

			// Info list Module.
			$form['info-list'] = array(
				'conditions'        => array( 'type' => 'info-list' ),
				'fields'            => array(),
				'integration-class' => 'WPML_UABB_Infolist',
			);

			// Info Table.
			$form['info-table'] = array(
				'conditions' => array( 'type' => 'info-table' ),
				'fields'     => array(
					array(
						'field'       => 'it_title',
						'type'        => __( 'Info Table : Heading', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'sub_heading',
						'type'        => __( 'Info Table : Sub Heading', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'it_long_desc',
						'type'        => __( 'Info Table : Description', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'button_text',
						'type'        => __( 'Info Table : Call to action button text', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'it_link',
						'type'        => __( 'Info Table : Link', 'uabb' ),
						'editor_type' => 'LINK',
					),
				),
			);

			// Image Separator Module.
			$form['image-separator'] = array(
				'conditions' => array( 'type' => 'image-separator' ),
				'fields'     => array(
					array(
						'field'       => 'link',
						'type'        => __( 'Image Separator : Link', 'uabb' ),
						'editor_type' => 'LINK',
					),
				),
			);

			return $form;
		}
	}
	UABBLite_WPML_Translatable::init();
}
