<?php 
    $settings->color = UABB_Helper::uabb_colorpicker( $settings, 'color' );
    $settings->desc_color = UABB_Helper::uabb_colorpicker( $settings, 'desc_color' );

    $settings->heading_margin_top = ( trim($settings->heading_margin_top) !== '' ) ? $settings->heading_margin_top : '0';
    $settings->heading_margin_bottom = ( trim($settings->heading_margin_bottom) !== '' ) ? $settings->heading_margin_bottom : '15';
    $settings->desc_margin_top = ( trim($settings->desc_margin_top) !== '' ) ? $settings->desc_margin_top : '15';
    $settings->desc_margin_bottom = ( trim($settings->desc_margin_bottom) !== '' ) ? $settings->desc_margin_bottom : '0';
    $settings->img_size = ( trim($settings->img_size) !== '' ) ? $settings->img_size : '50';

    if( $settings->separator_style != 'none' ) {
    	
    	$position = '0';
		if( $settings->alignment == 'center' ) {
			$position = '50';
		} elseif( $settings->alignment == 'right' ) {
			$position = '100';
		}

		$line_color = uabb_theme_base_color( $settings->separator_line_color );

		$separator_array = array(
			/* General Section */
			'separator' => $settings->separator_style,
			'style'		=> $settings->separator_line_style,
			'color'		=> $line_color,
			'height'	=> $settings->separator_line_height,
			'width'		=> ($settings->separator_line_width != '') ? $settings->separator_line_width : '30',
			'alignment'	=> $settings->alignment,
			'icon_photo_position'	=> $position,
			'icon_spacing'			=> '5',

			/* Icon Basics */
			'icon' => $settings->icon,
			'icon_size' => $settings->icon_size,
			'icon_align' => $settings->alignment,
			'icon_color' => $settings->separator_icon_color,


			/* Image Style */
			/*'image_style' => $settings->image_style,
			'img_bg_size' => $settings->img_bg_size,
			'img_border_style' => $settings->img_border_style,
			'img_border_width' => $settings->img_border_width,
			'img_bg_border_radius' => $settings->img_bg_border_radius,*/
			'responsive_img_size' => $settings->responsive_img_size,
			
			/* Image Basics */
			'img_size' => $settings->img_size,

			/* Text */
			'text_inline' => $settings->text_inline,
			'text_tag_selection' => $settings->separator_text_tag_selection,
			'text_font_family' => $settings->separator_text_font_family,
			'text_font_size' => $settings->separator_text_font_size,
			'text_line_height' => $settings->separator_text_line_height,
			'text_color' => $settings->separator_text_color,

		); 
		
		/* CSS Render Function */ 
    	// FLBuilder::render_module_css( 'advanced-separator', $id , $separator_array );
	}
?>

.fl-node-<?php echo $id; ?> <?php /* echo $settings->tag; */?>.uabb-heading {
	margin-top: <?php echo $settings->heading_margin_top; ?>px;
	margin-bottom: <?php echo $settings->heading_margin_bottom; ?>px;
}

.fl-node-<?php echo $id; ?> .uabb-subheading {
	margin-top: <?php echo $settings->desc_margin_top; ?>px;
	margin-bottom: <?php echo $settings->desc_margin_bottom; ?>px;
}

/* Heading Color */
.fl-node-<?php echo $id; ?> .fl-module-content.fl-node-content .uabb-heading,
.fl-node-<?php echo $id; ?> .fl-module-content.fl-node-content .uabb-heading .uabb-heading-text,
.fl-node-<?php echo $id; ?> .fl-module-content.fl-node-content .uabb-heading * {
	
	<?php if(!empty($settings->color)) : ?>
		color: <?php echo $settings->color; ?>;
	<?php endif; ?>
}

.fl-node-<?php echo $id; ?> <?php /* echo $settings->tag; */?>.uabb-heading,
.fl-node-<?php echo $id; ?> <?php /* echo $settings->tag; */?>.uabb-heading * {
	
	<?php if( !empty($settings->font) && $settings->font['family'] != 'Default' ) : ?>
		<?php UABB_Helper::uabb_font_css( $settings->font ); ?>
	<?php endif; ?>

	<?php if( $settings->new_font_size['desktop'] != '' ) : ?>
		font-size: <?php echo $settings->new_font_size['desktop']; ?>px;
	<?php elseif( isset( $settings->font_size ) && isset( $settings->custom_font_size ) && $settings->font_size == 'custom' && $settings->custom_font_size != '' ) : ?>
		font-size: <?php echo $settings->custom_font_size; ?>px;
	<?php endif; ?>

	<?php if( $settings->line_height['desktop'] != '' ) : ?>
	line-height: <?php echo $settings->line_height['desktop']; ?>px;
	<?php endif; ?>
}

/* Heading's Description Color */
.fl-node-<?php echo $id; ?> .fl-module-content.fl-node-content .uabb-module-content .uabb-text-editor {
	color: <?php echo uabb_theme_text_color( $settings->desc_color ); ?>;
}

