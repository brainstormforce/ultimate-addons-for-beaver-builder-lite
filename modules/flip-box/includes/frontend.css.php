<?php

$settings->front_background_color = UABB_Helper::uabb_colorpicker( $settings, 'front_background_color', true );
$settings->front_border_color = UABB_Helper::uabb_colorpicker( $settings, 'front_border_color' );

$settings->back_background_color = UABB_Helper::uabb_colorpicker( $settings, 'back_background_color', true );
$settings->back_border_color = UABB_Helper::uabb_colorpicker( $settings, 'back_border_color' );

$settings->front_title_typography_color = UABB_Helper::uabb_colorpicker( $settings, 'front_title_typography_color' );
$settings->front_desc_typography_color = UABB_Helper::uabb_colorpicker( $settings, 'front_desc_typography_color' );
$settings->back_title_typography_color = UABB_Helper::uabb_colorpicker( $settings, 'back_title_typography_color' );
$settings->back_desc_typography_color = UABB_Helper::uabb_colorpicker( $settings, 'back_desc_typography_color' );

?>
<?php
if( $settings->show_button == 'yes' ) {
    ( $settings->button != '' ) ? FLBuilder::render_module_css( 'uabb-button', $id, $settings->button ) : '';
    
    if( $settings->button->style == 'flat' && $settings->button->flat_button_options != 'none' ) {
    ?>
    .fl-node-<?php echo $id; ?> .uabb-button-wrap .uabb-creative-flat-btn .uabb-button-text {
        -webkit-backface-visibility: visible;
        -moz-backface-visibility: visible;
         backface-visibility: visible;
    }
    <?php
    }
}
if( $settings->smile_icon != '' && $settings->smile_icon->icon != '' ) {
    /* Render CSS */

    /* CSS "$settings" Array */
    //$settings->smile_icon['image_type'] = 'icon';
    $settings->smile_icon->image_type = 'icon';

    /* CSS Render Function */ 
    FLBuilder::render_module_css( 'image-icon', $id, $settings->smile_icon );
}
?>

<?php
if( $settings->flip_box_min_height_options == 'uabb-custom-height' ) {
?>
    .fl-node-<?php echo $id; ?> .uabb-flip-box {
        height: <?php echo ( $settings->flip_box_min_height != '' ) ? $settings->flip_box_min_height : '300'; ?>px;
    }
<?php
}
?>

.fl-node-<?php echo $id; ?> .uabb-front {
    <?php
    if( $settings->front_background_type == 'color' ) {
        echo ( $settings->front_background_color != '' ) ? 'background-color: ' . $settings->front_background_color . ';' : '';
    } else {
        echo ( $settings->front_bg_image_src != '' ) ? 'background: url( "' . $settings->front_bg_image_src . '");' : '';
        echo ( $settings->front_bg_image_repeat != 'no' ) ? 'background-repeat: repeat;' : 'background-repeat: no-repeat;';
        echo ( $settings->front_bg_image_display != '' ) ? 'background-size: ' . $settings->front_bg_image_display . ';' : '';
        echo ( $settings->front_bg_image_pos != '' ) ? 'background-position: ' . $settings->front_bg_image_pos . ';' : '';
    }
    echo ( $settings->front_border_color != '' ) ? 'border-color: ' . $settings->front_border_color . ';' : '';
    echo ( $settings->front_border_size != '' ) ? 'border-width: ' . $settings->front_border_size . 'px;' : 'border-width: 1px;';
    echo ( $settings->front_box_border_style != '' ) ? 'border-style: ' . $settings->front_box_border_style . ';' : '';
    ?>
}

.fl-node-<?php echo $id; ?> .uabb-back {
    <?php
    if( $settings->back_background_type == 'color' ) {
        echo ( $settings->back_background_color != '' ) ? 'background-color: ' . $settings->back_background_color . ';' : '';
    } else {
        echo ( $settings->back_bg_image_src != '' ) ? 'background: url( "' . $settings->back_bg_image_src . '");' : '';
        echo ( $settings->back_bg_image_repeat != 'no' ) ? 'background-repeat: repeat;' : 'background-repeat: no-repeat;';
        echo ( $settings->back_bg_image_display != '' ) ? 'background-size: ' . $settings->back_bg_image_display . ';' : '';
        echo ( $settings->back_bg_image_pos != '' ) ? 'background-position: ' . $settings->back_bg_image_pos . ';' : '';
    }
    echo ( $settings->back_border_color != '' ) ? 'border-color: ' . $settings->back_border_color . ';' : '';
    echo ( $settings->back_border_size != '' ) ? 'border-width: ' . $settings->back_border_size . 'px;' : 'border-width: 1px;';
    echo ( $settings->back_box_border_style != '' ) ? 'border-style: ' . $settings->back_box_border_style . ';' : '';
    ?>
}

