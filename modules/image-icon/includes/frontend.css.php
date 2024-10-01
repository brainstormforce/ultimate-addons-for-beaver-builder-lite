<?php
/**
 *  UABB Image Icon Module front-end CSS php file
 *
 *  @package UABB Image Icon Module
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

$bg_hover_grad_start = ''; // Ensure $bg_grad_start is always defined.
$border_hover_color  = ''; // Ensure $border_hover_color is always defined.

if ( 'none' !== $settings->image_type ) :

	$settings->icon_color       = FLBuilderColor::hex_or_rgb( $settings->icon_color );
	$settings->icon_hover_color = FLBuilderColor::hex_or_rgb( $settings->icon_hover_color );

	$settings->icon_bg_color       = FLBuilderColor::hex_or_rgb( $settings->icon_bg_color );
	$settings->icon_bg_hover_color = FLBuilderColor::hex_or_rgb( $settings->icon_bg_hover_color );

	$settings->icon_border_color       = FLBuilderColor::hex_or_rgb( $settings->icon_border_color );
	$settings->icon_border_hover_color = FLBuilderColor::hex_or_rgb( $settings->icon_border_hover_color );

	$settings->img_bg_color       = FLBuilderColor::hex_or_rgb( $settings->img_bg_color );
	$settings->img_bg_hover_color = FLBuilderColor::hex_or_rgb( $settings->img_bg_hover_color );

	$settings->img_border_color       = FLBuilderColor::hex_or_rgb( $settings->img_border_color );
	$settings->img_border_hover_color = FLBuilderColor::hex_or_rgb( $settings->img_border_hover_color );

	$settings->icon_size             = ( '' !== trim( $settings->icon_size ) ) ? $settings->icon_size : '30';
	$settings->icon_bg_size          = ( '' !== trim( $settings->icon_bg_size ) ) ? $settings->icon_bg_size : '30';
	$settings->icon_border_width     = ( '' !== trim( $settings->icon_border_width ) ) ? $settings->icon_border_width : '1';
	$settings->icon_bg_border_radius = ( '' !== trim( $settings->icon_bg_border_radius ) ) ? $settings->icon_bg_border_radius : '20';
	?>

	/* Global Alignment Css */
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-imgicon-wrap {
		<?php if ( 'icon' === $settings->image_type ) { ?>
			text-align: <?php echo esc_attr( $settings->icon_align ); ?>;
		<?php } elseif ( 'photo' === $settings->image_type ) { ?>
			text-align: <?php echo esc_attr( $settings->img_align ); ?>;
		<?php } ?>   
	}

	<?php
	if ( 'icon' === $settings->image_type ) {
		/* Icon Color Toggle */
		if ( 'simple' === $settings->icon_style ) {
			$settings->icon_color = uabb_theme_base_color( $settings->icon_color );
		} else {
			if ( 'preset1' === $settings->icon_color_preset ) {
				$settings->icon_color    = ( empty( $settings->icon_color ) ) ? '#fff' : $settings->icon_color;
				$settings->icon_bg_color = uabb_theme_base_color( $settings->icon_bg_color );
			} elseif ( 'preset2' === $settings->icon_color_preset ) {
				$settings->icon_color    = uabb_theme_base_color( $settings->icon_color );
				$settings->icon_bg_color = ( empty( $settings->icon_bg_color ) ) ? '#fafafa' : $settings->icon_bg_color;
			}
		}

		/* Gradient Color */
		if ( $settings->icon_three_d ) {
			$bg_grad_start = FLBuilderColor::hex_or_rgb( FLBuilderColor::adjust_brightness( $settings->icon_bg_color, 40, 'lighten' ) );
			$border_color  = FLBuilderColor::hex_or_rgb( FLBuilderColor::adjust_brightness( $settings->icon_bg_color, 20, 'darken' ) );
		}
		if ( $settings->icon_three_d && ! empty( $settings->icon_bg_hover_color ) ) {
			$bg_hover_grad_start = FLBuilderColor::hex_or_rgb( FLBuilderColor::adjust_brightness( $settings->icon_bg_hover_color, 40, 'lighten' ) );
			$border_hover_color  = FLBuilderColor::hex_or_rgb( FLBuilderColor::adjust_brightness( $settings->icon_bg_hover_color, 20, 'darken' ) );
		}

		?>

		/* Icon Css */
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-icon-wrap .uabb-icon i,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-icon-wrap .uabb-icon i:before {

			<?php
			if ( ! empty( $settings->icon_color ) ) {
				/* Icon Color */
				echo 'color: ' . esc_attr( $settings->icon_color );
			}
			?>
			;
			font-size: <?php echo esc_attr( $settings->icon_size ); ?>px;
			height: auto;
			width: auto;
			<?php if ( 'simple' !== $settings->icon_style ) { // Rounded Styles. ?>
				<?php echo 'background: ' . esc_attr( $settings->icon_bg_color ); ?>;
				<?php
				if ( 'circle' === $settings->icon_style || 'custom' === $settings->icon_style ) {
					?>
				border-radius: <?php echo ( 'custom' === $settings->icon_style ) ? esc_attr( $settings->icon_bg_border_radius ) . 'px' : '100%'; ?>;
				-moz-border-radius: <?php echo ( 'custom' === $settings->icon_style ) ? esc_attr( $settings->icon_bg_border_radius ) . 'px' : '100%'; ?>;
				-webkit-border-radius: <?php echo ( 'custom' === $settings->icon_style ) ? esc_attr( $settings->icon_bg_border_radius ) . 'px' : '100%'; ?>;
				<?php } if ( 'circle' === $settings->icon_style || 'square' === $settings->icon_style || 'custom' === $settings->icon_style ) { ?>
				line-height:
					<?php
					echo esc_attr(
						( ( 'custom' !== $settings->icon_style ) ? ( $settings->icon_size * 2 ) : $settings->icon_size )
						+
						( ( 'custom' === $settings->icon_style ) ? $settings->icon_bg_size : 0 )
						. 'px;'
					);
					?>

				height:
					<?php
					echo esc_attr(
						( ( 'custom' !== $settings->icon_style ) ? ( $settings->icon_size * 2 ) : $settings->icon_size )
						+
						( ( 'custom' === $settings->icon_style ) ? $settings->icon_bg_size : 0 )
						. 'px;'
					);
					?>
				width:
					<?php
					echo esc_attr(
						( ( 'custom' !== $settings->icon_style ) ? ( $settings->icon_size * 2 ) : $settings->icon_size )
						+
						( ( 'custom' === $settings->icon_style ) ? $settings->icon_bg_size : 0 )
						. 'px;'
					);
					?>
				text-align: center;
					<?php
				}
			} else {  // else rounded style.
				?>
				line-height: <?php echo esc_attr( $settings->icon_size ); ?>px;
				height: <?php echo esc_attr( $settings->icon_size ); ?>px;
				width: <?php echo esc_attr( $settings->icon_size ); ?>px;
				text-align: center;
			<?php } ?>

			<?php /* Border Style */ ?>
			<?php if ( 'custom' === $settings->icon_style && 'none' !== $settings->icon_border_style ) : ?>
				border-style: <?php echo esc_attr( $settings->icon_border_style ); ?>;
				box-sizing:content-box;

				<?php if ( ! empty( $settings->icon_border_color ) ) : ?>
					border-color: <?php echo esc_attr( $settings->icon_border_color ); ?>;
				<?php endif; ?>

				border-width: <?php echo esc_attr( $settings->icon_border_width ); ?>px;
			<?php endif; ?>

			/* Gradient Style */
			<?php if ( 'simple' !== $settings->icon_style && $settings->icon_three_d ) : // 3D Styles. ?>
				background: -moz-linear-gradient(top,  <?php echo esc_attr( $bg_grad_start ); ?> 0%, <?php echo esc_attr( $settings->icon_bg_color ); ?> 100%); /* FF3.6+ */
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo esc_attr( $bg_grad_start ); ?>), color-stop(100%,<?php echo esc_attr( $settings->icon_bg_color ); ?>)); /* Chrome,Safari4+ */
				background: -webkit-linear-gradient(top,  <?php echo esc_attr( $bg_grad_start ); ?> 0%,<?php echo esc_attr( $settings->icon_bg_color ); ?> 100%); /* Chrome10+,Safari5.1+ */
				background: -o-linear-gradient(top,  <?php echo esc_attr( $bg_grad_start ); ?> 0%,<?php echo esc_attr( $settings->icon_bg_color ); ?> 100%); /* Opera 11.10+ */
				background: -ms-linear-gradient(top,  <?php echo esc_attr( $bg_grad_start ); ?> 0%,<?php echo esc_attr( $settings->icon_bg_color ); ?> 100%); /* IE10+ */
				background: linear-gradient(to bottom,  <?php echo esc_attr( $bg_grad_start ); ?> 0%,<?php echo esc_attr( $settings->icon_bg_color ); ?> 100%); /* W3C */
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo esc_attr( $bg_grad_start ); ?>', endColorstr='<?php echo esc_attr( $settings->icon_bg_color ); ?>',GradientType=0 ); /* IE6-9 */
				/*<?php if ( 'circle' === $settings->icon_style || 'square' === $settings->icon_style ) : ?>
					border: 1px solid <?php echo esc_attr( $border_color ); ?>;
				<?php endif; ?>*/
			<?php endif; ?>
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-icon-wrap .uabb-icon i:before {
			background: none;
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-icon-wrap .uabb-icon i:hover,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-icon-wrap .uabb-icon i:hover:before {
			<?php if ( 'simple' !== $settings->icon_style ) : ?>
				<?php if ( ! empty( $settings->icon_bg_hover_color ) ) : ?>
				background: <?php echo esc_attr( $settings->icon_bg_hover_color ); ?>;
				<?php endif; ?>
				<?php if ( $settings->icon_three_d && ! empty( $settings->icon_bg_hover_color ) ) : // 3D Styles. ?>
				background: -moz-linear-gradient(top,  <?php echo esc_attr( $bg_hover_grad_start ); ?> 0%, <?php echo esc_attr( $settings->icon_bg_hover_color ); ?> 100%); /* FF3.6+ */
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo esc_attr( $bg_hover_grad_start ); ?>), color-stop(100%,<?php echo esc_attr( $settings->icon_bg_hover_color ); ?>)); /* Chrome,Safari4+ */
				background: -webkit-linear-gradient(top,  <?php echo esc_attr( $bg_hover_grad_start ); ?> 0%,<?php echo esc_attr( $settings->icon_bg_hover_color ); ?> 100%); /* Chrome10+,Safari5.1+ */
				background: -o-linear-gradient(top,  <?php echo esc_attr( $bg_hover_grad_start ); ?> 0%,<?php echo esc_attr( $settings->icon_bg_hover_color ); ?> 100%); /* Opera 11.10+ */
				background: -ms-linear-gradient(top,  <?php echo esc_attr( $bg_hover_grad_start ); ?> 0%,<?php echo esc_attr( $settings->icon_bg_hover_color ); ?> 100%); /* IE10+ */
				background: linear-gradient(to bottom,  <?php echo esc_attr( $bg_hover_grad_start ); ?> 0%,<?php echo esc_attr( $settings->icon_bg_hover_color ); ?> 100%); /* W3C */
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo esc_attr( $bg_hover_grad_start ); ?>', endColorstr='<?php echo esc_attr( $settings->icon_bg_hover_color ); ?>',GradientType=0 ); /* IE6-9 */
				/*<?php if ( 'circle' === $settings->icon_style || 'square' === $settings->icon_style ) : ?>
					border: 1px solid <?php echo esc_attr( $border_hover_color ); ?>;
				<?php endif; ?>  */  
				<?php endif; ?>
			<?php endif; ?>

			color: <?php echo esc_attr( $settings->icon_hover_color ); ?>;

			<?php /* Border Style */ ?>
			<?php if ( 'custom' === $settings->icon_style && 'none' !== $settings->icon_border_style ) : ?>
				<?php if ( ! empty( $settings->icon_border_color ) ) : ?>
					border-color: <?php echo esc_attr( $settings->icon_border_hover_color ); ?>;
				<?php endif; ?>
			<?php endif; ?>
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-icon-wrap .uabb-icon i:hover:before {
			background: none;
		}
		/* Icon Css End */
		<?php
	} elseif ( 'photo' === $settings->image_type ) {
		?>

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-image .uabb-photo-img {
			<?php if ( '' !== $settings->img_size ) : ?>
				width: <?php echo esc_attr( $settings->img_size ); ?>px;
			<?php endif; ?>
			<?php if ( 'custom' === $settings->image_style && '' !== $settings->img_bg_size ) : ?>
				padding: <?php echo esc_attr( $settings->img_bg_size ); ?>px;
			<?php endif; ?>
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-image .uabb-image-content{
			<?php /* Border Style */ ?>
			<?php if ( 'custom' === $settings->image_style ) : ?>

				<?php if ( 'none' !== $settings->img_border_style ) : ?>
					border-style: <?php echo esc_attr( $settings->img_border_style ); ?>;
				<?php endif; ?>

				background: <?php echo esc_attr( uabb_theme_base_color( $settings->img_bg_color ) ); ?>;

				border-width: <?php echo ( '' !== $settings->img_border_width ) ? esc_attr( $settings->img_border_width ) : '1'; ?>px;

				<?php if ( ! empty( $settings->img_border_color ) ) : ?>
					border-color: <?php echo esc_attr( $settings->img_border_color ); ?>;
				<?php endif; ?>

				border-radius: <?php echo ( '' !== $settings->img_bg_border_radius ) ? esc_attr( $settings->img_bg_border_radius ) : '0'; ?>px;
			<?php endif; ?>
		}

		/* Responsive Photo Size */
		<?php if ( isset( $settings->responsive_img_size ) && ! empty( $settings->responsive_img_size ) && $global_settings->responsive_enabled ) { // Global Setting If started. ?> 
				@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ) . 'px'; ?> ) {
					.fl-node-<?php echo esc_attr( $id ); ?> .uabb-image .uabb-photo-img{
					<?php if ( is_numeric( $settings->responsive_img_size ) ) : ?>
						width: <?php echo esc_attr( $settings->responsive_img_size ); ?>px;
					<?php endif; ?>
					}
				}
		<?php } ?>

		<?php if ( 'custom' === $settings->image_style ) : ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-image-content:hover {

			<?php if ( ! empty( $settings->img_bg_hover_color ) ) : ?>
				background: <?php echo esc_attr( $settings->img_bg_hover_color ); ?>;
			<?php endif; ?>

			<?php if ( ! empty( $settings->img_border_hover_color ) ) : ?>
				border-color: <?php echo esc_attr( $settings->img_border_hover_color ); ?>;
			<?php endif; ?>
		}
		<?php endif; ?>
	<?php } // Condition for Photo. ?>
<?php endif; ?>
