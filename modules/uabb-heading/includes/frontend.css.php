<?php
/**
 *  UABB Heading Module front-end CSS php file
 *
 *  @package UABB Heading Module
 */

global $post;
$version_bb_check = UABB_Lite_Compatibility::check_bb_version();
$converted        = UABB_Lite_Compatibility::check_old_page_migration();

	$settings->title_color = UABB_Helper::uabb_colorpicker( $settings, 'color' );
	$settings->desc_color  = UABB_Helper::uabb_colorpicker( $settings, 'desc_color' );
	$settings->bg_color    = UABB_Helper::uabb_colorpicker( $settings, 'bg_color' );

	$settings->heading_margin_top    = ( '' !== trim( $settings->heading_margin_top ) ) ? $settings->heading_margin_top : '0';
	$settings->heading_margin_bottom = ( '' !== trim( $settings->heading_margin_bottom ) ) ? $settings->heading_margin_bottom : '15';
	$settings->desc_margin_top       = ( '' !== trim( $settings->desc_margin_top ) ) ? $settings->desc_margin_top : '15';
	$settings->desc_margin_bottom    = ( '' !== trim( $settings->desc_margin_bottom ) ) ? $settings->desc_margin_bottom : '0';
	$settings->img_size              = ( '' !== trim( $settings->img_size ) ) ? $settings->img_size : '50';
	$settings->separator_line_color  = UABB_Helper::uabb_colorpicker( $settings, 'separator_line_color' );
	$settings->separator_text_color  = UABB_Helper::uabb_colorpicker( $settings, 'separator_text_color' );
	$settings->color                 = UABB_Helper::uabb_colorpicker( $settings, 'color' );
	$settings->img_size              = ( '' !== trim( $settings->img_size ) ) ? $settings->img_size : '50';
	$settings->separator_line_height = ( '' !== trim( $settings->separator_line_height ) ) ? $settings->separator_line_height : '1';
	$settings->separator_line_width  = ( '' !== trim( $settings->separator_line_width ) ) ? $settings->separator_line_width : '30';

if ( '' != $settings->separator_style ) {

	$position = '0';
	if ( 'center' == $settings->alignment ) {
		$position = '50';
	} elseif ( 'right' == $settings->alignment ) {
		$position = '100';
	}
}
?>
.fl-node-<?php echo $id; ?> .uabb-heading {
	margin-top: <?php echo $settings->heading_margin_top; ?>px;
	margin-bottom: <?php echo $settings->heading_margin_bottom; ?>px;
}

.fl-node-<?php echo $id; ?> .uabb-subheading {
	margin-top: <?php echo $settings->desc_margin_top; ?>px;
	margin-bottom: <?php echo $settings->desc_margin_bottom; ?>px;
}

.fl-node-<?php echo $id; ?> .fl-module-content.fl-node-content .uabb-heading,
.fl-node-<?php echo $id; ?> .fl-module-content.fl-node-content .uabb-heading .uabb-heading-text,
.fl-node-<?php echo $id; ?> .fl-module-content.fl-node-content .uabb-heading * {
	<?php if ( ! empty( $settings->title_color ) ) : ?>
		color:<?php echo $settings->title_color; ?>;
	<?php endif; ?>
}

.fl-node-<?php echo $id; ?> .uabb-heading .uabb-heading-text {
	<?php
	if ( isset( $settings->heading_padding_top ) ) {
		echo ( '' !== $settings->heading_padding_top ) ? 'padding-top:' . $settings->heading_padding_top . 'px;' : '';
	}
	if ( isset( $settings->heading_padding_right ) ) {
		echo ( '' !== $settings->heading_padding_right ) ? 'padding-right:' . $settings->heading_padding_right . 'px;' : '';
	}
	if ( isset( $settings->heading_padding_bottom ) ) {
		echo ( '' !== $settings->heading_padding_bottom ) ? 'padding-bottom:' . $settings->heading_padding_bottom . 'px;' : '';
	}
	if ( isset( $settings->heading_padding_left ) ) {
		echo ( '' !== $settings->heading_padding_left ) ? 'padding-left:' . $settings->heading_padding_left . 'px;' : '';
	}
	?>
}

