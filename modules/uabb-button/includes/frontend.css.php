<?php
/**
 * UABB Button Module front-end CSS php file.
 *
 * @package UABB Button Module
 */

global $post;
$version_bb_check = UABB_Lite_Compatibility::check_bb_version();
$converted        = UABB_Lite_Compatibility::check_old_page_migration();

// Ensure $settings is defined and initialized.
if ( ! isset( $settings ) ) {
	$settings = new stdClass(); // Create an empty object to avoid undefined errors.
}

// Ensure $global_settings is defined and initialized.
if ( ! isset( $global_settings ) ) {
	// Create an empty object to avoid undefined errors.
	$global_settings = new stdClass();
}

// $id = ''; // Ensure $id is always defined.
// Ensure $id is defined and initialized.
if ( ! isset( $id ) ) {
	$id = ''; // If we do not provide isset check, styling does mot get applied.
}

$border_color = ''; // Ensure $border_color is always defined.

$bg_grad_start = ''; // Ensure $bg_grad_start is always defined.

$bg_hover_grad_start = ''; // Ensure $bg_hover_grad_start is always defined.

$border_hover_color = ''; // Ensure $border_hover_color is always defined.

$padding_top_bottom = ''; // Ensure $padding_top_bottom is always defined.



$settings->bg_color         = uabb_theme_button_bg_color( $settings->bg_color );
$settings->bg_hover_color   = uabb_theme_button_bg_hover_color( $settings->bg_hover_color );
$settings->text_color       = uabb_theme_button_text_color( $settings->text_color );
$settings->text_hover_color = uabb_theme_button_text_hover_color( $settings->text_hover_color );

$settings->bg_color           = FLBuilderColor::hex_or_rgb( $settings->bg_color );
$settings->bg_hover_color     = FLBuilderColor::hex_or_rgb( $settings->bg_hover_color );
$settings->text_color         = FLBuilderColor::hex_or_rgb( $settings->text_color );
$settings->text_hover_color   = FLBuilderColor::hex_or_rgb( $settings->text_hover_color );
$settings->border_hover_color = FLBuilderColor::hex_or_rgb( $settings->border_hover_color );

// Border Size.
if ( 'transparent' === $settings->style ) {
	$border_size = ( '' !== trim( $settings->border_size ) ) ? $settings->border_size : '2';
} else {
	$border_size = 1;
}
// Border Color.
if ( ! empty( $settings->bg_color ) ) {
	$border_color = $settings->bg_color;
}
if ( ! empty( $settings->bg_hover_color ) ) {
	$border_hover_color = $settings->bg_hover_color;
}

// Old Background Gradient Setting.
if ( isset( $settings->three_d ) && $settings->three_d ) {
	$settings->style = 'gradient';
}

// Background Gradient.
if ( ! empty( $settings->bg_color ) ) {
	$bg_grad_start = FLBuilderColor::hex_or_rgb( FLBuilderColor::adjust_brightness( $settings->bg_color, 30, 'lighten' ) );
}
if ( ! empty( $settings->bg_hover_color ) ) {
	$bg_hover_grad_start = FLBuilderColor::hex_or_rgb( FLBuilderColor::adjust_brightness( $settings->bg_hover_color, 30, 'lighten' ) );
}

?>

<?php if ( 'animate_top' === $settings->threed_button_options || 'animate_bottom' === $settings->threed_button_options ) { ?>
/* 3D Fix */

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap.uabb-creative-button-width-auto .perspective, 
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap.uabb-creative-button-width-custom .perspective {
		display: inline-block;
		max-width: 100%;
	}
<?php } ?>

