<?php
global $post;
$converted = get_post_meta( $post->ID,'_uabb_lite_converted', true );
    
$settings->text_color = UABB_Helper::uabb_colorpicker( $settings, 'text_color' );
$settings->ribbon_color = UABB_Helper::uabb_colorpicker( $settings, 'ribbon_color' );
$settings->text_shadow_color = UABB_Helper::uabb_colorpicker( $settings, 'text_shadow_color' );
$settings->icon_color = UABB_Helper::uabb_colorpicker( $settings, 'icon_color' );
$settings->fold_color = UABB_Helper::uabb_colorpicker( $settings, 'fold_color' );
$settings->end_color = UABB_Helper::uabb_colorpicker( $settings, 'end_color' );

$settings->icon_color = uabb_theme_text_color( $settings->icon_color );
?>

.fl-node-<?php echo $id;?> .uabb-ribbon-wrap {
    text-align: <?php echo $settings->ribbon_align; ?>
}

.fl-node-<?php echo $id;?> .uabb-ribbon-wrap .uabb-ribbon-text {
    <?php if( $settings->ribbon_bg_type == 'color' ) { ?>
        background: <?php echo ( uabb_theme_base_color( $settings->ribbon_color ) != '' ) ? uabb_theme_base_color( $settings->ribbon_color ) : '#f7f7f7'; ?>;
    <?php } elseif ( $settings->ribbon_bg_type == 'gradient' ) {
        UABB_Helper::uabb_gradient_css( $settings->gradient_color );
    } ?>
}

.fl-node-<?php echo $id;?> .uabb-ribbon-wrap .uabb-ribbon {
	/*background: <?php echo ( uabb_theme_base_color( $settings->ribbon_color ) != '' ) ? uabb_theme_base_color( $settings->ribbon_color ) : '#f7f7f7'; ?>;*/
    <?php
    echo ( $settings->text_color != '' ) ? 'color: ' . $settings->text_color . ';' : ''; ?>

        <?php if( $converted === 'yes' || isset( $settings->text_font_size_unit ) && $settings->text_font_size_unit != '' ) { ?>
            font-size: <?php echo $settings->text_font_size_unit; ?>px;      
        <?php } else if( isset( $settings->text_font_size_unit ) && $settings->text_font_size_unit == '' && isset( $settings->text_font_size['desktop'] ) && $settings->text_font_size['desktop'] != '' ) { ?>
            font-size: <?php echo $settings->text_font_size['desktop']; ?>px;
        <?php } ?>

        <?php if( isset( $settings->text_font_size['desktop'] ) && $settings->text_font_size['desktop'] == '' && isset( $settings->text_line_height['desktop'] ) && $settings->text_line_height['desktop'] != '' && $settings->text_line_height_unit == '' ) { ?>
            line-height: <?php echo $settings->text_line_height['desktop']; ?>px;
        <?php } ?>

        <?php if( $converted === 'yes' || isset( $settings->text_line_height_unit ) && $settings->text_line_height_unit != '' ) { ?>
            line-height: <?php echo $settings->text_line_height_unit; ?>em;  
        <?php }  else if( isset( $settings->text_line_height_unit ) && $settings->text_line_height_unit == '' && isset( $settings->text_line_height['desktop'] ) && $settings->text_line_height['desktop'] != '' ) { ?>
            line-height: <?php echo $settings->text_line_height['desktop']; ?>px;
        <?php } ?>

    <?php
    if( $settings->text_font_family['family'] != 'Default' ) {
        UABB_Helper::uabb_font_css( $settings->text_font_family );
    }
    echo ( $settings->text_shadow_color != '' ) ? 'text-shadow: ' . $settings->text_shadow_color . ' 0 1px 0;' : '';   ?>

    display: inline-block;
    <?php if( $settings->shadow == 'yes' ) { ?>
        box-shadow: rgba(000,000,000,0.3) 0 1px 1px;
    <?php }
    if( $settings->ribbon_width == 'full' ) { ?>
        width: 100%;
        width: calc(100% - 7em);
    <?php } elseif( $settings->ribbon_width == 'custom' ) { ?>
        width: calc(<?php echo ( $settings->custom_width != '' ) ? $settings->custom_width : '500' ?>px - 7em);
    <?php } ?>
    max-width: 100%;
    max-width: calc(100% - 7em);
}

