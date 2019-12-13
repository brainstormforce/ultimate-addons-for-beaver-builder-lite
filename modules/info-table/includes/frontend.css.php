<?php
/**
 * Register the module's CSS file for Info Table module
 *
 * @package UABB Info Table Module
 */

global $post;
$version_bb_check = UABB_Lite_Compatibility::check_bb_version();
$converted        = UABB_Lite_Compatibility::check_old_page_migration();

$settings->btn_text_color       = UABB_Helper::uabb_colorpicker( $settings, 'btn_text_color' );
$settings->btn_text_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'btn_text_hover_color' );
$settings->heading_color        = UABB_Helper::uabb_colorpicker( $settings, 'heading_color' );
$settings->sub_heading_color    = UABB_Helper::uabb_colorpicker( $settings, 'sub_heading_color' );
$settings->description_color    = UABB_Helper::uabb_colorpicker( $settings, 'description_color' );
$settings->btn_bg_color         = UABB_Helper::uabb_colorpicker( $settings, 'btn_bg_color', true );
$settings->btn_bg_hover_color   = UABB_Helper::uabb_colorpicker( $settings, 'btn_bg_hover_color', true );
$settings->heading_back_color   = UABB_Helper::uabb_colorpicker( $settings, 'heading_back_color', true );
$settings->desc_back_color      = UABB_Helper::uabb_colorpicker( $settings, 'desc_back_color', true );

$settings->icon_size             = ( '' !== trim( $settings->icon_size ) ) ? $settings->icon_size : '75';
$settings->icon_bg_size          = ( '' !== trim( $settings->icon_bg_size ) ) ? $settings->icon_bg_size : '30';
$settings->img_size              = ( '' !== trim( $settings->img_size ) ) ? $settings->img_size : '150';
$settings->icon_bg_border_radius = ( '' !== trim( $settings->icon_bg_border_radius ) ) ? $settings->icon_bg_border_radius : '0';
$settings->icon_border_width     = ( '' !== trim( $settings->icon_border_width ) ) ? $settings->icon_border_width : '1';
$settings->img_border_width      = ( '' !== trim( $settings->img_border_width ) ) ? $settings->img_border_width : '1';

/* Render image icon css */
$imageicon_array = array(

	/* General Section */
	'image_type'              => $settings->image_type,

	/* Icon Basics */
	'icon'                    => $settings->icon,
	'icon_size'               => $settings->icon_size,
	'icon_align'              => 'center', // $settings->icon_align.

	/* Image Basics */
	'photo_source'            => $settings->photo_source,
	'photo'                   => $settings->photo,
	'photo_url'               => $settings->photo_url,
	'img_size'                => $settings->img_size,
	'img_align'               => 'center', // $settings->img_align.
	'photo_src'               => ( isset( $settings->photo_src ) ) ? $settings->photo_src : '',

	/* Icon Style */
	'icon_style'              => $settings->icon_style,
	'icon_bg_size'            => $settings->icon_bg_size,
	'icon_border_style'       => $settings->icon_border_style,
	'icon_border_width'       => $settings->icon_border_width,
	'icon_bg_border_radius'   => $settings->icon_bg_border_radius,

	/* Image Style */
	'image_style'             => $settings->image_style,
	'img_bg_size'             => $settings->img_bg_size,
	'img_border_style'        => $settings->img_border_style,
	'img_border_width'        => $settings->img_border_width,
	'img_bg_border_radius'    => $settings->img_bg_border_radius,

	/* Preset Color variable new */
	'icon_color_preset'       => $settings->icon_color_preset,

	/* Icon Colors */
	'icon_color'              => $settings->icon_color,
	'icon_hover_color'        => $settings->icon_hover_color,
	'icon_bg_color'           => $settings->icon_bg_color,
	'icon_bg_color_opc'       => $settings->icon_bg_color_opc,
	'icon_bg_hover_color'     => $settings->icon_bg_hover_color,
	'icon_bg_hover_color_opc' => $settings->icon_bg_hover_color_opc,
	'icon_border_color'       => $settings->icon_border_color,
	'icon_border_hover_color' => $settings->icon_border_hover_color,
	'icon_three_d'            => $settings->icon_three_d,

	/* Image Colors */
	'img_bg_color'            => $settings->img_bg_color,
	'img_bg_color_opc'        => $settings->img_bg_color_opc,
	'img_bg_hover_color'      => $settings->img_bg_hover_color,
	'img_bg_hover_color_opc'  => $settings->img_bg_hover_color_opc,
	'img_border_color'        => $settings->img_border_color,
	'img_border_hover_color'  => $settings->img_border_hover_color,
);
/* CSS Render Function */
FLBuilder::render_module_css( 'image-icon', $id, $imageicon_array );
?>



/* Box Styling */
<?php
	$icon_bg_color      = '';
	$bg_color_code      = '';
	$bg_head_color_code = '';
	$border_color       = '';
	$border_color_top   = '';
?>

.fl-node-<?php echo $id; ?> .info-table {
	min-height: <?php echo $settings->min_height; ?>px;
}


