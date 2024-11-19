<?php
/**
 *  UABB Star Rating Module file
 *
 *  @package UABB Star Rating
 */

/**
 * Class that initializes UABB Star Rating Module
 *
 * @class UABBStarRatingModule
 */
class UABBStarRatingModule extends FLBuilderModule {

	/**
	 * Constructor function for the module. You must pass the
	 * name, description, dir and url in an array to the parent class.
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Star Rating', 'uabb' ),
				'description'     => __( 'A module for Star Rating.', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$basic_modules ),
				'group'           => defined( 'UABB_CAT' ) ? UABB_CAT : '',
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-star-rating/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-star-rating/',
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => true,
				'icon'            => 'star.svg',
			)
		);

		$this->add_css( 'font-awesome-5' );
	}

		/**
		 * Function to get the icon for the Star Rating
		 *
		 * @method get_icons
		 * @param string $icon gets the icon for the module.
		 * @return string Icon path or empty string if not found
		 */
	public function get_icon( $icon = '' ) {

		$path = ''; // Default Initialization.

		// check if $icon is referencing an included icon.
		if ( '' !== $icon && file_exists( BB_ULTIMATE_ADDON_DIR . 'modules/uabb-star-rating/icon/' . $icon ) ) {
			$path = BB_ULTIMATE_ADDON_DIR . 'modules/uabb-star-rating/icon/' . $icon;
		}

		if ( file_exists( $path ) ) {
			$icon_content = file_get_contents( $path );
			return false !== $icon_content ? $icon_content : '';
		}

		return ''; // Return an empty string if no icon found.
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module(
	'UABBStarRatingModule',
	array(
		'star_rating_tab'  => array( // Tab.
			'title'    => __( 'General', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'heading_section' => array(// Section.
					'title'  => __( 'Star Rating', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'rating_scale'  => array(
							'type'    => 'select',
							'label'   => __( 'Scale', 'uabb' ),
							'default' => '5',
							'options' => array(
								'5'  => __( '0-5 Stars', 'uabb' ),
								'10' => __( '0-10 Stars', 'uabb' ),
							),
						),
						'rating'        => array(
							'type'    => 'unit',
							'label'   => __( 'Rating', 'uabb' ),
							'default' => '4',
							'slider'  => array(
								'step' => .5,
								'max'  => 10,
							),
						),
						'star_style'    => array(
							'type'    => 'select',
							'label'   => __( 'Unmarked Style', 'uabb' ),
							'default' => 'solid',
							'options' => array(
								'solid'   => __( 'Solid', 'uabb' ),
								'outline' => __( 'Outline', 'uabb' ),
							),
						),
						'rating_title'  => array(
							'type'        => 'text',
							'label'       => __( 'Title', 'uabb' ),
							'class'       => '',
							'default'     => __( 'Ratings !!!', 'uabb' ),
							'connections' => array( 'string', 'html', 'url' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-rating-title',
							),
						),
						'rating_layout' => array(
							'type'    => 'select',
							'label'   => __( 'Layout', 'uabb' ),
							'default' => 'default',
							'options' => array(
								'default' => __( 'Default', 'uabb' ),
								'inline'  => __( 'Inline', 'uabb' ),
							),
							'toggle'  => array(
								'inline' => array(
									'fields' => array( 'title_spacing' ),
								),
							),
						),
						'star_position' => array(
							'type'    => 'select',
							'label'   => __( 'Position', 'uabb' ),
							'default' => 'bottom',
							'options' => array(
								'top'    => __( 'Star First', 'uabb' ),
								'bottom' => __( 'Title First', 'uabb' ),
							),
						),
					),
				),
			),
		),
		'title_style'      => array( // Tab.
			'title'    => __( 'Style', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'rating_style' => array(
					'title'  => __( 'Rating', 'uabb' ),
					'fields' => array(
						'rating_color'          => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => 'f0ad4e',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
						),
						'rating_unmarked_color' => array(
							'type'        => 'color',
							'label'       => __( 'Unmarked Color', 'uabb' ),
							'default'     => 'efecdc',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
						),
						'star_icon_size'        => array(
							'type'       => 'unit',
							'label'      => __( 'Size', 'uabb' ),
							'default'    => '30',
							'responsive' => true,
							'units'      => array( 'px' ),
							'slider'     => array(
								'min' => 10,
								'max' => 100,
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-rating i',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'star_icon_spacing'     => array(
							'type'       => 'unit',
							'label'      => __( 'Spacing', 'uabb' ),
							'responsive' => true,
							'units'      => array( 'px' ),
							'slider'     => array(
								'min' => 0,
								'max' => 100,
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-rating-content .uabb-rating > i',
								'property' => 'margin-right',
								'unit'     => 'px',
							),
						),
						'alignment'             => array(
							'type'       => 'select',
							'label'      => __( 'Alignment', 'uabb' ),
							'default'    => 'left',
							'responsive' => true,
							'options'    => array(
								'left'    => __( 'Left', 'uabb' ),
								'center'  => __( 'Center', 'uabb' ),
								'right'   => __( 'Right', 'uabb' ),
								'justify' => __( 'Justify', 'uabb' ),
							),
						),
					),
				),
				'title_style'  => array(
					'title'  => __( 'Title', 'uabb' ),
					'fields' => array(
						'title_color'   => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '000000',
							'show_reset'  => true,
							'show_alpha'  => false,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-rating-content .uabb-rating-title',
								'property' => 'color',
							),
						),
						'title_spacing' => array(
							'type'    => 'unit',
							'label'   => __( 'Spacing', 'uabb' ),
							'default' => '10',
							'units'   => array( 'px' ),
							'slider'  => true,
						),
					),
				),
			),
		),
		'title_typography' => array( // Tab.
			'title'    => __( 'Typography', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'title_style' => array(
					'title'  => __( 'Title', 'uabb' ),
					'fields' => array(
						'title_typography' => array(
							'type'       => 'typography',
							'label'      => __( 'Title', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-rating-title',
							),
						),
					),
				),
			),
		),
	)
);
