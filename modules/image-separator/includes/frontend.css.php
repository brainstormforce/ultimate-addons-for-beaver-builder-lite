<?php
/**
 *  UABB Image Separator Module front-end CSS php file
 *
 *  @package UABB Image Separator Module
 */

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

$settings->img_bg_color       = FLBuilderColor::hex_or_rgb( $settings->img_bg_color );
$settings->img_bg_hover_color = FLBuilderColor::hex_or_rgb( $settings->img_bg_hover_color );

$settings->img_border_color       = FLBuilderColor::hex_or_rgb( $settings->img_border_color );
$settings->img_border_hover_color = FLBuilderColor::hex_or_rgb( $settings->img_border_hover_color );

?>

<?php
	$settings->gutter    = ( '' !== $settings->gutter ) ? $settings->gutter : '50';
	$settings->gutter_lr = ( '' !== $settings->gutter_lr ) ? $settings->gutter_lr : '50';
?>
.fl-node-<?php echo esc_attr( $id ); ?> {
	max-width: 100%;
	<?php
	if ( ! empty( $settings->img_size ) ) :
		$margin_left  = '' !== $settings->margin_left ? $settings->margin_left : '20';
		$margin_right = '' !== $settings->margin_right ? $settings->margin_right : '20';
		?>
		width: <?php echo esc_attr( $settings->img_size ) + $margin_left + $margin_right; ?>px;
	<?php endif; ?>
}
<?php if ( 'bottom' === $settings->image_position ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> {
		bottom: 0;
		top: auto;
		<?php if ( 'left' === $settings->image_position_lr ) { ?>
		left: <?php echo esc_attr( $settings->gutter_lr ); ?>%;
		right: auto;
		-webkit-transform: translate(0%, <?php echo esc_attr( $settings->gutter ); ?>%);
		-moz-transform: translate(0%, <?php echo esc_attr( $settings->gutter ); ?>%);
			transform: translate(0%, <?php echo esc_attr( $settings->gutter ); ?>%);
		<?php } elseif ( 'right' === $settings->image_position_lr ) { ?>
		right: <?php echo esc_attr( $settings->gutter_lr ); ?>%;
		left: auto;
		-webkit-transform: translate(0%, <?php echo esc_attr( $settings->gutter ); ?>%);
		-moz-transform: translate(0%, <?php echo esc_attr( $settings->gutter ); ?>%);
				transform: translate(0%, <?php echo esc_attr( $settings->gutter ); ?>%);
		<?php } else { ?>
		-webkit-transform: translate(-50%, <?php echo esc_attr( $settings->gutter ); ?>%);
		-moz-transform: translate(-50%, <?php echo esc_attr( $settings->gutter ); ?>%);
				transform: translate(-50%, <?php echo esc_attr( $settings->gutter ); ?>%);
		<?php } ?>
	}
<?php } ?>

<?php if ( 'top' === $settings->image_position ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> {
		top: 0;
		bottom: auto;
		<?php if ( 'left' === $settings->image_position_lr ) { ?>
		left: <?php echo esc_attr( $settings->gutter_lr ); ?>%;
		right: auto;
		-webkit-transform: translate(0%, -<?php echo esc_attr( $settings->gutter ); ?>%);
		-moz-transform: translate(0%, -<?php echo esc_attr( $settings->gutter ); ?>%);
				transform: translate(0%, -<?php echo esc_attr( $settings->gutter ); ?>%);
		<?php } elseif ( 'right' === $settings->image_position_lr ) { ?>
		right: <?php echo esc_attr( $settings->gutter_lr ); ?>%;
		left: auto;
		-webkit-transform: translate(0%, -<?php echo esc_attr( $settings->gutter ); ?>%);
		-moz-transform: translate(0%, -<?php echo esc_attr( $settings->gutter ); ?>%);
				transform: translate(0%, -<?php echo esc_attr( $settings->gutter ); ?>%);
		<?php } else { ?>
		-webkit-transform: translate(-50%, -<?php echo esc_attr( $settings->gutter ); ?>%);
		-moz-transform: translate(-50%, -<?php echo esc_attr( $settings->gutter ); ?>%);
				transform: translate(-50%, -<?php echo esc_attr( $settings->gutter ); ?>%);
		<?php } ?>
	}
<?php } ?>