.fl-node-<?php echo $id;?> .uabb-ribbon .uabb-left-ribb i,
.fl-node-<?php echo $id;?> .uabb-ribbon .uabb-right-ribb i {
	color: <?php echo uabb_theme_text_color( $settings->icon_color ); ?>;
}

<?php if( $settings->ribbon_resp == 'none' ) : ?>
    .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-ribbon-text:before,
    .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-ribbon-text:after {
        border-style: solid;
        border-color: <?php echo uabb_theme_text_color( $settings->fold_color ); ?> transparent transparent transparent;
    }

    .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-left-ribb,
    .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-right-ribb {
        border: 1em solid <?php echo uabb_theme_base_color( $settings->end_color ); ?>;
        z-index: -1;
    }

    /* Left Ribbon */
    .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-left-ribb {
        left: -3.5em;
        border-right-width: 3em;
        border-left-width: 1.5em;
        border-left-color: transparent;
        <?php
        if( $settings->shadow == 'yes' ) {
        ?>
        box-shadow: rgba(0,0,0,0.3) 2px 2px 1px;
        <?php
        }
        ?>
    }

    /* Right Ribbon */
    .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-right-ribb {
        right: -3.5em;
        border-left-width: 3em;
        border-right-width: 1.5em;
        border-right-color: transparent;
        <?php
        if( $settings->shadow == 'yes' ) {
        ?>
        box-shadow: rgba(0,0,0,0.3) -2px 2px 1px;
        <?php
        }
        ?>
    }

    .fl-node-<?php echo $id;?> .uabb-ribbon-wrap .uabb-ribbon {
        <?php if( $settings->ribbon_align == 'left' ) { ?>
            left: 3.5em;
        <?php } elseif( $settings->ribbon_align == 'right' ) { ?>
            right: 3.5em;
        <?php } ?>
    }

    /* For Icon
    *=============*/
    .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-left-ribb i,
    .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-right-ribb i {
        top: initial;
        transform: none;
    }

    .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-right-ribb i {
        transform: translate(-1.5em,-50%);
        right: initial;
    }

    .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-left-ribb i {
        transform: translate(0.5em,-50%);
        left: initial;
    }


    /*  Common Code
    *================ */
    .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-left-ribb,
    .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-right-ribb,
    .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-ribbon-text:before,
    .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-ribbon-text:after {
        content: "";
        bottom: -1em;
        position: absolute;
        display: block;
    }

    /* Inner Shadow Commonn */
    .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-ribbon-text:before,
    .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-ribbon-text:after {
        border-style: solid;
    }

    /* Inner Shadow Left */
    .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-ribbon-text:before {
        left: 0;
        border-width: 1em 0 0 1em;
    }

    /* Inner Shadow Right */
    .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-ribbon-text:after {
        right: 0;
        border-width: 1em 1em 0 0;
    }

