<?php
/* Variable settings */
$settings->heading_color = UABB_Helper::uabb_colorpicker( $settings, 'heading_color' );
$settings->description_color = UABB_Helper::uabb_colorpicker( $settings, 'description_color' );
$settings->list_icon_border_color = UABB_Helper::uabb_colorpicker( $settings, 'list_icon_border_color' );
$settings->list_connector_color = UABB_Helper::uabb_colorpicker( $settings, 'list_connector_color' );

$settings->list_icon_bg_color = UABB_Helper::uabb_colorpicker( $settings, 'list_icon_bg_color', true );

$settings->icon_image_size = ( $settings->icon_image_size !== "" ) ? $settings->icon_image_size : '75';
$settings->list_icon_bg_padding = ( $settings->list_icon_bg_padding !== "" ) ?	$settings->list_icon_bg_padding : '10';
$settings->space_between_elements = ( $settings->space_between_elements !== "" ) ?	$settings->space_between_elements : '20';
$settings->list_icon_border_width = ( $settings->list_icon_border_width !== "" ) ?	$settings->list_icon_border_width : '1';
$settings->list_icon_bg_border_radius = ( $settings->list_icon_bg_border_radius !== "" ) ?	$settings->list_icon_bg_border_radius : '0';

/* If connector Yes execute this */
if ( $settings->list_connector_option == "yes" ) {
?>
	.fl-node-<?php echo $id;?> .uabb-info-list-connector,
	.fl-node-<?php echo $id;?> .uabb-info-list-connector-top {
		<?php if ( $settings->list_connector_color != "" ) { ?>
			color: <?php echo $settings->list_connector_color;?>;
		<?php } ?>
		<?php if ( $settings->list_connector_style != "" ) { ?>
			border-style: <?php echo $settings->list_connector_style;?>;
		<?php } ?>
	}
	<?php
		if ( $settings->list_icon_style === "custom" &&  $settings->list_icon_bg_padding != "" ) {
			$icon_extra_padding = $settings->list_icon_bg_padding;
			$icon_extra_padding_top = $settings->list_icon_bg_padding * 2;
			if ( $settings->list_icon_border_style != "none" ) {
				$icon_extra_padding = $icon_extra_padding + $settings->list_icon_border_width;
				$icon_extra_padding_top = $icon_extra_padding_top + $settings->list_icon_border_width * 2;
			}
		}else{
			$icon_extra_padding = 0;
			$icon_extra_padding_top = 0;
		}

		$space_element = 0;
		$space_element_top = 0;
		if( $settings->space_between_elements != '0' ) {
			$space_element += $settings->space_between_elements / 2;
			$space_element_top += $settings->space_between_elements / 2;
		}
	?>
	.fl-node-<?php echo $id;?> .uabb-info-list-connector {
		
		<?php if( $settings->align_items == 'center' ) : ?>
		top: calc( 50% + <?php echo ( $settings->icon_image_size / 2 ) + $icon_extra_padding - $space_element; ?>px );
		height: calc( 50% - <?php echo ( $settings->icon_image_size / 2 ) + $icon_extra_padding - $space_element; ?>px );
		<?php else : ?>
		top: <?php echo $settings->icon_image_size + $icon_extra_padding_top; ?>px;
		height: calc( 100% - <?php echo ( $settings->icon_image_size ) + $icon_extra_padding_top; ?>px );
		<?php endif; ?>
	}
	<?php if( $settings->align_items == 'center' ) : ?>
	.fl-node-<?php echo $id;?> .uabb-info-list-connector-top {
		height: calc( 50% - <?php echo ( ( $settings->icon_image_size / 2 ) + $icon_extra_padding + $space_element ); ?>px );
	}
	.fl-node-<?php echo $id;?> .uabb-info-list-item:last-child .uabb-info-list-connector-top {
		height: calc( 50% - <?php echo ( ( $settings->icon_image_size / 2 ) + $icon_extra_padding ); ?>px );
	}
	<?php endif; ?>
	
	.fl-node-<?php echo $id;?> .uabb-info-list-wrapper.uabb-info-list-top li .uabb-info-list-connector {
		border-top-style: <?php //echo $settings->list_connector_style;?>;
    	border-top-width: 1px;
    	/*width: 100%;
	    background: #000<?php //echo $settings->list_connector_color;?>;
	    height: 1px;*/
	}

<?php
}
?>


