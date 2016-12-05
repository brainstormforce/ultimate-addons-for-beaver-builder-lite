/**
 *
 * This file should contain frontend styles that 
 * will be applied to individual module instances of Slide Box.
 *
 */

<?php 
    $settings->icon_color = UABB_Helper::uabb_colorpicker( $settings, 'icon_color' );
    $settings->icon_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'icon_hover_color' );
    $settings->overlay_icon_color = UABB_Helper::uabb_colorpicker( $settings, 'overlay_icon_color' );
    $settings->dropdown_icon_color = UABB_Helper::uabb_colorpicker( $settings, 'dropdown_icon_color' );
    $settings->front_title_focused_color = UABB_Helper::uabb_colorpicker( $settings, 'front_title_focused_color' );
    $settings->front_title_color = UABB_Helper::uabb_colorpicker( $settings, 'front_title_color' );
    $settings->back_title_color = UABB_Helper::uabb_colorpicker( $settings, 'back_title_color' );
    $settings->front_desc_focused_color = UABB_Helper::uabb_colorpicker( $settings, 'front_desc_focused_color' );
    $settings->front_desc_color = UABB_Helper::uabb_colorpicker( $settings, 'front_desc_color' );
    $settings->back_desc_color = UABB_Helper::uabb_colorpicker( $settings, 'back_desc_color' );
    $settings->link_color = UABB_Helper::uabb_colorpicker( $settings, 'link_color' );
    $settings->dropdown_plus_icon_color = UABB_Helper::uabb_colorpicker( $settings, 'dropdown_plus_icon_color' );
    $settings->img_bg_color = UABB_Helper::uabb_colorpicker( $settings, 'img_bg_color', true );
    $settings->front_icon_border_color = UABB_Helper::uabb_colorpicker( $settings, 'front_icon_border_color', true );
    $settings->front_icon_border_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'front_icon_border_hover_color', true );
    $settings->front_background_color = UABB_Helper::uabb_colorpicker( $settings, 'front_background_color', true );
    $settings->focused_front_background_color = UABB_Helper::uabb_colorpicker( $settings, 'focused_front_background_color', true );
    $settings->back_background_color = UABB_Helper::uabb_colorpicker( $settings, 'back_background_color', true );
    $settings->overlay_color = UABB_Helper::uabb_colorpicker( $settings, 'overlay_color', true );
    $settings->overlay_icon_bg_color = UABB_Helper::uabb_colorpicker( $settings, 'overlay_icon_bg_color', true );
    $settings->dropdown_icon_bg_color = UABB_Helper::uabb_colorpicker( $settings, 'dropdown_icon_bg_color', true );

    $settings->icon_size = ( trim($settings->icon_size) !== '' ) ? $settings->icon_size : '32';
    $settings->img_size = ( trim($settings->img_size) !== '' ) ? $settings->img_size : '60';
    $settings->front_icon_border_size = ( trim($settings->front_icon_border_size) !== '' ) ? $settings->front_icon_border_size : '1';
    $settings->overlay_icon_size = ( trim($settings->overlay_icon_size) !== '' ) ? $settings->overlay_icon_size : '30';
    $settings->dropdown_icon_size = ( trim($settings->dropdown_icon_size) !== '' ) ? $settings->dropdown_icon_size : '20';
?>

.fl-node-<?php echo $id; ?> {
    width: 100%;
}

