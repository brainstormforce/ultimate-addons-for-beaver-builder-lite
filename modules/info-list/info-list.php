<?php

class UABBInfoList extends FLBuilderModule {

    public function __construct()
    {
        parent::__construct(array(
            'name'            => __( 'Info List', 'uabb' ),
            'description'     => __( 'A totally awesome module!', 'uabb' ),
            'category'      => UABB_CAT,
            'dir'           => BB_ULTIMATE_ADDON_DIR . 'modules/info-list/',
            'url'           => BB_ULTIMATE_ADDON_URL . 'modules/info-list/',
            'editor_export'   => true, // Defaults to true and can be omitted.
            'enabled'         => true, // Defaults to true and can be omitted.
            'partial_refresh' => false, // Defaults to false and can be omitted.
        ));
        $this->add_js( 'jquery-waypoints' );
        // Register and enqueue your own.
        $this->add_css( 'uabb-animate', $this->url . 'css/animate.css' );
    }


    /**
     * @method render_image
     */
    public function render_image( $item, $settings )
    {
        if ( $settings->list_icon_style == 'circle' ) {
            $infolist_icon_size = $settings->icon_image_size / 2;
        }else if ( $settings->list_icon_style == 'square' ) {
            $infolist_icon_size = $settings->icon_image_size / 2;
        }else if ( $settings->list_icon_style == 'custom' ) {
            $infolist_icon_size = $settings->icon_image_size;
        }else {
            $infolist_icon_size = $settings->icon_image_size;
        }
        $imageicon_array = array(
 
            /* General Section */
            'image_type' => $item->image_type,
         
            /* Icon Basics */
            'icon' => $item->icon,
            'icon_size' => $infolist_icon_size,
            'icon_align' => "center",
         
            /* Image Basics */
            'photo_source' => $item->photo_source,
            'photo' => $item->photo,
            'photo_url' => $item->photo_url,
            'img_size' => $settings->icon_image_size,
            'img_align' => "center",
            'photo_src' => ( isset( $item->photo_src ) ) ? $item->photo_src : '' ,
         
            /* Icon Style */
            'icon_style' => $settings->list_icon_style,
            'icon_bg_size' => $settings->list_icon_bg_padding,
            'icon_border_style' => "",
            'icon_border_width' => "",
            'icon_bg_border_radius' => $settings->list_icon_bg_border_radius,
         
            /* Image Style */
            'image_style' => $settings->list_icon_style,
            'img_bg_size' => $settings->list_icon_bg_padding,
            'img_border_style' => "",
            'img_border_width' => "",
            'img_bg_border_radius' => $settings->list_icon_bg_border_radius,
        ); 
        /* Render HTML Function */
        FLBuilder::render_module_html( 'image-icon', $imageicon_array );

    }
    /**
     * @method render_text
     */
    public function render_each_item( $item, $list_item_counter )
    {
        echo '<li class="uabb-info-list-item info-list-item-dynamic'.$list_item_counter.'">';
        echo '<div class="uabb-info-list-content-wrapper uabb-info-list-'.$this->settings->icon_position.'">';

        if ( !empty( $item->list_item_link ) && $item->list_item_link === "complete" && !empty($item->list_item_url) ) {

            echo '<a href="'.$item->list_item_url.'" class="uabb-info-list-link" target="'.$item->list_item_link_target.'"></a>';
        }

        if( $item->image_type != "none" ) {
            echo '<div class="uabb-info-list-icon info-list-icon-dynamic'. $list_item_counter.'">';

            if ( !empty( $item->list_item_link ) && $item->list_item_link == "icon") {
                echo '<a href="'. $item->list_item_url .'" class="uabb-info-list-link" target="'. $item->list_item_link_target .'"></a>';
            }
                $this->render_image( $item, $this->settings );
          
            echo '</div>';
        }

        echo '<div class="uabb-info-list-content uabb-info-list-'. $this->settings->icon_position.' info-list-content-dynamic'. $list_item_counter.'">';
        
        echo '<'. $this->settings->heading_tag_selection . ' class="uabb-info-list-title">';
        if ( !empty( $item->list_item_link ) && $item->list_item_link === "list-title" && !empty($item->list_item_url) ) {

            echo '<a href="'. $item->list_item_url .'" target="'.$item->list_item_link_target.'">';

        }
        echo $item->list_item_title;
        if ( !empty( $item->list_item_link ) && $item->list_item_link === "list-title" && !empty($item->list_item_url) ) {

            echo '</a>';

        }
        echo '</'. $this->settings->heading_tag_selection . ' >';
        
        
        echo '<div class="uabb-info-list-description uabb-text-editor info-list-description-dynamic'. $list_item_counter.'">';
        if ( strpos( $item->list_item_description, "</p>" ) > 0 ) {
            echo $item->list_item_description;
        }else{
            echo "<p>".$item->list_item_description."</p>";
        }

        echo '</div>';

        echo '</div>';

        $list_item_counter = $list_item_counter + 1;
        echo '</div>';
        if( $item->image_type != "none" ) {
            if( $this->settings->align_items == 'center' && $this->settings->icon_position != 'top' ) {
                echo '<div class="uabb-info-list-connector-top uabb-info-list-'. $this->settings->icon_position.'"></div>';
            }
            echo '<div class="uabb-info-list-connector uabb-info-list-'. $this->settings->icon_position.'"></div>';
        }
        
        echo '</li>';
    }
    /**
     * @method render_text
     */
    public function render_list()
    {
        $info_list_html= "";
        $list_item_counter = 0;
        foreach( $this->settings->add_list_item as $item ){
            $this->render_each_item( $item, $list_item_counter );
            $list_item_counter = $list_item_counter + 1;
        }
    }
}