<?php
if ( ! $version_bb_check ) {
	$settings->font_family = (array) $settings->font_family;
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a:visited {
		<?php if ( 'Default' !== $settings->font_family['family'] ) : ?>
			<?php UABB_Helper::uabb_font_css( $settings->font_family ); ?>
		<?php endif; ?>
		<?php if ( 'yes' === $converted || isset( $settings->font_size_unit ) && '' !== $settings->font_size_unit ) { ?>
			font-size: <?php echo esc_attr( $settings->font_size_unit ); ?>px;
			<?php if ( '' === $settings->line_height_unit && '' !== $settings->font_size_unit ) { ?>
				line-height: <?php echo esc_attr( $settings->font_size_unit + 2 ); ?>px;
			<?php } ?>		
		<?php } elseif ( isset( $settings->font_size_unit ) && '' === $settings->font_size_unit && isset( $settings->font_size ) && is_array( $settings->font_size ) && isset( $settings->font_size['desktop'] ) && '' !== $settings->font_size['desktop'] ) { ?>
			font-size: <?php echo esc_attr( $settings->font_size['desktop'] ); ?>px;
			line-height: <?php echo esc_attr( $settings->font_size['desktop'] + 2 ); ?>px;
		<?php } elseif ( isset( $settings->font_size_unit ) && '' === $settings->font_size_unit && isset( $settings->font_size ) && is_object( $settings->font_size ) && isset( $settings->font_size->desktop ) && '' !== $settings->font_size->desktop ) { ?>
			font-size: <?php echo esc_attr( $settings->font_size->desktop ); ?>px;
			line-height: <?php echo esc_attr( $settings->font_size->desktop + 2 ); ?>px; ?>
		<?php } ?>

		<?php if ( isset( $settings->font_size ) && is_array( $settings->font_size ) ) { ?>
			<?php if ( isset( $settings->font_size['desktop'] ) && '' === $settings->font_size['desktop'] && isset( $settings->line_height['desktop'] ) && '' !== $settings->line_height['desktop'] && '' === $settings->line_height_unit ) { ?>
					line-height: <?php echo esc_attr( $settings->line_height['desktop'] ); ?>px;
			<?php } ?>
		<?php } elseif ( isset( $settings->font_size ) && is_object( $settings->font_size ) ) { ?>
			<?php if ( isset( $settings->font_size->desktop ) && '' === $settings->font_size->desktop && isset( $settings->line_height->desktop ) && '' !== $settings->line_height->desktop && '' === $settings->line_height_unit ) { ?>
					line-height: <?php echo esc_attr( $settings->line_height->desktop ); ?>px;
			<?php } ?>
		<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->line_height_unit ) && '' !== $settings->line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->line_height_unit ); ?>em;	
		<?php } elseif ( isset( $settings->line_height_unit ) && '' === $settings->line_height_unit && isset( $settings->line_height ) && is_array( $settings->line_height ) && isset( $settings->line_height['desktop'] ) && '' !== $settings->line_height['desktop'] ) { ?>
			line-height: <?php echo esc_attr( $settings->line_height['desktop'] ); ?>px;
		<?php } elseif ( isset( $settings->line_height_unit ) && '' === $settings->line_height_unit && isset( $settings->line_height ) && is_object( $settings->line_height ) && isset( $settings->line_height->desktop ) && '' !== $settings->line_height->desktop ) { ?>
			line-height: <?php echo esc_attr( $settings->line_height->desktop ); ?>px;
		<?php } ?>
	}
	<?php
} else {
	if ( 'default' === $settings->style ) {

		$button_typo = uabb_theme_button_typography( $settings->button_typo );

		$settings->button_typo            = ( array_key_exists( 'desktop', $button_typo ) ) ? $button_typo['desktop'] : $settings->button_typo;
		$settings->button_typo_medium     = ( array_key_exists( 'tablet', $button_typo ) ) ? $button_typo['tablet'] : $settings->button_typo_medium;
		$settings->button_typo_responsive = ( array_key_exists( 'mobile', $button_typo ) ) ? $button_typo['mobile'] : $settings->button_typo_responsive;
	}

	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'button_typo',
				'selector'     => ".fl-node-$id .uabb-creative-button-wrap a,.fl-node-$id .uabb-creative-button-wrap a:visited",
			)
		);
	}
}
?>
<?php if ( 'default' !== $settings->style ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a:visited {
		<?php
		if ( 'custom' === $settings->width ) {
				$padding_top_bottom = ( '' !== $settings->padding_top_bottom ) ? esc_attr( $settings->padding_top_bottom ) : '0';
				$padding_left_right = ( '' !== $settings->padding_left_right ) ? esc_attr( $settings->padding_left_right ) : '0';
			?>

			padding-top: <?php echo esc_attr( $padding_top_bottom ); ?>px;
			padding-bottom: <?php echo esc_attr( $padding_top_bottom ); ?>px;
			padding-left: <?php echo esc_attr( $padding_left_right ); ?>px;
			padding-right: <?php echo esc_attr( $padding_left_right ); ?>px;
			<?php
		} else {
			echo 'padding:' . esc_attr( uabb_theme_button_padding( '' ) ) . ';';
		}

		$settings->border_radius = uabb_theme_button_border_radius( $settings->border_radius );
		if ( '' !== $settings->border_radius ) :
			?>
		border-radius: <?php echo esc_attr( $settings->border_radius ); ?>px;
		-moz-border-radius: <?php echo esc_attr( $settings->border_radius ); ?>px;
		-webkit-border-radius: <?php echo esc_attr( $settings->border_radius ); ?>px;
		<?php endif; ?>
		<?php if ( 'custom' === $settings->width ) : ?>
		width: <?php echo esc_attr( $settings->custom_width ); ?>px;
		min-height: <?php echo esc_attr( $settings->custom_height ); ?>px;
		display: -webkit-inline-box;
		display: -ms-inline-flexbox;
		display: inline-flex;
		-webkit-box-align: center;
		-ms-flex-align: center;
		align-items: center;
		-webkit-box-pack: center;
		-ms-flex-pack: center;
		justify-content: center;	
		<?php endif; ?>

		<?php if ( ! empty( $settings->bg_color ) ) : ?>
		background: <?php echo esc_attr( $settings->bg_color ); ?>;
		border: <?php echo esc_attr( $border_size ); ?>px solid <?php echo esc_attr( $border_color ); ?>;
			<?php
			if ( 'transparent' === $settings->style ) : // Transparent.
				?>
				background: none;
			<?php endif; ?>

			<?php if ( 'gradient' === $settings->style ) : // Gradient. ?>
			background: -moz-linear-gradient(top,  <?php echo esc_attr( $bg_grad_start ); ?> 0%, <?php echo esc_attr( $settings->bg_color ); ?> 100%); /* FF3.6+ */
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo esc_attr( $bg_grad_start ); ?>), color-stop(100%,<?php echo esc_attr( $settings->bg_color ); ?>)); /* Chrome,Safari4+ */
			background: -webkit-linear-gradient(top,  <?php echo esc_attr( $bg_grad_start ); ?> 0%,<?php echo esc_attr( $settings->bg_color ); ?> 100%); /* Chrome10+,Safari5.1+ */
			background: -o-linear-gradient(top,  <?php echo esc_attr( $bg_grad_start ); ?> 0%,<?php echo esc_attr( $settings->bg_color ); ?> 100%); /* Opera 11.10+ */
			background: -ms-linear-gradient(top,  <?php echo esc_attr( $bg_grad_start ); ?> 0%,<?php echo esc_attr( $settings->bg_color ); ?> 100%); /* IE10+ */
			background: linear-gradient(to bottom,  <?php echo esc_attr( $bg_grad_start ); ?> 0%,<?php echo esc_attr( $settings->bg_color ); ?> 100%); /* W3C */
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo esc_attr( $bg_grad_start ); ?>', endColorstr='<?php echo esc_attr( $settings->bg_color ); ?>',GradientType=0 ); /* IE6-9 */
			<?php endif; ?>
		<?php endif; ?>
	}
	<?php
} else {
	$padding_top_bottom = ( isset( $settings->button_padding_dimension_top ) && '' !== $settings->button_padding_dimension_top ) ? $settings->button_padding_dimension_top : uabb_theme_padding_button( 'desktop', 'top' );
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a:visited {
		<?php
		if ( isset( $settings->button_padding_dimension_top ) ) {
			echo ( '' !== $settings->button_padding_dimension_top ) ? 'padding-top:' . esc_attr( $settings->button_padding_dimension_top ) . 'px;' : 'padding-top:' . esc_attr( uabb_theme_padding_button( 'desktop', 'top' ) ) . ';';
		}
		if ( isset( $settings->button_padding_dimension_bottom ) ) {
			echo ( '' !== $settings->button_padding_dimension_bottom ) ? 'padding-bottom:' . esc_attr( $settings->button_padding_dimension_bottom ) . 'px;' : 'padding-bottom:' . esc_attr( uabb_theme_padding_button( 'desktop', 'bottom' ) ) . ';';
		}
		if ( isset( $settings->button_padding_dimension_left ) ) {
			echo ( '' !== $settings->button_padding_dimension_left ) ? 'padding-left:' . esc_attr( $settings->button_padding_dimension_left ) . 'px;' : 'padding-left:' . esc_attr( uabb_theme_padding_button( 'desktop', 'left' ) ) . ';';
		}
		if ( isset( $settings->button_padding_dimension_right ) ) {
			echo ( '' !== $settings->button_padding_dimension_right ) ? 'padding-right:' . esc_attr( $settings->button_padding_dimension_right ) . 'px;' : 'padding-right:' . esc_attr( uabb_theme_padding_button( 'desktop', 'right' ) ) . ';';
		}
		?>

	}
	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a:visited {
			<?php
			if ( isset( $settings->button_border_style ) ) {
				echo ( '' !== $settings->button_border_style && 'none' !== $settings->button_border_style ) ? 'border-style:' . esc_attr( $settings->button_border_style ) . ';' : 'border-style:solid;';
			}
			if ( isset( $settings->button_border_width ) && ! empty( $settings->button_border_width ) ) {
				echo ( '' !== $settings->button_border_width ) ? 'border-width:' . esc_attr( $settings->button_border_width ) . 'px;' : '';
			} else {

				$border_width = uabb_theme_button_border_width( '' );


				// Ensure $border_width is an array before performing array_key_exists checks.
				if ( is_array( $border_width ) ) {
					echo array_key_exists( 'top', $border_width ) ? 'border-top-width:' . esc_attr( $border_width['top'] ) . 'px;' : '';
					echo array_key_exists( 'left', $border_width ) ? 'border-left-width:' . esc_attr( $border_width['left'] ) . 'px;' : '';
					echo array_key_exists( 'right', $border_width ) ? 'border-right-width:' . esc_attr( $border_width['right'] ) . 'px;' : '';
					echo array_key_exists( 'bottom', $border_width ) ? 'border-bottom-width:' . esc_attr( $border_width['bottom'] ) . 'px;' : '';
				}
			}
			if ( isset( $settings->button_border_radius ) ) {
				echo ( '' !== $settings->button_border_radius ) ? 'border-radius:' . esc_attr( $settings->button_border_radius ) . 'px;' : 'border-radius:' . esc_attr( uabb_theme_button_border_radius( '' ) ) . 'px;';
			}
			if ( isset( $settings->button_border_color ) ) {
				echo ( '' !== $settings->button_border_color ) ? 'border-color:' . esc_attr( $settings->button_border_color ) . ';' : 'border-color:' . esc_attr( uabb_theme_border_color( '' ) ) . ';';
			}
			?>
		}
		<?php
	} else {
		$settings->button_border = uabb_theme_border( $settings->button_border );

		if ( class_exists( 'FLBuilderCSS' ) ) {
			// Border - Settings.
			FLBuilderCSS::border_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'button_border',
					'selector'     => ".fl-node-$id .uabb-module-content.uabb-creative-button-wrap a",
				)
			);
		}
	}
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a:visited {
		background: <?php echo esc_attr( uabb_theme_default_button_bg_color( $settings->bg_color ) ); ?>;

	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-module-content.uabb-creative-button-wrap a:hover {
		<?php echo ( '' !== $settings->border_hover_color ) ? 'border-color:' . esc_attr( $settings->border_hover_color ) . ';' : 'border-color:' . esc_attr( uabb_theme_border_hover_color( '' ) ) . ';'; ?>
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a:hover {
		background:<?php echo esc_attr( uabb_theme_default_button_bg_hover_color( $settings->bg_hover_color ) ); ?>;
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a *,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a:visited,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a:visited * {
		color: <?php echo esc_attr( uabb_theme_default_button_text_color( $settings->text_color ) ); ?>;
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a:hover,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a:hover * {
		color: <?php echo esc_attr( uabb_theme_default_button_text_hover_color( $settings->text_hover_color ) ); ?>;
	}
<?php } ?>
<?php if ( ! $version_bb_check ) { ?>
	<?php if ( isset( $settings->line_height ) && is_array( $settings->line_height ) && 'custom' === $settings->width && '' !== $settings->custom_height && ( isset( $settings->line_height['desktop'] ) && '' === $settings->line_height['desktop'] || ( intval( $settings->custom_height ) > intval( $settings->line_height['desktop'] ) ) ) ) { ?>

		html.internet-explorer .fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a,
		html.internet-explorer .fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a:visited {
		line-height: <?php echo esc_attr( $settings->custom_height ); ?>px;
		}

	<?php } elseif ( isset( $settings->line_height ) && is_object( $settings->line_height ) && 'custom' === $settings->width && '' !== $settings->custom_height && ( isset( $settings->line_height->desktop ) && '' === $settings->line_height->desktop || ( intval( $settings->custom_height ) > intval( $settings->line_height->desktop ) ) ) ) { ?>
		html.internet-explorer .fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a,
		html.internet-explorer .fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a:visited {
		line-height: <?php echo esc_attr( $settings->custom_height ); ?>px;
		}
	<?php } ?>
<?php } else { ?>
	<?php if ( is_array( $settings->button_typo ) ) { ?>
		<?php if ( isset( $settings->button_typo['line_height'] ) && is_array( $settings->button_typo['line_height'] ) && 'custom' === $settings->width && '' !== $settings->custom_height ) { ?>
			html.internet-explorer .fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a,
			html.internet-explorer .fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a:visited {
				line-height: <?php echo esc_attr( $settings->custom_height ); ?>px;
			}
		<?php } elseif ( isset( $settings->button_typo['line_height'] ) && is_object( $settings->button_typo['line_height'] ) && 'custom' === $settings->width && '' !== $settings->custom_height ) { ?>
			html.internet-explorer .fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a,
			html.internet-explorer .fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a:visited {
				line-height: <?php echo esc_attr( $settings->custom_height ); ?>px;
			}
		<?php } ?>
	<?php } elseif ( is_object( $settings->button_typo ) ) { ?>
			<?php if ( isset( $settings->button_typo->line_height ) && is_object( $settings->button_typo->line_height ) && 'custom' === $settings->width && '' !== $settings->custom_height ) { ?>
			html.internet-explorer .fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a,
			html.internet-explorer .fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a:visited {
				line-height: <?php echo esc_attr( $settings->custom_height ); ?>px;
			}
		<?php } elseif ( isset( $settings->button_typo->line_height ) && is_object( $settings->button_typo->line_height ) && 'custom' === $settings->width && '' !== $settings->custom_height ) { ?>
			html.internet-explorer .fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a,
			html.internet-explorer .fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a:visited {
				line-height: <?php echo esc_attr( $settings->custom_height ); ?>px;
			}
		<?php } ?>
	<?php } ?>
<?php } ?>

<?php
if ( 'custom' === $settings->width && '' !== $settings->custom_height ) :
	$translateText = intval( $settings->custom_height ) + ( $padding_top_bottom * 2 ) + 50; // @codingStandardsIgnoreLine.
	?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-flat-btn.uabb-animate_from_top-btn:hover .uabb-button-text {
	-webkit-transform: translateY(<?php echo $translateText; ?>px); <?php // @codingStandardsIgnoreLine. ?>
	-moz-transform: translateY(<?php echo $translateText; ?>px); <?php // @codingStandardsIgnoreLine. ?>
	-ms-transform: translateY(<?php echo $translateText; ?>px); <?php // @codingStandardsIgnoreLine. ?>
	-o-transform: translateY(<?php echo $translateText; ?>px); <?php // @codingStandardsIgnoreLine. ?>
	transform: translateY(<?php echo $translateText; ?>px);  <?php // @codingStandardsIgnoreLine. ?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-flat-btn.uabb-animate_from_bottom-btn:hover .uabb-button-text {
	-webkit-transform: translateY(-<?php echo $translateText; ?>px); <?php // @codingStandardsIgnoreLine. ?>
	-moz-transform: translateY(-<?php echo $translateText; ?>px); <?php // @codingStandardsIgnoreLine. ?>
	-ms-transform: translateY(-<?php echo $translateText; ?>px); <?php // @codingStandardsIgnoreLine. ?>
	-o-transform: translateY(-<?php echo $translateText; ?>px); <?php // @codingStandardsIgnoreLine. ?>
	transform: translateY(-<?php echo $translateText; ?>px); <?php // @codingStandardsIgnoreLine. ?>
}
<?php endif; ?>

<?php if ( ! empty( $settings->text_color ) && 'default' !== $settings->style ) : ?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a *,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a:visited,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a:visited * {
	color: <?php echo esc_attr( $settings->text_color ); ?>;
}
<?php endif; ?>

<?php if ( ! empty( $settings->bg_hover_color ) ) : ?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a:hover {
	<?php if ( 'transparent' !== $settings->style && 'gradient' !== $settings->style && 'default' !== $settings->style ) { ?>
		background: <?php echo esc_attr( $settings->bg_hover_color ); ?>;
	<?php } ?>
	<?php if ( 'default' !== $settings->style ) { ?>
		border: <?php echo esc_attr( $border_size ); ?>px solid <?php echo esc_attr( $border_hover_color ); ?>;
	<?php } ?>
	<?php if ( 'gradient' === $settings->style ) : // Gradient. ?>
	background: -moz-linear-gradient(top,  <?php echo esc_attr( $bg_hover_grad_start ); ?> 0%, <?php echo esc_attr( $settings->bg_hover_color ); ?> 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo esc_attr( $bg_hover_grad_start ); ?>), color-stop(100%,<?php echo esc_attr( $settings->bg_hover_color ); ?>)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  <?php echo esc_attr( $bg_hover_grad_start ); ?> 0%,<?php echo esc_attr( $settings->bg_hover_color ); ?> 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  <?php echo esc_attr( $bg_hover_grad_start ); ?> 0%,<?php echo esc_attr( $settings->bg_hover_color ); ?> 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  <?php echo esc_attr( $bg_hover_grad_start ); ?> 0%,<?php echo esc_attr( $settings->bg_hover_color ); ?> 100%); /* IE10+ */
	background: linear-gradient(to bottom,  <?php echo esc_attr( $bg_hover_grad_start ); ?> 0%,<?php echo esc_attr( $settings->bg_hover_color ); ?> 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo esc_attr( $bg_hover_grad_start ); ?>', endColorstr='<?php echo esc_attr( $settings->bg_hover_color ); ?>',GradientType=0 ); /* IE6-9 */
	<?php endif; ?>
}
<?php endif; ?>

<?php if ( ! empty( $settings->text_hover_color ) && 'default' !== $settings->style ) : ?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a:hover,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a:hover * {
	color: <?php echo esc_attr( $settings->text_hover_color ); ?>;
}
<?php endif; ?>

<?php
// Responsive button Alignment.
if ( $global_settings->responsive_enabled ) :
	?>
	@media ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ) . 'px'; ?> ) {
		<?php if ( 'default' === $settings->style ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a:visited {
				<?php
				if ( isset( $settings->button_padding_dimension_top_medium ) ) {
					echo ( '' !== $settings->button_padding_dimension_top_medium ) ? 'padding-top:' . esc_attr( $settings->button_padding_dimension_top_medium ) . 'px;' : 'padding-top:' . esc_attr( uabb_theme_padding_button( 'tablet', 'top' ) ) . ';';
				}
				if ( isset( $settings->button_padding_dimension_bottom_medium ) ) {
					echo ( '' !== $settings->button_padding_dimension_bottom_medium ) ? 'padding-bottom:' . esc_attr( $settings->button_padding_dimension_bottom_medium ) . 'px;' : 'padding-bottom:' . esc_attr( uabb_theme_padding_button( 'tablet', 'bottom' ) ) . ';';
				}
				if ( isset( $settings->button_padding_dimension_left_medium ) ) {
					echo ( '' !== $settings->button_padding_dimension_left_medium ) ? 'padding-left:' . esc_attr( $settings->button_padding_dimension_left_medium ) . 'px;' : 'padding-left:' . esc_attr( uabb_theme_padding_button( 'tablet', 'left' ) ) . ';';
				}
				if ( isset( $settings->button_padding_dimension_right_medium ) ) {
					echo ( '' !== $settings->button_padding_dimension_right_medium ) ? 'padding-right:' . esc_attr( $settings->button_padding_dimension_right_medium ) . 'px;' : 'padding-right:' . esc_attr( uabb_theme_padding_button( 'tablet', 'right' ) ) . ';';
				}
				?>

			}
		<?php } ?>
	}
	@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ); ?>px ) {
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap.uabb-creative-button-reponsive-<?php echo esc_attr( $settings->mob_align ); ?> {
			text-align: <?php echo esc_attr( $settings->mob_align ); ?>;
		}
		<?php if ( 'default' === $settings->style ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a:visited {
				<?php
				if ( isset( $settings->button_padding_dimension_top_responsive ) ) {
					echo ( '' !== $settings->button_padding_dimension_top_responsive ) ? 'padding-top:' . esc_attr( $settings->button_padding_dimension_top_responsive ) . 'px;' : 'padding-top:' . esc_attr( uabb_theme_padding_button( 'mobile', 'top' ) ) . ';';
				}
				if ( isset( $settings->button_padding_dimension_bottom_responsive ) ) {
					echo ( '' !== $settings->button_padding_dimension_bottom_responsive ) ? 'padding-bottom:' . esc_attr( $settings->button_padding_dimension_bottom_responsive ) . 'px;' : 'padding-bottom:' . esc_attr( uabb_theme_padding_button( 'mobile', 'bottom' ) ) . ';';
				}
				if ( isset( $settings->button_padding_dimension_left_responsive ) ) {
					echo ( '' !== $settings->button_padding_dimension_left_responsive ) ? 'padding-left:' . esc_attr( $settings->button_padding_dimension_left_responsive ) . 'px;' : 'padding-left:' . esc_attr( uabb_theme_padding_button( 'mobile', 'left' ) ) . ';';
				}
				if ( isset( $settings->button_padding_dimension_right_responsive ) ) {
					echo ( '' !== $settings->button_padding_dimension_right_responsive ) ? 'padding-right:' . esc_attr( $settings->button_padding_dimension_right_responsive ) . 'px;' : 'padding-right:' . esc_attr( uabb_theme_padding_button( 'mobile', 'right' ) ) . ';';
				}
				?>

			}
		<?php } ?>
	}
