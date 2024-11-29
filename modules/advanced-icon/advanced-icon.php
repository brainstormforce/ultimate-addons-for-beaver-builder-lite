<?php
/**
 *  UABB Advanced Icon Module file
 *
 *  @package UABB Advanced Icon Module
 */

/**
 * Function that initializes UABB Advanced Icon Module
 *
 * @class UABBAdvancedIconModule
 */
class UABBAdvancedIconModule extends FLBuilderModule {
	/**
	 * Constructor function that constructs default values for the Advanced Icon module.
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			[
				'name'            => __( 'Advanced Icons', 'uabb' ),
				'description'     => __( 'Display a group of Image / Icons.', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$basic_modules ),
				'group'           => defined( 'UABB_CAT' ) ? UABB_CAT : '',
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/advanced-icon/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/advanced-icon/',
				'editor_export'   => false, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => true,
				'icon'            => 'star-filled.svg',
			]
		);
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 *
 */

FLBuilder::register_module(
	'UABBAdvancedIconModule',
	[
		'advimgicons' => [
			'title'    => __( 'Image / Icon', 'uabb' ),
			'sections' => [
				'general' => [
					'title'  => '',
					'fields' => [
						'icons' => [
							'type'         => 'form',
							'label'        => __( 'Image / Icon', 'uabb' ),
							'form'         => 'uabb_advicon_group_form', // ID from registered form below.
							'preview_text' => 'image_type', // Name of a field to use for the preview text.
							'multiple'     => true,
						],
					],
				],
			],
		],
		'style'       => [ // Tab.
			'title'    => __( 'Style', 'uabb' ), // Tab title.
			'sections' => [ // Tab Sections.
				'structure' => [ // Section.
					'title'  => __( 'Structure', 'uabb' ), // Section Title.
					'fields' => [ // Section Fields.
						'icon_struc_align' => [
							'type'    => 'select',
							'label'   => __( 'Icons Structure', 'uabb' ),
							'default' => 'horizontal',
							'options' => [
								'horizontal' => __( 'Horizontal', 'uabb' ),
								'vertical'   => __( 'Vertical', 'uabb' ),
							],
							'width'   => '70px',
						],
						'size'             => [
							'type'       => 'unit',
							'label'      => __( 'Icon Size', 'uabb' ),
							'default'    => '40',
							'responsive' => 'true',
							'units'      => [ 'px' ],
							'slider'     => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								],
							],
						],
						'spacing'          => [
							'type'       => 'unit',
							'label'      => __( 'Spacing', 'uabb' ),
							'default'    => '10',
							'maxlength'  => '2',
							'size'       => '4',
							'responsive' => 'true',
							'units'      => [ 'px' ],
							'help'       => __( 'To manage the space between Icons use this option', 'uabb' ),
							'slider'     => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								],
							],
						],
						'icoimage_style'   => [
							'type'    => 'select',
							'label'   => __( 'Icon Background Style', 'uabb' ),
							'default' => 'simple',
							'options' => [
								'simple' => __( 'Simple', 'uabb' ),
								'circle' => __( 'Circle Background', 'uabb' ),
								'square' => __( 'Square Background', 'uabb' ),
								'custom' => __( 'Design your own', 'uabb' ),
							],
							'toggle'  => [
								'circle' => [
									'fields' => [ 'color_preset', 'bg_color', 'bg_hover_color', 'three_d' ],
								],
								'square' => [
									'fields' => [ 'color_preset', 'bg_color', 'bg_hover_color', 'three_d' ],
								],
								'custom' => [
									'fields' => [ 'color_preset', 'border_style', 'bg_color', 'bg_hover_color', 'three_d', 'bg_size', 'bg_border_radius' ],
								],
							],
						],
						'bg_size'          => [
							'type'      => 'unit',
							'label'     => __( 'Background Size', 'uabb' ),
							'help'      => __( 'Spacing between Icon & Background edge', 'uabb' ),
							'default'   => '10',
							'maxlength' => '3',
							'size'      => '6',
							'units'     => [ 'px' ],
							'slider'    => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								],
							],
						],
						'border_style'     => [
							'type'    => 'select',
							'label'   => __( 'Border Style', 'uabb' ),
							'default' => 'none',
							'help'    => __( 'The type of border to use. Double borders must have a width of at least 3px to render properly.', 'uabb' ),
							'options' => [
								'none'   => __( 'None', 'uabb' ), // Removed args  'Border type.'.
								'solid'  => __( 'Solid', 'uabb' ), // Removed args  'Border type.'.
								'dashed' => __( 'Dashed', 'uabb' ), // Removed args  'Border type.'.
								'dotted' => __( 'Dotted', 'uabb' ), // Removed args  'Border type.'.
								'double' => __( 'Double', 'uabb' ), // Removed args  'Border type.'.
							],
							'toggle'  => [
								'solid'  => [
									'fields' => [ 'border_width', 'border_color', 'border_hover_color' ],
								],
								'dashed' => [
									'fields' => [ 'border_width', 'border_color', 'border_hover_color' ],
								],
								'dotted' => [
									'fields' => [ 'border_width', 'border_color', 'border_hover_color' ],
								],
								'double' => [
									'fields' => [ 'border_width', 'border_color', 'border_hover_color' ],
								],
							],
						],
						'border_width'     => [
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '1',
							'units'       => [ 'px' ],
							'slider'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								],
							],
						],
						'bg_border_radius' => [
							'type'        => 'unit',
							'label'       => __( 'Border Radius', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '0',
							'units'       => [ 'px' ],
							'slider'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								],
							],
						],
						'align'            => [
							'type'    => 'align',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'center',
							'help'    => __( 'The overall alignment of Icon', 'uabb' ),
						],
						'responsive_align' => [
							'type'    => 'align',
							'label'   => __( 'Mobile Alignment', 'uabb' ),
							'default' => '',
							'help'    => __( 'This alignment will apply on Mobile', 'uabb' ),
						],
					],
				],
				'colors'    => [ // Section.
					'title'  => __( 'Colors', 'uabb' ), // Section Title.
					'fields' => [ // Section Fields.
						'color_preset'       => [
							'type'    => 'select',
							'label'   => __( 'Icon Color Presets', 'uabb' ),
							'default' => 'preset1',
							'options' => [

								'preset1' => __( 'Preset 1', 'uabb' ),
								'preset2' => __( 'Preset 2', 'uabb' ),
							],
							'help'    => __( 'Preset 1 => Icon : White, Background : Theme </br>Preset 2 => Icon : Theme, Background : #f3f3f3', 'uabb' ),
						],
						'color'              => [
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'connections' => [ 'color' ],
							'show_alpha'  => true,
							'show_reset'  => true,
						],
						'hover_color'        => [
							'type'        => 'color',
							'label'       => __( 'Hover Color', 'uabb' ),
							'default'     => '',
							'connections' => [ 'color' ],
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => [
								'type' => 'none',
							],
						],
						'bg_color'           => [
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'connections' => [ 'color' ],
							'show_alpha'  => true,
							'show_reset'  => true,
						],
						'bg_hover_color'     => [
							'type'        => 'color',
							'label'       => __( 'Background Hover Color', 'uabb' ),
							'default'     => '',
							'connections' => [ 'color' ],
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => [
								'type' => 'none',
							],
						],
						'border_color'       => [
							'type'        => 'color',
							'label'       => __( 'Border Color', 'uabb' ),
							'default'     => '',
							'connections' => [ 'color' ],
							'show_alpha'  => true,
							'show_reset'  => true,
						],
						'border_hover_color' => [
							'type'        => 'color',
							'label'       => __( 'Border Hover Color', 'uabb' ),
							'default'     => '',
							'connections' => [ 'color' ],
							'show_alpha'  => true,
							'show_reset'  => true,
						],
						'three_d'            => [
							'type'    => 'select',
							'label'   => __( 'Gradient', 'uabb' ),
							'default' => '0',
							'options' => [
								'0' => __( 'No', 'uabb' ),
								'1' => __( 'Yes', 'uabb' ),
							],
						],
					],
				],
			],
		],
	]
);