FLBuilder::register_module('UABBInfoList', array(
    'info_list_item'       => array( // Tab
        'title'         => __('List Item', 'uabb'), // Tab title
        'sections'      => array( // Tab Sections
            'info_list_general'       => array( // Section
                'title'         => '', // Section Title
                'fields'        => array( // Section Fields
                    'add_list_item'     => array(
                        'type'         => 'form',
                        'label'        => __('List Item', 'uabb'),
                        'form'         => 'info_list_item_form',
                        'preview_text' => 'list_item_title',
                        'multiple'     => true
                    ),
                )
            )
        )
    ),

    'info_list_general'       => array( // Tab
        'title'         => __('General', 'uabb'), // Tab title
        'sections'      => array( // Tab Sections
            'info_list_general'       => array( // Section
                'title'         => __('List Settings', 'uabb'), // Section Title
                'fields'        => array( // Section Fields
                    'icon_position'   => array(
                        'type'          => 'select',
                        'label'         => __('Icon / Image Position', 'uabb'),
                        'default'       => 'left',
                        'options'       => array(
                            'left'      => __('Icon to the left', 'uabb'),
                            'right'     => __('Icon to the right', 'uabb'),
                            'top'       => __('Icon at top', 'uabb')
                        ),
                        'toggle' => array(
                            'left' => array(
                                'fields' => array( 'align_items', 'mobile_view' )
                            ),
                            'right' => array(
                                'fields' => array( 'align_items', 'mobile_view' )
                            ),
                        )
                    ),
                    'align_items' => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __('Icon Vertical Alignment', 'uabb'),
                        'default'       => 'top',
                        'options'       => array(
                            'center'        => __('Center', 'uabb'),
                            'top'          => __('Top', 'uabb'),
                        ),
                    ),
                    'mobile_view' => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __('Mobile Structure', 'uabb'),
                        'default'       => '',
                        'options'       => array(
                            ''        => __('Inline', 'uabb'),
                            'stack'   => __('Stack', 'uabb'),
                        ),
                        'preview'       => array(
                            'type'    => 'none'
                        )
                    ),
                    'icon_image_size'          => array(
                        'type'          => 'text',
                        'label'         => __('Icon / Image Size', 'uabb'),
                        'description'   => 'px',
                        'size'          => '8',
                        'placeholder'   => '75',
                    ),
                    'space_between_elements'          => array(
                        'type'          => 'text',
                        'label'         => __('Space Between Two Elements', 'uabb'),
                        'description'   => 'px',
                        'size'          => '8',
                        'placeholder'   => '20',
                    ),
                    'list_icon_style'         => array(
                        'type'          => 'select',
                        'label'         => __('Icon / Image Style', 'uabb'),
                        'default'       => 'simple',
                        'description'   => '',
                        'options'       => array(
                            'simple'         => __('Simple', 'uabb'),
                            'square'         => __('Square', 'uabb'),
                            'circle'          => __('Circle', 'uabb'),
                            'custom'         => __('Design your own', 'uabb'),
                        ),
                        'toggle' => array(
                            'circle' => array(
                                'fields' => array( 'list_icon_bg_color', 'list_icon_bg_color_opc' )
                            ),
                            'square' => array(
                                'fields' => array( 'list_icon_bg_color', 'list_icon_bg_color_opc' )
                            ),
                            'custom' => array(
                                'fields' => array( 'list_icon_bg_color', 'list_icon_bg_color_opc', 'list_icon_bg_size', 'list_icon_bg_border_radius', 'list_icon_bg_padding', 'list_icon_border_style' )
                            )
                        )
                    ),
                    'list_icon_bg_color'    => array( 
                        'type'       => 'color',
                        'label'         => __('Color Option for Background', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'list_icon_bg_color_opc'    => array( 
                        'type'        => 'text',
                        'label'       => __('Opacity', 'uabb'),
                        'default'     => '',
                        'description' => '%',
                        'maxlength'   => '3',
                        'size'        => '5',
                    ),
                    'list_icon_bg_border_radius'          => array(
                        'type'          => 'text',
                        'label'         => __('Border Radius ( For Background )', 'uabb'),
                        'maxlength'     => '3',
                        'size'          => '4',
                        'placeholder'   => '0',
                        'description'   => 'px'
                    ),

                    'list_icon_bg_padding'          => array(
                        'type'          => 'text',
                        'label'         => __('Padding ( For Background )', 'uabb'),
                        'maxlength'     => '3',
                        'size'          => '4',
                        'placeholder'   => '10',
                        'description'   => 'px'
                    ),
                    'list_icon_border_style'   => array(
                        'type'          => 'select',
                        'label'         => __('Border Style', 'uabb'),
                        'default'       => 'none',
                        'help'          => __('The type of border to use. Double borders must have a width of at least 3px to render properly.', 'uabb'),
                        'options'       => array(
                            'none'  => __( 'None', 'uabb' ),
                            'solid'  => __( 'Solid', 'uabb' ),
                            'dashed' => __( 'Dashed', 'uabb' ),
                            'dotted' => __( 'Dotted', 'uabb' ),
                            'double' => __( 'Double', 'uabb' )
                        ),
                    ),
                    'list_icon_border_width'    => array(
                        'type'          => 'text',
                        'label'         => __('Border Width', 'uabb'),
                        'description'   => 'px',
                        'maxlength'     => '3',
                        'size'          => '6',
                        'placeholder'   => '1',
                    ),
                    'list_icon_border_color' => array( 
                        'type'       => 'color',
                        'label'      => __('Border Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'list_icon_animation' => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __('Image/Icon Animation', 'uabb'),
                        'description'   => '',
                        'help'          => __( 'Select whether you want to animate image/icon or not', 'uabb' ),
                        'default'       => 'no',
                        'options'       => array(
                            'yes'         => __('Yes', 'uabb'),
                            'no'        => __('No', 'uabb')
                        ),
                    ),
                )
            ),
            'info_list_connector'       => array( // Section
                'title'         => __('List Connector', 'uabb'), // Section Title
                'fields'        => array( // Section Fields
                    'list_connector_option'   => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __('Show Connector', 'uabb'),
                        'description'   => '',
                        'help'          => __( 'Select whether you would like to show connector on list items.', 'uabb' ),
                        'default'       => 'yes',
                        'options'       => array(
                            'yes'         => __('Yes', 'uabb'),
                            'no'        => __('No', 'uabb')
                        ),
                        'toggle'       => array(
                            'yes' => array(
                                'fields' => array( 'list_connector_color', 'list_connector_style' )
                            )
                        )

                    ),
                    'list_connector_color'    => array( 
                        'type'       => 'color',
                        'label'      => __('Connector Line Color', 'uabb'),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                    'list_connector_style'   => array(
                        'type'          => 'select',
                        'label'         => __('Connector Line Style', 'uabb'),
                        'description'   => '',
                        'default'       => 'solid',
                        'options'       => array(
                            'solid'         => __('Solid', 'uabb'),
                            'dashed'        => __('Dashed', 'uabb'),
                            'dotted'        => __('Dotted', 'uabb')
                        ),
                    ),
                )
            )
        )
    ),

    'info_list_style'       => array( // Tab
        'title'         => __('Typography', 'uabb'), // Tab title
        'sections'      => array( // Tab Sections
            'heading_typography'    =>  array(
                'title'     => __('Title', 'uabb' ) ,
                'fields'    => array(
                    'heading_tag_selection'   => array(
                        'type'          => 'select',
                        'label' => __('Select Tag', 'uabb'),
                        'default'   => 'h3',
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
                    'heading_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.uabb-info-list-title'
                        )
                    ),
                    'heading_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                    ),
                    'heading_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                    ),
                    'heading_color'        => array( 
                        'type'       => 'color',
                        'default'    => '',
                        'show_reset' => true,
                        'label' => __('Choose Color', 'uabb'),
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-info-list-title',
                            'property'        => 'color'
                        )
                    ),
                    'heading_margin_top' => array(
                        'label' => __('Margin Top', 'uabb'),
                        'type'  => 'text',
                        'size'  => '8',
                        'description'   => 'px',
                        'max_length'    => '3',
                    ),
                    'heading_margin_bottom' => array(
                        'label' => __('Margin Bottom', 'uabb'),
                        'type'  => 'text',
                        'size'  => '8',
                        'description'   => 'px',
                        'max_length'    => '3',
                    ),
                )
            ),
            'description_typography'    =>  array(
                'title'     => __('Description', 'uabb'),
                'fields'    => array(
                    'description_font_family'       => array(
                        'type'          => 'font',
                        'label'         => __('Font Family', 'uabb'),
                        'default'       => array(
                            'family'        => 'Default',
                            'weight'        => 'Default'
                        ),
                        'preview'         => array(
                            'type'            => 'font',
                            'selector'        => '.uabb-info-list-description *',
                            
                        )
                    ),
                    'description_font_size'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                    ),
                    'description_line_height'    => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Line Height', 'uabb' ),
                        'default'       => array(
                            'desktop'       => '',
                            'medium'        => '',
                            'small'         => '',
                        ),
                    ),
                    'description_color'        => array( 
                        'type'       => 'color',
                        'label' => __('Choose Color', 'uabb'),
                        'preview'         => array(
                            'type'            => 'css',
                            'selector'        => '.uabb-info-list-content .uabb-info-list-description *',
                            'property'        => 'color'
                        ),
                        'default'    => '',
                        'show_reset' => true,
                    ),
                )
            ),
        )
    )
));