<?php endif; ?>

<?php /* Typography responsive layout starts here*/ ?>
<?php if ( ! $version_bb_check ) { ?>
	<?php
	if ( $global_settings->responsive_enabled ) { // Global Setting If started.
		if ( isset( $settings->font_size_unit_medium ) || isset( $settings->line_height_unit_medium ) || isset( $settings->line_height ) || isset( $settings->font_size ) || ( isset( $settings->font_size['medium'] ) && '' !== $settings->font_size['medium'] ) || ( isset( $settings->line_height['medium'] ) && '' !== $settings->line_height['medium'] || isset( $settings->width ) ) ) {
			/* Medium Breakpoint media query */
			?>
			@media ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ) . 'px'; ?> ) {
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a,
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a:visited {

					<?php if ( 'yes' === $converted || isset( $settings->font_size_unit_medium ) && '' !== $settings->font_size_unit_medium ) { ?>
						font-size: <?php echo esc_attr( $settings->font_size_unit_medium ); ?>px;
						<?php if ( 'custom' !== $settings->width && '' === $settings->line_height_unit_medium && '' !== $settings->font_size_unit_medium ) { ?>
							line-height: <?php $settings->font_size_unit_medium + 2; ?>px;
						<?php } ?>	
					<?php } elseif ( isset( $settings->font_size_unit_medium ) && isset( $settings->font_size ) && is_array( $settings->font_size ) && '' === $settings->font_size_unit_medium && isset( $settings->font_size['medium'] ) && '' !== $settings->font_size['medium'] ) { ?>
						font-size: <?php echo esc_attr( $settings->font_size['medium'] ); ?>px;
						line-height: <?php $settings->font_size['medium'] + 2; ?>px;
					<?php } elseif ( isset( $settings->font_size_unit_medium ) && isset( $settings->font_size ) && is_object( $settings->font_size ) && '' === $settings->font_size_unit_medium && isset( $settings->font_size->medium ) && '' !== $settings->font_size->medium ) { ?>
						font-size: <?php echo esc_attr( $settings->font_size->medium ); ?>px;
						line-height: <?php $settings->font_size->medium + 2; ?>px;
					<?php } ?>
					<?php if ( isset( $settings->font_size ) && is_array( $settings->font_size ) ) { ?>
						<?php if ( isset( $settings->font_size['medium'] ) && '' === $settings->font_size['medium'] && isset( $settings->line_height['medium'] ) && '' !== $settings->line_height['medium'] && '' === $settings->line_height_unit && '' === $settings->line_height_unit_medium ) { ?>
							line-height: <?php echo esc_attr( $settings->line_height['medium'] ); ?>px;
						<?php } ?>
					<?php } elseif ( isset( $settings->font_size ) && is_object( $settings->font_size ) ) { ?>
						<?php if ( isset( $settings->font_size->medium ) && '' === $settings->font_size->medium && isset( $settings->line_height->medium ) && '' !== $settings->line_height->medium && '' === $settings->line_height_unit && '' === $settings->line_height_unit_medium ) { ?>
								line-height: <?php echo esc_attr( $settings->line_height->medium ); ?>px;
						<?php } ?>
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->line_height_unit_medium ) && '' !== $settings->line_height_unit_medium ) { ?>
						line-height: <?php echo esc_attr( $settings->line_height_unit_medium ); ?>em;   
					<?php } elseif ( isset( $settings->line_height_unit_medium ) && isset( $settings->line_height ) && is_array( $settings->line_height ) && '' === $settings->line_height_unit_medium && isset( $settings->line_height['medium'] ) && '' !== $settings->line_height['medium'] ) { ?>
						line-height: <?php echo esc_attr( $settings->line_height['medium'] ); ?>px;
					<?php } elseif ( isset( $settings->line_height_unit_medium ) && isset( $settings->line_height ) && is_object( $settings->line_height ) && '' === $settings->line_height_unit_medium && isset( $settings->line_height->medium ) && '' !== $settings->line_height->medium ) { ?>
						line-height: <?php echo esc_attr( $settings->line_height->medium ); ?>px;
					<?php } ?>
				}
				<?php if ( 'custom' === $settings->width && '' !== $settings->custom_height && ( '' === $settings->line_height->medium || ( intval( $settings->custom_height ) > intval( $settings->line_height->medium ) ) ) ) : ?>
				html.internet-explorer .fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a,
				html.internet-explorer .fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a:visited {
					line-height: <?php echo esc_attr( $settings->custom_height ); ?>px;
				}
				<?php else : ?>
				html.internet-explorer .fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a,
				html.internet-explorer .fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a:visited {

					<?php if ( isset( $settings->font_size->medium ) && '' === $settings->font_size->medium && isset( $settings->line_height->medium ) && '' !== $settings->line_height->medium && '' === $settings->line_height_unit && '' === $settings->line_height_unit_medium ) { ?>
					line-height: <?php echo esc_attr( $settings->line_height->medium ); ?>px;
				<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->line_height_unit_medium ) && '' !== $settings->line_height_unit_medium ) { ?>
					line-height: <?php echo esc_attr( $settings->line_height_unit_medium ); ?>em;   
				<?php } elseif ( isset( $settings->line_height_unit_medium ) && '' === $settings->line_height_unit_medium && isset( $settings->line_height->medium ) && '' !== $settings->line_height->medium ) { ?>
					line-height: <?php echo esc_attr( $settings->line_height->medium ); ?>px;
				<?php } ?>

				}
				<?php endif; ?>
			}		
			<?php
		}
		if ( isset( $settings->font_size_unit_responsive ) || isset( $settings->line_height_unit_responsive ) || isset( $settings->font_size_unit_medium ) || isset( $settings->line_height_unit_medium ) || isset( $settings->line_height ) || isset( $settings->font_size ) || ( isset( $settings->font_size['small'] ) && '' !== $settings->font_size['small'] ) || ( isset( $settings->line_height['small'] ) && '' !== $settings->line_height['small'] || isset( $settings->width ) ) ) {
			/* Small Breakpoint media query */
			?>
			@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ) . 'px'; ?> ) {
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a,
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a:visited {

					<?php if ( 'yes' === $converted || isset( $settings->font_size_unit_responsive ) && '' !== $settings->font_size_unit_responsive ) { ?>
						font-size: <?php echo esc_attr( $settings->font_size_unit_responsive ); ?>px;
						<?php if ( '' === $settings->line_height_unit_responsive && '' !== $settings->font_size_unit_responsive ) { ?>
							line-height: <?php echo esc_attr( $settings->font_size_unit_responsive + 2 ); ?>px;
						<?php } ?>  
					<?php } elseif ( isset( $settings->font_size_unit_responsive ) && isset( $settings->font_size ) && is_array( $settings->font_size ) && '' === $settings->font_size_unit_responsive && isset( $settings->line_height['small'] ) && '' !== $settings->line_height['small'] ) { ?>
						font-size: <?php echo esc_attr( $settings->font_size['small'] ); ?>px;
						line-height: <?php echo esc_attr( $settings->font_size['small'] + 2 ); ?>px;
					<?php } elseif ( isset( $settings->font_size_unit_responsive ) && isset( $settings->font_size ) && is_object( $settings->font_size ) && '' === $settings->font_size_unit_responsive && isset( $settings->line_height->small ) && '' !== $settings->line_height->small ) { ?>
						font-size: <?php echo esc_attr( $settings->font_size->small ); ?>px;
						line-height: <?php echo esc_attr( $settings->font_size->small + 2 ); ?>px;
					<?php } ?>

					<?php if ( isset( $settings->font_size ) && is_array( $settings->font_size ) ) { ?>
						<?php if ( isset( $settings->font_size['small'] ) && '' === $settings->font_size['small'] && isset( $settings->line_height['small'] ) && '' !== $settings->line_height['small'] && '' === $settings->line_height_unit && '' === $settings->line_height_unit_medium && '' === $settings->line_height_unit_responsive ) { ?>
							line-height: <?php echo esc_attr( $settings->line_height['small'] ); ?>px;
						<?php } ?>
					<?php } elseif ( isset( $settings->font_size ) && is_object( $settings->font_size ) ) { ?>
						<?php if ( isset( $settings->font_size->small ) && '' === $settings->font_size->small && isset( $settings->line_height->small ) && '' !== $settings->line_height->small && '' === $settings->line_height_unit && '' === $settings->line_height_unit_medium && '' === $settings->line_height_unit_responsive ) { ?>
							line-height: <?php echo esc_attr( $settings->line_height->small ); ?>px;
						<?php } ?>
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->line_height_unit_responsive ) && '' !== $settings->line_height_unit_responsive ) { ?>
						line-height: <?php echo esc_attr( $settings->line_height_unit_responsive ); ?>em;
					<?php } elseif ( isset( $settings->line_height_unit_responsive ) && isset( $settings->line_height ) && is_array( $settings->line_height ) && '' === $settings->line_height_unit_responsive && isset( $settings->line_height['small'] ) && '' !== $settings->line_height['small'] ) { ?>
						line-height: <?php echo esc_attr( $settings->line_height['small'] ); ?>px;
					<?php } elseif ( isset( $settings->line_height_unit_responsive ) && isset( $settings->line_height ) && is_object( $settings->line_height ) && '' === $settings->line_height_unit_responsive && isset( $settings->line_height->small ) && '' !== $settings->line_height->small ) { ?>
						line-height: <?php echo esc_attr( $settings->line_height->small ); ?>px;
					<?php } ?> 
				}

				<?php if ( 'custom' === $settings->width && '' !== $settings->custom_height && ( '' === $settings->line_height->small || ( intval( $settings->custom_height ) > intval( $settings->line_height->small ) ) ) ) : ?>
				html.internet-explorer .fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a,
				html.internet-explorer .fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a:visited {
					line-height: <?php echo esc_attr( $settings->custom_height ); ?>px;
				}
				<?php else : ?>
				html.internet-explorer .fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a,
				html.internet-explorer .fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a:visited {

					<?php if ( isset( $settings->font_size->small ) && '' === $settings->font_size->small && isset( $settings->line_height->small ) && '' !== $settings->line_height->small && '' === $settings->line_height_unit && '' === $settings->line_height_unit_medium && '' === $settings->line_height_unit_responsive ) { ?>
						line-height: <?php echo esc_attr( $settings->line_height->small ); ?>px;
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->line_height_unit_responsive ) && '' !== $settings->line_height_unit_responsive ) { ?>
						line-height: <?php echo esc_attr( $settings->line_height_unit_responsive ); ?>em;
					<?php } elseif ( isset( $settings->line_height_unit_responsive ) && '' === $settings->line_height_unit_responsive && isset( $settings->line_height->small ) && '' !== $settings->line_height->small ) { ?>
						line-height: <?php echo esc_attr( $settings->line_height->small ); ?>px;
					<?php } ?> 

				}
				<?php endif; ?>
			}		
			<?php
		}
	}
}
/* Typography responsive layout Ends here*/
?>