<?php
if( $settings->icon_position == 'left' || $settings->icon_position == 'right' ) {
	if( $settings->align_items == 'center' ) {
?>
	.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-info-list-icon {
		vertical-align: middle;
	}
	.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-info-list-content {
		vertical-align: middle;
	}
<?php
	}
}
?>

.fl-node-<?php echo $id;?> .uabb-info-list-wrapper .uabb-info-list-item:last-child {
	padding-bottom: 0;
}
	
<?php

/* Code As per Image position */
if( $settings->icon_position == "left" ){ ?>

	.fl-node-<?php echo $id;?> .uabb-info-list-content-wrapper.uabb-info-list-left .uabb-info-list-content {
		<?php
		if ( $settings->list_icon_style === "custom" &&  $settings->list_icon_bg_padding != "" ) {
			$extra_padding = $settings->list_icon_bg_padding * 2;
			if ( $settings->list_icon_border_style != "none" ) {
				$extra_padding = $extra_padding + $settings->list_icon_border_width * 2;
			}
		}else{
			$extra_padding = 0;
		}
		$icon_image_size = $settings->icon_image_size;

		?>
		width: calc( 100% - <?php echo $icon_image_size + 20 + $extra_padding;?>px );
	}
	.fl-node-<?php echo $id;?> .uabb-info-list-wrapper.uabb-info-list-left li .uabb-info-list-connector,
	.fl-node-<?php echo $id;?> .uabb-info-list-wrapper.uabb-info-list-left li .uabb-info-list-connector-top {
		<?php
		if ( $settings->list_icon_style === "custom" && $settings->list_icon_bg_padding != "" ) {
			$extra_padding = $settings->list_icon_bg_padding * 2 / 2; 
			if ( $settings->list_icon_border_style != "none" ) {
				$extra_padding = $extra_padding + $settings->list_icon_border_width;
			}
		}else{
			$extra_padding = 0;
		}
		$icon_image_size = $settings->icon_image_size;
		?>
		left: <?php echo $icon_image_size / 2 + $extra_padding ;?>px;
	}

	<?php if ( $settings->space_between_elements != "" ) { ?>
		.fl-node-<?php echo $id;?> .uabb-info-list-wrapper .uabb-info-list-item {
			padding-bottom: <?php echo $settings->space_between_elements;?>px;
		}
	<?php } ?>
<?php
} if( $settings->icon_position == "right" ){ ?>
	.fl-node-<?php echo $id;?> .uabb-info-list-content-wrapper.uabb-info-list-right .uabb-info-list-content {
		<?php
		if ( $settings->list_icon_style === "custom" &&  $settings->list_icon_bg_padding != "" ) {
			$extra_padding = $settings->list_icon_bg_padding * 2 ;
			if ( $settings->list_icon_border_style != "none" ) {
				$extra_padding = $extra_padding + $settings->list_icon_border_width * 2;
			}
		}else{
			$extra_padding = 0;
		} 
		$icon_image_size = $settings->icon_image_size;
		?>
		width: calc( 100% - <?php echo $icon_image_size + 20 + $extra_padding;?>px );
	}
	.fl-node-<?php echo $id;?> .uabb-info-list-wrapper.uabb-info-list-right li .uabb-info-list-connector,
	.fl-node-<?php echo $id;?> .uabb-info-list-wrapper.uabb-info-list-right li .uabb-info-list-connector-top {
		<?php
		if ( $settings->list_icon_style === "custom" && $settings->list_icon_bg_padding != "" ) {
			$extra_padding = $settings->list_icon_bg_padding * 2 / 2;
			if ( $settings->list_icon_border_style != "none" ) {
				$extra_padding = $extra_padding + $settings->list_icon_border_width;
			}
		}else{
			$extra_padding = 0;
		}
		
		$icon_image_size = $settings->icon_image_size;
		?>
		right: <?php echo $icon_image_size / 2 + $extra_padding ;?>px;
	}

	<?php if ( $settings->space_between_elements != "" ) { ?>
		.fl-node-<?php echo $id;?> .uabb-info-list-wrapper .uabb-info-list-item {
			padding-bottom: <?php echo $settings->space_between_elements;?>px;
		}
	<?php } ?>
<?php
} if( $settings->icon_position == "top" ){ ?>
	.fl-node-<?php echo $id;?> .uabb-info-list-wrapper.uabb-info-list-top li .uabb-info-list-connector {
		
		<?php if ( $settings->list_icon_style === "custom" &&  $settings->list_icon_bg_padding != "" ) {
			$extra_padding = $settings->list_icon_bg_padding;
			$extra_padding_top = $settings->list_icon_bg_padding * 2;
			if ( $settings->list_icon_border_style != "none" ) {
				$extra_padding = $extra_padding + $settings->list_icon_border_width;
				$extra_padding_top = $extra_padding_top + $settings->list_icon_border_width * 2;
			}
		}else{
			$extra_padding = 0;
			$extra_padding_top = 0;
		} ?>

		left: calc(50% + <?php echo $settings->icon_image_size / 2 + $extra_padding; ?>px);
		width: calc(100% - <?php echo $settings->icon_image_size + $extra_padding_top; ?>px);
		<?php
		if ( $settings->list_icon_style === "custom" &&  $settings->list_icon_bg_padding != "" ) {
			$extra_padding = $settings->list_icon_bg_padding;
			if ( $settings->list_icon_border_style != "none" ) {
				$extra_padding = $extra_padding + $settings->list_icon_border_width;
			}
		}else{
			$extra_padding = 0;
		}
		?>
		top: <?php echo ( $settings->icon_image_size / 2 ) + $extra_padding ;?>px;
	}
	
	<?php if ( $settings->space_between_elements != "" ) { ?>
		.fl-node-<?php echo $id;?> .uabb-info-list-wrapper .uabb-info-list-item {
			padding-bottom: <?php echo ( $settings->space_between_elements );?>px;
		}
	<?php } ?>

	@media all and (min-width:768px) {
		.fl-node-<?php echo $id;?> .uabb-info-list-wrapper.uabb-info-list-top li{
			width: <?php echo round( 100 / count( $settings->add_list_item ), 3 ) ?>%;
			display: inline-block;
		}
		<?php if ( $settings->space_between_elements != "" ) { ?>
			.fl-node-<?php echo $id;?> .uabb-info-list-wrapper .uabb-info-list-item {
				padding-right: <?php echo ( $settings->space_between_elements/2 );?>px;
				padding-left: <?php echo ( $settings->space_between_elements/2 );?>px;
				padding-bottom: 0;
			}
		<?php } ?>
	}
<?php
}
?>