<?php if ( isset( $settings->bg_color ) ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-heading .uabb-heading-text {
		<?php echo ( '' !== $settings->bg_color ) ? 'background:' . $settings->bg_color : ''; ?>
	}
<?php } ?>

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-heading,
	.fl-node-<?php echo $id; ?> .uabb-heading * {
		<?php if ( ! empty( $settings->font ) && 'Default' != $settings->font['family'] ) : ?>
			<?php UABB_Helper::uabb_font_css( $settings->font ); ?>
		<?php endif; ?>

		<?php if ( 'yes' === $converted || isset( $settings->new_font_size_unit ) && '' != $settings->new_font_size_unit ) { ?>
			font-size: <?php echo $settings->new_font_size_unit; ?>px; 
		<?php } elseif ( isset( $settings->new_font_size_unit ) && '' == $settings->new_font_size_unit && isset( $settings->new_font_size['desktop'] ) && '' != $settings->new_font_size['desktop'] ) { ?>
			font-size: <?php echo $settings->new_font_size['desktop']; ?>px;
		<?php } ?>

		<?php if ( isset( $settings->new_font_size['desktop'] ) && '' == $settings->new_font_size['desktop'] && isset( $settings->line_height['desktop'] ) && '' != $settings->line_height['desktop'] && '' == $settings->line_height_unit ) { ?>
			line-height: <?php echo $settings->line_height['desktop']; ?>px;
		<?php } ?>
		<?php if ( 'yes' === $converted || isset( $settings->line_height_unit ) && '' != $settings->line_height_unit ) { ?> 
			line-height: <?php echo $settings->line_height_unit; ?>em;
		<?php } elseif ( isset( $settings->line_height_unit ) && '' == $settings->line_height_unit && isset( $settings->line_height['desktop'] ) && '' != $settings->line_height['desktop'] ) { ?> 
			line-height: <?php echo $settings->line_height['desktop']; ?>px;
		<?php } ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'font_typo',
				'selector'     => ".fl-node-$id .fl-module-content.fl-node-content .uabb-heading .uabb-heading-text",
			)
		);
	}
}
?>
<?php /* Heading's Description Color */ ?>
.fl-node-<?php echo $id; ?> .fl-module-content.fl-node-content .uabb-module-content .uabb-text-editor {
	color: <?php echo uabb_theme_text_color( $settings->desc_color ); ?>;
}

<?php /* Heading's Description Typography */ ?>
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-text-editor {
		<?php if ( ! empty( $settings->desc_font_family ) && 'Default' != $settings->desc_font_family['family'] ) : ?>
			<?php UABB_Helper::uabb_font_css( $settings->desc_font_family ); ?>
		<?php endif; ?>

		<?php if ( 'yes' === $converted || isset( $settings->desc_font_size_unit ) && '' != $settings->desc_font_size_unit ) { ?>
			font-size: <?php echo $settings->desc_font_size_unit; ?>px;      
		<?php } elseif ( isset( $settings->desc_font_size_unit ) && '' == $settings->desc_font_size_unit && isset( $settings->desc_font_size['desktop'] ) && '' != $settings->desc_font_size['desktop'] ) { ?>
			font-size: <?php echo $settings->desc_font_size['desktop']; ?>px;
		<?php } ?>

		<?php if ( isset( $settings->desc_font_size['desktop'] ) && '' == $settings->desc_font_size['desktop'] && isset( $settings->desc_line_height['desktop'] ) && '' != $settings->desc_line_height['desktop'] && '' == $settings->desc_line_height_unit ) { ?>
			line-height: <?php echo $settings->desc_line_height['desktop']; ?>px;
		<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->desc_line_height_unit ) && '' != $settings->desc_line_height_unit ) { ?>
			line-height: <?php echo $settings->desc_line_height_unit; ?>em;  
		<?php } elseif ( isset( $settings->desc_line_height_unit ) && '' == $settings->desc_line_height_unit && isset( $settings->desc_line_height['desktop'] ) && '' != $settings->desc_line_height['desktop'] ) { ?>
			line-height: <?php echo $settings->desc_line_height['desktop']; ?>px;
		<?php } ?>

	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'desc_font_typo',
				'selector'     => ".fl-node-$id .uabb-text-editor",
			)
		);
	}
}
?>
<?php /* Global Setting If started */ ?>


