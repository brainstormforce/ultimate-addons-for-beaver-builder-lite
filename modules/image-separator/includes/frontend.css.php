<?php
/**
 *  UABB Image Separator Module front-end CSS php file
 *
 *  @package UABB Image Separator Module
 */

$settings->img_bg_color       = UABB_Helper::uabb_colorpicker( $settings, 'img_bg_color', true );
$settings->img_bg_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'img_bg_hover_color', true );

$settings->img_border_color       = UABB_Helper::uabb_colorpicker( $settings, 'img_border_color' );
$settings->img_border_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'img_border_hover_color' );

?>

<?php
	$settings->gutter    = ( '' != $settings->gutter ) ? $settings->gutter : '50';
	$settings->gutter_lr = ( '' != $settings->gutter_lr ) ? $settings->gutter_lr : '50';
?>
.fl-node-<?php echo $id; ?> {
	max-width: 100%;
	<?php
	if ( ! empty( $settings->img_size ) ) :
		$margin_left  = '' != $settings->margin_left ? $settings->margin_left : '20';
		$margin_right = '' != $settings->margin_right ? $settings->margin_right : '20';
		?>
		width: <?php echo $settings->img_size + $margin_left + $margin_right; ?>px;
	<?php endif; ?>
}
<?php if ( 'bottom' == $settings->image_position ) { ?>
	.fl-node-<?php echo $id; ?> {
		bottom: 0;
		top: auto;
		<?php if ( 'left' == $settings->image_position_lr ) { ?>
		left: <?php echo $settings->gutter_lr; ?>%;
		right: auto;
		-webkit-transform: translate(0%, <?php echo $settings->gutter; ?>%);
		-moz-transform: translate(0%, <?php echo $settings->gutter; ?>%);
			transform: translate(0%, <?php echo $settings->gutter; ?>%);
		<?php } elseif ( 'right' == $settings->image_position_lr ) { ?>
		right: <?php echo $settings->gutter_lr; ?>%;
		left: auto;
		-webkit-transform: translate(0%, <?php echo $settings->gutter; ?>%);
		-moz-transform: translate(0%, <?php echo $settings->gutter; ?>%);
				transform: translate(0%, <?php echo $settings->gutter; ?>%);
		<?php } else { ?>
		-webkit-transform: translate(-50%, <?php echo $settings->gutter; ?>%);
		-moz-transform: translate(-50%, <?php echo $settings->gutter; ?>%);
				transform: translate(-50%, <?php echo $settings->gutter; ?>%);
		<?php } ?>
	}
<?php } ?>

<?php if ( 'top' == $settings->image_position ) { ?>
	.fl-node-<?php echo $id; ?> {
		top: 0;
		bottom: auto;
		<?php if ( 'left' == $settings->image_position_lr ) { ?>
		left: <?php echo $settings->gutter_lr; ?>%;
		right: auto;
		-webkit-transform: translate(0%, -<?php echo $settings->gutter; ?>%);
		-moz-transform: translate(0%, -<?php echo $settings->gutter; ?>%);
				transform: translate(0%, -<?php echo $settings->gutter; ?>%);
		<?php } elseif ( 'right' == $settings->image_position_lr ) { ?>
		right: <?php echo $settings->gutter_lr; ?>%;
		left: auto;
		-webkit-transform: translate(0%, -<?php echo $settings->gutter; ?>%);
		-moz-transform: translate(0%, -<?php echo $settings->gutter; ?>%);
				transform: translate(0%, -<?php echo $settings->gutter; ?>%);
		<?php } else { ?>
		-webkit-transform: translate(-50%, -<?php echo $settings->gutter; ?>%);
		-moz-transform: translate(-50%, -<?php echo $settings->gutter; ?>%);
				transform: translate(-50%, -<?php echo $settings->gutter; ?>%);
		<?php } ?>
	}
<?php } ?>


/*.fl-node-<?php echo $id; ?>,*/
.fl-node-<?php echo $id; ?> .uabb-image .uabb-photo-img {
	<?php if ( ! empty( $settings->img_size ) ) : ?>
		width: <?php echo $settings->img_size; ?>px;
	<?php endif; ?>

	<?php /* Border Style */ ?>
	<?php if ( 'custom' == $settings->image_style ) : ?>

		<?php if ( 'none' != $settings->img_border_style ) : ?>
			border-style: <?php echo $settings->img_border_style; ?>;
		<?php endif; ?>

		background: <?php echo uabb_theme_base_color( $settings->img_bg_color ); ?>;

		<?php if ( ! empty( $settings->img_bg_size ) ) : ?>
			padding: <?php echo $settings->img_bg_size; ?>px;
		<?php endif; ?>

		border-width: <?php echo ( '' != $settings->img_border_width ) ? $settings->img_border_width : '1'; ?>px;

		<?php if ( ! empty( $settings->img_border_color ) ) : ?>
			border-color: <?php echo $settings->img_border_color; ?>;
		<?php endif; ?>

		border-radius: <?php echo ( empty( $settings->img_bg_border_radius ) ) ? '0' : $settings->img_bg_border_radius; ?>px;
	<?php endif; ?>
}

