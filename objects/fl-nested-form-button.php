<?php

/**
 * 	FLBuilder Registered Nested Forms - Button Form Field
 */

FLBuilder::register_settings_form('button_form_field', array(
    'title' => __('Button', 'uabb'),
    'tabs'  => array(
        'general'       => array(
            'title'         => __('General', 'uabb'),
            'sections'      => array(
                'general'       => array(
                    'title'         => '',
                    'fields'        => array(
                        'text'          => array(
                            'type'          => 'text',
                            'label'         => __('Text', 'uabb'),
                            'default'       => __('Click Here', 'uabb'),
                            'preview'         => array(
                                'type'            => 'text',
                                'selector'        => '.uabb-creative-button-text'
                            )
                        ),

                    )
                ),
                'link'          => array(
                    'title'         => __('Link', 'uabb'),
                    'fields'        => array(
                        'link'          => array(
                            'type'          => 'link',
                            'label'         => __('Link', 'uabb'),
                            'placeholder'   => 'http://www.example.com',
                        ),
                        'link_target'   => array(
                            'type'          => 'select',
                            'label'         => __('Link Target', 'uabb'),
                            'default'       => '_self',
                            'options'       => array(
                                '_self'         => __('Same Window', 'uabb'),
                                '_blank'        => __('New Window', 'uabb')
                            ),
                        )
                    )
                )
            )
        ),
        'style'         => array(
            'title'         => __('Style', 'uabb'),
            'sections'      => array(
                'style'         => array(
                    'title'         => __('Style', 'uabb'),
                    'fields'        => array(
                        'style'         => array(
                            'type'          => 'select',
                            'label'         => __('Style', 'uabb'),
                            'default'       => 'flat',
                            'class'         => 'creative_button_styles',
                            'options'       => array(
                                'flat'          => __('Flat', 'uabb'),
                                'gradient'      => __('Gradient', 'uabb'),
                                'transparent'   => __('Transparent', 'uabb'),
                                'threed'          => __('3D', 'uabb'),
                            ),
                            'toggle'        => array(
                                'transparent'   => array(
                                    'fields'    => array( 'border_size', 'transparent_button_options'),
                                ),
                                'threed'   => array(
                                    'fields'    => array( 'threed_button_options' )
                                ),
                                'flat'   => array(
                                    'fields'    => array( 'flat_button_options' )
                                ),
                                
                            )
                        ),
                        'border_size'   => array(
                            'type'          => 'text',
                            'label'         => __('Border Size', 'uabb'),
                            'description'   => 'px',
                            'maxlength'     => '3',
                            'size'          => '5',
                            'placeholder'   => '2'
                        ),
                        'transparent_button_options'         => array(
                            'type'          => 'select',
                            'label'         => __('Hover Styles', 'uabb'),
                            'default'       => 'transparent-fade',
                            'options'       => array(
                                'none'          => __('None', 'uabb'),
                                'transparent-fade'          => __('Fade Background', 'uabb'),
                                'transparent-fill-top'      => __('Fill Background From Top', 'uabb'),
                                'transparent-fill-bottom'      => __('Fill Background From Bottom', 'uabb'),
                                'transparent-fill-left'     => __('Fill Background From Left', 'uabb'),
                                'transparent-fill-right'     => __('Fill Background From Right', 'uabb'),
                                'transparent-fill-center'       => __('Fill Background Vertical', 'uabb'),
                                'transparent-fill-diagonal'     => __('Fill Background Diagonal', 'uabb'),
                                'transparent-fill-horizontal'  => __('Fill Background Horizontal', 'uabb'),
                            ),
                        ),
                        'threed_button_options'         => array(
                            'type'          => 'select',
                            'label'         => __('Hover Styles', 'uabb'),
                            'default'       => 'threed_down',
                            'options'       => array(
                                'threed_down'          => __('Move Down', 'uabb'),
                                'threed_up'      => __('Move Up', 'uabb'),
                                'threed_left'      => __('Move Left', 'uabb'),
                                'threed_right'     => __('Move Right', 'uabb'),
                                'animate_top'     => __('Animate Top', 'uabb'),
                                'animate_bottom'     => __('Animate Bottom', 'uabb'),
                                /*'animate_left'     => __('Animate Left', 'uabb'),
                                'animate_right'     => __('Animate Right', 'uabb'),*/
                            ),
                        ),
                        'flat_button_options'         => array(
                            'type'          => 'select',
                            'label'         => __('Hover Styles', 'uabb'),
                            'default'       => 'none',
                            'options'       => array(
                                'none'          => __('None', 'uabb'),
                                'animate_to_left'      => __('Appear Icon From Right', 'uabb'),
                                'animate_to_right'          => __('Appear Icon From Left', 'uabb'),
                                'animate_from_top'      => __('Appear Icon From Top', 'uabb'),
                                'animate_from_bottom'     => __('Appear Icon From Bottom', 'uabb'),
                            ),
                        ),
                    )
                ),
                'icon'    => array(
                    'title'         => __('Icons', 'uabb'),
                    'fields'        => array(
                        'icon'          => array(
                            'type'          => 'icon',
                            'label'         => __('Icon', 'uabb'),
                            'show_remove'   => true
                        ),
                        'icon_position' => array(
                            'type'          => 'select',
                            'label'         => __('Icon Position', 'uabb'),
                            'default'       => 'before',
                            'options'       => array(
                                'before'        => __('Before Text', 'uabb'),
                                'after'         => __('After Text', 'uabb')
                            )
                        )
                    )
                ),
                'colors'        => array(
                    'title'         => __('Colors', 'uabb'),
                    'fields'        => array(
                        'text_color'        => array( 
                            'type'       => 'color',
                            'label'         => __('Text Color', 'uabb'),
                            'default'    => '',
                            'show_reset' => true,
                        ),
                        'text_hover_color' => array( 
                            'type'       => 'color',
                            'label'   => __('Text Hover Color', 'uabb'),
                            'default' => '',
                            'show_reset' => true,
                            'preview' => array(
                                'type'          => 'none'
                            )
                        ),                        
                        'bg_color'        => array( 
                            'type'       => 'color',
                            'label'         => __('Background Color', 'uabb'),
                            'default'    => '',
                            'show_reset' => true,
                        ),
                        'bg_color_opc'    => array( 
                            'type'        => 'text',
                            'label'       => __('Opacity', 'uabb'),
                            'default'     => '',
                            'description' => '%',
                            'maxlength'   => '3',
                            'size'        => '5',
                        ),
                        'bg_hover_color'        => array( 
                            'type'       => 'color',
                            'label'         => __('Background Hover Color', 'uabb'),
                            'default'    => '',
                            'show_reset' => true,
                            'preview'       => array(
                                'type'          => 'none'
                            )
                        ),
                        'bg_hover_color_opc'    => array( 
                            'type'        => 'text',
                            'label'       => __('Opacity', 'uabb'),
                            'default'     => '',
                            'description' => '%',
                            'maxlength'   => '3',
                            'size'        => '5',
                        ),
                        'hover_attribute' => array(
                            'type'          => 'uabb-toggle-switch',
                            'label'         => __( 'Apply Hover Color To', 'uabb' ),
                            'default'       => 'bg',
                            'options'       => array(
                                'border'    => __( 'Border', 'uabb' ),
                                'bg'        => __( 'Background', 'uabb' ),
                            ),
                            'width' => '75px'
                        ),
                    )
                ),
                'formatting'    => array(
                    'title'         => __('Structure', 'uabb'),
                    'fields'        => array(
                        'width'         => array(
                            'type'          => 'select',
                            'label'         => __('Width', 'uabb'),
                            'default'       => 'auto',
                            'options'       => array(
                                'auto'          => _x( 'Auto', 'Width.', 'uabb' ),
                                'full'          => __('Full Width', 'uabb'),
                                'custom'        => __('Custom', 'uabb')
                            ),
                            'toggle'        => array(
                                'auto'          => array(
                                    'fields'        => array('align', 'mob_align', 'line_height')
                                ),
                                'full'          => array(
                                    'fields'        => array( 'line_height' )
                                ),
                                'custom'        => array(
                                    'fields'        => array('align', 'mob_align', 'custom_width', 'custom_height', 'padding_top_bottom', 'padding_left_right' )
                                )
                            )
                        ),
                        'custom_width'  => array(
                            'type'          => 'text',
                            'label'         => __('Custom Width', 'uabb'),
                            'default'       => '200',
                            'maxlength'     => '3',
                            'size'          => '4',
                            'description'   => 'px'
                        ),
                        'custom_height'  => array(
                            'type'          => 'text',
                            'label'         => __('Custom Height', 'uabb'),
                            'default'       => '45',
                            'maxlength'     => '3',
                            'size'          => '4',
                            'description'   => 'px'
                        ),
                        'padding_top_bottom'       => array(
                            'type'          => 'text',
                            'label'         => __('Padding Top/Bottom', 'uabb'),
                            'placeholder'   => '0',
                            'maxlength'     => '3',
                            'size'          => '4',
                            'description'   => 'px'
                        ),
                        'padding_left_right'       => array(
                            'type'          => 'text',
                            'label'         => __('Padding Left/Right', 'uabb'),
                            'placeholder'   => '0',
                            'maxlength'     => '3',
                            'size'          => '4',
                            'description'   => 'px'
                        ),
                        'border_radius' => array(
                            'type'          => 'text',
                            'label'         => __('Round Corners', 'uabb'),
                            'maxlength'     => '3',
                            'size'          => '4',
                            'description'   => 'px'
                        ),
                        'align'         => array(
                            'type'          => 'select',
                            'label'         => __('Alignment', 'uabb'),
                            'default'       => 'center',
                            'options'       => array(
                                'center'        => __('Center', 'uabb'),
                                'left'          => __('Left', 'uabb'),
                                'right'         => __('Right', 'uabb')
                            )
                        ),
                        'mob_align'         => array(
                            'type'          => 'select',
                            'label'         => __('Mobile Alignment', 'uabb'),
                            'default'       => 'center',
                            'options'       => array(
                                'center'        => __('Center', 'uabb'),
                                'left'          => __('Left', 'uabb'),
                                'right'         => __('Right', 'uabb')
                            )
                        ),
                    )
                )
            )
        ),
        'creative_typography'         => array(
            'title'         => __('Typography', 'uabb'),
            'sections'      => array(
                'typography'    =>  array(
                    'title'     => __('Button Settings', 'uabb' ) ,
                    'fields'    => array(
                        'font_family'       => array(
                            'type'          => 'font',
                            'label'         => __('Font Family', 'uabb'),
                            'default'       => array(
                                'family'        => 'Default',
                                'weight'        => 'Default'
                            ),
                            'preview'         => array(
                                'type'            => 'font',
                                'selector'        => '.uabb-creative-button'
                            )
                        ),
                        'font_size'     => array(
                            'type'          => 'uabb-simplify',
                            'label'         => __( 'Font Size', 'uabb' ),
                            'default'       => array(
                                'desktop'       => '',
                                'medium'        => '',
                                'small'         => '',
                            )
                        ),
                        'line_height'    => array(
                            'type'          => 'uabb-simplify',
                            'label'         => __( 'Line Height', 'uabb' ),
                            'default'       => array(
                                'desktop'       => '',
                                'medium'        => '',
                                'small'         => '',
                            )
                        ),
                    )
                ),
            )
        )
    )
));