.fl-node-<?php echo $id; ?> .uabb-separator-parent {
	line-height: 0;
	text-align: <?php echo ( 100 != $settings->separator_line_width ) ? $settings->alignment : 'center'; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-image-outter-wrap {
	width: <?php echo (int) $settings->img_size; ?>px;
}

<?php if ( 'line' == $settings->separator_style || 'line_text' == $settings->separator_style ) { ?> 
	.fl-node-<?php echo $id; ?> .uabb-separator {
		border-top:<?php echo $settings->separator_line_height; ?>px <?php echo $settings->separator_line_style; ?> <?php echo uabb_theme_base_color( $settings->separator_line_color ); ?>;
		width: <?php echo $settings->separator_line_width; ?>%;
		display: inline-block;
	}
<?php } ?>

<?php if ( 'line_icon' == $settings->separator_style || 'line_image' == $settings->separator_style || 'line_text' == $settings->separator_style ) { ?>

	<?php
	if ( 'line_image' == $settings->separator_style || 'line_icon' == $settings->separator_style ) {

		$imageicon_array = array(

			'image_type'          => ( 'line_image' == $settings->separator_style ) ? 'photo' : ( ( 'line_icon' == $settings->separator_style ) ? 'icon' : '' ),
			/* Icon Basics */
			'icon'                => $settings->icon,
			'icon_size'           => $settings->icon_size,
			'icon_align'          => 'center',

			/* Image Basics */
			'photo_source'        => $settings->photo_source,
			'photo'               => $settings->photo,
			'photo_url'           => $settings->photo_url,
			'img_size'            => $settings->img_size,
			'responsive_img_size' => $settings->responsive_img_size,
			'img_align'           => 'center', // $settings->img_align,
			'photo_src'           => ( isset( $settings->photo_src ) ) ? $settings->photo_src : '',

			/* Icon color */
			'icon_color'          => $settings->separator_icon_color,
		);

		/* CSS Render Function */
		FLBuilder::render_module_css( 'image-icon', $id, $imageicon_array );

		?>
	<?php } ?>

	<?php if ( 'line_icon' == $settings->separator_style ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-imgicon-wrap .uabb-icon i,
		.fl-node-<?php echo $id; ?> .uabb-imgicon-wrap .uabb-icon i:before {
			width: 1.3em;
			height: 1.3em;
			line-height: 1.3em;
		}
	<?php } ?>

	<?php if ( 'line_text' == $settings->separator_style ) { ?>
		.fl-node-<?php echo $id; ?> <?php echo $settings->separator_text_tag_selection; ?>.uabb-divider-text{
			white-space: nowrap;
			margin: 0;
			<?php echo ( ! empty( $settings->separator_text_color ) ) ? 'color: ' . $settings->separator_text_color . ';' : ''; ?>
		}
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo $id; ?> <?php echo $settings->separator_text_tag_selection; ?>.uabb-divider-text{
				<?php if ( 'Default' != $settings->separator_text_font_family['family'] ) { ?>
					<?php UABB_Helper::uabb_font_css( $settings->separator_text_font_family ); ?>
					<?php } ?>
				<?php if ( 'yes' === $converted || isset( $settings->separator_text_font_size_unit ) && '' != $settings->separator_text_font_size_unit ) { ?>
					font-size: <?php echo $settings->separator_text_font_size_unit; ?>px; 
				<?php } elseif ( isset( $settings->separator_text_font_size_unit ) && '' == $settings->separator_text_font_size_unit && isset( $settings->separator_text_font_size['desktop'] ) && '' != $settings->separator_text_font_size['desktop'] ) { ?>
					font-size: <?php echo $settings->separator_text_font_size['desktop']; ?>px;
				<?php } ?>

				<?php if ( isset( $settings->separator_text_font_size['desktop'] ) && '' == $settings->separator_text_font_size['desktop'] && isset( $settings->separator_text_line_height['desktop'] ) && '' != $settings->separator_text_line_height['desktop'] && '' == $settings->separator_text_line_height_unit ) { ?>
					line-height: <?php echo $settings->separator_text_line_height['desktop']; ?>px;
				<?php } ?>
				<?php if ( 'yes' === $converted || isset( $settings->separator_text_line_height_unit ) && '' != $settings->separator_text_line_height_unit ) { ?>
					line-height: <?php echo $settings->separator_text_line_height_unit; ?>em;
				<?php } elseif ( isset( $settings->separator_text_line_height_unit ) && '' == $settings->separator_text_line_height_unit && isset( $settings->separator_text_line_height['desktop'] ) && '' != $settings->separator_text_line_height['desktop'] ) { ?> 
					line-height: <?php echo $settings->separator_text_line_height['desktop']; ?>px;
				<?php } ?>
			}
			<?php
		} else {
			if ( class_exists( 'FLBuilderCSS' ) ) {
				$tag = $settings->separator_text_tag_selection;
				FLBuilderCSS::typography_field_rule(
					array(
						'settings'     => $settings,
						'setting_name' => 'separator_font_typo',
						'selector'     => ".fl-node-$id $tag.uabb-divider-text",
					)
				);
			}
		}
		?>
	<?php } ?>

	.fl-node-<?php echo $id; ?> .uabb-separator-wrap {
		width: <?php echo $settings->separator_line_width; ?>%;
		display: table;
	}

	<?php if ( 'center' == $settings->alignment ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-separator-wrap.uabb-separator-center {
		margin-left: auto;
		margin-right: auto;
	}
	<?php } ?>

	<?php if ( 'left' == $settings->alignment ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-separator-wrap.uabb-separator-left {
		margin-left: 0;
		margin-right: auto;
	}
	<?php } ?>

	<?php if ( 'right' == $settings->alignment ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-separator-wrap.uabb-separator-right {
		margin-left: auto;
		margin-right: 0;
	}
	<?php } ?>

	.fl-node-<?php echo $id; ?> .uabb-separator-line {
		display: table-cell;
		vertical-align:middle;
	}

	.fl-node-<?php echo $id; ?> .uabb-separator-line > span {
		border-top:<?php echo $settings->separator_line_height; ?>px <?php echo $settings->separator_line_style; ?> <?php echo uabb_theme_base_color( $settings->separator_line_color ); ?>;
		display: block;
		margin-top: 0 !important;
	}

	.fl-node-<?php echo $id; ?> .uabb-divider-content{
		padding-left: 5px;
		padding-right: 5px;
	}

	.fl-node-<?php echo $id; ?> .uabb-side-left{
		width: <?php echo $position; ?>%;
	}
	.fl-node-<?php echo $id; ?> .uabb-side-right{
		width: <?php echo ( 100 - $position ); ?>%;
	}

	.fl-node-<?php echo $id; ?> .uabb-divider-content {
		display: table-cell;
	}
	.fl-node-<?php echo $id; ?> .uabb-divider-content .uabb-icon-wrap{
		display: block;
	}

	<?php
}