/*.fl-node-<?php echo esc_attr( $id ); ?>,*/
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-image .uabb-photo-img {
	<?php if ( ! empty( $settings->img_size ) ) : ?>
		width: <?php echo esc_attr( $settings->img_size ); ?>px;
	<?php endif; ?>

	<?php /* Border Style */ ?>
	<?php if ( 'custom' === $settings->image_style ) : ?>

		<?php if ( 'none' !== $settings->img_border_style ) : ?>
			border-style: <?php echo esc_attr( $settings->img_border_style ); ?>;
		<?php endif; ?>

		background: <?php echo esc_attr( uabb_theme_base_color( $settings->img_bg_color ) ); ?>;

		<?php if ( ! empty( $settings->img_bg_size ) ) : ?>
			padding: <?php echo esc_attr( $settings->img_bg_size ); ?>px;
		<?php endif; ?>

		border-width: <?php echo ( '' !== $settings->img_border_width ) ? esc_attr( $settings->img_border_width ) : '1'; ?>px;

		<?php if ( ! empty( $settings->img_border_color ) ) : ?>
			border-color: <?php echo esc_attr( $settings->img_border_color ); ?>;
		<?php endif; ?>

		border-radius: <?php echo ( empty( $settings->img_bg_border_radius ) ) ? '0' : esc_attr( $settings->img_bg_border_radius ); ?>px;
	<?php endif; ?>
}

/* Responsive Photo Size */
<?php if ( $global_settings->responsive_enabled ) { // Global Setting If started. ?> 
		@media ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ) . 'px'; ?> ) {
			<?php if ( '' !== $settings->medium_img_size ) { ?>
				.fl-node-<?php echo esc_attr( $id ); ?> {
					<?php
					$margin_left  = '' !== $settings->margin_left ? $settings->margin_left : '20';
					$margin_right = '' !== $settings->margin_right ? $settings->margin_right : '20';
					?>

					width: <?php echo esc_attr( $settings->medium_img_size ) + $margin_left + $margin_right; ?>px;
					}

				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-image .uabb-photo-img {
					width: <?php echo esc_attr( $settings->medium_img_size ); ?>px;
				}
			<?php } ?>

			<?php
			if ( ( 'left' === $settings->image_position_lr || 'right' === $settings->image_position_lr ) && 'both' === $settings->responsive_center ) {
				if ( 'bottom' === $settings->image_position ) {
					?>
				.fl-node-<?php echo esc_attr( $id ); ?> {
					/*bottom: 0;
					top: auto;*/
					right: auto;
					left: 50%;
					-webkit-transform: translate(-50%, 50%);
					-moz-transform: translate(-50%, 50%);
					transform: translate(-50%, 50%);
				}
					<?php
				} elseif ( 'top' === $settings->image_position ) {
					?>
					.fl-node-<?php echo esc_attr( $id ); ?> {
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

		@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ) . 'px'; ?> ) {
			<?php if ( '' !== $settings->small_img_size ) { ?>
				.fl-node-<?php echo esc_attr( $id ); ?> {
					<?php
					$margin_left  = '' !== $settings->margin_left ? $settings->margin_left : '20';
					$margin_right = '' !== $settings->margin_right ? $settings->margin_right : '20';
					?>

					width: <?php echo esc_attr( $settings->small_img_size + $margin_left ) + $margin_right; ?>px;
					}

				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-image .uabb-photo-img {
					width: <?php echo esc_attr( $settings->small_img_size ); ?>px;
				}
			<?php } ?>

			<?php
			if ( ( 'left' === $settings->image_position_lr || 'right' === $settings->image_position_lr ) && 'small' === $settings->responsive_center ) {
				if ( 'bottom' === $settings->image_position ) {
					?>
				.fl-node-<?php echo esc_attr( $id ); ?> {
					/*bottom: 0;
					top: auto;*/
					right: auto;
					left: 50%;
					-webkit-transform: translate(-50%, 50%);
					-moz-transform: translate(-50%, 50%);
					transform: translate(-50%, 50%);
				}
					<?php
				} elseif ( 'top' === $settings->image_position ) {
					?>
					.fl-node-<?php echo esc_attr( $id ); ?> {
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
<?php if ( '' !== $settings->img_animation_repeat && '0' !== $settings->img_animation_repeat && '1' !== $settings->img_animation_repeat ) { ?>
.fl-node-<?php echo esc_attr( $id ); ?> .animated {
	-webkit-animation-iteration-count: <?php echo esc_attr( $settings->img_animation_repeat ); ?>;
			animation-iteration-count: <?php echo esc_attr( $settings->img_animation_repeat ); ?>;
}
<?php } ?>

.fl-node-<?php echo esc_attr( $id ); ?> .imgseparator-link:hover ~ .uabb-image .uabb-photo-img {

	<?php if ( 'custom' === $settings->image_style ) : ?>
		<?php if ( ! empty( $settings->img_bg_hover_color ) ) : ?>
			background: <?php echo esc_attr( $settings->img_bg_hover_color ); ?>;
		<?php endif; ?>

		<?php if ( ! empty( $settings->img_border_hover_color ) ) : ?>
			border-color: <?php echo esc_attr( $settings->img_border_hover_color ); ?>;
		<?php endif; ?>
	<?php endif; ?>

}