.fl-node-<?php echo $id; ?> .uabb-front .uabb-text-editor {
    color : <?php echo uabb_theme_text_color( $settings->front_desc_typography_color ); ?>;
    <?php
    echo ( $settings->front_desc_typography_font_size['desktop'] != '' ) ? 'font-size: ' . $settings->front_desc_typography_font_size['desktop'] . 'px;' : '';
    echo ( $settings->front_desc_typography_line_height['desktop'] != '' ) ? 'line-height: ' . $settings->front_desc_typography_line_height['desktop'] . 'px;' : '';
    if( $settings->front_desc_typography_font_family['family'] != 'Default' ) {
        UABB_Helper::uabb_font_css( $settings->front_desc_typography_font_family );
    }

    echo ( $settings->front_desc_typography_margin_top != '' ) ? 'margin-top: ' . $settings->front_desc_typography_margin_top . 'px;' : 'margin-top: 0;';

    echo ( $settings->front_desc_typography_margin_bottom != '' ) ? 'margin-bottom: ' . $settings->front_desc_typography_margin_bottom . 'px;' : 'margin-bottom: 25;';
    ?>
}

.fl-node-<?php echo $id; ?> .uabb-flip-box-section {
    <?php echo ( $settings->inner_padding != '' ) ? $settings->inner_padding : 'padding: 15px;'; ?>
}


.fl-node-<?php echo $id; ?> .uabb-front .uabb-face-text-title {
    <?php
    echo ( $settings->front_title_typography_font_size['desktop'] != '' ) ? 'font-size: ' . $settings->front_title_typography_font_size['desktop'] . 'px;' : '';
    echo ( $settings->front_title_typography_line_height['desktop'] != '' ) ? 'line-height: ' . $settings->front_title_typography_line_height['desktop'] . 'px;' : '';
    if( $settings->front_title_typography_font_family['family'] != 'Default' ) {
        UABB_Helper::uabb_font_css( $settings->front_title_typography_font_family );
    }
    echo ( $settings->front_title_typography_color != '' ) ? 'color: ' . $settings->front_title_typography_color . ';' : '';

    echo ( $settings->front_title_typography_margin_top != '' ) ? 'margin-top: ' . $settings->front_title_typography_margin_top . 'px;' : 'margin-top: 0;';

    echo ( $settings->front_title_typography_margin_bottom != '' ) ? 'margin-bottom: ' . $settings->front_title_typography_margin_bottom . 'px;' : 'margin-bottom: 12px;';
    ?>
}


.fl-node-<?php echo $id; ?> .uabb-back .uabb-text-editor {
    color : <?php echo uabb_theme_text_color( $settings->back_desc_typography_color ); ?>;
    <?php
    echo ( $settings->back_desc_typography_font_size['desktop'] != '' ) ? 'font-size: ' . $settings->back_desc_typography_font_size['desktop'] . 'px;' : '';
    echo ( $settings->back_desc_typography_line_height['desktop'] != '' ) ? 'line-height: ' . $settings->back_desc_typography_line_height['desktop'] . 'px;' : '';
    if( $settings->back_desc_typography_font_family['family'] != 'Default' ) {
        UABB_Helper::uabb_font_css( $settings->back_desc_typography_font_family );
    }

    echo ( $settings->back_desc_typography_margin_top != '' ) ? 'margin-top: ' . $settings->back_desc_typography_margin_top . 'px;' : 'margin-top: 0;';

    echo ( $settings->back_desc_typography_margin_bottom != '' ) ? 'margin-bottom: ' . $settings->back_desc_typography_margin_bottom . 'px;' : 'margin-bottom: 0;';
    ?>
}

.fl-node-<?php echo $id; ?> .uabb-button-wrap {
    <?php
    echo ( $settings->button_margin_top != '' ) ? 'margin-top: ' . $settings->button_margin_top . 'px;' : 'margin-top: 15px;';
    echo ( $settings->button_margin_bottom != '' ) ? 'margin-bottom: ' . $settings->button_margin_bottom . 'px;' : 'margin-bottom: 0;';
    ?>
}

.fl-node-<?php echo $id; ?> .uabb-imgicon-wrap {
    <?php
    echo ( $settings->icon_margin_top != '' ) ? 'margin-top: ' . $settings->icon_margin_top . 'px;' : 'margin-top: 25;';
    echo ( $settings->icon_margin_bottom != '' ) ? 'margin-bottom: ' . $settings->icon_margin_bottom . 'px;' : 'margin-bottom: 15px;';
    ?>
}


.fl-node-<?php echo $id; ?> .uabb-back .uabb-back-text-title {
    <?php
    echo ( $settings->back_title_typography_font_size['desktop'] != '' ) ? 'font-size: ' . $settings->back_title_typography_font_size['desktop'] . 'px;' : '';
    echo ( $settings->back_title_typography_line_height['desktop'] != '' ) ? 'line-height: ' . $settings->back_title_typography_line_height['desktop'] . 'px;' : '';
    if( $settings->back_title_typography_font_family['family'] != 'Default' ) {
        UABB_Helper::uabb_font_css( $settings->back_title_typography_font_family );
    }
    echo ( $settings->back_title_typography_color != '' ) ? 'color: ' . $settings->back_title_typography_color . ';' : '';

    echo ( $settings->back_title_typography_margin_top != '' ) ? 'margin-top: ' . $settings->back_title_typography_margin_top . 'px;' : 'margin-top: 25;';

    echo ( $settings->back_title_typography_margin_bottom != '' ) ? 'margin-bottom: ' . $settings->back_title_typography_margin_bottom . 'px;' : 'margin-bottom: 12px;';
    ?>
}