/* Responsive Photo Size */
<?php if ( $global_settings->responsive_enabled ) { // Global Setting If started. ?> 
		@media ( max-width: <?php echo $global_settings->medium_breakpoint . 'px'; ?> ) {
			<?php if ( '' != $settings->medium_img_size ) { ?>
				.fl-node-<?php echo $id; ?> {
					<?php
					$margin_left  = '' != $settings->margin_left ? $settings->margin_left : '20';
					$margin_right = '' != $settings->margin_right ? $settings->margin_right : '20';
					?>

					width: <?php echo $settings->medium_img_size + $margin_left + $margin_right; ?>px;
					}

				.fl-node-<?php echo $id; ?> .uabb-image .uabb-photo-img {
					width: <?php echo $settings->medium_img_size; ?>px;
				}
			<?php } ?>

			<?php
			if ( ( 'left' == $settings->image_position_lr || 'right' == $settings->image_position_lr ) && 'both' == $settings->responsive_center ) {
				if ( 'bottom' == $settings->image_position ) {
					?>
				.fl-node-<?php echo $id; ?> {
					/*bottom: 0;
					top: auto;*/
					right: auto;
					left: 50%;
					-webkit-transform: translate(-50%, 50%);
					-moz-transform: translate(-50%, 50%);
					transform: translate(-50%, 50%);
				}
					<?php
				} elseif ( 'top' == $settings->image_position ) {
					?>
					.fl-node-<?php echo $id; ?> {
						/*bottom: 0;
						top: auto;*/
						right: auto;
						left: 50%;
						-webkit-transform: translate(-50%, -50%);
						-moz-transform: translate(-50%, -50%);
						transform: translate(-50%, -50%);
					}
					<?php
				}
			}
			?>
		}

		@media ( max-width: <?php echo $global_settings->responsive_breakpoint . 'px'; ?> ) {
			<?php if ( '' != $settings->small_img_size ) { ?>
				.fl-node-<?php echo $id; ?> {
					<?php
					$margin_left  = '' != $settings->margin_left ? $settings->margin_left : '20';
					$margin_right = '' != $settings->margin_right ? $settings->margin_right : '20';
					?>

					width: <?php echo $settings->small_img_size + $margin_left + $margin_right; ?>px;
					}

				.fl-node-<?php echo $id; ?> .uabb-image .uabb-photo-img {
					width: <?php echo $settings->small_img_size; ?>px;
				}
			<?php } ?>

			<?php
			if ( ( 'left' == $settings->image_position_lr || 'right' == $settings->image_position_lr ) && 'small' == $settings->responsive_center ) {
				if ( 'bottom' == $settings->image_position ) {
					?>
				.fl-node-<?php echo $id; ?> {
					/*bottom: 0;
					top: auto;*/
					right: auto;
					left: 50%;
					-webkit-transform: translate(-50%, 50%);
					-moz-transform: translate(-50%, 50%);
					transform: translate(-50%, 50%);
				}
					<?php
				} elseif ( 'top' == $settings->image_position ) {
					?>
					.fl-node-<?php echo $id; ?> {
						right: auto;
						left: 50%;
						-webkit-transform: translate(-50%, -50%);
						-moz-transform: translate(-50%, -50%);
						transform: translate(-50%, -50%);
					}
					<?php
				}
			}
			?>

		}
<?php } ?>

/* Animation CSS */
<?php if ( '' != $settings->img_animation_repeat && '0' != $settings->img_animation_repeat && '1' != $settings->img_animation_repeat ) { ?>
.fl-node-<?php echo $id; ?> .animated {
	-webkit-animation-iteration-count: <?php echo $settings->img_animation_repeat; ?>;
			animation-iteration-count: <?php echo $settings->img_animation_repeat; ?>;
}
<?php } ?>

.fl-node-<?php echo $id; ?> .imgseparator-link:hover ~ .uabb-image .uabb-photo-img {

	<?php if ( 'custom' == $settings->image_style ) : ?>
		<?php if ( ! empty( $settings->img_bg_hover_color ) ) : ?>
			background: <?php echo $settings->img_bg_hover_color; ?>;
		<?php endif; ?>

		<?php if ( ! empty( $settings->img_border_hover_color ) ) : ?>
			border-color: <?php echo $settings->img_border_hover_color; ?>;
		<?php endif; ?>
	<?php endif; ?>

}