//Add List Items
FLBuilder::register_settings_form('info_list_item_form', array(
    'title' => __( 'Add List Item', 'uabb' ),
    'tabs'  => array(
        'list_item_general'      => array(
            'title'         => __('General', 'uabb'),
            'sections'      => array(
                'title'       => array(
                    'title'         => __( 'General Settings', 'uabb' ),
                    'fields'        => array(
                        'list_item_title'          => array(
                            'type'          => 'text',
                            'label'         => __('Title', 'uabb'),
                            'description'   => '',
                            'default'       => __('Name of the element','uabb'),
                            'help'          => __( 'Provide a title for this icon list item.', 'uabb' ),
                            'placeholder'         => __('Title','uabb'),
                            'class'         => 'uabb-list-item-title'
                        ),
                        'list_item_url'          => array(
                            'type'          => 'link',
                            'label'         => __('Link', 'uabb')
                        ),
                        'list_item_link'          => array(
                            'type'          => 'select',
                            'label'         => __('Apply Link To', 'uabb'),
                            'default'       => 'no',
                            'options'       => array(
                                'no'        => __('No Link', 'uabb'),
                                'complete'  => __('Complete Box', 'uabb'),
                                'list-title' => __('List Title', 'uabb'),
                                'icon'      => __('Icon', 'uabb')
                            ),
                            'preview'       => 'none'
                        ),
                        'list_item_link_target'   => array(
                            'type'          => 'select',
                            'label'         => __('Link Target', 'uabb'),
                            'default'       => '_self',
                            'options'       => array(
                                '_self'         => __('Same Window', 'uabb'),
                                '_blank'        => __('New Window', 'uabb')
                            ),
                        ),
                        'list_item_description'          => array(
                            'type'          => 'editor',
                            'default'       => __('Enter description text here.','uabb'),
                            'label'         => '',
                            'rows'          => 13
                        )
                    ),
                ),
            )
        ),

        'list_item_image'      => array(
            'title'         => __('Icon / Image', 'uabb'),
            'sections'      => array(
                'title'       => array(
                    'title'         => __( 'Icon / Image', 'uabb' ),
                    'fields'        => array(
                        'image_type'    => array(
                            'type'          => 'select',
                            'label'         => __('Image Type', 'uabb'),
                            'default'       => 'none',
                            'options'       => array(
                                'none'          => __( 'None', 'Image type.', 'uabb' ),
                                'icon'          => __('Icon', 'uabb'),
                                'photo'         => __('Photo', 'uabb'),
                            ),
                            'toggle'        => array(
                                'icon'          => array(
                                    'sections'   => array( 'icon_basic',  'icon_style', 'icon_colors' ),
                                ),
                                'photo'         => array(
                                    'sections'   => array( 'img_basic', 'img_style' ),
                                )
                            ),
                        ),
                    ),
                ),
                /* Icon Basic Setting */
                'icon_basic'        => array( // Section
                    'title'         => __('Icon','uabb'), // Section Title
                    'fields'        => array( // Section Fields
                        'icon'          => array(
                            'type'          => 'icon',
                            'label'         => __('Icon', 'uabb'),
                            'show_remove' => true
                        ),
                        'icon_color' => array( 
                            'type'       => 'color',
                            'label'      => __('Icon Color', 'uabb'),
                            'default'    => '',
                            'show_reset' => true,
                        ),
                    )
                ),
                /* Image Basic Setting */
                'img_basic'     => array( // Section
                    'title'         => __('Image','uabb'), // Section Title
                    'fields'        => array( // Section Fields
                        'photo_source'  => array(
                            'type'          => 'select',
                            'label'         => __('Photo Source', 'uabb'),
                            'default'       => 'library',
                            'options'       => array(
                                'library'       => __('Media Library', 'uabb'),
                                'url'           => __('URL', 'uabb')
                            ),
                            'toggle'        => array(
                                'library'       => array(
                                    'fields'        => array('photo')
                                ),
                                'url'           => array(
                                    'fields'        => array('photo_url' )
                                )
                            )
                        ),
                        'photo'         => array(
                            'type'          => 'photo',
                            'label'         => __('Photo', 'uabb'),
                            'show_remove'   => true,
                        ),
                        'photo_url'     => array(
                            'type'          => 'text',
                            'label'         => __('Photo URL', 'uabb'),
                            'placeholder'   => 'http://www.example.com/my-photo.jpg',
                        ),
                    )
                ),
            ),
        )
    )
));