/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form(
	'uabb_advicon_group_form',
	[
		'title' => __( 'Add Icon', 'uabb' ),
		'tabs'  => [
			'form_general' => [ // Tab.
				'title'    => __( 'General', 'uabb' ), // Tab title.
				'sections' => [ // Tab Sections.
					'general' => [ // Section.
						'title'  => '', // Section Title.
						'fields' => [ // Section Fields.
							'image_type' => [
								'type'    => 'select',
								'label'   => __( 'Image Type', 'uabb' ),
								'default' => 'icon',
								'options' => [
									'icon'  => __( 'Icon', 'uabb' ),
									'photo' => __( 'Photo', 'uabb' ),
								],
								'toggle'  => [
									'icon'  => [
										'fields' => [ 'icon', 'icocolor', 'icohover_color' ],
										'tabs'   => [ 'form_style' ],
									],
									'photo' => [
										'fields' => [ 'photo' ],
									],
								],
							],
							'icon'       => [
								'type'        => 'icon',
								'label'       => __( 'Icon', 'uabb' ),
								'default'     => 'ua-icon ua-icon-facebook-with-circle',
								'show_remove' => true,
							],
							'photo'      => [
								'type'        => 'photo',
								'label'       => __( 'Photo', 'uabb' ),
								'show_remove' => true,
							],
							'link'       => [
								'type'          => 'link',
								'label'         => __( 'Link', 'uabb' ),
								'description'   => '',
								'show_target'   => true,
								'show_nofollow' => true,
								'preview'       => [
									'type' => 'none',
								],
								'connections'   => [ 'url' ],
							],
						],
					],
				],
			],
			'form_style'   => [ // Tab.
				'title'       => __( 'Style', 'uabb' ), // Tab title.
				'description' => __( 'This background color properties will work only when Icon background style is not simple. Also the border color properties will work for Design your own.', 'uabb' ),
				'sections'    => [ // Tab Sections.
					'colors' => [ // Section.
						'title'  => __( 'Colors', 'uabb' ), // Section Title.
						'fields' => [ // Section Fields.
							'icocolor'           => [
								'type'        => 'color',
								'label'       => __( 'Color', 'uabb' ),
								'default'     => '',
								'connections' => [ 'color' ],
								'show_alpha'  => true,
								'show_reset'  => true,
							],
							'icohover_color'     => [
								'type'        => 'color',
								'label'       => __( 'Hover Color', 'uabb' ),
								'default'     => '',
								'connections' => [ 'color' ],
								'show_alpha'  => true,
								'show_reset'  => true,
								'preview'     => [
									'type' => 'none',
								],
							],
							'bg_color'           => [
								'type'        => 'color',
								'label'       => __( 'Background Color ', 'uabb' ),
								'default'     => '',
								'connections' => [ 'color' ],
								'show_alpha'  => true,
								'show_reset'  => true,
							],
							'bg_hover_color'     => [
								'type'        => 'color',
								'label'       => __( 'Background Hover Color', 'uabb' ),
								'default'     => '',
								'connections' => [ 'color' ],
								'show_alpha'  => true,
								'show_reset'  => true,
								'preview'     => [
									'type' => 'none',
								],
							],
							/* Border Color Dependent on Border Style for ICon */
							'border_color'       => [
								'type'        => 'color',
								'label'       => __( 'Border Color', 'uabb' ),
								'default'     => '',
								'connections' => [ 'color' ],
								'show_alpha'  => true,
								'show_reset'  => true,
							],
							'border_hover_color' => [
								'type'        => 'color',
								'label'       => __( 'Border Hover Color', 'uabb' ),
								'default'     => '',
								'connections' => [ 'color' ],
								'show_alpha'  => true,
								'show_reset'  => true,
								'preview'     => [
									'type' => 'none',
								],
							],
						],
					],
				],
			],
		],
	]
);