<?php /* Assign Style to inner Items*/ 
	$list_item_counter = 0;
	foreach( $settings->add_list_item as $item ){

		/*if ( $settings->list_icon_style == 'simple' && ( $settings->icon_position == "right" || $settings->icon_position == "left" ) ) {
			if ( $item->image_type == 'icon' ) {
	?>
			.fl-node-<?php echo $id; ?> .uabb-info-list .uabb-info-list-icon .uabb-icon-wrap .uabb-icon i, 
			.fl-node-<?php echo $id; ?> .uabb-info-list .uabb-info-list-icon .uabb-icon-wrap .uabb-icon i:before {
			    width: 1.3em;
			    height: 1.3em;
			    line-height: 1.3em;
			}
	<?php
			} else if( $item->image_type == 'photo' ) {
	?>
			.fl-node-<?php echo $id; ?> .uabb-info-list .uabb-info-list-icon .uabb-imgicon-wrap .uabb-image img {
			    width: <?php echo $settings->icon_image_size * 1.3; ?>px;
			}
	<?php
			}
		}*/

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
            'icon_bg_size' => $settings->list_icon_bg_padding * 2,
            'icon_border_style' => $settings->list_icon_border_style,
            'icon_border_width' => $settings->list_icon_border_width,
            'icon_bg_border_radius' => $settings->list_icon_bg_border_radius,
         
            /* Image Style */
            'image_style' => $settings->list_icon_style,
            'img_bg_size' => $settings->list_icon_bg_padding,
            'img_border_style' => $settings->list_icon_border_style,
            'img_border_width' => $settings->list_icon_border_width,
            'img_bg_border_radius' => $settings->list_icon_bg_border_radius,

            /* Icon Colors */ 
		    'icon_color' => $item->icon_color,
		    'icon_hover_color' => "",
		    'icon_bg_color' => $settings->list_icon_bg_color,
		    'icon_bg_color_opc' => $settings->list_icon_bg_color_opc,
		    'icon_bg_hover_color' => "",
		    'icon_border_color' => $settings->list_icon_border_color,
		    'icon_border_hover_color' => "",
		    'icon_three_d' => "",
		 
		    /* Image Colors */
		    'img_bg_color' => $settings->list_icon_bg_color,
		    'img_bg_color_opc' => $settings->list_icon_bg_color_opc,
		    'img_bg_hover_color' => "",
		    'img_border_color' => $settings->list_icon_border_color,
		    'img_border_hover_color' => "",
        ); 
        /* CSS Render Function */ 
 		FLBuilder::render_module_css( 'image-icon', $id . " .info-list-icon-dynamic". $list_item_counter, $imageicon_array );

 		/* If No image no Icon selected than run this */
 		if( $item->image_type == "none" && ( !isset( $item->icon ) || !isset( $item->photo_src ) || !isset( $item->photo_url ) ) )
 		{
 		?>
 		.fl-node-<?php echo $id;?> .info-list-icon-dynamic<?php echo $list_item_counter;?> .uabb-imgicon-wrap {
 			
 			<?php if ( $settings->list_icon_style =="custom" ) { 
 				$custom_extra_width = $settings->list_icon_bg_padding * 2;
 				if ( $settings->list_icon_border_style != "none" ) {
					$custom_extra_width = $custom_extra_width + $settings->list_icon_border_width * 2;
				}
 			?>
 			border-radius: <?php echo $settings->list_icon_bg_border_radius; ?>px;
 			<?php if ( $settings->list_icon_border_style !="none" ) { ?>
 				border: <?php echo $settings->list_icon_border_width;?>px <?php echo $settings->list_icon_border_style;?> <?php echo uabb_theme_text_color( $settings->list_icon_border_color );?>;
 			<?php } ?>
 			<?php
 			}else{ $custom_extra_width = 0; } ?>

 			width: <?php echo $settings->icon_image_size + $custom_extra_width;?>px;
 			height: <?php echo $settings->icon_image_size + $custom_extra_width;?>px;
 			<?php if ( $item->image_type == "none" && ( $item->icon == "" || $item->photo || $item->photo_url == "" ) ) { ?>
			<?php if ( $settings->list_icon_style =="simple" ) { ?> 			
			background: <?php echo uabb_theme_base_color( '' );?>;
			<?php }else { ?>
 			background: <?php echo uabb_theme_base_color( $settings->list_icon_bg_color );?>;
 			<?php 
 				}
 			} ?>

 			<?php if ( $settings->list_icon_style =="circle" ) { ?>
 			border-radius: 50%;
 			<?php } ?>
 			<?php if ( $settings->icon_position =="top" ) { ?>
 			margin: auto;
 			<?php } ?>
 		}
 		<?php	
 		}
 		if( $item->image_type != "none" || ( ( isset( $item->icon ) && $item->icon != "" ) || ( isset( $item->photo_src ) && $item->photo_src != "" ) || ( isset( $item->photo_url ) && $item->photo_url != "" ) ) )
 		{
 		?>
	 		.fl-node-<?php echo $id;?> .info-list-icon-dynamic<?php echo $list_item_counter;?> .uabb-imgicon-wrap .uabb-photo-img {
	 			<?php if ( $settings->list_icon_style != "simple" && $item->image_type != "none" && ( $item->icon != "" || $item->photo !="" || $item->photo_url != "" ) ) { ?>
	 			background: <?php echo uabb_theme_base_color( $settings->list_icon_bg_color );?>;
	 			<?php } ?>
	 		}
	 	<?php 
	 	} 
	 	if( $item->image_type == "none" && $settings->icon_position != 'top' ) {
	 	?>
	 		.fl-node-<?php echo $id;?> .uabb-info-list-content-wrapper.<?php echo $settings->icon_position; ?> .info-list-content-dynamic<?php echo $list_item_counter;?> {
	 			width: 100%;
	 		}
 		<?php
 		}

 		
		if( $item->image_type == 'photo' && ( $settings->list_icon_style === "custom" || $settings->list_icon_style === "simple" ) ) :
			$img_size = array();
			if( $item->photo_source == 'library' && $item->photo != '' ) :
				$img_size = ( isset( FLBuilderPhoto::get_attachment_data($item->photo)->url ) ) ? getimagesize( FLBuilderPhoto::get_attachment_data($item->photo)->url ) : '';
			elseif( trim($item->photo_url) != '' ) :
				$img_size = getimagesize( $item->photo_url );
			endif;

			if( isset($img_size[0]) && isset($img_size[1]) ) :
				$actual_height = ( $settings->icon_image_size * $img_size[1] ) / $img_size[0];
				
				if( $actual_height > $settings->icon_image_size ) :
					$need_to_add = $actual_height - $settings->icon_image_size;
				else :
					$need_to_add = $settings->icon_image_size - $actual_height;
				endif; 


				if ( $settings->list_connector_option == "yes" ) : ?>

					.fl-node-<?php echo $id;?> .info-list-item-dynamic<?php echo $list_item_counter;?> .uabb-info-list-connector {
						<?php if( $settings->align_items == 'center' ) : ?>
						top: calc( 50% + <?php echo ( ( $settings->icon_image_size - $need_to_add ) / 2 ) + $icon_extra_padding - $space_element; ?>px );
						height: calc( 50% - <?php echo ( ( $settings->icon_image_size - $need_to_add ) / 2 ) + $icon_extra_padding - $space_element; ?>px );
						<?php else : ?>
						top: <?php echo ( $settings->icon_image_size - $need_to_add ) + $icon_extra_padding_top; ?>px;
						height: calc( 100% - <?php echo ( ( $settings->icon_image_size - $need_to_add ) ) + $icon_extra_padding_top; ?>px );
						<?php endif; ?>
					}

					<?php if( $settings->align_items == 'center' ) : ?>
					.fl-node-<?php echo $id;?> .info-list-item-dynamic<?php echo $list_item_counter;?> .uabb-info-list-connector-top {
						height: calc( 50% - <?php echo ( ( ( $settings->icon_image_size - $need_to_add ) / 2 ) + $icon_extra_padding + $space_element ); ?>px );
					}
					<?php endif;
				endif;
			endif;
		endif;

		$list_item_counter = $list_item_counter + 1;
	}