.fl-node-<?php echo $id; ?> .uabb-slide-box-wrap .uabb-slide-front {
    <?php echo $settings->front_padding; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-slide-box-wrap .uabb-slide-down {
    <?php echo $settings->back_padding; ?>;
}

 <?php

    $imageicon_array = array(

        /* General Section */
        'image_type' => $settings->image_type,

        /* Icon Basics */
        'icon' => $settings->icon,
        'icon_size' => $settings->icon_size,
        'icon_align' => '',

        /* Image Basics */
        'photo_source' => 'library',
        'photo' => $settings->photo,
        'photo_url' => '',
        'img_size' => $settings->img_size,
        'img_align' => 'inherit',
        'photo_src' => ( isset( $settings->photo_src ) ) ? $settings->photo_src : '' ,

        /* Icon Style */
        'icon_style' => 'simple',
        'icon_bg_size' => '',
        'icon_border_style' => '',
        'icon_border_width' => '',
        'icon_bg_border_radius' => '',

        /* Image Style */
        'image_style' => $settings->image_style,
        'img_bg_size' => $settings->img_bg_size,
        'img_border_style' => '',
        'img_border_width' => '',
        'img_bg_border_radius' => '',

        /* Preset Color variable new */
        'icon_color_preset' => 'preset1', 

        /* Icon Colors */
        'icon_color' => $settings->icon_color,
        'icon_hover_color' => '',
        'icon_bg_color' => '',
        'icon_bg_hover_color' => '',
        'icon_border_color' => '',
        'icon_border_hover_color' => '',
        'icon_three_d' => '',

        /* Image Colors */
        'img_bg_color' => $settings->img_bg_color,
        'img_bg_color_opc' => $settings->img_bg_color_opc,
        'img_bg_hover_color' => '',
        'img_border_color' => '',
        'img_border_hover_color' => '',

    );
     
    /* CSS Render Function */ 
    FLBuilder::render_module_css( 'image-icon', $id, $imageicon_array );
?>

.fl-node-<?php echo $id; ?> .uabb-icon-wrap .uabb-icon i {
<?php if( $settings->front_img_icon_position == 'above-title' ) : ?>
    width: auto;
<?php elseif( $settings->front_img_icon_position == 'right-title' || $settings->front_img_icon_position == 'right' ) : ?>
    direction: rtl;
<?php endif; ?>
}

<?php if ( $settings->image_type == 'icon' ) { ?>
/* Icon */

<?php
if( $settings->icon_hover_color != '' /*&& $settings->slide_type == 'style1'*/ ) {
?>
.fl-node-<?php echo $id; ?> .uabb-<?php echo $settings->slide_type; ?>.open-slidedown .uabb-slide-box-section .uabb-imgicon-wrap .uabb-icon i,
.fl-node-<?php echo $id; ?> .uabb-<?php echo $settings->slide_type; ?>.open-slidedown .uabb-slide-box-section .uabb-imgicon-wrap .uabb-icon i:before {
    color: <?php echo $settings->icon_hover_color; ?>;
}
<?php
}

?>

/*.fl-node-<?php //echo $id; ?> .uabb-slide-box-wrap .uabb-icon-wrap .uabb-icon i, 
.fl-node-<?php //echo $id; ?> .uabb-slide-box-wrap .uabb-icon-wrap .uabb-icon i:before {
    width: 1.3em;
    height: 1.3em;
    line-height: 1.3em;
}*/
<?php } ?>

/* Render Button CSS */
<?php if($settings->cta_type == 'button') {
    ( $settings->button != '' ) ? FLBuilder::render_module_css( 'uabb-button', $id, $settings->button ) : '';
} ?>

<?php if( $settings->overlay_color != "" ) { ?>
    .fl-node-<?php echo $id; ?> .uabb-slide-box-overlay {
        background: <?php echo $settings->overlay_color; ?>;
    }
<?php } ?>

.fl-node-<?php echo $id; ?> .fl-module-content .uabb-slide-dropdown .uabb-icon i, 
.fl-node-<?php echo $id; ?> .fl-module-content .uabb-slide-dropdown .uabb-icon i:before {
    
    font-size: <?php echo $settings->dropdown_icon_size; ?>px;
    <?php
    if( $settings->slide_type == "style2" ) {
    ?>
    color: <?php echo $settings->dropdown_icon_color; ?>;
    background: <?php echo uabb_theme_base_color( $settings->dropdown_icon_bg_color ); ?>;
    border-radius: 100%;
    -moz-border-radius: 100%;
    -webkit-border-radius: 100%;
    line-height: 1.75em;
    height: 1.75em;
    width: 1.75em;
    text-align: center;
    <?php
    }  else if( $settings->slide_type == "style3" ) {
    ?>
    color: <?php echo uabb_theme_base_color( $settings->dropdown_plus_icon_color ); ?>;
    <?php
    }
    ?>
}

.fl-node-<?php echo $id; ?> .uabb-slide-box-overlay .uabb-icon i, 
.fl-node-<?php echo $id; ?> .uabb-slide-box-overlay .uabb-icon i:before {
    color: <?php echo uabb_theme_base_color ( $settings->overlay_icon_color ); ?>;
    font-size: <?php echo $settings->overlay_icon_size; ?>px;
    <?php if( isset($settings->overlay_icon_bg_color) && trim($settings->overlay_icon_bg_color) != "" ) : ?>
        background: <?php echo $settings->overlay_icon_bg_color; ?>;
        border-radius: 100%;
        -moz-border-radius: 100%;
        -webkit-border-radius: 100%;
        line-height: 1.75em;
        height: 1.75em;
        width: 1.75em;
        text-align: center;
    <?php endif; ?>
}

.fl-node-<?php echo $id; ?> .uabb-slide-box .uabb-slide-down {
    text-align: <?php echo $settings->back_alignment; ?>;
    <?php echo ( $settings->back_background_color != '' ) ? 'background:' . $settings->back_background_color . ';' : ''; ?>
    <?php if( $settings->set_min_height != 'default' && !empty($settings->slide_min_height) ) { ?>
    min-height: <?php echo $settings->slide_min_height; ?>px;
    justify-content : <?php echo $settings->slide_vertical_align; ?>;
    <?php } ?> 
}

/*  Front Slide Vertical Alignment */
.fl-node-<?php echo $id; ?> .uabb-slide-box .uabb-slide-front {
    background: <?php echo $settings->front_background_color; ?>;
    <?php if ( $settings->front_img_icon_position == 'above-title' ) { ?>
        text-align: <?php echo $settings->front_alignment; ?>;
    <?php } ?>
    <?php
    if( $settings->set_min_height != 'default' && !empty($settings->slide_min_height) ) { ?>
    min-height: <?php echo $settings->slide_min_height; ?>px;
    justify-content : <?php echo $settings->slide_vertical_align; ?>;
    <?php
    }
    ?>
    
}

/* Calculated Width Slidebox */
<?php if ( $settings->front_img_icon_position != 'above-title' && $settings->image_type != 'none' ) { ?>
    <?php 
    $extra_width = 0;
    if ( $settings->image_type == "photo" ) { 

        $extra_width = $settings->img_size;
        if ( $settings->image_style == 'custom' ) {
            $extra_width = $extra_width + intval($settings->img_bg_size) * 2;
        }
        $extra_width = $extra_width + 15;
    } elseif ( $settings->image_type == "icon" ) {
        $extra_width = $settings->icon_size + 15;
    }
    ?>

    <?php if ( $settings->front_img_icon_position == 'left' || $settings->front_img_icon_position == 'right' ) { ?>

        .fl-node-<?php echo $id; ?> .uabb-slide-front-right-text {
            width: calc( 100% - <?php echo $extra_width;?>px );
        }

        .fl-node-<?php echo $id; ?> .uabb-slide-front-right-text,
        .fl-node-<?php echo $id; ?> .uabb-slide-front-left-img,
        .fl-node-<?php echo $id; ?> .uabb-slide-front-right-img {
            vertical-align: <?php echo $settings->front_align_items; ?>;
        }

        <?php if ( $settings->front_icon_border == 'yes' ) { ?>
        .fl-node-<?php echo $id; ?> .uabb-slide-icon-border {
            position: absolute; 
            height: 100%; 
            top: 0;
            transition: all linear 300ms;
        }

        .fl-node-<?php echo $id; ?> .uabb-slide-front-right-text {
            width: calc( 100% - <?php echo ( $extra_width + $settings->front_icon_border_size );?>px );
        }
        
        .fl-node-<?php echo $id; ?> .open-slidedown .uabb-slide-icon-border {
            <?php echo ( $settings->front_icon_border_hover_color != '' ) ? 'border-color: '.$settings->front_icon_border_hover_color.';' : ''; ?>
        }
       
        .fl-node-<?php echo $id; ?> .uabb-slide-icon-left .uabb-slide-icon-border,
        .fl-node-<?php echo $id; ?> .uabb-slide-photo-left .uabb-slide-icon-border {
            border-right-style: solid; 
            <?php echo ( $settings->front_icon_border_color != '' ) ? 'border-right-color: '.$settings->front_icon_border_color.';' : ''; ?>
            border-right-width: <?php echo $settings->front_icon_border_size; ?>px
        }
        .fl-node-<?php echo $id; ?> .uabb-slide-icon-right .uabb-slide-icon-border,
        .fl-node-<?php echo $id; ?> .uabb-slide-photo-right .uabb-slide-icon-border {
            border-left-style: solid; 
            <?php echo ( $settings->front_icon_border_color != '' ) ? 'border-left-color: '.$settings->front_icon_border_color.';' : ''; ?>
            border-left-width: <?php echo $settings->front_icon_border_size; ?>px
        }

        .fl-node-<?php echo $id; ?> .uabb-slide-icon-left .uabb-slide-front-right-text,
        .fl-node-<?php echo $id; ?> .uabb-slide-photo-left .uabb-slide-front-right-text {
            <?php if( $settings->front_icon_border_size != '' ) { ?>
            padding-left: <?php echo ( $settings->front_icon_border_size + 15 ); ?>px
            <?php }else{ ?>
            padding-left: 15px;
            <?php } ?>
        }
        .fl-node-<?php echo $id; ?> .uabb-slide-icon-right .uabb-slide-front-right-text,
        .fl-node-<?php echo $id; ?> .uabb-slide-photo-right .uabb-slide-front-right-text {
            padding-right: 15px;
        }


        .fl-node-<?php echo $id; ?> .uabb-slide-icon-right .uabb-slide-front-right-img,
        .fl-node-<?php echo $id; ?> .uabb-slide-photo-right .uabb-slide-front-right-img {
            <?php if( $settings->front_icon_border_size != '' ) { ?>
            padding-left: <?php echo ( $settings->front_icon_border_size + 15 ); ?>px
            <?php }else{ ?>
            padding-left: 15px;
            <?php } ?>
        }

        <?php } ?>
    <?php } ?>

    <?php if ( $settings->front_img_icon_position == 'left-title' || $settings->front_img_icon_position == 'right-title' ) { ?>

        .fl-node-<?php echo $id; ?> .uabb-slide-front-right-text {
            width: 100%;
        }
        .fl-node-<?php echo $id; ?> .uabb-slide-face-text-title {
            width: calc( 100% - <?php echo $extra_width;?>px );
        }
    <?php } ?>

<?php } ?>

<?php
if( $settings->slide_type == "style1" ) { ?>

    .fl-node-<?php echo $id; ?> .uabb-slide-box-wrap .uabb-style1.open-slidedown .uabb-slide-front {
        background: <?php echo $settings->focused_front_background_color; ?>;
        transition: all linear 300ms;
    }

    .fl-node-<?php echo $id; ?> .uabb-style1.open-slidedown .uabb-slide-box .uabb-slide-box-section-content {
        color: <?php echo uabb_theme_text_color( $settings->front_desc_focused_color ); ?>;
        transition: all linear 300ms;
    }

    .fl-node-<?php echo $id; ?> .uabb-style1.open-slidedown .uabb-slide-box .uabb-slide-face-text-title {
        color: <?php echo $settings->front_title_focused_color; ?>;
        transition: all linear 300ms;
    }


    .fl-node-<?php echo $id; ?> .uabb-slide-box-wrap .uabb-style1.open-slidedown .uabb-slide-down {
        opacity:1;
        pointer-events: visible;
    }

    .fl-node-<?php echo $id; ?> .uabb-slide-box-wrap .uabb-style1 .uabb-button-wrap {
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translate(-50%,-50%);
    }

    <?php if ( $settings->cta_type == 'button' && $settings->button != '' && $settings->button->width == 'full' ) { ?>
    .fl-node-<?php echo $id; ?> .uabb-button-wrap {
        width: 100%;
    }
    <?php } ?>
<?php }
?>

<?php
if( $settings->slide_type == "style2" ) {
?>  
    .fl-node-<?php echo $id; ?> .uabb-slide-box-wrap {
        <?php echo ( $settings->dropdown_icon_size != '' ) ? 'margin-bottom: ' . ( ( $settings->dropdown_icon_size * 1.75 ) / 2 ) . 'px;' : ''; ?>
    }
    .fl-node-<?php echo $id; ?> .uabb-style2 .uabb-slide-front-right-text {
        <?php echo ( $settings->dropdown_icon_size != '' ) ? 'padding-bottom: ' . ( $settings->dropdown_icon_size * 0.75 ) . 'px;' : ''; ?>
    }

    .fl-node-<?php echo $id; ?> .uabb-style2.open-slidedown .uabb-slide-box .uabb-slide-box-section-content {
        color: <?php echo uabb_theme_text_color( $settings->front_desc_focused_color ); ?>;
        transition: all linear 300ms;
    }

    .fl-node-<?php echo $id; ?> .uabb-style2.open-slidedown .uabb-slide-box .uabb-slide-face-text-title {
        color: <?php echo $settings->front_title_focused_color; ?>;
        transition: all linear 300ms;
    }

    .fl-node-<?php echo $id; ?> .uabb-slide-box-wrap .uabb-style2.open-slidedown .uabb-slide-front {
        background: <?php echo $settings->focused_front_background_color; ?>;
        transition: all linear 300ms;
    }

    <?php
    if( $settings->dropdown_icon_align != 'center' ) {
    ?>
    .fl-node-<?php echo $id; ?> .fl-module-content .uabb-style2 .uabb-slide-dropdown {
        <?php if( $settings->dropdown_icon_align == 'left' ) { ?>
            left: 0;
            transform: translate(0%,50%);
        <?php } elseif( $settings->dropdown_icon_align == 'right' ) { ?>
            left: 100%;
            transform: translate(-100%,50%);
        <?php } ?>
    }
    <?php
    }
    ?>
        
            
<?php
}
?>

<?php
if( $settings->slide_type == "style3" ) {
?>
    .fl-node-<?php echo $id; ?> .uabb-style3 .uabb-slide-dropdown .uabb-icon i, 
    .fl-node-<?php echo $id; ?> .uabb-style3 .uabb-slide-dropdown .uabb-icon i:before {
        line-height: 1em;
        height: 1em;
        width: 1em;
        text-align: center;
    }

    .fl-node-<?php echo $id; ?> .uabb-style3 .uabb-slide-front-right-text {
        <?php echo ( $settings->dropdown_icon_size != '' ) ? 'padding-bottom: ' . ( $settings->dropdown_icon_size + 10 ) . 'px;' : ''; ?>
    }

    .fl-node-<?php echo $id; ?> .uabb-style3.open-slidedown .uabb-slide-box .uabb-slide-box-section-content {
        color: <?php echo uabb_theme_text_color( $settings->front_desc_focused_color ); ?>;
        transition: all linear 300ms;
    }

    .fl-node-<?php echo $id; ?> .uabb-style3.open-slidedown .uabb-slide-box .uabb-slide-face-text-title {
        color: <?php echo $settings->front_title_focused_color; ?>;
        transition: all linear 300ms;
    }

    .fl-node-<?php echo $id; ?> .uabb-slide-box-wrap .uabb-style3.open-slidedown .uabb-slide-front {
        background: <?php echo $settings->focused_front_background_color; ?>;
        transition: all linear 300ms;
    }

    .fl-node-<?php echo $id; ?> .fl-module-content .uabb-style3 .uabb-slide-dropdown {
        justify-content: <?php echo ( $settings->dropdown_icon_align == 'left' ) ? 'flex-start' : ( ( $settings->dropdown_icon_align == 'right' ) ? 'flex-end' : '' ); ?>;
    }
<?php
}
?>

/* Font Front Slide Heading (Desktop) */
.fl-node-<?php echo $id; ?> .uabb-slide-box .uabb-slide-face-text-title {
    
    <?php if( $settings->front_title_font_family['family'] != "Default") : ?>
        <?php UABB_Helper::uabb_font_css( $settings->front_title_font_family ); ?>
    <?php endif; ?>

    <?php if( $settings->front_title_font_size['desktop'] != '' ) : ?>
    font-size: <?php echo $settings->front_title_font_size['desktop']; ?>px;
    <?php endif; ?>

    <?php if( $settings->front_title_line_height['desktop'] != '' ) : ?>
    line-height: <?php echo $settings->front_title_line_height['desktop']; ?>px;
    <?php endif; ?>

    <?php echo ( $settings->front_title_color != '' ) ? 'color: ' . $settings->front_title_color . ';' : '';
    echo ( $settings->front_title_margin_top != '' ) ? 'margin-top: ' . $settings->front_title_margin_top . 'px;' : '';
    echo ( $settings->front_title_margin_bottom != '' ) ? 'margin-bottom: ' . $settings->front_title_margin_bottom . 'px;' : 'margin-bottom: 15px;';
    ?>
}

/* Font Front Slide Description (Desktop) */
.fl-node-<?php echo $id; ?> .uabb-slide-box .uabb-slide-box-section-content {

    <?php if( $settings->front_desc_font_family['family'] != "Default") : ?>
    <?php UABB_Helper::uabb_font_css( $settings->front_desc_font_family ); ?>
    <?php endif; ?>

    <?php if( $settings->front_desc_font_size['desktop'] != '' ) : ?>
    font-size: <?php echo $settings->front_desc_font_size['desktop']; ?>px;
    <?php endif; ?>

    <?php if( $settings->front_desc_line_height['desktop'] != '' ) : ?>
    line-height: <?php echo $settings->front_desc_line_height['desktop']; ?>px;
    <?php endif; ?>
    <?php echo ( $settings->front_desc_margin_top != '' ) ? 'margin-top: ' . $settings->front_desc_margin_top . 'px;' : ''; ?>
    <?php echo ( $settings->front_desc_margin_bottom != '' ) ? 'margin-bottom: ' . $settings->front_desc_margin_bottom . 'px;' : ''; ?>
    <?php echo ( $settings->front_desc_color != '' ) ? 'color: ' . $settings->front_desc_color . ';' : ''; ?>

}

/* .fl-node-<?php // echo $id; ?> .uabb-slide-box .uabb-slide-box-section-content * {
    font-family: inherit;
    font-weight: inherit; 
    font-size: inherit;
    font-style: inherit; 
    color: inherit; 
    line-height: inherit;
} */

/* Font Back Slide Heading (Desktop) */
.fl-node-<?php echo $id; ?> .uabb-slide-box .uabb-slide-back-text-title {
    
    <?php if( $settings->back_title_font_family['family'] != "Default") : ?>
        <?php UABB_Helper::uabb_font_css( $settings->back_title_font_family ); ?>
    <?php endif; ?>

    <?php if( $settings->back_title_font_size['desktop'] != '' ) : ?>
    font-size: <?php echo $settings->back_title_font_size['desktop']; ?>px;
    <?php endif; ?>

    <?php if( $settings->back_title_line_height['desktop'] != '' ) : ?>
    line-height: <?php echo $settings->back_title_line_height['desktop']; ?>px;
    <?php endif; ?>

    <?php
    echo ( $settings->back_title_color != '' ) ? 'color: ' . $settings->back_title_color . ';' : '';
    echo ( $settings->back_title_margin_top != '' ) ? 'margin-top: ' . $settings->back_title_margin_top . 'px;' : '';
    echo ( $settings->back_title_margin_bottom != '' ) ? 'margin-bottom: ' . $settings->back_title_margin_bottom . 'px;' : '';
    ?>
}

/* Font Back Slide Description (Desktop) */
.fl-node-<?php echo $id; ?> .uabb-slide-box .uabb-slide-down-box-section-content {

    <?php if( $settings->back_desc_font_family['family'] != "Default") : ?>
        <?php UABB_Helper::uabb_font_css( $settings->back_desc_font_family ); ?>
    <?php endif; ?>

    <?php if( $settings->back_desc_font_size['desktop'] != '' ) : ?>
    font-size: <?php echo $settings->back_desc_font_size['desktop']; ?>px;
    <?php endif; ?>

    <?php if( $settings->back_desc_line_height['desktop'] != '' ) : ?>
    line-height: <?php echo $settings->back_desc_line_height['desktop']; ?>px;
    <?php endif; ?>

    <?php echo ( $settings->back_desc_margin_top != '' ) ? 'margin-top: ' . $settings->back_desc_margin_top . 'px;' : ''; ?>
    <?php echo ( $settings->back_desc_margin_bottom != '' ) ? 'margin-bottom: ' . $settings->back_desc_margin_bottom . 'px;' : 'margin-bottom: 10px;'; ?>
    <?php echo ( $settings->back_desc_color != '' ) ? 'color: ' . $settings->back_desc_color . ';' : ''; ?>
}

/* .fl-node-<?php //echo $id; ?> .uabb-slide-box .uabb-slide-down-box-section-content * {
    font-family: inherit;
    font-weight: inherit; 
    font-size: inherit;
    font-style: inherit; 
    color: inherit; 
    line-height: inherit;
} */

/* Link Color */
<?php if( !empty($settings->link_color) ) : ?> 
.fl-builder-content .fl-node-<?php echo $id; ?> a.uabb-callout-cta-link,
.fl-builder-content .fl-node-<?php echo $id; ?> a.uabb-callout-cta-link *,
.fl-builder-content .fl-node-<?php echo $id; ?> a.uabb-callout-cta-link:visited {
    color: <?php echo uabb_theme_text_color( $settings->link_color ); ?>;
}
<?php endif; ?>

/* Typography Options for Link Text */
.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-callout-cta-link {
    <?php if( $settings->link_font_family['family'] != "Default") : ?>
        <?php UABB_Helper::uabb_font_css( $settings->link_font_family ); ?>
    <?php endif; ?>

    <?php if( $settings->link_font_size['desktop'] != '' ) : ?>
    font-size: <?php echo $settings->link_font_size['desktop']; ?>px;
    <?php endif; ?>

    <?php if( $settings->link_line_height['desktop'] != '' ) : ?>
    line-height: <?php echo $settings->link_line_height['desktop']; ?>px;
    <?php endif; ?>
}

<?php
if( $global_settings->responsive_enabled ) { // Global Setting If started
?>
    @media ( max-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {

        .fl-node-<?php echo $id; ?> .uabb-slide-box .uabb-slide-box-section-content {
            <?php
            echo ( $settings->front_desc_font_size['medium'] != '' ) ? 'font-size: ' . $settings->front_desc_font_size['medium'] . 'px;' : '';
            echo ( $settings->front_desc_line_height['medium'] != '' ) ? 'line-height: ' . $settings->front_desc_line_height['medium'] . 'px;' : '';
            ?>
        }

        .fl-node-<?php echo $id; ?> .uabb-slide-box .uabb-slide-face-text-title {
            <?php
            echo ( $settings->front_title_font_size['medium'] != '' ) ? 'font-size: ' . $settings->front_title_font_size['medium'] . 'px;' : '';
            echo ( $settings->front_title_line_height['medium'] != '' ) ? 'line-height: ' . $settings->front_title_line_height['medium'] . 'px;' : '';
            ?>
        }

        .fl-node-<?php echo $id; ?> .uabb-slide-box .uabb-slide-down-box-section-content {
            <?php
            echo ( $settings->back_desc_font_size['medium'] != '' ) ? 'font-size: ' . $settings->back_desc_font_size['medium'] . 'px;' : '';
            echo ( $settings->back_desc_line_height['medium'] != '' ) ? 'line-height: ' . $settings->back_desc_line_height['medium'] . 'px;' : '';
            ?>
        }

        .fl-node-<?php echo $id; ?> .uabb-slide-box .uabb-slide-back-text-title {
            <?php
            echo ( $settings->back_title_font_size['medium'] != '' ) ? 'font-size: ' . $settings->back_title_font_size['medium'] . 'px;' : '';
            echo ( $settings->back_title_line_height['medium'] != '' ) ? 'line-height: ' . $settings->back_title_line_height['medium'] . 'px;' : '';
        ?>
        }

        .fl-builder-content .fl-node-<?php echo $id; ?> .uabb-callout-cta-link {

            <?php if( $settings->link_font_size['medium'] != '' ) : ?>
            font-size: <?php echo $settings->link_font_size['medium']; ?>px;
            <?php endif; ?>

            <?php if( $settings->link_line_height['medium'] != '' ) : ?>
            line-height: <?php echo $settings->link_line_height['medium']; ?>px;
            <?php endif; ?>
        }
    }
 
     @media ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {

        .fl-node-<?php echo $id; ?> .uabb-slide-box .uabb-slide-box-section-content {
            <?php
            echo ( $settings->front_desc_font_size['small'] != '' ) ? 'font-size: ' . $settings->front_desc_font_size['small'] . 'px;' : '';
            echo ( $settings->front_desc_line_height['small'] != '' ) ? 'line-height: ' . $settings->front_desc_line_height['small'] . 'px;' : '';
            ?>
        }

        .fl-node-<?php echo $id; ?> .uabb-slide-box .uabb-slide-face-text-title {
            <?php
            echo ( $settings->front_title_font_size['small'] != '' ) ? 'font-size: ' . $settings->front_title_font_size['small'] . 'px;' : '';
            echo ( $settings->front_title_line_height['small'] != '' ) ? 'line-height: ' . $settings->front_title_line_height['small'] . 'px;' : '';
            ?>
        }

        .fl-node-<?php echo $id; ?> .uabb-slide-box .uabb-slide-down-box-section-content {
            <?php
            echo ( $settings->back_desc_font_size['small'] != '' ) ? 'font-size: ' . $settings->back_desc_font_size['small'] . 'px;' : '';
            echo ( $settings->back_desc_line_height['small'] != '' ) ? 'line-height: ' . $settings->back_desc_line_height['small'] . 'px;' : '';
            ?>
        }

        .fl-node-<?php echo $id; ?> .uabb-slide-box .uabb-slide-back-text-title {
            <?php
            echo ( $settings->back_title_font_size['small'] != '' ) ? 'font-size: ' . $settings->back_title_font_size['small'] . 'px;' : '';
            echo ( $settings->back_title_line_height['small'] != '' ) ? 'line-height: ' . $settings->back_title_line_height['small'] . 'px;' : '';
            ?>
        }

        .fl-builder-content .fl-node-<?php echo $id; ?> .uabb-callout-cta-link {

            <?php if( $settings->link_font_size['small'] != '' ) : ?>
            font-size: <?php echo $settings->link_font_size['small']; ?>px;
            <?php endif; ?>

            <?php if( $settings->link_line_height['small'] != '' ) : ?>
            line-height: <?php echo $settings->link_line_height['small']; ?>px;
            <?php endif; ?>
        }

        <?php if( $settings->image_type != 'none' && $settings->mobile_view == 'stack' && ( $settings->front_img_icon_position == 'left' || $settings->front_img_icon_position == 'right' ) ) : ?>
            .fl-node-<?php echo $id; ?> .uabb-slide-icon-border {
                display: none;
            }

            .fl-node-<?php echo $id; ?> .uabb-slide-front .uabb-slide-front-right-text,
            .fl-node-<?php echo $id; ?> .uabb-slide-front .uabb-slide-front-left-img,
            .fl-node-<?php echo $id; ?> .uabb-slide-front .uabb-slide-front-right-img {
                padding: 0;
            }
            .fl-node-<?php echo $id; ?> .uabb-slide-front .uabb-slide-front-right-img {
                font-size: 0;
                line-height: 0;
            }
            .fl-node-<?php echo $id; ?> .uabb-slide-front-left-img,
            .fl-node-<?php echo $id; ?> .uabb-slide-front-right-img,
            .fl-node-<?php echo $id; ?> .uabb-slide-front-right-text {
                display: block;
                width: 100%;
                text-align: center;
            }
            <?php if( $settings->front_img_icon_position == 'left' ) : ?>
            .fl-node-<?php echo $id; ?> .uabb-slide-front .uabb-slide-front-right-text {
                padding-top: 15px;
            }
            <?php else : ?>
            .fl-node-<?php echo $id; ?> .uabb-slide-front .uabb-slide-front-right-text {
                padding-bottom: 15px;
            }
            <?php endif; ?>

            <?php if( $settings->front_img_icon_position == 'left' || $settings->stacking_order == 'reversed' ) : ?>
                .fl-node-<?php echo $id; ?> .uabb-style2 .uabb-slide-front-right-text {
                    <?php echo ( $settings->dropdown_icon_size != '' ) ? 'padding-bottom: ' . ( $settings->dropdown_icon_size * 0.75 ) . 'px;' : ''; ?>
                }
                .fl-node-<?php echo $id; ?> .uabb-style3 .uabb-slide-front-right-text {
                    <?php echo ( $settings->dropdown_icon_size != '' ) ? 'padding-bottom: ' . ( $settings->dropdown_icon_size + 10 ) . 'px;' : ''; ?>
                }

                <?php if( $settings->front_img_icon_position == 'right' ) : ?>
                .fl-node-<?php echo $id; ?> .uabb-slide-front .uabb-slide-front-right-text {
                    padding-top: 15px;
                }
                .fl-node-<?php echo $id; ?> .uabb-slide-box-section {
                    display: -webkit-box;
                    display: -ms-flexbox;
                    display: flex;
                    -webkit-box-orient: vertical;
                    -webkit-box-direction: reverse;
                    -ms-flex-direction: column-reverse;
                    flex-direction: column-reverse;
                } 
                <?php endif; ?>

            <?php else : ?>
                .fl-node-<?php echo $id; ?> .uabb-style2 .uabb-slide-front-right-img {
                    <?php echo ( $settings->dropdown_icon_size != '' ) ? 'padding-bottom: ' . ( $settings->dropdown_icon_size * 0.75 ) . 'px;' : ''; ?>
                }
                .fl-node-<?php echo $id; ?> .uabb-style3 .uabb-slide-front-right-img {
                    <?php echo ( $settings->dropdown_icon_size != '' ) ? 'padding-bottom: ' . ( $settings->dropdown_icon_size + 10 ) . 'px;' : ''; ?>
                }
            <?php endif; ?>
        
        <?php endif; ?>
    }
<?php
}
?>