/* Heading's Description Typography */
.fl-node-<?php echo $id; ?> .uabb-text-editor {
	
	<?php if( !empty($settings->desc_font_family) && $settings->desc_font_family['family'] != 'Default' ) : ?>
		<?php UABB_Helper::uabb_font_css( $settings->desc_font_family ); ?>
	<?php endif; ?>

	<?php if( $settings->desc_font_size['desktop'] != '' ) : ?>
		font-size: <?php echo $settings->desc_font_size['desktop']; ?>px;
	<?php endif; ?>
	<?php if( $settings->desc_line_height['desktop'] != '' ) : ?>
	line-height: <?php echo $settings->desc_line_height['desktop']; ?>px;
	<?php endif; ?>
}

<?php /* Global Setting If started */ ?>
<?php if($global_settings->responsive_enabled) { ?> 
    
        <?php /* Medium Breakpoint media query */  ?>
        @media ( max-width: <?php echo $global_settings->medium_breakpoint .'px'; ?> ) {

        	/* For Medium Device */
			.fl-node-<?php echo $id; ?> .uabb-responsive-medsmall .uabb-side-left,
			.fl-node-<?php echo $id; ?> .uabb-responsive-medsmall .uabb-side-right {
			    width: 20%;
			}

			.fl-node-<?php echo $id; ?> .uabb-responsive-medsmall .uabb-divider-content <?php echo $settings->separator_text_tag_selection; ?> {
			    white-space: normal;
			}


            .fl-node-<?php echo $id; ?> <?php /* echo $settings->tag; */?>.uabb-heading,
            .fl-node-<?php echo $id; ?> <?php /* echo $settings->tag; */?>.uabb-heading * { 
				<?php if( $settings->new_font_size['medium'] != '' ) : ?>
					font-size: <?php echo $settings->new_font_size['medium']; ?>px;
				<?php endif; ?>
				<?php if( $settings->line_height['medium'] != '' ) : ?>
					line-height: <?php echo $settings->line_height['medium']; ?>px;
				<?php endif; ?>
			}
			.fl-node-<?php echo $id; ?> .uabb-text-editor {
				<?php if( $settings->desc_font_size['medium'] != '' ) : ?>
					font-size: <?php echo $settings->desc_font_size['medium']; ?>px;
				<?php endif; ?>
				<?php if( $settings->desc_line_height['medium'] != '' ) : ?>
					line-height: <?php echo $settings->desc_line_height['medium']; ?>px;
				<?php endif; ?>
			}
        }
    
        <?php /* Small Breakpoint media query */ ?>
        @media ( max-width: <?php echo $global_settings->responsive_breakpoint .'px'; ?> ) {

        	/* For Small Device */
			.fl-node-<?php echo $id; ?> .uabb-responsive-mobile .uabb-side-left,
			.fl-node-<?php echo $id; ?> .uabb-responsive-mobile .uabb-side-right,
			.fl-node-<?php echo $id; ?> .uabb-responsive-medsmall .uabb-side-left,
			.fl-node-<?php echo $id; ?> .uabb-responsive-medsmall .uabb-side-right {
			    width: 10%;
			}

			.fl-node-<?php echo $id; ?> .uabb-responsive-mobile .uabb-divider-content <?php echo $settings->separator_text_tag_selection; ?> {
			    white-space: normal;
			}
        	
            .fl-node-<?php echo $id; ?> <?php /* echo $settings->tag; */?>.uabb-heading,
            .fl-node-<?php echo $id; ?> <?php /* echo $settings->tag; */?>.uabb-heading * { 
				<?php if( $settings->new_font_size['small'] != '' ) : ?>
					font-size: <?php echo $settings->new_font_size['small']; ?>px;
				<?php elseif( isset( $settings->r_font_size ) && isset( $settings->r_custom_font_size ) && $settings->r_font_size == 'custom' && $settings->r_custom_font_size != '' ) : ?>
					font-size: <?php echo $settings->r_custom_font_size; ?>px;
					line-height: <?php echo ( $settings->line_height['small'] != '' ) ? $settings->line_height['small'] : $settings->r_custom_font_size + 2; ?>px;
				<?php endif; ?>
				<?php if( $settings->line_height['small'] != '' ) : ?>
					line-height: <?php echo $settings->line_height['small']; ?>px;
				<?php endif; ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-text-editor {
				<?php if( $settings->desc_font_size['small'] != '' ) : ?>
					font-size: <?php echo $settings->desc_font_size['small']; ?>px;
				<?php endif; ?>
				<?php if( $settings->desc_line_height['small'] != '' ) : ?>
					line-height: <?php echo $settings->desc_line_height['small']; ?>px;
				<?php endif; ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-heading,
			.fl-node-<?php echo $id; ?> .uabb-subheading,
			.fl-node-<?php echo $id; ?> .uabb-subheading * {
				text-align: <?php echo $settings->r_custom_alignment; ?>;
			}

			<?php if( ( $settings->r_custom_alignment != $settings->alignment ) && $settings->separator_style != 'none' ) :
				$r_position = '0';
				if( $settings->r_custom_alignment == 'center' ) {
					$r_position = '50'; ?>
				
					.fl-node-<?php echo $id; ?> .uabb-separator-wrap.uabb-separator-<?php echo $settings->alignment; ?> {
						margin-left: auto;
						margin-right: auto;
					}

				<?php } elseif( $settings->r_custom_alignment == 'right' ) {
					$r_position = '100'; ?>
					
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

			.fl-node-<?php echo $id; ?> .uabb-separator-parent {
				text-align: <?php echo $settings->r_custom_alignment ?>;
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
}