?>

.fl-node-<?php echo $id;?> .uabb-icon i {
	float: none;	
}
.fl-node-<?php echo $id;?> .uabb-icon {
	display: block;	
}


<?php 
/* Typography style starts here  */ 

if ( $settings->heading_font_family['family'] != "Default" || $settings->heading_font_size['desktop'] != '' || $settings->heading_line_height['desktop'] != '' || $settings->heading_color != '' || $settings->heading_margin_top != '' || $settings->heading_margin_bottom != '' ) { ?>
	.fl-node-<?php echo $id;?> .uabb-info-list-content .uabb-info-list-title{
		<?php if( $settings->heading_font_family['family'] != "Default") : ?>
			<?php UABB_Helper::uabb_font_css( $settings->heading_font_family ); ?>
		<?php endif; ?>
		<?php if( $settings->heading_font_size['desktop'] != '' ) : ?>
			font-size: <?php echo $settings->heading_font_size['desktop']; ?>px;
		<?php endif; ?>
		<?php if( $settings->heading_line_height['desktop'] != '' ) : ?>
			line-height: <?php echo $settings->heading_line_height['desktop']; ?>px;
		<?php endif; ?>
		<?php if( $settings->heading_color != '' ) : ?>
			color: <?php echo $settings->heading_color; ?>;
		<?php endif; ?>
		<?php if( $settings->heading_margin_top != '' ) : ?>
			margin-top: <?php echo $settings->heading_margin_top; ?>px;
		<?php endif; ?>
		<?php if( $settings->heading_margin_bottom != '' ) : ?>
			margin-bottom: <?php echo $settings->heading_margin_bottom; ?>px;
		<?php endif; ?>
	}
<?php } ?>