<?php if ( 'custom' != $settings->color_scheme ) { ?>
	<?php
	if ( 'black' == $settings->color_scheme ) {
		if ( 'design01' == $settings->box_design || 'design03' == $settings->box_design ) {
			$bg_color_code = '#333333';
			$icon_bg_color = '#333333';
		} elseif ( 'design02' == $settings->box_design ) {
			$icon_bg_color      = '#fbfbfb';
			$border_color       = '#dcdcdc';
			$bg_color_code      = '#f0f0f0';
			$bg_head_color_code = '#333333';
		} elseif ( 'design04' == $settings->box_design ) {
			$bg_color_code    = '#f9f9f9';
			$border_color     = '#dddddd';
			$border_color_top = '#333333';
		} elseif ( 'design05' == $settings->box_design ) {
			$bg_head_color_code = '#333333';
			$bg_color_code      = '#f7f7f7';
			$border_color       = '#dddddd';
		} elseif ( 'design06' == $settings->box_design ) {
			$bg_head_color_code = '#333333';
			$bg_color_code      = '#ffffff';
			$border_color       = '#efefef';
		}
		$bg_grad_start = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $bg_color_code ), 30, 'lighten' );
	} elseif ( 'red' == $settings->color_scheme ) {
		if ( 'design01' == $settings->box_design || 'design03' == $settings->box_design ) {
			$bg_color_code = '#df4130';
			$icon_bg_color = '#333333';
		} elseif ( 'design02' == $settings->box_design ) {
			$icon_bg_color      = '#fbfbfb';
			$border_color       = '#dcdcdc';
			$bg_color_code      = '#f0f0f0';
			$bg_head_color_code = '#df4130';
		} elseif ( 'design04' == $settings->box_design ) {
			$bg_color_code    = '#f9f9f9';
			$border_color     = '#dddddd';
			$border_color_top = '#df4130';
		} elseif ( 'design05' == $settings->box_design ) {
			$bg_head_color_code = '#df4130';
			$bg_color_code      = '#f7f7f7';
			$border_color       = '#dddddd';
		} elseif ( 'design06' == $settings->box_design ) {
			$bg_head_color_code = '#df4130';
			$bg_color_code      = '#ffffff';
			$border_color       = '#efefef';
		}
		$bg_grad_start = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $bg_color_code ), 30, 'lighten' );
	} elseif ( 'blue' == $settings->color_scheme ) {
		if ( 'design01' == $settings->box_design || 'design03' == $settings->box_design ) {
			$bg_color_code = '#2867b6';
			$icon_bg_color = '#333333';
		} elseif ( 'design02' == $settings->box_design ) {
			$icon_bg_color      = '#fbfbfb';
			$border_color       = '#dcdcdc';
			$bg_color_code      = '#f0f0f0';
			$bg_head_color_code = '#2867b6';
		} elseif ( 'design04' == $settings->box_design ) {
			$bg_color_code    = '#f9f9f9';
			$border_color     = '#dddddd';
			$border_color_top = '#2867b6';
		} elseif ( 'design05' == $settings->box_design ) {
			$bg_head_color_code = '#2867b6';
			$bg_color_code      = '#f7f7f7';
			$border_color       = '#dddddd';
		} elseif ( 'design06' == $settings->box_design ) {
			$bg_head_color_code = '#2867b6';
			$bg_color_code      = '#ffffff';
			$border_color       = '#efefef';
		}
		$bg_grad_start = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $bg_color_code ), 30, 'lighten' );
	} elseif ( 'yellow' == $settings->color_scheme ) {
		if ( 'design01' == $settings->box_design || 'design03' == $settings->box_design ) {
			$bg_color_code = '#f1a90f';
			$icon_bg_color = '#333333';
		} elseif ( 'design02' == $settings->box_design ) {
			$icon_bg_color      = '#fbfbfb';
			$border_color       = '#dcdcdc';
			$bg_color_code      = '#f0f0f0';
			$bg_head_color_code = '#f1a90f';
		} elseif ( 'design04' == $settings->box_design ) {
			$bg_color_code    = '#f9f9f9';
			$border_color     = '#dddddd';
			$border_color_top = '#f1a90f';
		} elseif ( 'design05' == $settings->box_design ) {
			$bg_head_color_code = '#f1a90f';
			$bg_color_code      = '#f7f7f7';
			$border_color       = '#dddddd';
		} elseif ( 'design06' == $settings->box_design ) {
			$bg_head_color_code = '#f1a90f';
			$bg_color_code      = '#ffffff';
			$border_color       = '#efefef';
		}
		$bg_grad_start = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $bg_color_code ), 30, 'lighten' );
	} elseif ( 'green' == $settings->color_scheme ) {
		if ( 'design01' == $settings->box_design || 'design03' == $settings->box_design ) {
			$bg_color_code = '#17924b';
			$icon_bg_color = '#333333';
		} elseif ( 'design02' == $settings->box_design ) {
			$icon_bg_color      = '#fbfbfb';
			$border_color       = '#dcdcdc';
			$bg_color_code      = '#f0f0f0';
			$bg_head_color_code = '#17924b';
		} elseif ( 'design04' == $settings->box_design ) {
			$bg_color_code    = '#f9f9f9';
			$border_color     = '#dddddd';
			$border_color_top = '#17924b';
		} elseif ( 'design05' == $settings->box_design ) {
			$bg_head_color_code = '#17924b';
			$bg_color_code      = '#f7f7f7';
			$border_color       = '#dddddd';
		} elseif ( 'design06' == $settings->box_design ) {
			$bg_head_color_code = '#17924b';
			$bg_color_code      = '#ffffff';
			$border_color       = '#efefef';
		}
		$bg_grad_start = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $bg_color_code ), 30, 'lighten' );
	} elseif ( 'gray' == $settings->color_scheme ) {
		if ( 'design01' == $settings->box_design || 'design03' == $settings->box_design ) {
			$bg_color_code = '#d9dee0';
			$icon_bg_color = '#333333';
		} elseif ( 'design02' == $settings->box_design ) {
			$icon_bg_color      = '#fbfbfb';
			$border_color       = '#dcdcdc';
			$bg_color_code      = '#f0f0f0';
			$bg_head_color_code = '#d9dee0';
		} elseif ( 'design04' == $settings->box_design ) {
			$bg_color_code    = '#f9f9f9';
			$border_color     = '#dddddd';
			$border_color_top = '#d9dee0';
		} elseif ( 'design05' == $settings->box_design ) {
			$bg_head_color_code = '#d9dee0';
			$bg_color_code      = '#f7f7f7';
			$border_color       = '#dddddd';
		} elseif ( 'design06' == $settings->box_design ) {
			$bg_head_color_code = '#d9dee0';
			$bg_color_code      = '#ffffff';
			$border_color       = '#efefef';
		}
		$bg_grad_start = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $bg_color_code ), 30, 'lighten' );
	}
	?>
	.fl-node-<?php echo $id; ?> .info-table-<?php echo $settings->box_design; ?>.info-table-cs-<?php echo $settings->color_scheme; ?> {
		background: -moz-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%, <?php echo $bg_color_code; ?> 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $bg_grad_start; ?>), color-stop(100%,<?php echo $bg_color_code; ?>)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%,<?php echo $bg_color_code; ?> 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%,<?php echo $bg_color_code; ?> 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%,<?php echo $bg_color_code; ?> 100%); /* IE10+ */
		background: linear-gradient(to bottom,  <?php echo $bg_grad_start; ?> 0%,<?php echo $bg_color_code; ?> 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $bg_grad_start; ?>', endColorstr='<?php echo $bg_color_code; ?>',GradientType=0 ); /* IE6-9 */
	}

	/* Design Two */
	.fl-node-<?php echo $id; ?> .info-table-design02.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-heading {
		background: <?php echo $bg_head_color_code; ?>;
	}
	.fl-node-<?php echo $id; ?> .info-table-design02.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-icon {
		background: <?php echo $icon_bg_color; ?>;
		border-bottom: 4px double <?php echo $border_color; ?>;
	}

	<?php if ( 'shadow' == $settings->hover_effect ) { ?>
	.fl-node-<?php echo $id; ?> .info-table:hover {
		box-shadow: 0 0 7px rgba(167,167,167,.5);
	}
	<?php } ?>

	/* Design Three */
	.fl-node-<?php echo $id; ?> .info-table-design03.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-icon {
		background: <?php echo $icon_bg_color; ?>;
	}
	/* Design Four */
	.fl-node-<?php echo $id; ?> .info-table-design04.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table {
		border-top: 5px solid <?php echo $border_color_top; ?>;
		border-bottom: 5px solid <?php echo $border_color; ?>;
	}
	.fl-node-<?php echo $id; ?> .info-table-design04.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-icon {
		border-bottom: 2px solid #e5e5e5;
	}


	/* Design Five */
	.fl-node-<?php echo $id; ?> .info-table-design05.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-heading,
	.fl-node-<?php echo $id; ?> .info-table-design05.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-icon {
		background: <?php echo $bg_head_color_code; ?>;
	}
	.fl-node-<?php echo $id; ?> .info-table-design05.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table {
		border-bottom: 5px solid <?php echo $border_color; ?>;
	}


	/* Design Six */
	.fl-node-<?php echo $id; ?> .info-table-design06.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table {
		border: 1px solid <?php echo $border_color; ?>;
	}
	.fl-node-<?php echo $id; ?> .info-table-design06.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-heading {
		background: <?php echo $bg_head_color_code; ?>;
	}
	.fl-node-<?php echo $id; ?> .info-table-design06.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-icon {
		background: <?php echo $bg_head_color_code; ?>;
		<?php
		if ( 'icon' == $settings->image_type ) {
			$spacing = ( $settings->icon_size / 2 ) + 25;
		} elseif ( 'photo' == $settings->image_type ) {
			$spacing = ( $settings->img_size / 2 ) + 25;
		}

		if ( 'icon' == $settings->image_type && 'custom' == $settings->icon_style ) {
			$spacing = $spacing + ( $settings->icon_bg_size / 2 );
		} elseif ( 'photo' == $settings->image_type && 'custom' == $settings->image_style ) {
			$spacing = $spacing + $settings->img_bg_size;
		}

		if ( 'icon' == $settings->image_type && 'simple' != $settings->icon_style && 'custom' != $settings->icon_style ) {
			$spacing = $spacing + 40;
		} elseif ( 'photo' == $settings->image_type && 'simple' != $settings->image_style && 'custom' != $settings->image_style ) {
			$spacing = $spacing;
		}
		?>
		height: <?php echo $spacing; ?>px;
		margin-bottom: <?php echo $spacing; ?>px;
	}


	/* Button Design */
	<?php if ( 'cta' == $settings->it_link_type ) { ?>
		.fl-node-<?php echo $id; ?> .info-table-wrap .info-table-button a {
			color: <?php echo uabb_theme_button_text_color( $settings->btn_text_color ); ?>;
			background: <?php echo uabb_theme_base_color( $settings->btn_bg_color ); ?>;
			padding: <?php echo uabb_theme_button_padding( '' ); ?>
		}

		<?php if ( 'design02' != $settings->box_design ) { ?>
			.fl-node-<?php echo $id; ?> .info-table-wrap .info-table-button a {
				border-radius: <?php echo ( '' != $settings->btn_radius ) ? $settings->btn_radius : '3'; ?>px;
			}
		<?php } ?>

		<?php if ( '' != $settings->btn_text_hover_color || '' != $settings->btn_bg_hover_color ) { ?>
		.fl-node-<?php echo $id; ?> .info-table-wrap .info-table-button a:hover {
			color: <?php echo $settings->btn_text_hover_color; ?>;
			background: <?php echo $settings->btn_bg_hover_color; ?>;
		}
		<?php } ?>

		<?php if ( 'design01' == $settings->box_design ) { ?>
			.fl-node-<?php echo $id; ?> .info-table-design01 .info-table-button {
				background: #333333;
			}
		<?php } elseif ( 'design02' == $settings->box_design ) { ?>
			.fl-node-<?php echo $id; ?> .info-table-wrap.info-table-design02 .info-table-button {
				position: absolute;
				right: 0;
				width: 100%;
				top: 50%;
				transform: translateY(-50%);
			}
			.fl-node-<?php echo $id; ?> .info-table-design02 .info-table-button a {
				padding: 7px;
				position: absolute;
				right: -8px;
				top: 0;
				transform: translateY(-50%);
			}
			.fl-node-<?php echo $id; ?> .info-table-design02 .info-table-button a:after {
				content: "";
				display: block;
				position: absolute;
				width: 0;
				height: 0;
				bottom: -6px;
				right: 0;
				border-bottom: 8px solid transparent;
				border-left: 8px solid <?php echo uabb_theme_base_color( $settings->btn_bg_color ); ?>;
				-webkit-transition: all 200ms ease-in-out;
					-moz-transition: all 200ms ease-in-out;
					transition: all 200ms ease-in-out
			}
			.fl-node-<?php echo $id; ?> .info-table-design02 .info-table-heading {
				position: relative;
			}

			<?php if ( '' != $settings->btn_bg_hover_color ) { ?>
			.fl-node-<?php echo $id; ?> .info-table-design02 .info-table-button a:hover::after {
				border-left: 8px solid <?php echo $settings->btn_bg_hover_color; ?>;
			}
			<?php } ?>
		<?php } elseif ( 'design04' == $settings->box_design ) { ?>
		<?php } elseif ( 'design05' == $settings->box_design ) { ?>
		<?php } elseif ( 'design06' == $settings->box_design ) { ?>
		<?php } ?>
	<?php } ?>
	<?php
} else {

	if ( 'design01' == $settings->box_design ) {
		$bg_color_code = ( $settings->desc_back_color ) ? $settings->desc_back_color : '#333333';
		$bg_grad_start = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $bg_color_code ), 30, 'lighten' );
	} elseif ( 'design02' == $settings->box_design ) {
		$icon_bg_color      = '#fbfbfb';
		$border_color       = '#dcdcdc';
		$bg_head_color_code = ( $settings->heading_back_color ) ? $settings->heading_back_color : '#333333';
		$bg_color_code      = ( $settings->desc_back_color ) ? $settings->desc_back_color : '#f0f0f0';
	} elseif ( 'design03' == $settings->box_design ) {
		$icon_bg_color = ( $settings->heading_back_color ) ? $settings->heading_back_color : '#333333';
		$bg_color_code = ( $settings->desc_back_color ) ? $settings->desc_back_color : '#333333';
		$bg_grad_start = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $bg_color_code ), 30, 'lighten' );
	} elseif ( 'design04' == $settings->box_design ) {
		$border_color_top = ( $settings->desc_back_color ) ? $settings->desc_back_color : '#333333';
		$bg_color_code    = ( $settings->heading_back_color ) ? $settings->heading_back_color : '#f9f9f9';
		$bg_grad_start    = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $bg_color_code ), 30, 'lighten' );
	} elseif ( 'design05' == $settings->box_design ) {
		$border_color       = '#dddddd';
		$bg_head_color_code = ( $settings->desc_back_color ) ? $settings->desc_back_color : '#333333';
		$bg_color_code      = ( $settings->heading_back_color ) ? $settings->heading_back_color : '#f7f7f7';
		$bg_grad_start      = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $bg_color_code ), 30, 'lighten' );
	} elseif ( 'design06' == $settings->box_design ) {
		$border_color       = '#efefef';
		$bg_head_color_code = ( $settings->desc_back_color ) ? $settings->desc_back_color : '#333333';
		$bg_color_code      = ( $settings->heading_back_color ) ? $settings->heading_back_color : '#ffffff';
		$bg_grad_start      = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $bg_color_code ), 30, 'lighten' );
	}

	if ( 'design01' == $settings->box_design || 'design03' == $settings->box_design || 'design04' == $settings->box_design || 'design05' == $settings->box_design || 'design06' == $settings->box_design ) {
		?>
		.fl-node-<?php echo $id; ?> .info-table-<?php echo $settings->box_design; ?>.info-table-cs-<?php echo $settings->color_scheme; ?> {
			background: -moz-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%, <?php echo $bg_color_code; ?> 100%); /* FF3.6+ */
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $bg_grad_start; ?>), color-stop(100%,<?php echo $bg_color_code; ?>)); /* Chrome,Safari4+ */
			background: -webkit-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%,<?php echo $bg_color_code; ?> 100%); /* Chrome10+,Safari5.1+ */
			background: -o-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%,<?php echo $bg_color_code; ?> 100%); /* Opera 11.10+ */
			background: -ms-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%,<?php echo $bg_color_code; ?> 100%); /* IE10+ */
			background: linear-gradient(to bottom,  <?php echo $bg_grad_start; ?> 0%,<?php echo $bg_color_code; ?> 100%); /* W3C */
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $bg_grad_start; ?>', endColorstr='<?php echo $bg_color_code; ?>',GradientType=0 ); /* IE6-9 */
		}
	<?php } ?>

	/* Design Two */
	.fl-node-<?php echo $id; ?> .info-table-design02.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-heading {
		background: <?php echo $bg_head_color_code; ?>;
	}
	.fl-node-<?php echo $id; ?> .info-table-design02.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-icon {
		background: <?php echo $icon_bg_color; ?>;
		border-bottom: 4px double <?php echo $border_color; ?>;
	}
	.fl-node-<?php echo $id; ?> .info-table-design02.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-description {
		background: <?php echo $bg_color_code; ?>;
	}
	.fl-node-<?php echo $id; ?> .info-table-wrap.info-table-design02 .info-table-heading {
		position: relative;
	}
	.fl-node-<?php echo $id; ?> .info-table-wrap.info-table-design02 .info-table-button {
		position: absolute;
		right: 0;
		width: 100%;
		top: 50%;
		transform: translateY(-50%);
	}
	.fl-node-<?php echo $id; ?> .info-table-design02 .info-table-button a {
		/*background: <?php echo $bg_head_color_code; ?>;*/
		border-radius: 3px;
		padding: 7px;
		position: absolute;
		right: -8px;
		/*bottom: 70px;*/
		top: 0;
		transform: translateY(-50%);
	}

	<?php if ( 'shadow' == $settings->hover_effect ) { ?>
	.fl-node-<?php echo $id; ?> .info-table-design02 .info-table:hover,
	.fl-node-<?php echo $id; ?> .info-table-design04 .info-table:hover,
	.fl-node-<?php echo $id; ?> .info-table-design05 .info-table:hover,
	.fl-node-<?php echo $id; ?> .info-table-design06 .info-table:hover {
		box-shadow: 0 0 7px rgba(167,167,167,.5);
	}
	<?php } ?>

	/* Design Three */
	.fl-node-<?php echo $id; ?> .info-table-design03.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-icon {
		background: <?php echo $icon_bg_color; ?>;
	}

	/* Design Four */
	.fl-node-<?php echo $id; ?> .info-table-design04.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table {
		border-top: 5px solid <?php echo $border_color_top; ?>;
		border-bottom: 5px solid <?php echo $border_color; ?>;
	}
	.fl-node-<?php echo $id; ?> .info-table-design04.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-icon {
		border-bottom: 2px solid #e5e5e5;
	}


	/* Design Five */
	.fl-node-<?php echo $id; ?> .info-table-design05.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-heading,
	.fl-node-<?php echo $id; ?> .info-table-design05.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-icon {
		background: <?php echo $bg_head_color_code; ?>;
	}
	.fl-node-<?php echo $id; ?> .info-table-design05.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table {
		border-bottom: 5px solid <?php echo $border_color; ?>;
	}

	/* Design Six */
	.fl-node-<?php echo $id; ?> .info-table-design06.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table {
		border: 1px solid <?php echo $border_color; ?>;
	}
	.fl-node-<?php echo $id; ?> .info-table-design06.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-heading {
		background: <?php echo $bg_head_color_code; ?>;
	}

	<?php
	$cal_width      = 0;
	$original_width = 0;
	if ( 'icon' == $settings->image_type ) {
		$cal_width = $settings->icon_size;
		if ( 'simple' != $settings->icon_style ) {
			$cal_width = $settings->icon_size * 2;
			if ( 'custom' == $settings->icon_style ) {
				$cal_width = $settings->icon_size + intval( $settings->icon_bg_size );
				if ( 'none' != $settings->icon_border_style ) {
					$cal_width = $cal_width + ( intval( $settings->icon_border_width ) * 2 );
				}
			}
		}
		$original_width = intval( $cal_width );
		$cal_width      = ( intval( $cal_width ) / 2 ) + 25;
	}

	if ( 'photo' == $settings->image_type ) {
		$cal_width = $settings->img_size;
		if ( 'custom' == $settings->image_style ) {
			$cal_width = $cal_width + intval( $settings->img_bg_size ) * 2;
			if ( 'none' != $settings->img_border_style ) {
				$cal_width = $cal_width + ( intval( $settings->img_border_width ) * 2 );
			}
		}
		$original_width = intval( $cal_width );
		$cal_width      = ( intval( $cal_width ) / 2 ) + 25;
	}
	?>

	<?php if ( 'design06' == $settings->box_design ) { ?>
		.fl-node-<?php echo $id; ?> .info-table .uabb-imgicon-wrap {
			<?php if ( 'icon' == $settings->image_type || 'photo' == $settings->image_type ) { ?>
			width: <?php echo $original_width; ?>px;
			<?php } ?>
		}
	<?php } ?>

	.fl-node-<?php echo $id; ?> .info-table-design06.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-icon {
		background: <?php echo $bg_head_color_code; ?>;
		height: <?php echo $cal_width; ?>px;
		margin-bottom: <?php echo $cal_width; ?>px;
	}


	/* Button Design */
	<?php if ( 'cta' == $settings->it_link_type ) { ?>
		.fl-node-<?php echo $id; ?> .info-table-wrap .info-table-button a {
			color: <?php echo $settings->btn_text_color; ?>;
			background: <?php echo uabb_theme_base_color( $settings->btn_bg_color ); ?>;
			padding: <?php echo uabb_theme_button_padding( '' ); ?>;
		}
		<?php if ( 'design02' != $settings->box_design ) { ?>
			.fl-node-<?php echo $id; ?> .info-table-wrap .info-table-button a {
				border-radius: <?php echo ( '' != $settings->btn_radius ) ? $settings->btn_radius : '3'; ?>px;
			}
		<?php } ?>

		<?php if ( '' != $settings->btn_text_hover_color || '' != $settings->btn_bg_hover_color ) { ?>
			.fl-node-<?php echo $id; ?> .info-table-wrap .info-table-button a:hover {
				color: <?php echo $settings->btn_text_hover_color; ?>;
				background: <?php echo $settings->btn_bg_hover_color; ?>;
			}
		<?php } ?>

		<?php if ( 'design01' == $settings->box_design ) { ?>
			.fl-node-<?php echo $id; ?> .info-table-design01 .info-table-button {
				background: #333333;
				<?php echo ( '' != $settings->heading_back_color ) ? 'background: ' . $settings->heading_back_color . ';' : ''; ?>
			}
		<?php } elseif ( 'design02' == $settings->box_design ) { ?>
			.fl-node-<?php echo $id; ?> .info-table-design02 .info-table-button a {
				padding: 7px;
				position: absolute;
				right: -8px;
				top: 0;
				transform: translateY(-50%);
			}
			.fl-node-<?php echo $id; ?> .info-table-design02 .info-table-button a:after {
				content: "";
				display: block;
				position: absolute;
				width: 0;
				height: 0;
				bottom: -6px;
				right: 0;
				border-bottom: 8px solid transparent;
				border-left: 8px solid <?php echo uabb_theme_base_color( $settings->btn_bg_color ); ?>;
				-webkit-transition: all 200ms ease-in-out;
					-moz-transition: all 200ms ease-in-out;
						transition: all 200ms ease-in-out
			}

			<?php if ( '' != $settings->btn_bg_hover_color ) { ?>
			.fl-node-<?php echo $id; ?> .info-table-design02 .info-table-button a:hover::after {
				border-left: 8px solid <?php echo $settings->btn_bg_hover_color; ?>;
			}
			<?php } ?>
		<?php } elseif ( 'design03' == $settings->box_design ) { ?>
		<?php } elseif ( 'design04' == $settings->box_design ) { ?>
			.fl-node-<?php echo $id; ?> .info-table-design04 .info-table-button a {
				background: <?php echo $border_color_top; ?>;*/
			}
		<?php } elseif ( 'design05' == $settings->box_design ) { ?>
		<?php } elseif ( 'design06' == $settings->box_design ) { ?>
		<?php } ?>
	<?php } ?>
	/* Button Design Ends */
	<?php
}
?>

