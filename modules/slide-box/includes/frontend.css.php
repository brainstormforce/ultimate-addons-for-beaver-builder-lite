<?php
/**
 *
 * This file should contain frontend styles that
 * will be applied to individual module instances of Slide Box.
 *
 * @package Slide Box
 */

	global $post;
	$version_bb_check = UABB_Lite_Compatibility::check_bb_version();
	$converted        = UABB_Lite_Compatibility::check_old_page_migration();

	// Ensure $settings is defined and initialized.
if ( ! isset( $settings ) ) {
	$settings = new stdClass(); // Create an empty object to avoid undefined errors.
}

// Ensure $id is defined and initialized.
if ( ! isset( $id ) ) {
	$id = '';
}

// Ensure $global_settings is defined and initialized.
if ( ! isset( $global_settings ) ) {
	// Create an empty object to avoid undefined errors.
	$global_settings = new stdClass();
}

	$settings->icon_color                     = FLBuilderColor::hex_or_rgb( $settings->icon_color );
	$settings->icon_hover_color               = FLBuilderColor::hex_or_rgb( $settings->icon_hover_color );
	$settings->overlay_icon_color             = FLBuilderColor::hex_or_rgb( $settings->overlay_icon_color );
	$settings->dropdown_icon_color            = FLBuilderColor::hex_or_rgb( $settings->dropdown_icon_color );
	$settings->front_title_focused_color      = FLBuilderColor::hex_or_rgb( $settings->front_title_focused_color );
	$settings->front_title_color              = FLBuilderColor::hex_or_rgb( $settings->front_title_color );
	$settings->back_title_color               = FLBuilderColor::hex_or_rgb( $settings->back_title_color );
	$settings->front_desc_focused_color       = FLBuilderColor::hex_or_rgb( $settings->front_desc_focused_color );
	$settings->front_desc_color               = FLBuilderColor::hex_or_rgb( $settings->front_desc_color );
	$settings->back_desc_color                = FLBuilderColor::hex_or_rgb( $settings->back_desc_color );
	$settings->link_color                     = FLBuilderColor::hex_or_rgb( $settings->link_color );
	$settings->dropdown_plus_icon_color       = FLBuilderColor::hex_or_rgb( $settings->dropdown_plus_icon_color );
	$settings->img_bg_color                   = FLBuilderColor::hex_or_rgb( $settings->img_bg_color );
	$settings->front_icon_border_color        = FLBuilderColor::hex_or_rgb( $settings->front_icon_border_color );
	$settings->front_icon_border_hover_color  = FLBuilderColor::hex_or_rgb( $settings->front_icon_border_hover_color );
	$settings->front_background_color         = FLBuilderColor::hex_or_rgb( $settings->front_background_color );
	$settings->focused_front_background_color = FLBuilderColor::hex_or_rgb( $settings->focused_front_background_color );
	$settings->back_background_color          = FLBuilderColor::hex_or_rgb( $settings->back_background_color );
	$settings->overlay_color                  = FLBuilderColor::hex_or_rgb( $settings->overlay_color );
	$settings->overlay_icon_bg_color          = FLBuilderColor::hex_or_rgb( $settings->overlay_icon_bg_color );
	$settings->dropdown_icon_bg_color         = FLBuilderColor::hex_or_rgb( $settings->dropdown_icon_bg_color );

	$settings->icon_size              = ( '' !== trim( $settings->icon_size ) ) ? $settings->icon_size : '32';
	$settings->img_size               = ( '' !== trim( $settings->img_size ) ) ? $settings->img_size : '60';
	$settings->front_icon_border_size = ( '' !== trim( $settings->front_icon_border_size ) ) ? $settings->front_icon_border_size : '1';
	$settings->overlay_icon_size      = ( '' !== trim( $settings->overlay_icon_size ) ) ? $settings->overlay_icon_size : '30';
	$settings->dropdown_icon_size     = ( '' !== trim( $settings->dropdown_icon_size ) ) ? $settings->dropdown_icon_size : '20';
?>

