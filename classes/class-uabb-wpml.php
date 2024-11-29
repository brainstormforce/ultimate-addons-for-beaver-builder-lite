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
		public static function init(): void {
			add_filter( 'wpml_beaver_builder_modules_to_translate', self::class . '::wpml_uabb_modules_translate' );
			UABBLite_WPML_Translatable::load_files();
		}

		/**
		 * Load files.
		 *
		 * @since 1.2.2
		 *
		 * @return void
		 */
		public static function load_files(): void {
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
		public static function wpml_uabb_modules_translate( $form ) {

			// Button Module.
			$form['uabb-button'] = [
				'conditions' => [ 'type' => 'uabb-button' ],
				'fields'     => [
					[
						'field'       => 'text',
						'type'        => __( 'Button', 'uabb' ),
						'editor_type' => 'LINE',
					],
					[
						'field'       => 'link',
						'type'        => __( 'Link', 'uabb' ),
						'editor_type' => 'LINK',
					],
				],
			];

			// Flip Box.
			$form['flip-box'] = [
				'conditions' => [ 'type' => 'flip-box' ],
				'fields'     => [
					[
						'field'       => 'title_front',
						'type'        => __( 'Flip Box: Title on Front', 'uabb' ),
						'editor_type' => 'LINE',
					],
					[
						'field'       => 'desc_front',
						'type'        => __( 'Flip Box: Description', 'uabb' ),
						'editor_type' => 'VISUAL',
					],
					[
						'field'       => 'title_back',
						'type'        => __( 'Flip Box: Title on Back', 'uabb' ),
						'editor_type' => 'LINE',
					],
					[
						'field'       => 'desc_back',
						'type'        => __( 'Flip Box: Description', 'uabb' ),
						'editor_type' => 'VISUAL',
					],
				],
			];

			// Slide Box.
			$form['slide-box'] = [
				'conditions' => [ 'type' => 'slide-box' ],
				'fields'     => [
					[
						'field'       => 'title_front',
						'type'        => __( 'Slide Box: Front Slide Title', 'uabb' ),
						'editor_type' => 'LINE',
					],
					[
						'field'       => 'desc_front',
						'type'        => __( 'Slide Box: Front Description', 'uabb' ),
						'editor_type' => 'VISUAL',
					],
					[
						'field'       => 'title_back',
						'type'        => __( 'Slide Box: Back Slide Title', 'uabb' ),
						'editor_type' => 'LINE',
					],
					[
						'field'       => 'desc_back',
						'type'        => __( 'Slide Box: Back Description', 'uabb' ),
						'editor_type' => 'VISUAL',
					],
					[
						'field'       => 'link',
						'type'        => __( 'Slide Box: Link', 'uabb' ),
						'editor_type' => 'LINK',
					],
					[
						'field'       => 'cta_text',
						'type'        => __( 'Slide Box: Call to action text', 'uabb' ),
						'editor_type' => 'LINE',
					],
				],
			];

			// Info list Module.
			$form['info-list'] = [
				'conditions'        => [ 'type' => 'info-list' ],
				'fields'            => [],
				'integration-class' => 'WPML_UABB_Infolist',
			];

			// Info Table.
			$form['info-table'] = [
				'conditions' => [ 'type' => 'info-table' ],
				'fields'     => [
					[
						'field'       => 'it_title',
						'type'        => __( 'Info Table : Heading', 'uabb' ),
						'editor_type' => 'LINE',
					],
					[
						'field'       => 'sub_heading',
						'type'        => __( 'Info Table : Sub Heading', 'uabb' ),
						'editor_type' => 'LINE',
					],
					[
						'field'       => 'it_long_desc',
						'type'        => __( 'Info Table : Description', 'uabb' ),
						'editor_type' => 'LINE',
					],
					[
						'field'       => 'button_text',
						'type'        => __( 'Info Table : Call to action button text', 'uabb' ),
						'editor_type' => 'LINE',
					],
					[
						'field'       => 'it_link',
						'type'        => __( 'Info Table : Link', 'uabb' ),
						'editor_type' => 'LINK',
					],
				],
			];

			// Image Separator Module.
			$form['image-separator'] = [
				'conditions' => [ 'type' => 'image-separator' ],
				'fields'     => [
					[
						'field'       => 'link',
						'type'        => __( 'Image Separator : Link', 'uabb' ),
						'editor_type' => 'LINK',
					],
				],
			];
			// Heading Module.
			$form['uabb-heading'] = [
				'conditions' => [ 'type' => 'uabb-heading' ],
				'fields'     => [
					[
						'field'       => 'heading',
						'type'        => __( 'Heading Text', 'uabb' ),
						'editor_type' => 'LINE',
					],
					[
						'field'       => 'link',
						'type'        => __( 'Link', 'uabb' ),
						'editor_type' => 'LINK',
					],
					[
						'field'       => 'description',
						'type'        => __( 'Description Text', 'uabb' ),
						'editor_type' => 'LINE',
					],
				],
			];

			// Ribbon.
			$form['ribbon'] = [
				'conditions' => [ 'type' => 'ribbon' ],
				'fields'     => [
					[
						'field'       => 'title',
						'type'        => __( 'Ribbon Message', 'uabb' ),
						'editor_type' => 'LINE',
					],
				],
			];

			return $form;
		}
	}
	UABBLite_WPML_Translatable::init();
}