if ( 'line_text' == $settings->separator_style || 'line_image' == $settings->separator_style ) {

	if ( $global_settings->responsive_enabled ) { // Global Setting If started.
		?>
		@media ( max-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {
			<?php if ( ! $version_bb_check ) { ?>
				.fl-node-<?php echo $id; ?> <?php echo $settings->separator_text_tag_selection; ?>.uabb-divider-text {
					<?php if ( 'yes' === $converted || isset( $settings->separator_text_font_size_unit_medium ) && '' != $settings->separator_text_font_size_unit_medium ) { ?>
						font-size: <?php echo $settings->separator_text_font_size_unit_medium; ?>px;
					<?php } elseif ( isset( $settings->separator_text_font_size_unit_medium ) && '' == $settings->separator_text_font_size_unit_medium && isset( $settings->separator_text_font_size['medium'] ) && '' != $settings->separator_text_font_size['medium'] ) { ?>
						font-size: <?php echo $settings->separator_text_font_size['medium']; ?>px;
						<?php } ?>
					<?php if ( isset( $settings->separator_text_font_size['medium'] ) && '' == $settings->separator_text_font_size['medium'] && isset( $settings->separator_text_line_height['medium'] ) && '' != $settings->separator_text_line_height['medium'] && '' == $settings->separator_text_line_height_unit_medium && '' == $settings->separator_text_line_height_unit ) { ?>
						line-height: <?php echo $settings->separator_text_line_height['medium']; ?>px;
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->separator_text_line_height_unit_medium ) && '' != $settings->separator_text_line_height_unit_medium ) { ?> 
						line-height: <?php echo $settings->separator_text_line_height_unit_medium; ?>em;
					<?php } elseif ( isset( $settings->separator_text_line_height_unit_medium ) && '' == $settings->separator_text_line_height_unit_medium && isset( $settings->separator_text_line_height['medium'] ) && '' != $settings->separator_text_line_height['medium'] ) { ?>
						line-height: <?php echo $settings->separator_text_line_height['medium']; ?>px;
						<?php } ?>

				}
			<?php } ?>
			<?php /* For Medium Device */ ?>
			.fl-node-<?php echo $id; ?> .uabb-responsive-medsmall .uabb-side-left {
				width: <?php echo ( $position * 40 / 100 ); ?>%;
			}
			.fl-node-<?php echo $id; ?> .uabb-responsive-medsmall .uabb-side-right {
				width: <?php echo 40 - ( $position * 40 / 100 ); ?>%;
			}
			.fl-node-<?php echo $id; ?> .uabb-responsive-medsmall .uabb-divider-content <?php echo $settings->separator_text_tag_selection; ?> {
				white-space: normal;
			}
		}
		@media ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {
			<?php if ( ! $version_bb_check ) { ?>
				.fl-node-<?php echo $id; ?> <?php echo $settings->separator_text_tag_selection; ?>.uabb-divider-text {

					<?php if ( 'yes' === $converted || isset( $settings->separator_text_font_size_unit_responsive ) && '' != $settings->separator_text_font_size_unit_responsive ) { ?>
						font-size: <?php echo $settings->separator_text_font_size_unit_responsive; ?>px;
					<?php } elseif ( isset( $settings->separator_text_font_size_unit_responsive ) && '' == $settings->separator_text_font_size_unit_responsive && isset( $settings->separator_text_font_size['small'] ) && '' != $settings->separator_text_font_size['small'] ) { ?>
						font-size: <?php echo $settings->separator_text_font_size['small']; ?>px;
					<?php } ?>
					<?php if ( isset( $settings->separator_text_font_size['small'] ) && '' == $settings->separator_text_font_size['small'] && isset( $settings->separator_text_line_height['small'] ) && '' != $settings->separator_text_line_height['small'] && '' == $settings->separator_text_line_height_unit_responsive && '' == $settings->separator_text_line_height_unit_medium && '' == $settings->separator_text_line_height_unit ) : ?>
							line-height: <?php echo $settings->separator_text_line_height['small']; ?>px;
					<?php endif; ?>
					<?php if ( 'yes' === $converted || isset( $settings->separator_text_line_height_unit_responsive ) && '' != $settings->separator_text_line_height_unit_responsive ) { ?> 
						line-height: <?php echo $settings->separator_text_line_height_unit_responsive; ?>em;
					<?php } elseif ( isset( $settings->separator_text_line_height_unit_responsive ) && '' == $settings->separator_text_line_height_unit_responsive && isset( $settings->separator_text_line_height['small'] ) && '' != $settings->separator_text_line_height['small'] ) { ?>
						line-height:<?php echo $settings->separator_text_line_height['small']; ?>px;
					<?php } ?>
				}
			<?php } ?>
			<?php if ( '' != $settings->responsive_img_size ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-image-outter-wrap {
				width: <?php echo ( 2 * ( $settings->img_border_width ) ) + ( 2 * ( $settings->img_size ) ) + ( $settings->responsive_img_size ); ?>px;
			}
			<?php } ?>

			<?php /* For Small Device */ ?>
			.fl-node-<?php echo $id; ?> .uabb-responsive-mobile .uabb-side-left,
			.fl-node-<?php echo $id; ?> .uabb-responsive-medsmall .uabb-side-left {
				width: <?php echo ( $position * 20 / 100 ); ?>%; 
			}
			.fl-node-<?php echo $id; ?> .uabb-responsive-mobile .uabb-side-right,
			.fl-node-<?php echo $id; ?> .uabb-responsive-medsmall .uabb-side-right {
				width: <?php echo 20 - ( $position * 20 / 100 ); ?>%; 
			}

			.fl-node-<?php echo $id; ?> .uabb-responsive-mobile .uabb-divider-content <?php echo $settings->separator_text_tag_selection; ?> {
				white-space: normal;
			}
		}
		<?php
	}
}
?>
<?php if ( $global_settings->responsive_enabled ) { ?>
		<?php /* Medium Breakpoint media query */ ?>
		@media ( max-width: <?php echo $global_settings->medium_breakpoint . 'px'; ?> ) {

			<?php /* For Medium Device */ ?>
			.fl-node-<?php echo $id; ?> .uabb-responsive-medsmall .uabb-side-left,
			.fl-node-<?php echo $id; ?> .uabb-responsive-medsmall .uabb-side-right {
				width: 20%;
			}

			.fl-node-<?php echo $id; ?> .uabb-responsive-medsmall .uabb-divider-content <?php echo $settings->separator_text_tag_selection; ?> {
				white-space: normal;
			}
			<?php if ( ! $version_bb_check ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-heading,
				.fl-node-<?php echo $id; ?> .uabb-heading * { 

					<?php if ( 'yes' === $converted || isset( $settings->new_font_size_unit_medium ) && '' != $settings->new_font_size_unit_medium ) { ?>
						font-size: <?php echo $settings->new_font_size_unit_medium; ?>px;
					<?php } elseif ( isset( $settings->new_font_size_unit_medium ) && '' == $settings->new_font_size_unit_medium && isset( $settings->new_font_size['medium'] ) && '' != $settings->new_font_size['medium'] ) { ?>
						font-size: <?php echo $settings->new_font_size['medium']; ?>px;
					<?php } ?>

					<?php if ( isset( $settings->new_font_size['medium'] ) && '' == $settings->new_font_size['medium'] && isset( $settings->line_height['medium'] ) && '' != $settings->line_height['medium'] && '' == $settings->line_height_unit && '' == $settings->line_height_unit_medium ) { ?>
						line-height: <?php echo $settings->line_height['medium']; ?>px;
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->line_height_unit_medium ) && '' != $settings->line_height_unit_medium ) { ?>
						line-height: <?php echo $settings->line_height_unit_medium; ?>em;   
					<?php } elseif ( isset( $settings->line_height_unit_medium ) && '' == $settings->line_height_unit_medium && isset( $settings->line_height['medium'] ) && '' != $settings->line_height['medium'] ) { ?>
						line-height: <?php echo $settings->line_height['medium']; ?>px;
					<?php } ?>

				}
			<?php } ?>
			<?php if ( ! $version_bb_check ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-text-editor {

					<?php if ( 'yes' === $converted || isset( $settings->desc_font_size_unit_medium ) && '' != $settings->desc_font_size_unit_medium ) { ?>
						font-size: <?php echo $settings->desc_font_size_unit_medium; ?>px;
					<?php } elseif ( isset( $settings->desc_font_size_unit_medium ) && '' == $settings->desc_font_size_unit_medium && isset( $settings->desc_font_size['medium'] ) && '' != $settings->desc_font_size['medium'] ) { ?>
						font-size: <?php echo $settings->desc_font_size['medium']; ?>px;
					<?php } ?>

					<?php if ( isset( $settings->desc_font_size['medium'] ) && '' == $settings->desc_font_size['medium'] && isset( $settings->desc_line_height['medium'] ) && '' != $settings->desc_line_height['medium'] && '' == $settings->desc_line_height_unit && '' == $settings->desc_line_height_unit_medium ) { ?>
						line-height: <?php echo $settings->desc_line_height['medium']; ?>px;
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->desc_line_height_unit_medium ) && '' != $settings->desc_line_height_unit_medium ) { ?>
						line-height: <?php echo $settings->desc_line_height_unit_medium; ?>em;   
					<?php } elseif ( isset( $settings->desc_line_height_unit_medium ) && '' == $settings->desc_line_height_unit_medium && isset( $settings->desc_line_height['medium'] ) && '' != $settings->desc_line_height['medium'] ) { ?>
						line-height: <?php echo $settings->desc_line_height['medium']; ?>px;
					<?php } ?>
				}
			<?php } ?>
			.fl-node-<?php echo $id; ?> .uabb-heading .uabb-heading-text {
				<?php
				if ( isset( $settings->heading_padding_top_medium ) ) {
					echo ( '' !== $settings->heading_padding_top_medium ) ? 'padding-top:' . $settings->heading_padding_top_medium . 'px;' : '';
				}
				if ( isset( $settings->heading_padding_right_medium ) ) {
					echo ( '' !== $settings->heading_padding_right_medium ) ? 'padding-right:' . $settings->heading_padding_right_medium . 'px;' : '';
				}
				if ( isset( $settings->heading_padding_bottom_medium ) ) {
					echo ( '' !== $settings->heading_padding_bottom_medium ) ? 'padding-bottom:' . $settings->heading_padding_bottom_medium . 'px;' : '';
				}
				if ( isset( $settings->heading_padding_left_medium ) ) {
					echo ( '' !== $settings->heading_padding_left_medium ) ? 'padding-left:' . $settings->heading_padding_left_medium . 'px;' : '';
				}
				?>
			}
		}
		<?php /* Small Breakpoint media query */ ?>
		@media ( max-width: <?php echo $global_settings->responsive_breakpoint . 'px'; ?> ) {
			<?php /* For Small Device */ ?>
			.fl-node-<?php echo $id; ?> .uabb-responsive-mobile .uabb-side-left,
			.fl-node-<?php echo $id; ?> .uabb-responsive-mobile .uabb-side-right,
			.fl-node-<?php echo $id; ?> .uabb-responsive-medsmall .uabb-side-left,
			.fl-node-<?php echo $id; ?> .uabb-responsive-medsmall .uabb-side-right {
				width: 10%;
			}

			.fl-node-<?php echo $id; ?> .uabb-responsive-mobile .uabb-divider-content <?php echo $settings->separator_text_tag_selection; ?> {
				white-space: normal;
			}
			<?php if ( ! $version_bb_check ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-heading,
				.fl-node-<?php echo $id; ?> .uabb-heading * { 

					<?php if ( 'yes' === $converted || isset( $settings->new_font_size_unit_responsive ) && '' != $settings->new_font_size_unit_responsive ) { ?> 
						font-size: <?php echo $settings->new_font_size_unit_responsive; ?>px;
					<?php } elseif ( isset( $settings->new_font_size_unit_responsive ) && '' == $settings->new_font_size_unit_responsive && isset( $settings->new_font_size['small'] ) && '' != $settings->new_font_size['small'] ) { ?>
						font-size: <?php echo $settings->new_font_size['small']; ?>px;
					<?php } ?>
					<?php if ( isset( $settings->new_font_size['small'] ) && '' == $settings->new_font_size['small'] && isset( $settings->line_height['small'] ) && '' != $settings->line_height['small'] && '' == $settings->line_height_unit_responsive && '' == $settings->line_height_unit_medium && '' == $settings->line_height_unit ) : ?>
						line-height: <?php echo $settings->line_height['small']; ?>px;
					<?php endif; ?>
					<?php if ( 'yes' === $converted || isset( $settings->line_height_unit_responsive ) && '' != $settings->line_height_unit_responsive ) { ?> 
						line-height: <?php echo $settings->line_height_unit_responsive; ?>em;
					<?php } elseif ( isset( $settings->line_height_unit_responsive ) && '' == $settings->line_height_unit_responsive && isset( $settings->line_height['small'] ) && '' != $settings->line_height['small'] ) { ?>
						line-height: <?php echo $settings->line_height['small']; ?>px;
					<?php } ?>
				}
			<?php } ?>
			<?php if ( ! $version_bb_check ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-text-editor {

					<?php if ( 'yes' === $converted || isset( $settings->desc_font_size_unit_responsive ) && '' != $settings->desc_font_size_unit_responsive ) { ?> 
						font-size: <?php echo $settings->desc_font_size_unit_responsive; ?>px;
					<?php } elseif ( isset( $settings->desc_font_size_unit_responsive ) && '' == $settings->desc_font_size_unit_responsive && isset( $settings->desc_font_size['small'] ) && '' != $settings->desc_font_size['small'] ) { ?>
						font-size: <?php echo $settings->desc_font_size['small']; ?>px;
					<?php } ?>
					<?php if ( isset( $settings->desc_font_size['small'] ) && '' == $settings->desc_font_size['small'] && isset( $settings->desc_line_height['small'] ) && '' != $settings->desc_line_height['small'] && '' == $settings->desc_line_height_unit_responsive && '' == $settings->desc_line_height_unit_medium && '' == $settings->desc_line_height_unit ) : ?>
							line-height: <?php echo $settings->desc_line_height['small']; ?>px;
					<?php endif; ?>
					<?php if ( 'yes' === $converted || isset( $settings->desc_line_height_unit_responsive ) && '' != $settings->desc_line_height_unit_responsive ) { ?> 
						line-height: <?php echo $settings->desc_line_height_unit_responsive; ?>em;
					<?php } elseif ( isset( $settings->desc_line_height_unit_responsive ) && '' == $settings->desc_line_height_unit_responsive && isset( $settings->desc_line_height['small'] ) && '' != $settings->desc_line_height['small'] ) { ?>
						line-height: <?php echo $settings->desc_line_height['small']; ?>px;
					<?php } ?>
				}
			<?php } ?>
			.fl-node-<?php echo $id; ?> .uabb-heading .uabb-heading-text {
				<?php
				if ( isset( $settings->heading_padding_top_responsive ) ) {
					echo ( '' !== $settings->heading_padding_top_responsive ) ? 'padding-top:' . $settings->heading_padding_top_responsive . 'px;' : '';
				}
				if ( isset( $settings->heading_padding_right_responsive ) ) {
					echo ( '' !== $settings->heading_padding_right_responsive ) ? 'padding-right:' . $settings->heading_padding_right_responsive . 'px;' : '';
				}
				if ( isset( $settings->heading_padding_bottom_responsive ) ) {
					echo ( '' !== $settings->heading_padding_bottom_responsive ) ? 'padding-bottom:' . $settings->heading_padding_bottom_responsive . 'px;' : '';
				}
				if ( isset( $settings->heading_padding_left_responsive ) ) {
					echo ( '' !== $settings->heading_padding_left_responsive ) ? 'padding-left:' . $settings->heading_padding_left_responsive . 'px;' : '';
				}
				?>
			}
			.fl-node-<?php echo $id; ?> .uabb-heading,
			.fl-node-<?php echo $id; ?> .uabb-subheading,
			.fl-node-<?php echo $id; ?> .uabb-subheading * {
				text-align: <?php echo $settings->r_custom_alignment; ?>;
			}

			<?php
			if ( ( $settings->alignment != $settings->r_custom_alignment ) && 'none' != $settings->separator_style ) :
				$r_position = '0';
				if ( 'center' == $settings->r_custom_alignment ) {
					$r_position = '50';
					?>
					.fl-node-<?php echo $id; ?> .uabb-separator-wrap.uabb-separator-<?php echo $settings->alignment; ?> {
						margin-left: auto;
						margin-right: auto;
					}
					<?php
				} elseif ( 'right' == $settings->r_custom_alignment ) {
					$r_position = '100';
					?>
					.fl-node-<?php echo $id; ?> .uabb-separator-wrap.uabb-separator-<?php echo $settings->alignment; ?> {
						margin-left: auto;
						margin-right: 0;
					}
				<?php } else { ?>
					.fl-node-<?php echo $id; ?> .uabb-separator-wrap.uabb-separator-<?php echo $settings->alignment; ?> {
						margin-left: 0;
						margin-right: auto;
					}
				<?php } ?>

			.fl-node-<?php echo $id; ?> .uabb-heading-wrapper .uabb-separator-parent {
				text-align: <?php echo $settings->r_custom_alignment; ?>;
			}
			.fl-node-<?php echo $id; ?> .uabb-side-left {
				width: <?php echo $r_position; ?>%;
			}
			.fl-node-<?php echo $id; ?> .uabb-side-right {
				width: <?php echo 100 - $r_position; ?>%;
			}
			<?php endif; ?>
		}
	<?php
} ?>
