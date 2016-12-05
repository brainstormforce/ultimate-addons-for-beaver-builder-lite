<?php 

$uabb_options = UABB_Init::$uabb_options['fl_builder_uabb'];
$enable_row_separator = true;

if ( !empty( $uabb_options ) && array_key_exists( 'uabb-row-separator', $uabb_options ) ) {
	if ( $uabb_options['uabb-row-separator'] == 1 ) {
		$enable_row_separator = true;
	}else{
		$enable_row_separator = false;
	}
}

if ( $enable_row_separator ) {
	/* Row Extended Setting CSS */
	$rows_object = $nodes['rows'];

	foreach ( $nodes['rows'] as $row_object ) {
									
		$id = $row_object->node;
		$row = $row_object->settings;
		$row->separator_color = UABB_Helper::uabb_colorpicker( $row, 'separator_color', true );
		$row->bot_separator_color = UABB_Helper::uabb_colorpicker( $row, 'bot_separator_color', true );
		
		if( $row->separator_shape == 'round_split' ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-top-row-separator.uabb-round-split:before {
				    background-color: <?php echo $row->separator_color; ?>;
				    height: <?php echo $row->separator_shape_height; ?>px;
				    top: 0px;
				    bottom: auto;
				    border-radius: 0 0 50px 0 !important;
				}

				.fl-node-<?php echo $id; ?> .uabb-top-row-separator.uabb-round-split:after {
				    background-color: <?php echo $row->separator_color; ?>;
				    height: <?php echo $row->separator_shape_height; ?>px;
				    left: 50%;
				    top: 0px;
				    bottom: auto;
				    border-radius: 0 0 0 50px !important;
				}
		<?php } ?>

		<?php if( $row->bot_separator_shape == 'round_split' ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-bottom-row-separator.uabb-round-split:before {
			    background-color: <?php echo $row->bot_separator_color; ?>;
			    height: <?php echo $row->bot_separator_shape_height; ?>px;
			    top: auto;
			    bottom: 0px;
			    border-radius: 0 50px 0 0 !important;
			}

			.fl-node-<?php echo $id; ?> .uabb-bottom-row-separator.uabb-round-split:after {
			    background-color: <?php echo $row->bot_separator_color; ?>;
			    height: <?php echo $row->bot_separator_shape_height; ?>px;
			    left: 50%;
			    top: auto;
			    bottom: 0px;
			    border-radius: 50px 0 0 0 !important;
			}
	<?php 
		}

		/* Responsive Sizes */
		if($global_settings->responsive_enabled) { // Responsive Sizes
			if( $row->separator_shape_height_medium != '' || $row->bot_separator_shape_height_medium != '' ) { ?>
			@media(max-width: <?php echo $global_settings->medium_breakpoint; ?>px) {
				<?php if( $row->separator_shape_height_medium != '' ) { ?>
					<?php if ( $row->separator_shape == 'round_split' ) { ?>
					.fl-node-<?php echo $id; ?> .uabb-top-row-separator.uabb-round-split:before,
					.fl-node-<?php echo $id; ?> .uabb-top-row-separator.uabb-round-split:after {
					    height: <?php echo $row->separator_shape_height_medium; ?>px;
					}
					<?php }else{ ?>
					.fl-node-<?php echo $id; ?> .uabb-top-row-separator svg {
					    height: <?php echo $row->separator_shape_height_medium; ?>px;
					}
					<?php } ?>
				<?php } ?>
				<?php if( $row->bot_separator_shape_height_medium != '' ) { ?>
					<?php if ( $row->bot_separator_shape == 'round_split' ) { ?>
					.fl-node-<?php echo $id; ?> .uabb-bottom-row-separator.uabb-round-split:before,
					.fl-node-<?php echo $id; ?> .uabb-bottom-row-separator.uabb-round-split:after {
					    height: <?php echo $row->bot_separator_shape_height_medium; ?>px;
					}
					<?php }else{ ?>
					.fl-node-<?php echo $id; ?> .uabb-bottom-row-separator svg {
					    height: <?php echo $row->bot_separator_shape_height_medium; ?>px;
					}
					<?php } ?>
				<?php } ?>
			}
			<?php }
			if( $row->separator_shape_height_small != '' || $row->bot_separator_shape_height_small != '' ) { ?>
			@media(max-width: <?php echo $global_settings->responsive_breakpoint; ?>px) {
				<?php if( $row->separator_shape_height_small != '' ) { ?>
					<?php if ( $row->separator_shape == 'round_split' ) { ?>
					.fl-node-<?php echo $id; ?> .uabb-top-row-separator.uabb-round-split:before,
					.fl-node-<?php echo $id; ?> .uabb-top-row-separator.uabb-round-split:after {
					    height: <?php echo $row->separator_shape_height_small; ?>px;
					}
					<?php }else{ ?>
					.fl-node-<?php echo $id; ?> .uabb-top-row-separator svg {
					    height: <?php echo $row->separator_shape_height_small; ?>px;
					}
					<?php } ?>
				<?php } ?>
				<?php if( $row->bot_separator_shape_height_small != '' ) { ?>
					<?php if ( $row->bot_separator_shape == 'round_split' ) { ?>
					.fl-node-<?php echo $id; ?> .uabb-bottom-row-separator.uabb-round-split:before,
					.fl-node-<?php echo $id; ?> .uabb-bottom-row-separator.uabb-round-split:after {
					    height: <?php echo $row->bot_separator_shape_height_small; ?>px;
					}
					<?php }else{ ?>
					.fl-node-<?php echo $id; ?> .uabb-bottom-row-separator svg {
					    height: <?php echo $row->bot_separator_shape_height_small; ?>px;
					}
					<?php } ?>
				<?php } ?>
			}
			<?php }
		}
	}
}
?>

/* Column Extended Settings CSS*/

<?php
/* Column Extended Settings CSS*/
$columns = $nodes['columns'];

foreach($columns as $id=>$col) {
	
	$parent = $nodes['groups'][$col->parent]->parent; 

?>
	<?php if($global_settings->responsive_enabled) : // Responsive Sizes ?>
		<?php if(!empty($col->settings->border_type)) : // Border ?>
		<?php if($col->settings->hide_border_mobile == 'yes') : ?>
		@media(max-width: <?php echo $global_settings->responsive_breakpoint; ?>px) {
			.fl-builder-content .fl-node-<?php echo $col->node; ?> .fl-col-content {
				border: none;
			}
		}
		<?php endif; ?>
		<?php endif; ?>
	<?php endif; ?>

<?php } ?>
/* Column End Extended Settings CSS*/