<?php elseif ( $settings->ribbon_resp == 'small' ) : ?>
    @media all and ( min-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {
        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-ribbon-text:before,
        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-ribbon-text:after {
            border-style: solid;
            border-color: <?php echo uabb_theme_text_color( $settings->fold_color ); ?> transparent transparent transparent;
        }

        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-left-ribb,
        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-right-ribb {
            border: 1em solid <?php echo uabb_theme_base_color( $settings->end_color ); ?>;
            z-index: -1;
        }

        /* Left Ribbon */
        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-left-ribb {
            left: -3.5em;
            border-right-width: 3em;
            border-left-width: 1.5em;
            border-left-color: transparent;
            <?php
            if( $settings->shadow == 'yes' ) {
            ?>
            box-shadow: rgba(000,000,000,0.4) 1px 1px 1px;
            <?php
            }
            ?>
        }

        /* Right Ribbon */
        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-right-ribb {
            right: -3.5em;
            border-left-width: 3em;
            border-right-width: 1.5em;
            border-right-color: transparent;
            <?php
            if( $settings->shadow == 'yes' ) {
            ?>
            box-shadow: rgba(000,000,000,0.4) -1px 1px 1px;
            <?php
            }
            ?>
        }

        .fl-node-<?php echo $id;?> .uabb-ribbon-wrap .uabb-ribbon {
            <?php if( $settings->ribbon_align == 'left' ) { ?>
                left: 3.5em;
            <?php } elseif( $settings->ribbon_align == 'right' ) { ?>
                right: 3.5em;
            <?php } ?>
        }


        /* For Icon
        *=============*/
        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-left-ribb i,
        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-right-ribb i {
            top: initial;
            transform: none;
        }

        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-right-ribb i {
            transform: translate(-1.5em,-50%);
            right: initial;
        }

        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-left-ribb i {
            transform: translate(0.5em,-50%);
            left: initial;
        }


        /*  Common Code
        *================ */
        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-left-ribb,
        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-right-ribb,
        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-ribbon-text:before,
        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-ribbon-text:after {
            content: "";
            bottom: -1em;
            position: absolute;
            display: block;
        }

        /* Inner Shadow Commonn */
        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-ribbon-text:before,
        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-ribbon-text:after {
            border-style: solid;
        }

        /* Inner Shadow Left */
        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-ribbon-text:before {
            left: 0;
            border-width: 1em 0 0 1em;
        }

        /* Inner Shadow Right */
        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-ribbon-text:after {
            right: 0;
            border-width: 1em 1em 0 0;
        }
    }
    @media ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {
        .fl-node-<?php echo $id;?> .uabb-ribbon-wrap .uabb-ribbon {
            <?php if( $settings->ribbon_width == 'full' ) { ?>
                width: 100%;
            <?php } elseif ( $settings->ribbon_width == 'auto' ) { ?>
                width: auto;
            <?php } else { ?>
                width: <?php echo ( $settings->custom_width != '' ) ? $settings->custom_width : '500' ?>px;
            <?php } ?>

            max-width: 100%;
        }

        <?php if( $settings->left_icon == '' && $settings->right_icon == '' ) : ?>
        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-ribbon-text {
            padding: 0.5em 1em;
        }
        <?php endif; ?>
    }
<?php else : ?>
    @media all and ( min-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {
        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-ribbon-text:before,
        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-ribbon-text:after {
            border-style: solid;
            border-color: <?php echo uabb_theme_text_color( $settings->fold_color ); ?> transparent transparent transparent;
        }

        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-left-ribb,
        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-right-ribb {
            border: 1em solid <?php echo uabb_theme_base_color( $settings->end_color ); ?>;
            z-index: -1;
        }

        /* Left Ribbon */
        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-left-ribb {
            left: -3.5em;
            border-right-width: 3em;
            border-left-width: 1.5em;
            border-left-color: transparent;
            <?php
            if( $settings->shadow == 'yes' ) {
            ?>
            box-shadow: rgba(000,000,000,0.4) 1px 1px 0px;
            <?php
            }
            ?>
        }

        /* Right Ribbon */
        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-right-ribb {
            right: -3.5em;
            border-left-width: 3em;
            border-right-width: 1.5em;
            border-right-color: transparent;
            <?php
            if( $settings->shadow == 'yes' ) {
            ?>
            box-shadow: rgba(000,000,000,0.4) -1px 1px 0px;
            <?php
            }
            ?>
        }

        .fl-node-<?php echo $id;?> .uabb-ribbon-wrap .uabb-ribbon {
            <?php if( $settings->ribbon_align == 'left' ) { ?>
                left: 3.5em;
            <?php } elseif( $settings->ribbon_align == 'right' ) { ?>
                right: 3.5em;
            <?php } ?>
        }

        /* For Icon
        *=============*/
        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-left-ribb i,
        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-right-ribb i {
            top: initial;
            transform: none;
        }

        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-right-ribb i {
            transform: translate(-1.5em,-50%);
            right: initial;
        }

        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-left-ribb i {
            transform: translate(0.5em,-50%);
            left: initial;
        }


        /*  Common Code
        *================ */
        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-left-ribb,
        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-right-ribb,
        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-ribbon-text:before,
        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-ribbon-text:after {
            content: "";
            bottom: -1em;
            position: absolute;
            display: block;
        }

        /* Inner Shadow Commonn */
        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-ribbon-text:before,
        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-ribbon-text:after {
            border-style: solid;
        }

        /* Inner Shadow Left */
        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-ribbon-text:before {
            left: 0;
            border-width: 1em 0 0 1em;
        }

        /* Inner Shadow Right */
        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-ribbon-text:after {
            right: 0;
            border-width: 1em 1em 0 0;
        }
    }
    @media ( max-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {
        .fl-node-<?php echo $id;?> .uabb-ribbon-wrap .uabb-ribbon {
            <?php if( $settings->ribbon_width == 'full' ) { ?>
                width: 100%;
            <?php } elseif ( $settings->ribbon_width == 'auto' ) { ?>
                width: auto;
            <?php } else { ?>
                width: <?php echo ( $settings->custom_width != '' ) ? $settings->custom_width : '500' ?>px;
            <?php } ?>
            max-width: 100%;
        }

        <?php if( $settings->left_icon == '' && $settings->right_icon == '' ) : ?>
        .fl-node-<?php echo $id;?> .uabb-ribbon .uabb-ribbon-text {
            padding: 0.5em 1em;
        }
        <?php endif; ?>
    }
<?php endif; ?>
<?php
if( $global_settings->responsive_enabled ) { // Global Setting If started
?>


    @media ( max-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {
        <?php
        if( isset($settings->text_line_height['medium']) &&  $settings->text_line_height['medium'] != '' || isset($settings->text_font_size['medium']) &&  $settings->text_font_size['medium'] != '' || isset($settings->text_line_height_unit) || $settings->ribbon_width == 'auto' )  {
        ?>

            .fl-node-<?php echo $id;?> .uabb-ribbon-wrap .uabb-ribbon {
            <?php if( $converted === 'yes' || isset( $settings->text_font_size_unit_medium ) && $settings->text_font_size_unit_medium != '' ){ ?>
                font-size: <?php echo $settings->text_font_size_unit_medium; ?>px;
            <?php } else if(  isset( $settings->text_font_size_unit_medium ) && $settings->text_font_size_unit_medium == '' && isset( $settings->text_font_size['medium'] ) && $settings->text_font_size['medium'] != '' ) {?>
                font-size: <?php echo $settings->text_font_size['medium']; ?>px;
            <?php } ?>

                <?php if( isset( $settings->text_font_size['medium'] ) && $settings->text_font_size['medium'] == '' && isset( $settings->text_line_height['medium'] ) && $settings->text_line_height['medium'] != '' && $settings->text_line_height_unit == '' && $settings->text_line_height_unit_medium == '' ) { ?>
                    line-height: <?php echo $settings->text_line_height['medium']; ?>px;
                <?php } ?>
            <?php if( $converted === 'yes' || isset( $settings->text_line_height_unit_medium ) && $settings->text_line_height_unit_medium != '' ){ ?>
                line-height: <?php echo $settings->text_line_height_unit_medium; ?>em;   
            <?php } else if( isset( $settings->text_line_height_unit_medium )&& $settings->text_line_height_unit_medium == '' && isset( $settings->text_line_height['medium'] ) && $settings->text_line_height['medium'] != '' ) {?>
                line-height: <?php echo $settings->text_line_height['medium']; ?>px;
            <?php } ?>

            }

        <?php } ?>
    }

    @media ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {
        .fl-node-<?php echo $id;?> .uabb-ribbon-wrap .uabb-ribbon {

            <?php if( $converted === 'yes' || isset( $settings->text_font_size_unit_responsive ) && $settings->text_font_size_unit_responsive != '' ){ ?>
                font-size: <?php echo $settings->text_font_size_unit_responsive; ?>px;   
            <?php } else if( $settings->text_font_size_unit_responsive  && $settings->text_font_size_unit_responsive == '' && isset( $settings->text_font_size['small'] ) && $settings->text_font_size['small'] != '' ) { ?>
                font-size: <?php echo $settings->text_font_size['small']; ?>px;
            <?php } ?>

            <?php if( isset( $settings->text_font_size['small'] ) && $settings->text_font_size['small'] == '' && isset( $settings->text_line_height['small'] ) && $settings->text_line_height['small'] != '' && $settings->text_line_height_unit == '' && $settings->text_line_height_unit_medium == '' && $settings->text_line_height_unit_responsive == '' ) { ?>
                line-height: <?php echo $settings->text_line_height['small']; ?>px;
            <?php } ?>

            <?php if( $converted === 'yes' || isset( $settings->text_line_height_unit_responsive ) && $settings->text_line_height_unit_responsive != '' ) { ?>
                line-height: <?php echo $settings->text_line_height_unit_responsive; ?>em;
            <?php } else if( isset( $settings->text_line_height_unit_responsive ) && $settings->text_line_height_unit_responsive == '' && isset( $settings->text_line_height['small'] ) && $settings->text_line_height['small'] != '' ) {?>
                line-height: <?php echo $settings->text_line_height['small']; ?>px;
            <?php } ?>  

        }
    }
<?php
}
?>