<?php
if ( $settings->description_font_family['family'] != "Default" || $settings->description_font_size['desktop'] != '' || $settings->description_line_height['desktop'] != '' || $settings->description_color != '' ) { ?>
	.fl-node-<?php echo $id;?> .uabb-info-list-content .uabb-info-list-description {
		<?php if( $settings->description_font_family['family'] != "Default") : ?>
			<?php UABB_Helper::uabb_font_css( $settings->description_font_family ); ?>
		<?php endif; ?>
		<?php if( $settings->description_font_size['desktop'] != '' ) : ?>
			font-size: <?php echo $settings->description_font_size['desktop']; ?>px;
		<?php endif; ?>
		<?php if( $settings->description_line_height['desktop'] != '' ) : ?>
			line-height: <?php echo $settings->description_line_height['desktop']; ?>px;
		<?php endif; ?>
		<?php if( $settings->description_color != '' ) : ?>
			color: <?php echo $settings->description_color; ?>;
		<?php endif; ?>
	}

<?php } 

/* Typography style Ends here  */ 
?>

/* Typography responsive layout starts here */ 

<?php if($global_settings->responsive_enabled) { // Global Setting If started 
	if( $settings->heading_font_size['medium'] !="" || $settings->heading_line_height['medium'] != "" || $settings->description_font_size['medium'] !="" || $settings->description_line_height['medium'] != "" ) {
	?>
		@media ( max-width: <?php echo $global_settings->medium_breakpoint .'px'; ?> ) {
			<?php if( $settings->heading_font_size['medium'] !="" || $settings->heading_line_height['medium'] != "" ) { ?>
				.fl-node-<?php echo $id;?> .uabb-info-list-content .uabb-info-list-title {
					<?php if( $settings->heading_font_size['medium'] != '' ) : ?>
						font-size: <?php echo $settings->heading_font_size['medium']; ?>px;
					<?php endif; ?>
					<?php if( $settings->heading_line_height['medium'] != '' ) : ?>
						line-height: <?php echo $settings->heading_line_height['medium']; ?>px;
					<?php endif; ?>
				}
			<?php } ?>

			<?php if( $settings->description_font_size['medium'] !="" || $settings->description_line_height['medium'] != "" ) { ?>
				.fl-node-<?php echo $id;?> .uabb-info-list-content .uabb-info-list-description {
					<?php if( $settings->description_font_size['medium'] != '' ) : ?>
						font-size: <?php echo $settings->description_font_size['medium']; ?>px;
					<?php endif; ?>
					<?php if( $settings->description_line_height['medium'] != '' ) : ?>
						line-height: <?php echo $settings->description_line_height['medium']; ?>px;
					<?php endif; ?>
				}

			<?php } ?>
	    }
	<?php
	}

	if( $settings->heading_font_size['small'] !="" || $settings->heading_line_height['small'] != "" || $settings->description_font_size['small'] !="" || $settings->description_line_height['small'] != "" || $settings->mobile_view == 'stack' ) {
	?>
		@media ( max-width: <?php echo $global_settings->responsive_breakpoint .'px'; ?> ) {
			<?php if( $settings->heading_font_size['small'] !="" || $settings->heading_line_height['small'] != "" ) { ?>
				.fl-node-<?php echo $id;?> .uabb-info-list-content .uabb-info-list-title {
					<?php if( $settings->heading_font_size['small'] != '' ) : ?>
						font-size: <?php echo $settings->heading_font_size['small']; ?>px;
					<?php endif; ?>
					<?php if( $settings->heading_line_height['small'] != '' ) : ?>
						line-height: <?php echo $settings->heading_line_height['small']; ?>px;
					<?php endif; ?>
				}
			<?php } ?>

			<?php if( $settings->description_font_size['small'] !="" || $settings->description_line_height['small'] != "" ) { ?>
				.fl-node-<?php echo $id;?> .uabb-info-list-content .uabb-info-list-description {
					<?php if( $settings->description_font_size['small'] != '' ) : ?>
						font-size: <?php echo $settings->description_font_size['small']; ?>px;
					<?php endif; ?>
					<?php if( $settings->description_line_height['small'] != '' ) : ?>
						line-height: <?php echo $settings->description_line_height['small']; ?>px;
					<?php endif; ?>
				}
			<?php } ?>

			<?php if( $settings->mobile_view == 'stack' ) { ?>
			.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-info-list-content-wrapper .uabb-info-list-icon {
				padding: 0;
				margin-bottom: 20px;
			}

			.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-info-list-content-wrapper .uabb-info-list-content,
			.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-info-list-content-wrapper .uabb-info-list-icon {
				display: block;
				width: 100%;
				text-align: center;
			}

			.fl-node-<?php echo $id;?> .uabb-info-list-wrapper.uabb-info-list-left li .uabb-info-list-connector,
			.fl-node-<?php echo $id;?> .uabb-info-list-wrapper.uabb-info-list-right li .uabb-info-list-connector,
			.fl-node-<?php echo $id;?> .uabb-info-list-wrapper.uabb-info-list-left li .uabb-info-list-connector-top,
			.fl-node-<?php echo $id;?> .uabb-info-list-wrapper.uabb-info-list-right li .uabb-info-list-connector-top {
				display: none;
			}
			<?php } ?>
	    }
	<?php
	}
}
?>
/* Typography responsive layout Ends here */