<?php
if( $global_settings->responsive_enabled ) { // Global Setting If started
?>
    @media ( max-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {

        <?php
        if( $settings->flip_box_min_height_options == 'uabb-custom-height' ) {
            if( $settings->flip_box_min_height_medium != '' ) {
        ?>
            .fl-node-<?php echo $id; ?> .uabb-flip-box {
                height: <?php echo $settings->flip_box_min_height_medium; ?>px;
            }
        <?php  
            }
        }
        ?>

        .fl-node-<?php echo $id; ?> .uabb-front .uabb-text-editor {
            <?php
            echo ( $settings->front_desc_typography_font_size['medium'] != '' ) ? 'font-size: ' . $settings->front_desc_typography_font_size['medium'] . 'px;' : '';
            echo ( $settings->front_desc_typography_line_height['medium'] != '' ) ? 'line-height: ' . $settings->front_desc_typography_line_height['medium'] . 'px;' : '';
            ?>
        }

        .fl-node-<?php echo $id; ?> .uabb-front .uabb-face-text-title {
            <?php
            echo ( $settings->front_title_typography_font_size['medium'] != '' ) ? 'font-size: ' . $settings->front_title_typography_font_size['medium'] . 'px;' : '';
            echo ( $settings->front_title_typography_line_height['medium'] != '' ) ? 'line-height: ' . $settings->front_title_typography_line_height['medium'] . 'px;' : '';
            ?>
        }

        .fl-node-<?php echo $id; ?> .uabb-back .uabb-text-editor {
            <?php
            echo ( $settings->back_desc_typography_font_size['medium'] != '' ) ? 'font-size: ' . $settings->back_desc_typography_font_size['medium'] . 'px;' : '';
            echo ( $settings->back_desc_typography_line_height['medium'] != '' ) ? 'line-height: ' . $settings->back_desc_typography_line_height['medium'] . 'px;' : '';
            ?>
        }


        .fl-node-<?php echo $id; ?> .uabb-back .uabb-back-text-title {
            <?php
            echo ( $settings->back_title_typography_font_size['medium'] != '' ) ? 'font-size: ' . $settings->back_title_typography_font_size['medium'] . 'px;' : '';
            echo ( $settings->back_title_typography_line_height['medium'] != '' ) ? 'line-height: ' . $settings->back_title_typography_line_height['medium'] . 'px;' : '';
            ?>
        }
    }
 
     @media ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {

        <?php
        if( $settings->flip_box_min_height_options == 'uabb-custom-height' ) {
            if( $settings->responsive_compatibility == 'yes' ) {
        ?>
            .fl-node-<?php echo $id; ?> .uabb-flip-box {
                height: 100%;
            }
        <?php
            }
            if( $settings->flip_box_min_height_small != '' ) {
        ?>
            .fl-node-<?php echo $id; ?> .uabb-flip-box {
                height: <?php echo $settings->flip_box_min_height_small; ?>px;
            }
        <?php  
            }
        }
        ?>

        .fl-node-<?php echo $id; ?> .uabb-front .uabb-text-editor {
            <?php
            echo ( $settings->front_desc_typography_font_size['small'] != '' ) ? 'font-size: ' . $settings->front_desc_typography_font_size['small'] . 'px;' : '';
            echo ( $settings->front_desc_typography_line_height['small'] != '' ) ? 'line-height: ' . $settings->front_desc_typography_line_height['small'] . 'px;' : '';
            ?>
        }

        .fl-node-<?php echo $id; ?> .uabb-front .uabb-face-text-title {
            <?php
            echo ( $settings->front_title_typography_font_size['small'] != '' ) ? 'font-size: ' . $settings->front_title_typography_font_size['small'] . 'px;' : '';
            echo ( $settings->front_title_typography_line_height['small'] != '' ) ? 'line-height: ' . $settings->front_title_typography_line_height['small'] . 'px;' : '';
            ?>
        }

        .fl-node-<?php echo $id; ?> .uabb-back .uabb-text-editor {
            <?php
            echo ( $settings->back_desc_typography_font_size['small'] != '' ) ? 'font-size: ' . $settings->back_desc_typography_font_size['small'] . 'px;' : '';
            echo ( $settings->back_desc_typography_line_height['small'] != '' ) ? 'line-height: ' . $settings->back_desc_typography_line_height['small'] . 'px;' : '';
            ?>
        }

        .fl-node-<?php echo $id; ?> .uabb-back .uabb-back-text-title {
            <?php
            echo ( $settings->back_title_typography_font_size['small'] != '' ) ? 'font-size: ' . $settings->back_title_typography_font_size['small'] . 'px;' : '';
            echo ( $settings->back_title_typography_line_height['small'] != '' ) ? 'line-height: ' . $settings->back_title_typography_line_height['small'] . 'px;' : '';
            ?>
        }
    }
<?php
}
?>