<?php
if ( 'design02' != $settings->box_design ) {
	?>
.fl-node-<?php echo $id; ?> .info-table-wrap .info-table .info-table-button {
	padding: <?php echo ( '' != $settings->btn_top_margin ) ? $settings->btn_top_margin : '15'; ?>px 0 <?php echo ( '' != $settings->btn_bottom_margin ) ? $settings->btn_bottom_margin : '15'; ?>px;
}
	<?php
}
?>
.info-table-heading .info-table-main-heading {
	<?php if ( '' != $settings->heading_color ) : ?>
		color: <?php echo $settings->heading_color; ?>;
	<?php endif; ?>
}
.fl-node-<?php echo $id; ?> .info-table-heading .info-table-sub-heading {
	<?php if ( isset( $settings->sub_heading_color ) ) { ?>
		color:<?php echo  $settings->sub_heading_color; ?>;
	<?php } ?>
}
.fl-node-<?php echo $id; ?> .info-table .info-table-description {
	<?php if ( isset( $settings->description_color ) ) { ?>
		color:<?php echo  $settings->description_color; ?>;
	<?php } ?>
}
<?php
if ( ! $version_bb_check ) {
	/* Typography style starts here  */

	if ( 'Default' != $settings->heading_font_family['family'] || isset( $settings->heading_font_size['desktop'] ) || isset( $settings->heading_line_height['desktop'] ) || '' != $settings->heading_font_size_unit || '' != $settings->heading_line_height_unit || '' != $settings->heading_color ) {

		?>
		.fl-node-<?php echo $id; ?> .info-table-heading .info-table-main-heading {
			<?php if ( 'Default' != $settings->heading_font_family['family'] ) : ?>
				<?php UABB_Helper::uabb_font_css( $settings->heading_font_family ); ?>
			<?php endif; ?>
			<?php
			if ( 'yes' === $converted || isset( $settings->heading_font_size_unit ) && '' != $settings->heading_font_size_unit ) {
				?>
				font-size: <?php echo $settings->heading_font_size_unit; ?>px;
			<?php } elseif ( isset( $settings->heading_font_size_unit ) && '' == $settings->heading_font_size_unit && isset( $settings->heading_font_size['desktop'] ) && '' != $settings->heading_font_size['desktop'] ) { ?>
				font-size: <?php echo $settings->heading_font_size['desktop']; ?>px;
			<?php } ?>

			<?php if ( isset( $settings->heading_font_size['desktop'] ) && '' == $settings->heading_font_size['desktop'] && isset( $settings->heading_line_height['desktop'] ) && '' != $settings->heading_line_height['desktop'] && '' == $settings->heading_line_height_unit ) { ?>
				line-height: <?php echo $settings->heading_line_height['desktop']; ?>px;
			<?php } ?>

			<?php if ( 'yes' === $converted || isset( $settings->heading_line_height_unit ) && '' != $settings->heading_line_height_unit ) { ?>
				line-height: <?php echo $settings->heading_line_height_unit; ?>em;
			<?php } elseif ( isset( $settings->heading_line_height_unit ) && '' == $settings->heading_line_height_unit && isset( $settings->heading_line_height['desktop'] ) && '' != $settings->heading_line_height['desktop'] ) { ?>
				line-height: <?php echo $settings->heading_line_height['desktop']; ?>px;
			<?php } ?>
		}
		<?php
	}
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'heading_font_typo',
				'selector'     => ".fl-node-$id .info-table-heading .info-table-main-heading",
			)
		);
	}
}
if ( ! $version_bb_check ) {
	if ( 'Default' != $settings->sub_heading_font_family['family'] || isset( $settings->sub_heading_font_size['desktop'] ) || isset( $settings->sub_heading_line_height['desktop'] ) || '' != $settings->sub_heading_font_size_unit || '' != $settings->sub_heading_line_height_unit || '' != $settings->sub_heading_color ) {
		?>
		.fl-node-<?php echo $id; ?> .info-table-heading .info-table-sub-heading {
			<?php if ( 'Default' != $settings->sub_heading_font_family['family'] ) : ?>
				<?php UABB_Helper::uabb_font_css( $settings->sub_heading_font_family ); ?>
			<?php endif; ?>

			<?php
			if ( 'yes' === $converted || isset( $settings->sub_heading_font_size_unit ) && '' != $settings->sub_heading_font_size_unit ) {
				?>
				font-size: <?php echo $settings->sub_heading_font_size_unit; ?>px;
			<?php } elseif ( isset( $settings->sub_heading_font_size_unit ) && '' == $settings->sub_heading_font_size_unit && isset( $settings->sub_heading_font_size['desktop'] ) && '' != $settings->sub_heading_font_size['desktop'] ) { ?>
				font-size: <?php echo $settings->sub_heading_font_size['desktop']; ?>px;
			<?php } ?>

			<?php if ( isset( $settings->sub_heading_font_size['desktop'] ) && '' == $settings->sub_heading_font_size['desktop'] && isset( $settings->sub_heading_line_height['desktop'] ) && '' != $settings->sub_heading_line_height['desktop'] && '' == $settings->sub_heading_line_height_unit ) { ?>
				line-height: <?php echo $settings->sub_heading_line_height['desktop']; ?>px;
			<?php } ?>
			<?php if ( 'yes' === $converted || isset( $settings->sub_heading_line_height_unit ) && '' != $settings->sub_heading_line_height_unit ) { ?>
				line-height: <?php echo $settings->sub_heading_line_height_unit; ?>em;
			<?php } elseif ( isset( $settings->sub_heading_line_height_unit ) && '' == $settings->sub_heading_line_height_unit && isset( $settings->sub_heading_line_height['desktop'] ) && '' != $settings->sub_heading_line_height['desktop'] ) { ?>
				line-height: <?php echo $settings->sub_heading_line_height['desktop']; ?>px;
			<?php } ?>

		}
		<?php
	}
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'sub_heading_font_typo',
				'selector'     => ".fl-node-$id .info-table-heading .info-table-sub-heading",
			)
		);
	}
}
if ( ! $version_bb_check ) {
	if ( 'Default' != $settings->description_font_family['family'] || isset( $settings->description_font_size['desktop'] ) || isset( $settings->description_line_height['desktop'] ) || '' != $settings->description_font_size_unit || '' != $settings->description_line_height_unit || '' != $settings->description_color ) {
		?>
		.fl-node-<?php echo $id; ?> .info-table .info-table-description {

			<?php if ( 'Default' != $settings->description_font_family['family'] ) : ?>
				<?php UABB_Helper::uabb_font_css( $settings->description_font_family ); ?>
			<?php endif; ?>

			<?php
			if ( 'yes' === $converted || isset( $settings->description_font_size_unit ) && '' != $settings->description_font_size_unit ) {
				?>
				font-size: <?php echo $settings->description_font_size_unit; ?>px;
			<?php } elseif ( isset( $settings->description_font_size_unit ) && '' == $settings->description_font_size_unit && isset( $settings->description_font_size['desktop'] ) && '' != $settings->description_font_size['desktop'] ) { ?>
				font-size: <?php echo $settings->description_font_size['desktop']; ?>px;
			<?php } ?>

			<?php if ( isset( $settings->description_font_size['desktop'] ) && '' == $settings->description_font_size['desktop'] && isset( $settings->description_line_height['desktop'] ) && '' != $settings->description_line_height['desktop'] && '' == $settings->description_line_height_unit ) { ?>
				line-height: <?php echo $settings->description_line_height['desktop']; ?>px;
			<?php } ?>

			<?php if ( 'yes' === $converted || isset( $settings->description_line_height_unit ) && '' != $settings->description_line_height_unit ) { ?>
				line-height: <?php echo $settings->description_line_height_unit; ?>em;
			<?php } elseif ( isset( $settings->description_line_height_unit ) && '' == $settings->description_line_height_unit && isset( $settings->description_line_height['desktop'] ) && '' != $settings->description_line_height['desktop'] ) { ?>
				line-height: <?php echo $settings->description_line_height['desktop']; ?>px;
			<?php } ?>

		}
		<?php
	}
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'description_font_typo',
				'selector'     => ".fl-node-$id .info-table .info-table-description",
			)
		);
	}
}
if ( ! $version_bb_check ) {
	if ( 'Default' != $settings->btn_font_family['family'] || isset( $settings->btn_font_size['desktop'] ) && '' != $settings->btn_font_size['desktop'] || isset( $settings->btn_line_height['desktop'] ) && '' != $settings->btn_line_height['desktop'] || isset( $settings->btn_font_size_unit ) || isset( $settings->btn_line_height_unit ) ) {
		?>
		.fl-node-<?php echo $id; ?> .info-table-wrap .info-table-button a {

			<?php if ( 'Default' != $settings->btn_font_family['family'] ) : ?>
				<?php UABB_Helper::uabb_font_css( $settings->btn_font_family ); ?>
			<?php endif; ?>
			<?php if ( 'yes' === $converted || isset( $settings->btn_font_size_unit ) && '' != $settings->btn_font_size_unit ) { ?>
				font-size: <?php echo $settings->btn_font_size_unit; ?>px;
				<?php if ( '' == $settings->btn_line_height_unit && '' != $settings->btn_font_size_unit ) { ?>
					line-height: <?php echo $settings->btn_font_size_unit + 5; ?>px;
				<?php } ?>		
			<?php } elseif ( isset( $settings->btn_font_size_unit ) && '' == $settings->btn_font_size_unit && isset( $settings->btn_font_size['desktop'] ) && '' != $settings->btn_font_size['desktop'] ) { ?>
				font-size: <?php echo $settings->btn_font_size['desktop']; ?>px;
				line-height: <?php echo $settings->btn_font_size['desktop'] + 5; ?>px;
			<?php } ?>

			<?php if ( isset( $settings->btn_font_size['desktop'] ) && '' == $settings->btn_font_size['desktop'] && isset( $settings->btn_line_height['desktop'] ) && '' != $settings->btn_line_height['desktop'] && '' == $settings->btn_line_height_unit ) { ?>
				line-height: <?php echo $settings->btn_line_height['desktop']; ?>px;
			<?php } ?>

			<?php if ( 'yes' === $converted || isset( $settings->btn_line_height_unit ) && '' != $settings->btn_line_height_unit ) { ?>
				line-height: <?php echo $settings->btn_line_height_unit; ?>em;	
			<?php } elseif ( isset( $settings->btn_line_height_unit ) && '' == $settings->btn_line_height_unit && isset( $settings->btn_line_height['desktop'] ) && '' != $settings->btn_line_height['desktop'] ) { ?>
				line-height: <?php echo $settings->btn_line_height['desktop']; ?>px;
			<?php } ?>

		}
		<?php
	}
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'btn_font_typo',
				'selector'     => ".fl-node-$id .info-table-wrap .info-table-button a",
			)
		);
	}
}
if ( $global_settings->responsive_enabled ) { // Global Setting If started.
	?>
		@media ( max-width: <?php echo $global_settings->medium_breakpoint . 'px'; ?> ) {
			<?php if ( ! $version_bb_check ) { ?>
				<?php if ( isset( $settings->heading_font_size['medium'] ) || isset( $settings->heading_line_height['medium'] ) || isset( $settings->heading_font_size_unit_medium ) || isset( $settings->heading_line_height_unit_medium ) || isset( $settings->heading_line_height_unit ) ) { ?>
					.fl-node-<?php echo $id; ?> .info-table-heading .info-table-main-heading {

						<?php if ( 'yes' === $converted || isset( $settings->heading_font_size_unit_medium ) && '' != $settings->heading_font_size_unit_medium ) { ?>
							font-size: <?php echo $settings->heading_font_size_unit_medium; ?>px;
						<?php } elseif ( isset( $settings->heading_font_size_unit_medium ) && '' == $settings->heading_font_size_unit_medium && isset( $settings->heading_font_size['medium'] ) && '' != $settings->heading_font_size['medium'] ) { ?>
							font-size: <?php echo $settings->heading_font_size['medium']; ?>px;
						<?php } ?>          

						<?php if ( isset( $settings->heading_font_size['medium'] ) && '' == $settings->heading_font_size['medium'] && isset( $settings->heading_line_height['medium'] ) && '' != $settings->heading_line_height['medium'] && '' == $settings->heading_line_height_unit_medium && '' == $settings->heading_line_height_unit ) { ?>
							line-height: <?php echo $settings->heading_line_height['medium']; ?>px;
						<?php } ?>

						<?php if ( 'yes' === $converted || isset( $settings->heading_line_height_unit_medium ) && '' != $settings->heading_line_height_unit_medium ) { ?>
							line-height: <?php echo $settings->heading_line_height_unit_medium; ?>em;   
						<?php } elseif ( isset( $settings->heading_line_height_unit_medium ) && '' == $settings->heading_line_height_unit_medium && isset( $settings->heading_line_height['medium'] ) && '' != $settings->heading_line_height['medium'] ) { ?>
							line-height: <?php echo $settings->heading_line_height['medium']; ?>px;
						<?php } ?>					

					}
				<?php } ?>
			<?php } ?>
			<?php if ( ! $version_bb_check ) { ?>
				<?php if ( isset( $settings->sub_heading_font_size['medium'] ) || isset( $settings->sub_heading_line_height['medium'] ) || isset( $settings->sub_heading_font_size_unit_medium ) || isset( $settings->sub_heading_line_height_unit_medium ) || isset( $settings->sub_heading_line_height_unit ) ) { ?>
					.fl-node-<?php echo $id; ?> .info-table-heading .info-table-sub-heading {

						<?php if ( 'yes' === $converted || isset( $settings->sub_heading_font_size_unit_medium ) && '' != $settings->sub_heading_font_size_unit_medium ) { ?>
							font-size: <?php echo $settings->sub_heading_font_size_unit_medium; ?>px;
						<?php } elseif ( isset( $settings->sub_heading_font_size_unit_medium ) && '' == $settings->sub_heading_font_size_unit_medium && isset( $settings->sub_heading_font_size['medium'] ) && '' != $settings->sub_heading_font_size['medium'] ) { ?>
							font-size: <?php echo $settings->sub_heading_font_size['medium']; ?>px;
						<?php } ?>

						<?php if ( isset( $settings->sub_heading_font_size['medium'] ) && '' == $settings->sub_heading_font_size['medium'] && isset( $settings->sub_heading_line_height['medium'] ) && '' != $settings->sub_heading_line_height['medium'] && '' == $settings->sub_heading_line_height_unit && '' == $settings->sub_heading_line_height_unit_medium ) { ?>
							line-height: <?php echo $settings->sub_heading_line_height['medium']; ?>px;
						<?php } ?>

						<?php if ( 'yes' === $converted || isset( $settings->sub_heading_line_height_unit_medium ) && '' != $settings->sub_heading_line_height_unit_medium ) { ?>
							line-height: <?php echo $settings->sub_heading_line_height_unit_medium; ?>em;   
						<?php } elseif ( isset( $settings->sub_heading_line_height_unit_medium ) && '' == $settings->sub_heading_line_height_unit_medium && isset( $settings->sub_heading_line_height['medium'] ) && '' != $settings->sub_heading_line_height['medium'] ) { ?>
							line-height: <?php echo $settings->sub_heading_line_height['medium']; ?>px;
						<?php } ?>

					}
				<?php } ?>
			<?php } ?>
			<?php if ( ! $version_bb_check ) { ?>
				<?php if ( isset( $settings->description_font_size['medium'] ) || isset( $settings->description_line_height['medium'] ) || '' != $settings->description_font_size_unit_medium || '' != $settings->description_line_height_unit_medium ) { ?>
					.fl-node-<?php echo $id; ?> .info-table .info-table-description {

						<?php if ( 'yes' === $converted || isset( $settings->description_font_size_unit_medium ) && '' != $settings->description_font_size_unit_medium ) { ?>
							font-size: <?php echo $settings->description_font_size_unit_medium; ?>px;
						<?php } elseif ( isset( $settings->description_font_size_unit_medium ) && '' == $settings->description_font_size_unit_medium && isset( $settings->description_font_size['medium'] ) && '' != $settings->description_font_size['medium'] ) { ?>
							font-size: <?php echo $settings->description_font_size['medium']; ?>px;
						<?php } ?>  

						<?php if ( isset( $settings->description_font_size['medium'] ) && '' == $settings->description_font_size['medium'] && isset( $settings->description_line_height['medium'] ) && '' != $settings->description_line_height['medium'] && '' == $settings->description_line_height_unit && '' == $settings->description_line_height_unit_medium ) { ?>
							line-height: <?php echo $settings->description_line_height['medium']; ?>px;
						<?php } ?>

						<?php if ( 'yes' === $converted || isset( $settings->description_line_height_unit_medium ) && '' != $settings->description_line_height_unit_medium ) { ?>
							line-height: <?php echo $settings->description_line_height_unit_medium; ?>em;   
						<?php } elseif ( isset( $settings->description_line_height_unit_medium ) && '' == $settings->description_line_height_unit_medium && isset( $settings->description_line_height['medium'] ) && '' != $settings->description_line_height['medium'] ) { ?>
							line-height: <?php echo $settings->description_line_height['medium']; ?>px;
						<?php } ?>

					}
				<?php } ?>
			<?php } ?>
			<?php if ( ! $version_bb_check ) { ?>
				<?php if ( isset( $settings->btn_font_size['medium'] ) || isset( $settings->btn_line_height['medium'] ) || isset( $settings->btn_font_size_unit_medium ) || isset( $settings->btn_line_height_unit_medium ) || isset( $settings->btn_line_height_unit ) ) { ?>
					.fl-node-<?php echo $id; ?> .info-table-wrap .info-table-button a {

						<?php if ( 'yes' === $converted || isset( $settings->btn_font_size_unit_medium ) && '' != $settings->btn_font_size_unit_medium ) { ?>
							font-size: <?php echo $settings->btn_font_size_unit_medium; ?>px;
						<?php } elseif ( isset( $settings->btn_font_size_unit_medium ) && '' == $settings->btn_font_size_unit_medium && isset( $settings->btn_font_size['medium'] ) && '' != $settings->btn_font_size['medium'] ) { ?>
							font-size: <?php echo $settings->btn_font_size['medium']; ?>px;
						<?php } ?> 

						<?php if ( isset( $settings->btn_font_size['medium'] ) && '' == $settings->btn_font_size['medium'] && isset( $settings->btn_line_height['medium'] ) && '' != $settings->btn_line_height['medium'] && '' == $settings->btn_line_height_unit && '' == $settings->btn_line_height_unit_medium ) { ?>
							line-height: <?php echo $settings->btn_line_height['medium']; ?>px;
						<?php } ?>

						<?php if ( 'yes' === $converted || isset( $settings->btn_line_height_unit_medium ) && '' != $settings->btn_line_height_unit_medium ) { ?>
							line-height: <?php echo $settings->btn_line_height_unit_medium; ?>em;   
						<?php } elseif ( isset( $settings->btn_line_height_unit_medium ) && '' == $settings->btn_line_height_unit_medium && isset( $settings->btn_line_height['medium'] ) && '' != $settings->btn_line_height['medium'] ) { ?>
							line-height: <?php echo $settings->btn_line_height['medium']; ?>px;
						<?php } ?>

					}
				<?php } ?>
			<?php } ?>
		}
	<?php
	if ( ! $version_bb_check ) {
		if ( isset( $settings->heading_font_size['small'] ) || isset( $settings->heading_line_height['small'] ) || isset( $settings->sub_heading_font_size['small'] ) || isset( $settings->sub_heading_line_height['small'] ) || isset( $settings->description_font_size['small'] ) || isset( $settings->description_line_height['small'] ) || isset( $settings->btn_font_size['small'] ) || isset( $settings->btn_line_height['small'] ) || isset( $settings->heading_font_size_unit_responsive ) || isset( $settings->heading_line_height_unit_responsive ) || isset( $settings->sub_heading_font_size_unit_responsive ) || isset( $settings->sub_heading_line_height_unit_responsive ) || isset( $settings->description_font_size_unit_responsive ) || isset( $settings->description_line_height_unit_responsive ) || isset( $settings->btn_font_size_unit_responsive ) || isset( $settings->btn_line_height_unit_responsive ) || isset( $settings->heading_line_height_unit ) || isset( $settings->heading_line_height_unit_medium ) || isset( $settings->sub_heading_line_height_unit ) || isset( $settings->sub_heading_line_height_unit_medium ) ) {
			?>
			@media ( max-width: <?php echo $global_settings->responsive_breakpoint . 'px'; ?> ) {

				.fl-node-<?php echo $id; ?> .info-table-heading .info-table-main-heading { 

					<?php if ( 'yes' === $converted || isset( $settings->heading_font_size_unit_responsive ) && '' != $settings->heading_font_size_unit_responsive ) { ?>
						font-size: <?php echo $settings->heading_font_size_unit_responsive; ?>px;   
					<?php } elseif ( $settings->heading_font_size_unit_responsive && '' == $settings->heading_font_size_unit_responsive && isset( $settings->heading_font_size['small'] ) && '' != $settings->heading_font_size['small'] ) { ?>
						font-size: <?php echo $settings->heading_font_size['small']; ?>px;
					<?php } ?>

					<?php if ( isset( $settings->heading_font_size['small'] ) && '' == $settings->heading_font_size['small'] && isset( $settings->heading_line_height['small'] ) && '' != $settings->heading_line_height['small'] && '' == $settings->heading_line_height_unit && '' == $settings->heading_line_height_unit_medium && '' == $settings->heading_line_height_unit_responsive ) { ?>
						line-height: <?php echo $settings->heading_line_height['small']; ?>px;
					<?php } ?>
					<?php if ( 'yes' === $converted || isset( $settings->heading_line_height_unit_responsive ) && '' != $settings->heading_line_height_unit_responsive ) { ?>
						line-height: <?php echo $settings->heading_line_height_unit_responsive; ?>em;
					<?php } elseif ( isset( $settings->heading_line_height_unit_responsive ) && '' == $settings->heading_line_height_unit_responsive && isset( $settings->heading_line_height['small'] ) && '' != $settings->heading_line_height['small'] ) { ?>
						line-height: <?php echo $settings->heading_line_height['small']; ?>px;
					<?php } ?> 

				}

				.fl-node-<?php echo $id; ?> .info-table-heading .info-table-sub-heading {

					<?php if ( 'yes' === $converted || isset( $settings->sub_heading_font_size_unit_responsive ) && '' != $settings->sub_heading_font_size_unit_responsive ) { ?>
						font-size: <?php echo $settings->sub_heading_font_size_unit_responsive; ?>px;   
					<?php } elseif ( $settings->sub_heading_font_size_unit_responsive && '' == $settings->sub_heading_font_size_unit_responsive && isset( $settings->sub_heading_font_size['small'] ) && '' != $settings->sub_heading_font_size['small'] ) { ?>
						font-size: <?php echo $settings->sub_heading_font_size['small']; ?>px;
					<?php } ?>

					<?php if ( isset( $settings->sub_heading_font_size['small'] ) && '' == $settings->sub_heading_font_size['small'] && isset( $settings->sub_heading_line_height['small'] ) && '' != $settings->sub_heading_line_height['small'] && '' == $settings->sub_heading_line_height_unit && '' == $settings->sub_heading_line_height_unit_medium && '' == $settings->sub_heading_line_height_unit_responsive ) { ?>
						line-height: <?php echo $settings->sub_heading_line_height['small']; ?>px;
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->sub_heading_line_height_unit_responsive ) && '' != $settings->sub_heading_line_height_unit_responsive ) { ?>
						line-height: <?php echo $settings->sub_heading_line_height_unit_responsive; ?>em;
					<?php } elseif ( isset( $settings->sub_heading_line_height_unit_responsive ) && '' == $settings->sub_heading_line_height_unit_responsive && isset( $settings->sub_heading_line_height['small'] ) && '' != $settings->sub_heading_line_height['small'] ) { ?>
						line-height: <?php echo $settings->sub_heading_line_height['small']; ?>px;
					<?php } ?>

				}
				<?php if ( isset( $settings->description_font_size['small'] ) || isset( $settings->description_line_height['small'] ) || '' != $settings->description_font_size_unit_responsive || '' != $settings->description_line_height_unit_responsive || isset( $settings->description_line_height_unit ) || isset( $settings->description_line_height_unit_responsive ) ) { ?>
					.fl-node-<?php echo $id; ?> .info-table .info-table-description {

						<?php if ( 'yes' === $converted || isset( $settings->description_font_size_unit_responsive ) && '' != $settings->description_font_size_unit_responsive ) { ?>
							font-size: <?php echo $settings->description_font_size_unit_responsive; ?>px;   
						<?php } elseif ( $settings->description_font_size_unit_responsive && '' == $settings->description_font_size_unit_responsive && isset( $settings->description_font_size['small'] ) && '' != $settings->description_font_size['small'] ) { ?>
							font-size: <?php echo $settings->description_font_size['small']; ?>px;
						<?php } ?>

						<?php if ( isset( $settings->description_font_size['small'] ) && '' == $settings->description_font_size['small'] && isset( $settings->description_line_height['small'] ) && '' != $settings->description_line_height['small'] && '' == $settings->description_line_height_unit && '' == $settings->description_line_height_unit_medium && '' == $settings->description_line_height_unit_responsive ) { ?>
							line-height: <?php echo $settings->description_line_height['small']; ?>px;
						<?php } ?>

						<?php if ( 'yes' === $converted || isset( $settings->description_line_height_unit_responsive ) && '' != $settings->description_line_height_unit_responsive ) { ?>
							line-height: <?php echo $settings->description_line_height_unit_responsive; ?>em;
						<?php } elseif ( isset( $settings->description_line_height_unit_responsive ) && '' == $settings->description_line_height_unit_responsive && isset( $settings->description_line_height['small'] ) && '' != $settings->description_line_height['small'] ) { ?>
							line-height: <?php echo $settings->description_line_height['small']; ?>px;
						<?php } ?>
					}

					.fl-node-<?php echo $id; ?> .info-table-description * {
						<?php if ( isset( $settings->description_font_size['small'] ) && '' != $settings->description_font_size['small'] || '' != $settings->description_font_size_unit_responsive ) : ?>
							font-size: inherit;
						<?php endif; ?>
						<?php if ( isset( $settings->description_line_height['small'] ) && '' != $settings->description_line_height['small'] || '' != $settings->description_line_height_unit_responsive ) : ?>
							line-height: inherit;
						<?php endif; ?>
					}
				<?php } ?>

				<?php if ( isset( $settings->btn_font_size['small'] ) || isset( $settings->btn_line_height['small'] ) || isset( $settings->btn_font_size_unit_responsive ) || isset( $settings->btn_line_height_unit_responsive ) || isset( $settings->btn_line_height_unit ) || isset( $settings->btn_line_height_unit_medium ) ) { ?>
					.fl-node-<?php echo $id; ?> .info-table-wrap .info-table-button a {

						<?php if ( 'yes' === $converted || isset( $settings->btn_font_size_unit_responsive ) && '' != $settings->btn_font_size_unit_responsive ) { ?>
							font-size: <?php echo $settings->btn_font_size_unit_responsive; ?>px;   
						<?php } elseif ( $settings->btn_font_size_unit_responsive && '' == $settings->btn_font_size_unit_responsive && isset( $settings->btn_font_size['small'] ) && '' != $settings->btn_font_size['small'] ) { ?>
							font-size: <?php echo $settings->btn_font_size['small']; ?>px;
						<?php } ?>

						<?php if ( isset( $settings->btn_font_size['small'] ) && '' == $settings->btn_font_size['small'] && isset( $settings->btn_line_height['small'] ) && '' != $settings->btn_line_height['small'] && '' == $settings->btn_line_height_unit && '' == $settings->btn_line_height_unit_medium && '' == $settings->btn_line_height_unit_responsive ) { ?>
							line-height: <?php echo $settings->btn_line_height['small']; ?>px;
						<?php } ?>

						<?php if ( 'yes' === $converted || isset( $settings->btn_line_height_unit_responsive ) && '' != $settings->btn_line_height_unit_responsive ) { ?>
							line-height: <?php echo $settings->btn_line_height_unit_responsive; ?>em;
						<?php } elseif ( isset( $settings->btn_line_height_unit_responsive ) && '' == $settings->btn_line_height_unit_responsive && isset( $settings->btn_line_height['small'] ) && '' != $settings->btn_line_height['small'] ) { ?>
							line-height: <?php echo $settings->btn_line_height['small']; ?>px;
						<?php } ?> 
					}

				<?php } ?>
			}
			<?php
		}
	}
}
?>