<?php /* Transparent New Style CSS*/ ?>
<?php
if ( ! empty( $settings->style ) && 'transparent' === $settings->style ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-transparent-btn.uabb-none-btn:hover{
		<?php
		if ( 'none' === $settings->transparent_button_options ) {
			if ( 'border' === $settings->hover_attribute ) {
				?>
			border-color:<?php echo esc_attr( uabb_theme_base_color( $settings->bg_hover_color ) ); ?>;
				<?php
			} else {
				?>
			background:<?php echo esc_attr( uabb_theme_base_color( $settings->bg_hover_color ) ); ?>;
				<?php
			}
		} else {
			?>
		background:<?php echo esc_attr( uabb_theme_base_color( $settings->bg_hover_color ) ); ?>;
			<?php
		}
		?>
	}
	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-transparent-btn.uabb-none-btn:hover .uabb-creative-button-icon {
		<?php if ( '' !== $settings->text_hover_color && 'FFFFFF' !== $settings->text_hover_color && 'none' === $settings->transparent_button_options ) { ?>
			color: <?php echo esc_attr( $settings->text_hover_color ); ?>
		<?php } else { ?>
			color: <?php echo esc_attr( $settings->text_color ); ?>;
		<?php } ?>
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap a.uabb-creative-transparent-btn.uabb-none-btn:hover .uabb-creative-button-text {
		<?php if ( '' !== $settings->text_hover_color && 'FFFFFF' !== $settings->text_hover_color && 'none' === $settings->transparent_button_options ) { ?>
			color: <?php echo esc_attr( $settings->text_hover_color ); ?>
		<?php } else { ?>
			color: <?php echo esc_attr( $settings->text_color ); ?>;
		<?php } ?>
	}
	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-transparent-btn.uabb-transparent-fade-btn:hover{
		background: <?php echo esc_attr( uabb_theme_base_color( $settings->bg_hover_color ) ); ?>;
	}

	/*transparent-fill-top*/
	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-transparent-btn.uabb-transparent-fill-top-btn:hover:after{
		background: <?php echo esc_attr( uabb_theme_base_color( $settings->bg_hover_color ) ); ?>;
		height: 100%;
	}

	/*transparent-fill-bottom*/
	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-transparent-btn.uabb-transparent-fill-bottom-btn:hover:after{
		background: <?php echo esc_attr( uabb_theme_base_color( $settings->bg_hover_color ) ); ?>;
		height: 100%;
	}

	/*transparent-fill-left*/
	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-transparent-btn.uabb-transparent-fill-left-btn:hover:after{
		background: <?php echo esc_attr( uabb_theme_base_color( $settings->bg_hover_color ) ); ?>;
		width: 100%;
	}
	/*transparent-fill-right*/
	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-transparent-btn.uabb-transparent-fill-right-btn:hover:after{
		background: <?php echo esc_attr( uabb_theme_base_color( $settings->bg_hover_color ) ); ?>;
		width: 100%;
	}

	/*transparent-fill-center*/
	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-transparent-btn.uabb-transparent-fill-center-btn:hover:after{
		background: <?php echo esc_attr( uabb_theme_base_color( $settings->bg_hover_color ) ); ?>;
		height: calc( 100% + <?php echo esc_attr( $border_size ) . 'px'; ?> );
		width: calc( 100% + <?php echo esc_attr( $border_size ) . 'px'; ?> );
	}

	/* transparent-fill-diagonal */
	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-transparent-btn.uabb-transparent-fill-diagonal-btn:hover:after{
		background: <?php echo esc_attr( uabb_theme_base_color( $settings->bg_hover_color ) ); ?>;
		height: 260%;
	}

	/*transparent-fill-horizontal*/
	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-transparent-btn.uabb-transparent-fill-horizontal-btn:hover:after{
		background: <?php echo esc_attr( uabb_theme_base_color( $settings->bg_hover_color ) ); ?>;
		height: calc( 100% + <?php echo esc_attr( $border_size ) . 'px'; ?> );
		width: calc( 100% + <?php echo esc_attr( $border_size ) . 'px'; ?> );
	}



	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-transparent-fill-diagonal-btn:hover {
		background: none;
	}

	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-transparent-btn.uabb-<?php echo esc_attr( $settings->transparent_button_options ); ?>-btn:hover .uabb-creative-button-text{
		color: <?php echo esc_attr( uabb_theme_button_text_color( $settings->text_hover_color ) ); ?>;

		position: relative;
		z-index: 9;
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-<?php echo esc_attr( $settings->transparent_button_options ); ?>-btn:hover .uabb-creative-button-icon {
		color: <?php echo esc_attr( uabb_theme_button_text_color( $settings->text_hover_color ) ); ?>;
		position: relative;
		z-index: 9;
	}
	<?php
}
?>

<?php /* 3D New Style CSS*/ ?>
<?php
if ( ! empty( $settings->style ) && 'threed' === $settings->style ) {
	?>
	<?php /* 3D Move Down*/ ?>
	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-threed-btn.uabb-threed_down-btn{
		<?php $shadow_color = FLBuilderColor::hex_or_rgb( FLBuilderColor::adjust_brightness( $settings->bg_color, 10, 'darken' ) ); ?>
		box-shadow: 0 6px <?php echo esc_attr( uabb_theme_base_color( $shadow_color ) ); ?>;
	}
	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-threed-btn.uabb-threed_down-btn:hover{
		<?php $shadow_color = FLBuilderColor::hex_or_rgb( FLBuilderColor::adjust_brightness( $settings->bg_hover_color, 10, 'darken' ) ); ?>
		top: 2px;
		box-shadow: 0 4px <?php echo esc_attr( uabb_theme_base_color( $shadow_color ) ); ?>;
	}

	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-threed-btn.uabb-threed_down-btn:active{
		box-shadow:none!important;
		-webkit-transition:all 50ms linear;
		-moz-transition:all 50ms linear;
		transition:all 50ms linear;
		top: 6px;
	}


	<?php /* 3D Move Up*/ ?>
	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-threed-btn.uabb-threed_up-btn{
		<?php $shadow_color = FLBuilderColor::hex_or_rgb( FLBuilderColor::adjust_brightness( $settings->bg_color, 10, 'darken' ) ); ?>
		box-shadow: 0 -6px <?php echo esc_attr( uabb_theme_base_color( $shadow_color ) ); ?>;
	}
	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-threed-btn.uabb-threed_up-btn:hover{
		<?php $shadow_color = FLBuilderColor::hex_or_rgb( FLBuilderColor::adjust_brightness( $settings->bg_hover_color, 10, 'darken' ) ); ?>
		top: -2px;
		box-shadow: 0 -4px <?php echo esc_attr( uabb_theme_base_color( $shadow_color ) ); ?>;
	}

	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-threed-btn.uabb-threed_up-btn:active{
		box-shadow:none!important;
		-webkit-transition:all 50ms linear;
		-moz-transition:all 50ms linear;
		transition:all 50ms linear;
		top: -6px;
	}

	<?php /* 3D Move Left*/ ?>
	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-threed-btn.uabb-threed_left-btn{
		<?php $shadow_color = FLBuilderColor::hex_or_rgb( FLBuilderColor::adjust_brightness( $settings->bg_color, 10, 'darken' ) ); ?>
		box-shadow: -6px 0 <?php echo esc_attr( uabb_theme_base_color( $shadow_color ) ); ?>;
	}
	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-threed-btn.uabb-threed_left-btn:hover{
		<?php $shadow_color = FLBuilderColor::hex_or_rgb( FLBuilderColor::adjust_brightness( $settings->bg_hover_color, 10, 'darken' ) ); ?>
		left: -2px;
		box-shadow: -4px 0 <?php echo esc_attr( uabb_theme_base_color( $shadow_color ) ); ?>;
	}

	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-threed-btn.uabb-threed_left-btn:active {
		box-shadow:none!important;
		-webkit-transition:all 50ms linear;
		-moz-transition:all 50ms linear;
		transition:all 50ms linear;
		left: -6px;
	}


	<?php /* 3D Move Right*/ ?>
	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-threed-btn.uabb-threed_right-btn{
		<?php $shadow_color = FLBuilderColor::hex_or_rgb( FLBuilderColor::adjust_brightness( $settings->bg_color, 10, 'darken' ) ); ?>
		box-shadow: 6px 0 <?php echo esc_attr( uabb_theme_base_color( $shadow_color ) ); ?>;
	}

	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-threed-btn.uabb-threed_right-btn:hover{
		<?php $shadow_color = FLBuilderColor::hex_or_rgb( FLBuilderColor::adjust_brightness( $settings->bg_hover_color, 10, 'darken' ) ); ?>
		left: 2px;
		box-shadow: 4px 0 <?php echo esc_attr( uabb_theme_base_color( $shadow_color ) ); ?>;
	}

	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-threed-btn.uabb-threed_right-btn:active {
		box-shadow:none!important;
		-webkit-transition:all 50ms linear;
		-moz-transition:all 50ms linear;
		transition:all 50ms linear;
		left: 6px;
	}

	<?php /* Animate Background Color */ ?>
	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-threed-btn.uabb-<?php echo esc_attr( $settings->threed_button_options ); ?>-btn:hover:after{
		<?php $background_color = FLBuilderColor::hex_or_rgb( FLBuilderColor::adjust_brightness( $settings->bg_hover_color, 10, 'darken' ) ); ?>
		background: <?php echo esc_attr( $background_color ); ?>;
	}


	<?php /* Text Color*/ ?>
	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-threed-btn.uabb-<?php echo esc_attr( $settings->threed_button_options ); ?>-btn:hover .uabb-creative-button-text{
		color: <?php echo esc_attr( uabb_theme_base_color( $settings->text_hover_color ) ); ?>;
	}

	<?php /* 3D Padding for Shadow */ ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap {
		<?php if ( 'threed_down' === $settings->threed_button_options ) : ?>
			padding-bottom: 6px;
		<?php elseif ( 'threed_up' === $settings->threed_button_options ) : ?>
			padding-top: 6px;
		<?php elseif ( 'threed_left' === $settings->threed_button_options ) : ?>
			padding-left: 6px;
		<?php elseif ( 'threed_right' === $settings->threed_button_options ) : ?>
			padding-right: 6px;
		<?php endif; ?>

	}
	<?php
}
?>
