<?php

/**
 *
 * @class RibbonModule
 */
class RibbonModule extends FLBuilderModule {

    /**
     *
     * @method __construct
     */
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Ribbon', 'uabb'),
            'description'   => __('Ribbon', 'uabb'),
            'category'		=> UABB_CAT,
            'dir'           => BB_ULTIMATE_ADDON_DIR . 'modules/ribbon/',
            'url'           => BB_ULTIMATE_ADDON_URL . 'modules/ribbon/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
        ));
    }

}



/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('RibbonModule', array(
    'general'       => array( // Tab
        'title'         => __('Layout', 'uabb'), // Tab title
        'sections'      => array( // Tab Sections
            'general'       => array(
                'title'         => '',
                'fields'        => array(
                    'title'         => array(
                        'type'          => 'text',
                        'label'         => __('Ribbon Message', 'uabb'),
                        'default'       => __('SPECIAL OFFER','uabb'),
                        'preview'       => array(
                            'type'          => 'text',
                            'selector'      => '.uabb-ribbon-text-title',
                        ),
                    ),
                    'left_icon'          => array(
                        'type'          => 'icon',
                        'label'         => __('Left Icon', 'uabb'),
                        'show_remove'   => true
                    ),
                    'right_icon'          => array(
                        'type'          => 'icon',
                        'label'         => __('Right Icon', 'uabb'),
                        'show_remove'   => true
                    ),
                    'ribbon_resp'          => array(
                        'type'          => 'select',
                        'label'         => __('Hide Ribbon Wings', 'uabb'),
                        'default'       => 'small',
                        'help' => __( 'To hide Ribbon Wings on Small or Medium device use this option.', 'uabb' ),
                        'options'       => array(
                            'none'         => __('None', 'uabb'),
                            'small'        => __('Small Devices', 'uabb'),
                            'medium'       => __('Medium & Small Devices', 'uabb'),
                        ),
                    )
                )
            ),
            'style'          => array(
                'title'         => __('Style', 'uabb'),
                'fields'        => array(
                    'ribbon_width'          => array(
                        'type'          => 'select',
                        'label'         => __('Ribbon Width', 'uabb'),
                        'default'       => 'auto',
                        'options'       => array(
                            'auto'         => __('Auto', 'uabb'),
                            'full'         => __('Full', 'uabb'),
                            'custom'         => __('Custom', 'uabb'),
                        ),
                        'toggle' => array(
                            'custom' => array(
                                'fields' => array( 'custom_width', 'ribbon_align' )
                            ),
                            'auto' => array(
                                'fields' => array( 'ribbon_align' /*, 'responsive_compatibility'*/ )
                            ),
                        )
                    ),
                    'custom_width'     => array(
                        'type'          => 'text',
                        'label'         => __('Custom Width', 'uabb'),
                        'placeholder'   => '500',
                        'size'          => '6',
                        'description'   => 'px',
                    ),
                    'ribbon_align'          => array(
                        'type'          => 'select',
                        'label'         => __('Alignment', 'uabb'),
                        'default'       => 'center',
                        'help' => __( 'To align Ribbon use this setting.', 'uabb' ),
                        'options'       => array(
                            'center'        => __('Center', 'uabb'),
                            'left'          => __('Left', 'uabb'),
                            'right'         => __('Right', 'uabb'),
                        ),
                    ),
                    /*'responsive_compatibility' => array(
                        'type' => 'uabb-toggle-switch',
                        'label' => __('Responsive Compatibility', 'uabb'),
                        'help' => __('There might be responsive issues for long texts. If you are facing such issues then select this option as Yes.', 'uabb'),
                        'default' => 'no',
                        'options' => array(
                            'yes' => __('Yes','uabb'),
                            'no' => __('No','uabb'),
                        ),
                    ),*/
                    'stitching'     => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Stitching', 'uabb' ),
                        'default'       => 'yes',
                        'options'       => array(
                            'yes'      => __( 'Yes', 'uabb' ),
                            'no'        => __( 'No', 'uabb' ),
                        ),
                        'help' => __( 'To give Stitch effect on Ribbon', 'uabb' )
                    ),
                    'shadow'     => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Ribbon Shadow', 'uabb' ),
                        'default'       => 'yes',
                        'options'       => array(
                            'yes'      => __( 'Yes', 'uabb' ),
                            'no'        => __( 'No', 'uabb' ),
                        )
                    ),
                )
            ),
            'colors'          => array(
                'title'         => __('Ribbon Colors', 'uabb'),
                'fields'        => array(
                    'ribbon_bg_type'          => array(
                        'type'          => 'select',
                        'label'         => __('Ribbon Color Type', 'uabb'),
                        'default'       => 'color',
                        'help' => __( 'You can select one of the two background types: Color: simple one color background or Gradient: two color background.', 'uabb' ),
                        'options'       => array(
                            'color'        => __('Color', 'uabb'),
                            'gradient'     => __('Gradient', 'uabb'),
                        ),
                        'toggle' => array(
                            'color' => array(
                                'fields' => array( 'ribbon_color' )
                            ),
                            'gradient' => array(
                                'fields' => array( /*'top_gradient_color', 'bottom_gradient_color'*/ 'gradient_color' )
                            ),
                        )
                    ),
                    'ribbon_color' => array( 
                        'type'       => 'color',
                        'label'         => __('Ribbon Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'gradient_color' => array(
                        'type'          => 'uabb-gradient',
                        'label'         => __('Gradient', 'uabb'),
                        'default'       => array(
                            'color_one' => '',
                            'color_two' => '',
                            'direction' => 'top_bottom',
                            'angle'     => '0'
                        ),
                    ),
                    'icon_color' => array( 
                        'type'       => 'color',
                        'label'         => __('Icon Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'fold_color' => array( 
                        'type'       => 'color',
                        'label'         => __('Ribbon Fold Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'end_color' => array( 
                        'type'       => 'color',
                        'label'         => __('Ribbon Wings Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                )
            ),
        )
    ),
    'typography'       => array( // Tab
        'title'         => __('Typography', 'uabb'), // Tab title
        'sections'      => array( // Tab Sections
            'text_typography' => array(
                'title' => __('Ribbon Text', 'uabb' ),
                'fields'    => array(
                    'text_tag_selection'   => array(
                        'type'          => 'select',
                        'label'         => __('Tag', 'uabb'),
                        'default'       => 'h3',
                        'options'       => array(
                            'h1'      => __('H1', 'uabb'),
                            'h2'      => __('H2', 'uabb'),
                            'h3'      => __('H3', 'uabb'),
                            'h4'      => __('H4', 'uabb'),
                            'h5'      => __('H5', 'uabb'),
                            'h6'      => __('H6', 'uabb'),
                            'div'     => __('Div', 'uabb'),
                            'p'       => __('p', 'uabb'),
                            'span'    => __('span', 'uabb'),
                        )
                    ),
                    'text_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.uabb-ribbon-text'
                        )
                    ),
                    'text_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                    ),
                    'text_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                    ),
                    'text_color'        => array( 
                        'type'       => 'color',
                        'label'      => __('Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'text_shadow_color' => array( 
                        'type'       => 'color',
                        'label'         => __('Text Shadow Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                )
            ),
        )
    ),
));
