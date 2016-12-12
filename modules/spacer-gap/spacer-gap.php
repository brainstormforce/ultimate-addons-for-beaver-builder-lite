<?php

class UABBSpacerGap extends FLBuilderModule {

    public function __construct()
    {
        parent::__construct(array(
            'name'            => __( 'Spacer / Gap', 'uabb' ),
            'description'     => __( 'A totally awesome module!', 'uabb' ),
            'category'        => UABB_CAT,
            'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/spacer-gap/',
            'url'             => BB_ULTIMATE_ADDON_URL . 'modules/spacer-gap/',
            'editor_export'   => true, // Defaults to true and can be omitted.
            'enabled'         => true, // Defaults to true and can be omitted.
            'partial_refresh' => false, // Defaults to false and can be omitted.
        ));
    }
}

FLBuilder::register_module('UABBSpacerGap', array(
    'spacer_gap_general'       => array( // Tab
        'title'         => __('General', 'uabb'), // Tab title
        'sections'      => array( // Tab Sections
            'spacer_gap_general'       => array( // Section
                'title'         => '', // Section Title
                'fields'        => array( // Section Fields
                    'desktop_space'   => array(
                        'type'          => 'text',
                        'label'         => __('Desktop', 'uabb'),
                        'size'          => '8',
                        'placeholder'   => '10',
                        'class'         => 'uabb-spacer-gap-desktop',
                        'description'   => 'px',
                        'help'          => __( 'This value will work for all devices.', 'uabb' )
                    ),
                    'medium_device'   => array(
                        'type'          => 'text',
                        'label'         => __('Medium Device ( Tabs )', 'uabb'),
                        'default'       => '',
                        'size'          => '8',
                        'class'         => 'uabb-spacer-gap-tab-landscape',
                        'description'   => 'px',
                    ),

                    'small_device'   => array(
                        'type'          => 'text',
                        'label'         => __('Small Device ( Mobile )', 'uabb'),
                        'default'       => '',
                        'size'          => '8',
                        'class'         => 'uabb-spacer-gap-mobile',
                        'description'   => 'px',
                    ),
                )
            )
        )
    )
));