.fl-node-<?php echo esc_attr( $id ); ?> {
	width: 100%;
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box-wrap .uabb-slide-front {

	<?php
	if ( 'yes' === $converted || isset( $settings->front_padding_dimension_top ) && isset( $settings->front_padding_dimension_bottom ) && '' !== $settings->front_padding_dimension_top && '' !== $settings->front_padding_dimension_bottom && isset( $settings->front_padding_dimension_left ) && '' !== $settings->front_padding_dimension_left && isset( $settings->front_padding_dimension_right ) && '' !== $settings->front_padding_dimension_right ) {
		if ( isset( $settings->front_padding_dimension_top ) ) {
			echo ( '' !== $settings->front_padding_dimension_top ) ? 'padding-top:' . esc_attr( $settings->front_padding_dimension_top ) . 'px;' : 'padding-top: 25px;';
		}
		if ( isset( $settings->front_padding_dimension_bottom ) ) {
			echo ( '' !== $settings->front_padding_dimension_bottom ) ? 'padding-bottom:' . esc_attr( $settings->front_padding_dimension_bottom ) . 'px;' : 'padding-bottom: 25px;';
		}
		if ( isset( $settings->front_padding_dimension_left ) ) {
			echo ( '' !== $settings->front_padding_dimension_left ) ? 'padding-left:' . esc_attr( $settings->front_padding_dimension_left ) . 'px;' : 'padding-left: 25px;';
		}
		if ( isset( $settings->front_padding_dimension_right ) ) {
			echo ( '' !== $settings->front_padding_dimension_right ) ? 'padding-right:' . esc_attr( $settings->front_padding_dimension_right ) . 'px;' : 'padding-right: 25px;';
		}
	} elseif ( isset( $settings->front_padding ) && '' !== $settings->front_padding && isset( $settings->front_padding_dimension_top ) && '' === $settings->front_padding_dimension_top && isset( $settings->front_padding_dimension_bottom ) && '' === $settings->front_padding_dimension_bottom && isset( $settings->front_padding_dimension_left ) && '' === $settings->front_padding_dimension_left && isset( $settings->front_padding_dimension_right ) && '' === $settings->front_padding_dimension_right ) {
		echo esc_attr( $settings->front_padding );
		?>
		;
	<?php } ?>
	?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box-wrap .uabb-slide-down {
	<?php
	if ( 'yes' === $converted || isset( $settings->back_padding_dimension_top ) && '' !== $settings->back_padding_dimension_top && isset( $settings->back_padding_dimension_bottom ) && '' !== $settings->back_padding_dimension_bottom && isset( $settings->back_padding_dimension_left ) && '' !== $settings->back_padding_dimension_left && isset( $settings->back_padding_dimension_right ) && '' !== $settings->back_padding_dimension_right ) {
		if ( isset( $settings->back_padding_dimension_top ) ) {
			echo ( '' !== $settings->back_padding_dimension_top ) ? 'padding-top:' . esc_attr( $settings->back_padding_dimension_top ) . 'px;' : 'padding-top: 25px;';
		}
		if ( isset( $settings->back_padding_dimension_bottom ) ) {
			echo ( '' !== $settings->back_padding_dimension_bottom ) ? 'padding-bottom:' . esc_attr( $settings->back_padding_dimension_bottom ) . 'px;' : 'padding-bottom: 25px;';
		}
		if ( isset( $settings->back_padding_dimension_left ) ) {
			echo ( '' !== $settings->back_padding_dimension_left ) ? 'padding-left:' . esc_attr( $settings->back_padding_dimension_left ) . 'px;' : 'padding-left: 25px;';
		}
		if ( isset( $settings->back_padding_dimension_right ) ) {
			echo ( '' !== $settings->back_padding_dimension_right ) ? 'padding-right:' . esc_attr( $settings->back_padding_dimension_right ) . 'px;' : 'padding-right: 25px;';
		}
	} elseif ( isset( $settings->back_padding ) && '' !== $settings->back_padding && isset( $settings->back_padding_dimension_top ) && '' === $settings->back_padding_dimension_top && isset( $settings->back_padding_dimension_bottom ) && '' === $settings->back_padding_dimension_bottom && isset( $settings->back_padding_dimension_left ) && '' === $settings->back_padding_dimension_left && isset( $settings->back_padding_dimension_right ) && '' === $settings->back_padding_dimension_right ) {
		echo esc_attr( $settings->back_padding );
		?>
		;
	<?php } ?>
}

<?php
if ( ! $version_bb_check ) {

	$imageicon_array = array(

		/* General Section */
		'image_type'              => $settings->image_type,

		/* Icon Basics */
		'icon'                    => $settings->icon,
		'icon_size'               => $settings->icon_size,
		'icon_align'              => '',

		/* Image Basics */
		'photo_source'            => 'library',
		'photo'                   => $settings->photo,
		'photo_url'               => '',
		'img_size'                => $settings->img_size,
		'img_align'               => 'inherit',
		'photo_src'               => ( isset( $settings->photo_src ) ) ? $settings->photo_src : '',

		/* Icon Style */
		'icon_style'              => 'simple',
		'icon_bg_size'            => '',
		'icon_border_style'       => '',
		'icon_border_width'       => '',
		'icon_bg_border_radius'   => '',

		/* Image Style */
		'image_style'             => $settings->image_style,
		'img_bg_size'             => $settings->img_bg_size,
		'img_border_style'        => '',
		'img_border_width'        => '',
		'img_bg_border_radius'    => '',

		/* Preset Color variable new */
		'icon_color_preset'       => 'preset1',

		/* Icon Colors */
		'icon_color'              => '',
		'icon_hover_color'        => '',
		'icon_bg_color'           => '',
		'icon_bg_hover_color'     => '',
		'icon_border_color'       => '',
		'icon_border_hover_color' => '',
		'icon_three_d'            => '',

		/* Image Colors */
		'img_bg_color'            => $settings->img_bg_color,
		'img_bg_color_opc'        => $settings->img_bg_color_opc,
		'img_bg_hover_color'      => '',
		'img_border_color'        => '',
		'img_border_hover_color'  => '',

	);
} else {
	$imageicon_array = array(
		/* General Section */
		'image_type'              => $settings->image_type,
		/* Icon Basics */
		'icon'                    => $settings->icon,
		'icon_size'               => $settings->icon_size,
		'icon_align'              => '',
		/* Image Basics */
		'photo_source'            => 'library',
		'photo'                   => $settings->photo,
		'photo_url'               => '',
		'img_size'                => $settings->img_size,
		'img_align'               => 'inherit',
		'photo_src'               => ( isset( $settings->photo_src ) ) ? $settings->photo_src : '',

		/* Icon Style */
		'icon_style'              => 'simple',
		'icon_bg_size'            => '',
		'icon_border_style'       => '',
		'icon_border_width'       => '',
		'icon_bg_border_radius'   => '',

		/* Image Style */
		'image_style'             => $settings->image_style,
		'img_bg_size'             => $settings->img_bg_size,
		'img_border_style'        => '',
		'img_border_width'        => '',
		'img_bg_border_radius'    => '',

		/* Preset Color variable new */
		'icon_color_preset'       => 'preset1',

		/* Icon Colors */
		'icon_color'              => '',
		'icon_hover_color'        => '',
		'icon_bg_color'           => '',
		'icon_bg_hover_color'     => '',
		'icon_border_color'       => '',
		'icon_border_hover_color' => '',
		'icon_three_d'            => '',

		/* Image Colors */
		'img_bg_color'            => $settings->img_bg_color,
		'img_bg_hover_color'      => '',
		'img_border_color'        => '',
		'img_border_hover_color'  => '',

	);
}

	/* CSS Render Function */
	FLBuilder::render_module_css( 'image-icon', $id, $imageicon_array );
?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-icon-wrap .uabb-icon i {
<?php if ( 'above-title' === $settings->front_img_icon_position ) : ?>
	width: auto;
<?php elseif ( 'right-title' === $settings->front_img_icon_position || 'right' === $settings->front_img_icon_position ) : ?>
	direction: rtl;
<?php endif; ?>
}

<?php if ( 'icon' === $settings->image_type ) { ?>
/* Icon */

	<?php

	if ( '' !== $settings->icon_color ) {
		?>

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-icon-wrap .uabb-icon i, 
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-icon-wrap .uabb-icon i:before {
			color: <?php echo esc_attr( $settings->icon_color ); ?>;
		}

		<?php
	}
	if ( '' !== $settings->icon_hover_color ) {
		?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-<?php echo esc_attr( $settings->slide_type ); ?>.open-slidedown .uabb-slide-box-section .uabb-imgicon-wrap .uabb-icon i,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-<?php echo esc_attr( $settings->slide_type ); ?>.open-slidedown .uabb-slide-box-section .uabb-imgicon-wrap .uabb-icon i:before {
			color: <?php echo esc_attr( $settings->icon_hover_color ); ?>;
		}
		<?php
	}

	?>
<?php } ?>

/* Render Button CSS */
<?php
if ( 'button' === $settings->cta_type ) {
	( '' !== $settings->button ) ? FLBuilder::render_module_css( 'uabb-button', $id, $settings->button ) : '';
}
?>

<?php if ( '' !== $settings->overlay_color ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box-overlay {
		background: <?php echo esc_attr( $settings->overlay_color ); ?>;
	}
<?php } ?>

.fl-node-<?php echo esc_attr( $id ); ?> .fl-module-content .uabb-slide-dropdown .uabb-icon i, 
.fl-node-<?php echo esc_attr( $id ); ?> .fl-module-content .uabb-slide-dropdown .uabb-icon i:before {
	font-size: <?php echo esc_attr( $settings->dropdown_icon_size ); ?>px;
	<?php if ( 'style2' === $settings->slide_type ) { ?>
		color: <?php echo esc_attr( $settings->dropdown_icon_color ); ?>;
		background: <?php echo esc_attr( uabb_theme_base_color( $settings->dropdown_icon_bg_color ) ); ?>;
		border-radius: 100%;
		-moz-border-radius: 100%;
		-webkit-border-radius: 100%;
		line-height: 1.75em;
		height: 1.75em;
		width: 1.75em;
		text-align: center;
		<?php
	} elseif ( 'style3' === $settings->slide_type ) {
		?>
	color: <?php echo esc_attr( uabb_theme_base_color( $settings->dropdown_plus_icon_color ) ); ?>;
		<?php
	}
	?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box-overlay .uabb-icon i, 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box-overlay .uabb-icon i:before {
	color: <?php echo esc_attr( uabb_theme_base_color( $settings->overlay_icon_color ) ); ?>;
	font-size: <?php echo esc_attr( $settings->overlay_icon_size ); ?>px;
	<?php if ( isset( $settings->overlay_icon_bg_color ) && trim( $settings->overlay_icon_bg_color ) !== '' ) : ?>
		background: <?php echo esc_attr( $settings->overlay_icon_bg_color ); ?>;
		border-radius: 100%;
		-moz-border-radius: 100%;
		-webkit-border-radius: 100%;
		line-height: 1.75em;
		height: 1.75em;
		width: 1.75em;
		text-align: center;
	<?php endif; ?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box .uabb-slide-down {
	text-align: <?php echo esc_attr( $settings->back_alignment ); ?>;
	<?php echo ( '' !== $settings->back_background_color ) ? 'background:' . esc_attr( $settings->back_background_color ) . ';' : ''; ?>
	<?php if ( 'default' !== $settings->set_min_height && ! empty( $settings->slide_min_height ) ) { ?>
	min-height: <?php echo esc_attr( $settings->slide_min_height ); ?>px;
	justify-content : <?php echo esc_attr( $settings->slide_vertical_align ); ?>;
	<?php } ?> 
}

/*  Front Slide Vertical Alignment */
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box .uabb-slide-front {
	background: <?php echo esc_attr( $settings->front_background_color ); ?>;
	<?php if ( 'above-title' === $settings->front_img_icon_position ) { ?>
		text-align: <?php echo esc_attr( $settings->front_alignment ); ?>;
	<?php } ?>
	<?php
	if ( 'default' !== $settings->set_min_height && ! empty( $settings->slide_min_height ) ) {
		?>
	min-height: <?php echo esc_attr( $settings->slide_min_height ); ?>px;
	justify-content : <?php echo esc_attr( $settings->slide_vertical_align ); ?>;
		<?php
	}
	?>
}

/* Calculated Width Slidebox */
<?php if ( 'above-title' !== $settings->front_img_icon_position && 'none' !== $settings->image_type ) { ?>
	<?php
	$extra_width = 0;
	if ( 'photo' === $settings->image_type ) {
		$extra_width = $settings->img_size;
		if ( 'custom' === $settings->image_style ) {
			$extra_width = $extra_width + intval( $settings->img_bg_size ) * 2;
		}
		$extra_width = $extra_width + 15;
	} elseif ( 'icon' === $settings->image_type ) {
		$extra_width = $settings->icon_size + 15;
	}
	?>

	<?php if ( 'left' === $settings->front_img_icon_position || 'right' === $settings->front_img_icon_position ) { ?>

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-front-right-text {
			width: calc( 100% - <?php echo esc_attr( $extra_width ); ?>px );
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-front-right-text,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-front-left-img,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-front-right-img {
			vertical-align: <?php echo esc_attr( $settings->front_align_items ); ?>;
		}

		<?php if ( 'yes' === $settings->front_icon_border ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-icon-border {
			position: absolute; 
			height: 100%; 
			top: 0;
			transition: all linear 300ms;
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-front-right-text {
			width: calc( 100% - <?php echo esc_attr( $extra_width + $settings->front_icon_border_size ); ?>px );
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .open-slidedown .uabb-slide-icon-border {
			<?php echo ( '' !== $settings->front_icon_border_hover_color ) ? 'border-color: ' . esc_attr( $settings->front_icon_border_hover_color ) . ';' : ''; ?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-icon-left .uabb-slide-icon-border,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-photo-left .uabb-slide-icon-border {
			border-right-style: solid; 
			<?php echo ( '' !== $settings->front_icon_border_color ) ? 'border-right-color: ' . esc_attr( $settings->front_icon_border_color ) . ';' : ''; ?>
			border-right-width: <?php echo esc_attr( $settings->front_icon_border_size ); ?>px;
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-icon-right .uabb-slide-icon-border,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-photo-right .uabb-slide-icon-border {
			border-left-style: solid; 
			<?php echo ( '' !== $settings->front_icon_border_color ) ? 'border-left-color: ' . esc_attr( $settings->front_icon_border_color ) . ';' : ''; ?>
			border-left-width: <?php echo esc_attr( $settings->front_icon_border_size ); ?>px;
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-icon-left .uabb-slide-front-right-text,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-photo-left .uabb-slide-front-right-text {
			<?php if ( '' !== $settings->front_icon_border_size ) { ?>
			padding-left: <?php echo esc_attr( $settings->front_icon_border_size + 15 ); ?>px;
			<?php } else { ?>
			padding-left: 15px;
			<?php } ?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-icon-right .uabb-slide-front-right-text,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-photo-right .uabb-slide-front-right-text {
			padding-right: 15px;
		}


		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-icon-right .uabb-slide-front-right-img,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-photo-right .uabb-slide-front-right-img {
			<?php if ( '' !== $settings->front_icon_border_size ) { ?>
			padding-left: <?php echo esc_attr( $settings->front_icon_border_size + 15 ); ?>px
			<?php } else { ?>
			padding-left: 15px;
			<?php } ?>
		}

		<?php } ?>
	<?php } ?>

	<?php if ( 'left-title' === $settings->front_img_icon_position || 'right-title' === $settings->front_img_icon_position ) { ?>

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-front-right-text {
			width: 100%;
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-face-text-title {
			width: calc( 100% - <?php echo esc_attr( $extra_width ); ?>px );
		}
	<?php } ?>

<?php } ?>

<?php
if ( 'style1' === $settings->slide_type ) {
	?>

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box-wrap .uabb-style1.open-slidedown .uabb-slide-front {
		background: <?php echo esc_attr( $settings->focused_front_background_color ); ?>;
		transition: all linear 300ms;
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-style1.open-slidedown .uabb-slide-box .uabb-slide-box-section-content {
		color: <?php echo esc_attr( uabb_theme_text_color( $settings->front_desc_focused_color ) ); ?>;
		transition: all linear 300ms;
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-style1.open-slidedown .uabb-slide-box .uabb-slide-face-text-title {
		color: <?php echo esc_attr( $settings->front_title_focused_color ); ?>;
		transition: all linear 300ms;
	}


	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box-wrap .uabb-style1.open-slidedown .uabb-slide-down {
		opacity:1;
		pointer-events: visible;
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box-wrap .uabb-style1 .uabb-button-wrap {
		position: absolute;
		top: 100%;
		left: 50%;
		transform: translate(-50%,-50%);
	}

	<?php if ( 'button' === $settings->cta_type && '' !== $settings->button && 'full' === $settings->button->width ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-button-wrap {
		width: 100%;
	}
	<?php } ?>
	<?php
}
?>

<?php if ( 'style2' === $settings->slide_type ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box-wrap {
		<?php echo ( '' !== $settings->dropdown_icon_size ) ? esc_attr( 'margin-bottom: ' . ( $settings->dropdown_icon_size * 1.75 ) / 2 . 'px;' ) : ''; ?>
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-style2 .uabb-slide-front-right-text {
		<?php echo ( '' !== $settings->dropdown_icon_size ) ? 'padding-bottom: ' . esc_attr( $settings->dropdown_icon_size * 0.75 ) . 'px;' : ''; ?>
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-style2.open-slidedown .uabb-slide-box .uabb-slide-box-section-content {
		color: <?php echo esc_attr( uabb_theme_text_color( $settings->front_desc_focused_color ) ); ?>;
		transition: all linear 300ms;
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-style2.open-slidedown .uabb-slide-box .uabb-slide-face-text-title {
		color: <?php echo esc_attr( $settings->front_title_focused_color ); ?>;
		transition: all linear 300ms;
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box-wrap .uabb-style2.open-slidedown .uabb-slide-front {
		background: <?php echo esc_attr( $settings->focused_front_background_color ); ?>;
		transition: all linear 300ms;
	}
	<?php if ( 'center' !== $settings->dropdown_icon_align ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .fl-module-content .uabb-style2 .uabb-slide-dropdown {
			<?php if ( 'left' === $settings->dropdown_icon_align ) { ?>
				left: 0;
				transform: translate(0%,50%);
			<?php } elseif ( 'right' === $settings->dropdown_icon_align ) { ?>
				left: 100%;
				transform: translate(-100%,50%);
			<?php } ?>
		}
	<?php } ?>
<?php } ?>
<?php if ( 'style3' === $settings->slide_type ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-style3 .uabb-slide-dropdown .uabb-icon i, 
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-style3 .uabb-slide-dropdown .uabb-icon i:before {
		line-height: 1em;
		height: 1em;
		width: 1em;
		text-align: center;
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-style3 .uabb-slide-front-right-text {
		<?php echo ( '' !== $settings->dropdown_icon_size ) ? 'padding-bottom: ' . esc_attr( $settings->dropdown_icon_size + 10 ) . 'px;' : ''; ?>
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-style3.open-slidedown .uabb-slide-box .uabb-slide-box-section-content {
		color: <?php echo esc_attr( uabb_theme_text_color( $settings->front_desc_focused_color ) ); ?>;
		transition: all linear 300ms;
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-style3.open-slidedown .uabb-slide-box .uabb-slide-face-text-title {
		color: <?php echo esc_attr( $settings->front_title_focused_color ); ?>;
		transition: all linear 300ms;
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box-wrap .uabb-style3.open-slidedown .uabb-slide-front {
		background: <?php echo esc_attr( $settings->focused_front_background_color ); ?>;
		transition: all linear 300ms;
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .fl-module-content .uabb-style3 .uabb-slide-dropdown {
		justify-content: <?php echo ( 'left' === $settings->dropdown_icon_align ) ? 'flex-start' : ( ( 'right' === $settings->dropdown_icon_align ) ? 'flex-end' : '' ); ?>;
	}
<?php } ?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box .uabb-slide-face-text-title {
	<?php
		echo ( '' !== $settings->front_title_color ) ? 'color: ' . esc_attr( $settings->front_title_color ) . ';' : '';
		echo ( '' !== $settings->front_title_margin_top ) ? 'margin-top: ' . esc_attr( $settings->front_title_margin_top ) . 'px;' : '';
		echo ( '' !== $settings->front_title_margin_bottom ) ? 'margin-bottom: ' . esc_attr( $settings->front_title_margin_bottom ) . 'px;' : 'margin-bottom: 15px;';
	?>
}
/* Font Front Slide Heading (Desktop). */
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box .uabb-slide-face-text-title {
		<?php if ( 'Default' !== $settings->front_title_font_family['family'] ) : ?>
			<?php UABB_Helper::uabb_font_css( $settings->front_title_font_family ); ?>
		<?php endif; ?>

		<?php if ( 'yes' === $converted || isset( $settings->front_title_font_size_unit ) && '' !== $settings->front_title_font_size_unit ) { ?>
			font-size: <?php echo esc_attr( $settings->front_title_font_size_unit ); ?>px;      
		<?php } elseif ( isset( $settings->front_title_font_size_unit ) && '' === $settings->front_title_font_size_unit && isset( $settings->front_title_font_size['desktop'] ) && '' !== $settings->front_title_font_size['desktop'] ) { ?>
			font-size: <?php echo esc_attr( $settings->front_title_font_size['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( isset( $settings->front_title_font_size['desktop'] ) && '' === $settings->front_title_font_size['desktop'] && isset( $settings->front_title_line_height['desktop'] ) && '' !== $settings->front_title_line_height['desktop'] && '' === $settings->front_title_line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->front_title_line_height['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->front_title_line_height_unit ) && '' !== $settings->front_title_line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->front_title_line_height_unit ); ?>em;  
		<?php } elseif ( isset( $settings->front_title_line_height_unit ) && '' === $settings->front_title_line_height_unit && isset( $settings->front_title_line_height['desktop'] ) && '' !== $settings->front_title_line_height['desktop'] ) { ?>
			line-height: <?php echo esc_attr( $settings->front_title_line_height['desktop'] ); ?>px;
		<?php } ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'front_title_typo',
				'selector'     => ".fl-node-$id .uabb-slide-box .uabb-slide-face-text-title",
			)
		);
	}
}
?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box .uabb-slide-box-section-content {
	<?php echo ( '' !== $settings->front_desc_margin_top ) ? 'margin-top: ' . esc_attr( $settings->front_desc_margin_top ) . 'px;' : ''; ?>
	<?php echo ( '' !== $settings->front_desc_margin_bottom ) ? 'margin-bottom: ' . esc_attr( $settings->front_desc_margin_bottom ) . 'px;' : ''; ?>
	<?php echo ( '' !== $settings->front_desc_color ) ? 'color: ' . esc_attr( $settings->front_desc_color ) . ';' : ''; ?>
}
/* Font Front Slide Description (Desktop) */
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box .uabb-slide-box-section-content {

		<?php if ( 'Default' !== $settings->front_desc_font_family['family'] ) : ?>
			<?php UABB_Helper::uabb_font_css( $settings->front_desc_font_family ); ?>
		<?php endif; ?>

		<?php if ( 'yes' === $converted || isset( $settings->front_desc_font_size_unit ) && '' !== $settings->front_desc_font_size_unit ) { ?>
			font-size: <?php echo esc_attr( $settings->front_desc_font_size_unit ); ?>px;      
		<?php } elseif ( isset( $settings->front_desc_font_size_unit ) && '' === $settings->front_desc_font_size_unit && isset( $settings->front_desc_font_size['desktop'] ) && '' !== $settings->front_desc_font_size['desktop'] ) { ?>
			font-size: <?php echo esc_attr( $settings->front_desc_font_size['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( isset( $settings->front_desc_font_size['desktop'] ) && '' === $settings->front_desc_font_size['desktop'] && isset( $settings->front_desc_line_height['desktop'] ) && '' !== $settings->front_desc_line_height['desktop'] && '' === $settings->front_desc_line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->front_desc_line_height['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->front_desc_line_height_unit ) && '' !== $settings->front_desc_line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->front_desc_line_height_unit ); ?>em;  
		<?php } elseif ( isset( $settings->front_desc_line_height_unit ) && '' === $settings->front_desc_line_height_unit && isset( $settings->front_desc_line_height['desktop'] ) && '' !== $settings->front_desc_line_height['desktop'] ) { ?>
			line-height: <?php echo esc_attr( $settings->front_desc_line_height['desktop'] ); ?>px;
		<?php } ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'front_desc_typo',
				'selector'     => ".fl-node-$id .uabb-slide-box .uabb-slide-box-section-content",
			)
		);
	}
}
?>
/* Font Back Slide Heading (Desktop) */
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box .uabb-slide-back-text-title {
		<?php
		echo ( '' !== $settings->back_title_color ) ? 'color: ' . esc_attr( $settings->back_title_color ) . ';' : '';
		echo ( '' !== $settings->back_title_margin_top ) ? 'margin-top: ' . esc_attr( $settings->back_title_margin_top ) . 'px;' : '';
		echo ( '' !== $settings->back_title_margin_bottom ) ? 'margin-bottom: ' . esc_attr( $settings->back_title_margin_bottom ) . 'px;' : '';
		?>
}
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box .uabb-slide-back-text-title {
		<?php if ( 'Default' !== $settings->back_title_font_family['family'] ) : ?>
			<?php UABB_Helper::uabb_font_css( $settings->back_title_font_family ); ?>
		<?php endif; ?>

		<?php if ( 'yes' === $converted || isset( $settings->back_title_font_size_unit ) && '' !== $settings->back_title_font_size_unit ) { ?>
			font-size: <?php echo esc_attr( $settings->back_title_font_size_unit ); ?>px;      
		<?php } elseif ( isset( $settings->back_title_font_size_unit ) && '' === $settings->back_title_font_size_unit && isset( $settings->back_title_font_size['desktop'] ) && '' !== $settings->back_title_font_size['desktop'] ) { ?>
			font-size: <?php echo esc_attr( $settings->back_title_font_size['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( isset( $settings->back_title_font_size['desktop'] ) && '' === $settings->back_title_font_size['desktop'] && isset( $settings->back_title_line_height['desktop'] ) && '' !== $settings->back_title_line_height['desktop'] && '' === $settings->back_title_line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->back_title_line_height['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->back_title_line_height_unit ) && '' !== $settings->back_title_line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->back_title_line_height_unit ); ?>em;  
		<?php } elseif ( isset( $settings->back_title_line_height_unit ) && '' === $settings->back_title_line_height_unit && isset( $settings->back_title_line_height['desktop'] ) && '' !== $settings->back_title_line_height['desktop'] ) { ?>
			line-height: <?php echo esc_attr( $settings->back_title_line_height['desktop'] ); ?>px;
		<?php } ?> 
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'back_title_typo',
				'selector'     => ".fl-node-$id .uabb-slide-box .uabb-slide-back-text-title",
			)
		);
	}
}
?>
/* Font Back Slide Description (Desktop) */
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box .uabb-slide-down-box-section-content {
	<?php echo ( '' !== $settings->back_desc_margin_top ) ? 'margin-top: ' . esc_attr( $settings->back_desc_margin_top ) . 'px;' : ''; ?>
	<?php echo ( '' !== $settings->back_desc_margin_bottom ) ? 'margin-bottom: ' . esc_attr( $settings->back_desc_margin_bottom ) . 'px;' : 'margin-bottom: 10px;'; ?>
	<?php echo ( '' !== $settings->back_desc_color ) ? 'color: ' . esc_attr( $settings->back_desc_color ) . ';' : ''; ?>
}
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box .uabb-slide-down-box-section-content {

		<?php if ( 'Default' !== $settings->back_desc_font_family['family'] ) : ?>
			<?php UABB_Helper::uabb_font_css( $settings->back_desc_font_family ); ?>
		<?php endif; ?>

		<?php if ( 'yes' === $converted || isset( $settings->back_desc_font_size_unit ) && '' !== $settings->back_desc_font_size_unit ) { ?>
			font-size: <?php echo esc_attr( $settings->back_desc_font_size_unit ); ?>px;      
		<?php } elseif ( isset( $settings->back_desc_font_size_unit ) && '' === $settings->back_desc_font_size_unit && isset( $settings->back_desc_font_size['desktop'] ) && '' !== $settings->back_desc_font_size['desktop'] ) { ?>
			font-size: <?php echo esc_attr( $settings->back_desc_font_size['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( isset( $settings->back_desc_font_size['desktop'] ) && '' === $settings->back_desc_font_size['desktop'] && isset( $settings->back_desc_line_height['desktop'] ) && '' !== $settings->back_desc_line_height['desktop'] && '' === $settings->back_desc_line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->back_desc_line_height['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->back_desc_line_height_unit ) && '' !== $settings->back_desc_line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->back_desc_line_height_unit ); ?>em;  
		<?php } elseif ( isset( $settings->back_desc_line_height_unit ) && '' === $settings->back_desc_line_height_unit && isset( $settings->back_desc_line_height['desktop'] ) && '' !== $settings->back_desc_line_height['desktop'] ) { ?>
			line-height: <?php echo esc_attr( $settings->back_desc_line_height['desktop'] ); ?>px;
		<?php } ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'back_desc_typo',
				'selector'     => ".fl-node-$id .uabb-slide-box .uabb-slide-down-box-section-content",
			)
		);
	}
}
?>
/* Link Color. */
<?php if ( ! empty( $settings->link_color ) ) : ?> 
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> a.uabb-callout-cta-link,
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> a.uabb-callout-cta-link *,
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> a.uabb-callout-cta-link:visited {
	color: <?php echo esc_attr( uabb_theme_text_color( $settings->link_color ) ); ?>;
}
<?php endif; ?>

/* Typography Options for Link Text. */
<?php if ( ! $version_bb_check ) { ?>
	.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-callout-cta-link {
		<?php if ( 'Default' !== $settings->link_font_family['family'] ) : ?>
			<?php UABB_Helper::uabb_font_css( $settings->link_font_family ); ?>
		<?php endif; ?>

		<?php if ( 'yes' === $converted || isset( $settings->link_font_size_unit ) && '' !== $settings->link_font_size_unit ) { ?>
			font-size: <?php echo esc_attr( $settings->link_font_size_unit ); ?>px;      
		<?php } elseif ( isset( $settings->link_font_size_unit ) && '' === $settings->link_font_size_unit && isset( $settings->link_font_size['desktop'] ) && '' !== $settings->link_font_size['desktop'] ) { ?>
			font-size: <?php echo esc_attr( $settings->link_font_size['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( isset( $settings->link_font_size['desktop'] ) && '' === $settings->link_font_size['desktop'] && isset( $settings->link_line_height['desktop'] ) && '' !== $settings->link_line_height['desktop'] && '' === $settings->link_line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->link_line_height['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->link_line_height_unit ) && '' !== $settings->link_line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->link_line_height_unit ); ?>em;  
		<?php } elseif ( isset( $settings->link_line_height_unit ) && '' === $settings->link_line_height_unit && isset( $settings->link_line_height['desktop'] ) && '' !== $settings->link_line_height['desktop'] ) { ?>
			line-height: <?php echo esc_attr( $settings->link_line_height['desktop'] ); ?>px;
		<?php } ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'link_typo',
				'selector'     => ".fl-node-$id .uabb-callout-cta-link",
			)
		);
	}
}
?>
<?php if ( $global_settings->responsive_enabled ) { // Global Setting If started. ?>
	@media ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ); ?>px ) {

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box-wrap .uabb-slide-front {
			<?php
			if ( isset( $settings->front_padding_dimension_top_medium ) ) {
				echo ( '' !== $settings->front_padding_dimension_top_medium ) ? 'padding-top:' . esc_attr( $settings->front_padding_dimension_top_medium ) . 'px;' : '';
			}
			if ( isset( $settings->front_padding_dimension_bottom_medium ) ) {
				echo ( '' !== $settings->front_padding_dimension_bottom_medium ) ? 'padding-bottom:' . esc_attr( $settings->front_padding_dimension_bottom_medium ) . 'px;' : '';
			}
			if ( isset( $settings->front_padding_dimension_left_medium ) ) {
				echo ( '' !== $settings->front_padding_dimension_left_medium ) ? 'padding-left:' . esc_attr( $settings->front_padding_dimension_left_medium ) . 'px;' : '';
			}
			if ( isset( $settings->front_padding_dimension_right_medium ) ) {
				echo ( '' !== $settings->front_padding_dimension_right_medium ) ? 'padding-right:' . esc_attr( $settings->front_padding_dimension_right_medium ) . 'px;' : '';
			}
			?>
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box-wrap .uabb-slide-down {
			<?php
			if ( isset( $settings->back_padding_dimension_top_medium ) ) {
				echo ( '' !== $settings->back_padding_dimension_top_medium ) ? 'padding-top:' . esc_attr( $settings->back_padding_dimension_top_medium ) . 'px;' : '';
			}
			if ( isset( $settings->back_padding_dimension_bottom_medium ) ) {
				echo ( '' !== $settings->back_padding_dimension_bottom_medium ) ? 'padding-bottom:' . esc_attr( $settings->back_padding_dimension_bottom_medium ) . 'px;' : '';
			}
			if ( isset( $settings->back_padding_dimension_left_medium ) ) {
				echo ( '' !== $settings->back_padding_dimension_left_medium ) ? 'padding-left:' . esc_attr( $settings->back_padding_dimension_left_medium ) . 'px;' : '';
			}
			if ( isset( $settings->back_padding_dimension_right_medium ) ) {
				echo ( '' !== $settings->back_padding_dimension_right_medium ) ? 'padding-right:' . esc_attr( $settings->back_padding_dimension_right_medium ) . 'px;' : '';
			}
			?>
		}
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box .uabb-slide-box-section-content {

				<?php if ( 'yes' === $converted || isset( $settings->front_desc_font_size_unit_medium ) && '' !== $settings->front_desc_font_size_unit_medium ) { ?>
					font-size: <?php echo esc_attr( $settings->front_desc_font_size_unit_medium ); ?>px;
				<?php } elseif ( isset( $settings->front_desc_font_size_unit_medium ) && '' === $settings->front_desc_font_size_unit_medium && isset( $settings->front_desc_font_size['medium'] ) && '' !== $settings->front_desc_font_size['medium'] ) { ?>
					font-size: <?php echo esc_attr( $settings->front_desc_font_size['medium'] ); ?>px;
				<?php } ?>

				<?php if ( isset( $settings->front_desc_font_size['medium'] ) && '' === $settings->front_desc_font_size['medium'] && isset( $settings->front_desc_line_height['medium'] ) && '' !== $settings->front_desc_line_height['medium'] && '' === $settings->front_desc_line_height_unit && '' === $settings->front_desc_line_height_unit_medium ) { ?>
					line-height: <?php echo esc_attr( $settings->front_desc_line_height['medium'] ); ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->front_desc_line_height_unit_medium ) && '' !== $settings->front_desc_line_height_unit_medium ) { ?>
					line-height: <?php echo esc_attr( $settings->front_desc_line_height_unit_medium ); ?>em;   
				<?php } elseif ( isset( $settings->front_desc_line_height_unit_medium ) && '' === $settings->front_desc_line_height_unit_medium && isset( $settings->front_desc_line_height['medium'] ) && '' !== $settings->front_desc_line_height['medium'] ) { ?>
					line-height: <?php echo esc_attr( $settings->front_desc_line_height['medium'] ); ?>px;
				<?php } ?>
			}
		<?php } ?>
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box .uabb-slide-face-text-title {

				<?php if ( 'yes' === $converted || isset( $settings->front_title_font_size_unit_medium ) && '' !== $settings->front_title_font_size_unit_medium ) { ?>
					font-size: <?php echo esc_attr( $settings->front_title_font_size_unit_medium ); ?>px;
				<?php } elseif ( isset( $settings->front_title_font_size_unit_medium ) && '' === $settings->front_title_font_size_unit_medium && isset( $settings->front_title_font_size['medium'] ) && '' !== $settings->front_title_font_size['medium'] ) { ?>
					font-size: <?php echo esc_attr( $settings->front_title_font_size['medium'] ); ?>px;
				<?php } ?>

				<?php if ( isset( $settings->front_title_font_size['medium'] ) && '' === $settings->front_title_font_size['medium'] && isset( $settings->front_title_line_height['medium'] ) && '' !== $settings->front_title_line_height['medium'] && '' === $settings->front_title_line_height_unit && '' === $settings->front_title_line_height_unit_medium ) { ?>
					line-height: <?php echo esc_attr( $settings->front_title_line_height['medium'] ); ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->front_title_line_height_unit_medium ) && '' !== $settings->front_title_line_height_unit_medium ) { ?>
					line-height: <?php echo esc_attr( $settings->front_title_line_height_unit_medium ); ?>em;   
				<?php } elseif ( isset( $settings->front_title_line_height_unit_medium ) && '' === $settings->front_title_line_height_unit_medium && isset( $settings->front_title_line_height['medium'] ) && '' !== $settings->front_title_line_height['medium'] ) { ?>
					line-height: <?php echo esc_attr( $settings->front_title_line_height['medium'] ); ?>px;
				<?php } ?>
			}
		<?php } ?>
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box .uabb-slide-down-box-section-content {

				<?php if ( 'yes' === $converted || isset( $settings->back_desc_font_size_unit_medium ) && '' !== $settings->back_desc_font_size_unit_medium ) { ?>
					font-size: <?php echo esc_attr( $settings->back_desc_font_size_unit_medium ); ?>px;
				<?php } elseif ( isset( $settings->back_desc_font_size_unit_medium ) && '' === $settings->back_desc_font_size_unit_medium && isset( $settings->back_desc_font_size['medium'] ) && '' !== $settings->back_desc_font_size['medium'] ) { ?>
					font-size: <?php echo esc_attr( $settings->back_desc_font_size['medium'] ); ?>px;
				<?php } ?>

				<?php if ( isset( $settings->back_desc_font_size['medium'] ) && '' === $settings->back_desc_font_size['medium'] && isset( $settings->back_desc_line_height['medium'] ) && '' !== $settings->back_desc_line_height['medium'] && '' === $settings->back_desc_line_height_unit && '' === $settings->back_desc_line_height_unit_medium ) { ?>
					line-height: <?php echo esc_attr( $settings->back_desc_line_height['medium'] ); ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->back_desc_line_height_unit_medium ) && '' !== $settings->back_desc_line_height_unit_medium ) { ?>
					line-height: <?php echo esc_attr( $settings->back_desc_line_height_unit_medium ); ?>em;   
				<?php } elseif ( isset( $settings->back_desc_line_height_unit_medium ) && '' === $settings->back_desc_line_height_unit_medium && isset( $settings->back_desc_line_height['medium'] ) && '' !== $settings->back_desc_line_height['medium'] ) { ?>
					line-height: <?php echo esc_attr( $settings->back_desc_line_height['medium'] ); ?>px;
				<?php } ?>
			}
		<?php } ?>
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box .uabb-slide-back-text-title {

				<?php if ( 'yes' === $converted || isset( $settings->back_title_font_size_unit_medium ) && '' !== $settings->back_title_font_size_unit_medium ) { ?>
					font-size: <?php echo esc_attr( $settings->back_title_font_size_unit_medium ); ?>px;
				<?php } elseif ( isset( $settings->back_title_font_size_unit_medium ) && '' === $settings->back_title_font_size_unit_medium && isset( $settings->back_title_font_size['medium'] ) && '' !== $settings->back_title_font_size['medium'] ) { ?>
					font-size: <?php echo esc_attr( $settings->back_title_font_size['medium'] ); ?>px;
				<?php } ?>

				<?php if ( isset( $settings->back_title_font_size['medium'] ) && '' === $settings->back_title_font_size['medium'] && isset( $settings->back_title_line_height['medium'] ) && '' !== $settings->back_title_line_height['medium'] && '' === $settings->back_title_line_height_unit && '' === $settings->back_title_line_height_unit_medium ) { ?>
					line-height: <?php echo esc_attr( $settings->back_title_line_height['medium'] ); ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->back_title_line_height_unit_medium ) && '' !== $settings->back_title_line_height_unit_medium ) { ?>
					line-height: <?php echo esc_attr( $settings->back_title_line_height_unit_medium ); ?>em;   
				<?php } elseif ( isset( $settings->back_title_line_height_unit_medium ) && '' === $settings->back_title_line_height_unit_medium && isset( $settings->back_title_line_height['medium'] ) && '' !== $settings->back_title_line_height['medium'] ) { ?>
					line-height: <?php echo esc_attr( $settings->back_title_line_height['medium'] ); ?>px;
				<?php } ?>
			}

			.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-callout-cta-link {

				<?php if ( 'yes' === $converted || isset( $settings->link_font_size_unit_medium ) && '' !== $settings->link_font_size_unit_medium ) { ?>
					font-size: <?php echo esc_attr( $settings->link_font_size_unit_medium ); ?>px;
				<?php } elseif ( isset( $settings->link_font_size_unit_medium ) && '' === $settings->link_font_size_unit_medium && isset( $settings->link_font_size['medium'] ) && '' !== $settings->link_font_size['medium'] ) { ?>
					font-size: <?php echo esc_attr( $settings->link_font_size['medium'] ); ?>px;
				<?php } ?>

				<?php if ( isset( $settings->link_font_size['medium'] ) && '' === $settings->link_font_size['medium'] && isset( $settings->link_line_height['medium'] ) && '' !== $settings->link_line_height['medium'] && '' === $settings->link_line_height_unit && '' === $settings->link_line_height_unit_medium ) { ?>
					line-height: <?php echo esc_attr( $settings->link_line_height['medium'] ); ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->link_line_height_unit_medium ) && '' !== $settings->link_line_height_unit_medium ) { ?>
					line-height: <?php echo esc_attr( $settings->link_line_height_unit_medium ); ?>em;   
				<?php } elseif ( isset( $settings->link_line_height_unit_medium ) && '' === $settings->link_line_height_unit_medium && isset( $settings->link_line_height['medium'] ) && '' !== $settings->link_line_height['medium'] ) { ?>
					line-height: <?php echo esc_attr( $settings->link_line_height['medium'] ); ?>px;
				<?php } ?>
			}
	<?php } ?>
	}
	@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ); ?>px ) {
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box-wrap .uabb-slide-front {
			<?php
			if ( isset( $settings->front_padding_dimension_top_responsive ) ) {
				echo ( '' !== $settings->front_padding_dimension_top_responsive ) ? 'padding-top:' . esc_attr( $settings->front_padding_dimension_top_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->front_padding_dimension_bottom_responsive ) ) {
				echo ( '' !== $settings->front_padding_dimension_bottom_responsive ) ? 'padding-bottom:' . esc_attr( $settings->front_padding_dimension_bottom_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->front_padding_dimension_left_responsive ) ) {
				echo ( '' !== $settings->front_padding_dimension_left_responsive ) ? 'padding-left:' . esc_attr( $settings->front_padding_dimension_left_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->front_padding_dimension_right_responsive ) ) {
				echo ( '' !== $settings->front_padding_dimension_right_responsive ) ? 'padding-right:' . esc_attr( $settings->front_padding_dimension_right_responsive ) . 'px;' : '';
			}
			?>
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box-wrap .uabb-slide-down {
			<?php
			if ( isset( $settings->back_padding_dimension_top_responsive ) ) {
				echo ( '' !== $settings->back_padding_dimension_top_responsive ) ? 'padding-top:' . esc_attr( $settings->back_padding_dimension_top_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->back_padding_dimension_bottom_responsive ) ) {
				echo ( '' !== $settings->back_padding_dimension_bottom_responsive ) ? 'padding-bottom:' . esc_attr( $settings->back_padding_dimension_bottom_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->back_padding_dimension_left_responsive ) ) {
				echo ( '' !== $settings->back_padding_dimension_left_responsive ) ? 'padding-left:' . esc_attr( $settings->back_padding_dimension_left_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->back_padding_dimension_right_responsive ) ) {
				echo ( '' !== $settings->back_padding_dimension_right_responsive ) ? 'padding-right:' . esc_attr( $settings->back_padding_dimension_right_responsive ) . 'px;' : '';
			}
			?>
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box-wrap .uabb-slide-front {
			<?php
			if ( isset( $settings->front_padding_dimension_top_responsive ) ) {
				echo ( '' !== $settings->front_padding_dimension_top_responsive ) ? 'padding-top:' . esc_attr( $settings->front_padding_dimension_top_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->front_padding_dimension_bottom_responsive ) ) {
				echo ( '' !== $settings->front_padding_dimension_bottom_responsive ) ? 'padding-bottom:' . esc_attr( $settings->front_padding_dimension_bottom_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->front_padding_dimension_left_responsive ) ) {
				echo ( '' !== $settings->front_padding_dimension_left_responsive ) ? 'padding-left:' . esc_attr( $settings->front_padding_dimension_left_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->front_padding_dimension_right_responsive ) ) {
				echo ( '' !== $settings->front_padding_dimension_right_responsive ) ? 'padding-right:' . esc_attr( $settings->front_padding_dimension_right_responsive ) . 'px;' : '';
			}
			?>
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box-wrap .uabb-slide-down {
			<?php
			if ( isset( $settings->back_padding_dimension_top_responsive ) ) {
				echo ( '' !== $settings->back_padding_dimension_top_responsive ) ? 'padding-top:' . esc_attr( $settings->back_padding_dimension_top_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->back_padding_dimension_bottom_responsive ) ) {
				echo ( '' !== $settings->back_padding_dimension_bottom_responsive ) ? 'padding-bottom:' . esc_attr( $settings->back_padding_dimension_bottom_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->back_padding_dimension_left_responsive ) ) {
				echo ( '' !== $settings->back_padding_dimension_left_responsive ) ? 'padding-left:' . esc_attr( $settings->back_padding_dimension_left_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->back_padding_dimension_right_responsive ) ) {
				echo ( '' !== $settings->back_padding_dimension_right_responsive ) ? 'padding-right:' . esc_attr( $settings->back_padding_dimension_right_responsive ) . 'px;' : '';
			}
			?>
		}
		<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box .uabb-slide-box-section-content {
			<?php if ( 'yes' === $converted || isset( $settings->front_desc_font_size_unit_responsive ) && '' !== $settings->front_desc_font_size_unit_responsive ) { ?>
				font-size: <?php echo esc_attr( $settings->front_desc_font_size_unit_responsive ); ?>px;
				<?php
				if ( '' === $settings->front_desc_line_height_unit_responsive && '' !== $settings->front_desc_font_size_unit_responsive ) {
					$line_height = floatval( $settings->front_desc_font_size_unit_responsive ) + 2; // ensure it's a numeric value before performing the addition.
					echo "line-height: {$line_height}px;";
				}
				?>
								<?php
			} elseif ( isset( $settings->front_desc_font_size_unit_responsive ) && '' === $settings->front_desc_font_size_unit_responsive && isset( $settings->line_height['small'] ) && '' !== $settings->line_height['small'] ) {
				?>
				<?php
				$small_font_size   = esc_attr( $settings->front_desc_font_size['small'] );
				$small_line_height = floatval( $small_font_size ) + 2; // ensure it's a numeric value before performing the addition.
				echo "font-size: {$small_font_size}px; line-height: {$small_line_height}px;";
				?>

			<?php } ?>

			<?php if ( isset( $settings->front_desc_font_size['small'] ) && '' === $settings->front_desc_font_size['small'] && isset( $settings->front_desc_line_height['small'] ) && '' !== $settings->front_desc_line_height['small'] && '' === $settings->front_desc_line_height_unit && '' === $settings->front_desc_line_height_unit_medium && '' === $settings->front_desc_line_height_unit_responsive ) { ?>
				line-height: <?php echo esc_attr( $settings->front_desc_line_height['small'] ); ?>px;
			<?php } ?>

			<?php if ( 'yes' === $converted || isset( $settings->front_desc_line_height_unit_responsive ) && '' !== $settings->front_desc_line_height_unit_responsive ) { ?>
				line-height: <?php echo esc_attr( $settings->front_desc_line_height_unit_responsive ); ?>em;
			<?php } elseif ( isset( $settings->front_desc_line_height_unit_responsive ) && '' === $settings->front_desc_line_height_unit_responsive && isset( $settings->front_desc_line_height['small'] ) && '' !== $settings->front_desc_line_height['small'] ) { ?>
				line-height: <?php echo esc_attr( $settings->front_desc_line_height['small'] ); ?>px;
			<?php } ?>
			}

			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box .uabb-slide-face-text-title {

				<?php if ( 'yes' === $converted || isset( $settings->front_title_font_size_unit_responsive ) && '' !== $settings->front_title_font_size_unit_responsive ) { ?>
					font-size: <?php echo esc_attr( $settings->front_title_font_size_unit_responsive ); ?>px;
					<?php
					if ( '' === $settings->front_title_line_height_unit_responsive && '' !== $settings->front_title_font_size_unit_responsive ) {
						$line_height = floatval( $settings->front_title_font_size_unit_responsive ) + 2; // ensure it's a numeric value before performing the addition.
						echo "line-height: {$line_height}px;";
					}
					?>
										<?php
				} elseif ( isset( $settings->front_title_font_size_unit_responsive ) && '' === $settings->front_title_font_size_unit_responsive && isset( $settings->front_title_font_size['small'] ) && '' !== $settings->front_title_font_size['small'] ) {
					?>
					<?php
					$small_font_size   = esc_attr( $settings->front_title_font_size['small'] );
					$small_line_height = floatval( $small_font_size ) + 2; // ensure it's a numeric value before performing the addition.
					echo "font-size: {$small_font_size}px; line-height: {$small_line_height}px;";
					?>

				<?php } ?>

				<?php if ( isset( $settings->front_title_font_size['small'] ) && '' === $settings->front_title_font_size['small'] && isset( $settings->front_title_line_height['small'] ) && '' !== $settings->front_title_line_height['small'] && '' === $settings->front_title_line_height_unit && '' === $settings->front_title_line_height_unit_medium && '' === $settings->front_title_line_height_unit_responsive ) { ?>
					line-height: <?php echo esc_attr( $settings->front_title_line_height['small'] ); ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->front_title_line_height_unit_responsive ) && '' !== $settings->front_title_line_height_unit_responsive ) { ?>
					line-height: <?php echo esc_attr( $settings->front_title_line_height_unit_responsive ); ?>em;
				<?php } elseif ( isset( $settings->front_title_line_height_unit_responsive ) && '' === $settings->front_title_line_height_unit_responsive && isset( $settings->front_title_line_height['small'] ) && '' !== $settings->front_title_line_height['small'] ) { ?>
					line-height: <?php echo esc_attr( $settings->front_title_line_height['small'] ); ?>px;
				<?php } ?>
			}

			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box .uabb-slide-down-box-section-content {

				<?php if ( 'yes' === $converted || isset( $settings->back_desc_font_size_unit_responsive ) && '' !== $settings->back_desc_font_size_unit_responsive ) { ?>
					font-size: <?php echo esc_attr( $settings->back_desc_font_size_unit_responsive ); ?>px;
					<?php
					if ( '' === $settings->back_desc_line_height_unit_responsive && '' !== $settings->back_desc_font_size_unit_responsive ) {

						$line_height = floatval( $settings->back_desc_font_size_unit_responsive ) + 2; // ensure it's a numeric value before performing the addition.
						echo "line-height: {$line_height}px;";
					}
					?>
										<?php
				} elseif ( isset( $settings->back_desc_font_size_unit_responsive ) && '' === $settings->back_desc_font_size_unit_responsive && isset( $settings->back_desc_font_size['small'] ) && '' !== $settings->back_desc_font_size['small'] ) {
					?>
					<?php
					$small_font_size   = esc_attr( $settings->back_desc_font_size['small'] );
					$small_line_height = floatval( $small_font_size ) + 2; // ensure it's a numeric value before performing the addition.
					echo "font-size: {$small_font_size}px; line-height: {$small_line_height}px;";
					?>

				<?php } ?>

				<?php if ( isset( $settings->back_desc_font_size['small'] ) && '' === $settings->back_desc_font_size['small'] && isset( $settings->back_desc_line_height['small'] ) && '' !== $settings->back_desc_line_height['small'] && '' === $settings->back_desc_line_height_unit && '' === $settings->back_desc_line_height_unit_medium && '' === $settings->back_desc_line_height_unit_responsive ) { ?>
					line-height: <?php echo esc_attr( $settings->back_desc_line_height['small'] ); ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->back_desc_line_height_unit_responsive ) && '' !== $settings->back_desc_line_height_unit_responsive ) { ?>
					line-height: <?php echo esc_attr( $settings->back_desc_line_height_unit_responsive ); ?>em;
				<?php } elseif ( isset( $settings->back_desc_line_height_unit_responsive ) && '' === $settings->back_desc_line_height_unit_responsive && isset( $settings->back_desc_line_height['small'] ) && '' !== $settings->back_desc_line_height['small'] ) { ?>
					line-height: <?php echo esc_attr( $settings->back_desc_line_height['small'] ); ?>px;
				<?php } ?>
			}

			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box .uabb-slide-back-text-title {

				<?php if ( 'yes' === $converted || isset( $settings->back_title_font_size_unit_responsive ) && '' !== $settings->back_title_font_size_unit_responsive ) { ?>
					font-size: <?php echo esc_attr( $settings->back_title_font_size_unit_responsive ); ?>px;
					<?php
					if ( '' === $settings->back_title_line_height_unit_responsive && '' !== $settings->back_title_font_size_unit_responsive ) {
						$line_height = floatval( $settings->back_title_font_size_unit_responsive ) + 2; // ensure it's a numeric value before performing the addition.
						echo "line-height: {$line_height}px;";
					}
					?>
									<?php } elseif ( isset( $settings->back_title_font_size_unit_responsive ) && '' === $settings->back_title_font_size_unit_responsive && isset( $settings->back_title_font_size['small'] ) && '' !== $settings->back_title_font_size['small'] ) { ?>
					<?php
					$small_font_size   = esc_attr( $settings->back_title_font_size['small'] );
					$small_line_height = floatval( $small_font_size ) + 2; // ensure it's a numeric value before performing the addition.
					echo "font-size: {$small_font_size}px; line-height: {$small_line_height}px;";
					?>

				<?php } ?>

				<?php if ( isset( $settings->back_title_font_size['small'] ) && '' === $settings->back_title_font_size['small'] && isset( $settings->back_title_line_height['small'] ) && '' !== $settings->back_title_line_height['small'] && '' === $settings->back_title_line_height_unit && '' === $settings->back_title_line_height_unit_medium && '' === $settings->back_title_line_height_unit_responsive ) { ?>
					line-height: <?php echo esc_attr( $settings->back_title_line_height['small'] ); ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->back_title_line_height_unit_responsive ) && '' !== $settings->back_title_line_height_unit_responsive ) { ?>
					line-height: <?php echo esc_attr( $settings->back_title_line_height_unit_responsive ); ?>em;
				<?php } elseif ( isset( $settings->back_title_line_height_unit_responsive ) && '' === $settings->back_title_line_height_unit_responsive && isset( $settings->back_title_line_height['small'] ) && '' !== $settings->back_title_line_height['small'] ) { ?>
					line-height: <?php echo esc_attr( $settings->back_title_line_height['small'] ); ?>px;
				<?php } ?>
			}

			.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-callout-cta-link {
				<?php if ( 'yes' === $converted || isset( $settings->link_font_size_unit_responsive ) && '' !== $settings->link_font_size_unit_responsive ) { ?>
					font-size: <?php echo esc_attr( $settings->link_font_size_unit_responsive ); ?>px;
					<?php
					if ( '' === $settings->link_line_height_unit_responsive && '' !== $settings->link_font_size_unit_responsive ) {

						$line_height = floatval( $settings->link_font_size_unit_responsive ) + 2; // ensure it's a numeric value before performing the addition.
						echo "line-height: {$line_height}px;";

					}
					?>
									<?php } elseif ( isset( $settings->link_font_size_unit_responsive ) && '' === $settings->link_font_size_unit_responsive && isset( $settings->link_font_size['small'] ) && '' !== $settings->link_font_size['small'] ) { ?> 
					<?php
					$small_font_size   = esc_attr( $settings->link_font_size['small'] );
					$small_line_height = floatval( $small_font_size ) + 2; // ensure it's a numeric value before performing the addition.
					echo "font-size: {$small_font_size}px; line-height: {$small_line_height}px;";
					?>

				<?php } ?> 

				<?php if ( isset( $settings->link_font_size['small'] ) && '' === $settings->link_font_size['small'] && isset( $settings->link_line_height['small'] ) && '' !== $settings->link_line_height['small'] && '' === $settings->link_line_height_unit && '' === $settings->link_line_height_unit_medium ) { ?>
					line-height: <?php echo esc_attr( $settings->link_line_height['small'] ); ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->link_line_height_unit_responsive ) && '' !== $settings->link_line_height_unit_responsive ) { ?>
					line-height: <?php echo esc_attr( $settings->link_line_height_unit_responsive ); ?>em;
				<?php } elseif ( isset( $settings->link_line_height_unit_responsive ) && '' === $settings->link_line_height_unit_responsive && isset( $settings->link_line_height['small'] ) && '' !== $settings->link_line_height['small'] ) { ?> 
					line-height: <?php echo esc_attr( $settings->link_line_height['small'] ); ?>px;
				<?php } ?>
			}
	<?php } ?>
		<?php if ( 'none' !== $settings->image_type && 'stack' === $settings->mobile_view && ( 'left' === $settings->front_img_icon_position || 'right' === $settings->front_img_icon_position ) ) : ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-icon-border {
				display: none;
			}

			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-front .uabb-slide-front-right-text,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-front .uabb-slide-front-left-img,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-front .uabb-slide-front-right-img {
				padding: 0;
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-front .uabb-slide-front-right-img {
				font-size: 0;
				line-height: 0;
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-front-left-img,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-front-right-img,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-front-right-text {
				display: block;
				width: 100%;
				text-align: center;
			}
			<?php if ( 'left' === $settings->front_img_icon_position ) : ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-front .uabb-slide-front-right-text {
				padding-top: 15px;
			}
			<?php else : ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-front .uabb-slide-front-right-text {
				padding-bottom: 15px;
			}
			<?php endif; ?>

			<?php if ( 'left' === $settings->front_img_icon_position || 'reversed' === $settings->stacking_order ) : ?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-style2 .uabb-slide-front-right-text {
					<?php echo ( '' !== $settings->dropdown_icon_size ) ? 'padding-bottom: ' . esc_attr( $settings->dropdown_icon_size * 0.75 ) . 'px;' : ''; ?>
				}
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-style3 .uabb-slide-front-right-text {
					<?php echo ( '' !== $settings->dropdown_icon_size ) ? 'padding-bottom: ' . esc_attr( $settings->dropdown_icon_size + 10 ) . 'px;' : ''; ?>
				}

				<?php if ( 'right' === $settings->front_img_icon_position ) : ?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-front .uabb-slide-front-right-text {
					padding-top: 15px;
				}
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slide-box-section {
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
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-style2 .uabb-slide-front-right-img {
					<?php echo ( '' !== $settings->dropdown_icon_size ) ? 'padding-bottom: ' . esc_attr( $settings->dropdown_icon_size * 0.75 ) . 'px;' : ''; ?>
				}
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-style3 .uabb-slide-front-right-img {
					<?php echo ( '' !== $settings->dropdown_icon_size ) ? 'padding-bottom: ' . esc_attr( $settings->dropdown_icon_size + 10 ) . 'px;' : ''; ?>
				}
			<?php endif; ?>

		<?php endif; ?>
	}
	<?php
}
?>
