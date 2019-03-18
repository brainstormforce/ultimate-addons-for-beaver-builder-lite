<?php
/**
 *  UABB Image Icon Module front-end CSS php file
 *
 *  @package UABB Image Icon Module
 */

if ( 'none' != $settings->image_type ) :

	$settings->icon_color       = UABB_Helper::uabb_colorpicker( $settings, 'icon_color' );
	$settings->icon_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'icon_hover_color' );

	$settings->icon_bg_color       = UABB_Helper::uabb_colorpicker( $settings, 'icon_bg_color', true );
	$settings->icon_bg_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'icon_bg_hover_color', true );

	$settings->icon_border_color       = UABB_Helper::uabb_colorpicker( $settings, 'icon_border_color' );
	$settings->icon_border_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'icon_border_hover_color' );

	$settings->img_bg_color       = UABB_Helper::uabb_colorpicker( $settings, 'img_bg_color', true );
	$settings->img_bg_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'img_bg_hover_color', true );

	$settings->img_border_color       = UABB_Helper::uabb_colorpicker( $settings, 'img_border_color' );
	$settings->img_border_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'img_border_hover_color' );

	$settings->icon_size             = ( '' !== trim( $settings->icon_size ) ) ? $settings->icon_size : '30';
	$settings->icon_bg_size          = ( '' !== trim( $settings->icon_bg_size ) ) ? $settings->icon_bg_size : '30';
	$settings->icon_border_width     = ( '' !== trim( $settings->icon_border_width ) ) ? $settings->icon_border_width : '1';
	$settings->icon_bg_border_radius = ( '' !== trim( $settings->icon_bg_border_radius ) ) ? $settings->icon_bg_border_radius : '20';
	?>

	/* Global Alignment Css */
	.fl-node-<?php echo $id; ?> .uabb-imgicon-wrap {
		<?php if ( 'icon' == $settings->image_type ) { ?>
			text-align: <?php echo $settings->icon_align; ?>;
		<?php } elseif ( 'photo' == $settings->image_type ) { ?>
			text-align: <?php echo $settings->img_align; ?>;
		<?php } ?>   
	}

	<?php
	if ( 'icon' == $settings->image_type ) {
		/* Icon Color Toggle */
		if ( 'simple' == $settings->icon_style ) {
			$settings->icon_color = uabb_theme_base_color( $settings->icon_color );
		} else {
			if ( 'preset1' == $settings->icon_color_preset ) {
				$settings->icon_color    = ( empty( $settings->icon_color ) ) ? '#fff' : $settings->icon_color;
				$settings->icon_bg_color = uabb_theme_base_color( $settings->icon_bg_color );
			} elseif ( 'preset2' == $settings->icon_color_preset ) {
				$settings->icon_color    = uabb_theme_base_color( $settings->icon_color );
				$settings->icon_bg_color = ( empty( $settings->icon_bg_color ) ) ? '#fafafa' : $settings->icon_bg_color;
			}
		}

		/* Gradient Color */
		if ( $settings->icon_three_d ) {
			$settings->icon_bg_color = $settings->icon_bg_color;
			$bg_color                = ( ! empty( $settings->icon_bg_color ) ) ? uabb_parse_color_to_hex( $settings->icon_bg_color ) : uabb_parse_color_to_hex( $settings->icon_bg_color );
			$bg_grad_start           = '#' . FLBuilderColor::adjust_brightness( $bg_color, 40, 'lighten' );
			$border_color            = '#' . FLBuilderColor::adjust_brightness( $bg_color, 20, 'darken' );
		}
		if ( $settings->icon_three_d && ! empty( $settings->icon_bg_hover_color ) ) {
			$bg_hover_color = ( ! empty( $settings->icon_bg_hover_color ) ) ? uabb_parse_color_to_hex( $settings->icon_bg_hover_color ) : '';

			$bg_hover_grad_start = '#' . FLBuilderColor::adjust_brightness( $bg_hover_color, 40, 'lighten' );
			$border_hover_color  = '#' . FLBuilderColor::adjust_brightness( $bg_hover_color, 20, 'darken' );
		}

		?>

		/* Icon Css */
		.fl-node-<?php echo $id; ?> .uabb-icon-wrap .uabb-icon i,
		.fl-node-<?php echo $id; ?> .uabb-icon-wrap .uabb-icon i:before {

			<?php
			if ( ! empty( $settings->icon_color ) ) {
				/* Icon Color */
				echo 'color: ' . $settings->icon_color;
			}
			?>
			;
			font-size: <?php echo $settings->icon_size; ?>px;
			height: auto;
			width: auto;
			<?php if ( 'simple' != $settings->icon_style ) { // Rounded Styles. ?>
				<?php echo 'background: ' . $settings->icon_bg_color; ?>;
				<?php
				if ( 'circle' == $settings->icon_style || 'custom' == $settings->icon_style ) {
					?>
				border-radius: <?php echo ( 'custom' == $settings->icon_style ) ? $settings->icon_bg_border_radius . 'px' : '100%'; ?>;
				-moz-border-radius: <?php echo ( 'custom' == $settings->icon_style ) ? $settings->icon_bg_border_radius . 'px' : '100%'; ?>;
				-webkit-border-radius: <?php echo ( 'custom' == $settings->icon_style ) ? $settings->icon_bg_border_radius . 'px' : '100%'; ?>;
				<?php } if ( 'circle' == $settings->icon_style || 'square' == $settings->icon_style || 'custom' == $settings->icon_style ) { ?>
				line-height:
					<?php
					echo (
					( ( 'custom' != $settings->icon_style ) ? ( $settings->icon_size * 2 ) : $settings->icon_size )
					+
					( ( 'custom' == $settings->icon_style ) ? $settings->icon_bg_size : 0 )
							. 'px;' );
					?>

				height:
					<?php
					echo (
					( ( 'custom' != $settings->icon_style ) ? ( $settings->icon_size * 2 ) : $settings->icon_size )
					+
					( ( 'custom' == $settings->icon_style ) ? $settings->icon_bg_size : 0 )
						. 'px;' );
					?>
				width:
					<?php
					echo (
					( ( 'custom' != $settings->icon_style ) ? ( $settings->icon_size * 2 ) : $settings->icon_size )
					+
					( ( 'custom' == $settings->icon_style ) ? $settings->icon_bg_size : 0 )
					. 'px;' );
					?>
				text-align: center;
					<?php
				}
			} else {  // else rounded style.
				?>
				line-height: <?php echo $settings->icon_size; ?>px;
				height: <?php echo $settings->icon_size; ?>px;
				width: <?php echo $settings->icon_size; ?>px;
				text-align: center;
			<?php }; ?>

			<?php /* Border Style */ ?>
			<?php if ( 'custom' == $settings->icon_style && 'none' != $settings->icon_border_style ) : ?>
				border-style: <?php echo $settings->icon_border_style; ?>;
				box-sizing:content-box;

				<?php if ( ! empty( $settings->icon_border_color ) ) : ?>
					border-color: <?php echo $settings->icon_border_color; ?>;
				<?php endif; ?>

				border-width: <?php echo $settings->icon_border_width; ?>px;
			<?php endif; ?>

			/* Gradient Style */
			<?php if ( 'simple' != $settings->icon_style && $settings->icon_three_d ) : // 3D Styles. ?>
				background: -moz-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%, <?php echo $settings->icon_bg_color; ?> 100%); /* FF3.6+ */
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $bg_grad_start; ?>), color-stop(100%,<?php echo $settings->icon_bg_color; ?>)); /* Chrome,Safari4+ */
				background: -webkit-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%,<?php echo $settings->icon_bg_color; ?> 100%); /* Chrome10+,Safari5.1+ */
				background: -o-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%,<?php echo $settings->icon_bg_color; ?> 100%); /* Opera 11.10+ */
				background: -ms-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%,<?php echo $settings->icon_bg_color; ?> 100%); /* IE10+ */
				background: linear-gradient(to bottom,  <?php echo $bg_grad_start; ?> 0%,<?php echo $settings->icon_bg_color; ?> 100%); /* W3C */
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $bg_grad_start; ?>', endColorstr='<?php echo $settings->icon_bg_color; ?>',GradientType=0 ); /* IE6-9 */
				/*<?php if ( 'circle' == $settings->icon_style || 'square' == $settings->icon_style ) : ?>
					border: 1px solid <?php echo $border_color; ?>;
				<?php endif; ?>*/
			<?php endif; ?>
		}

		.fl-node-<?php echo $id; ?> .uabb-icon-wrap .uabb-icon i:before {
			background: none;
		}

		.fl-node-<?php echo $id; ?> .uabb-icon-wrap .uabb-icon i:hover,
		.fl-node-<?php echo $id; ?> .uabb-icon-wrap .uabb-icon i:hover:before {
			<?php if ( 'simple' != $settings->icon_style ) : ?>
				<?php if ( ! empty( $settings->icon_bg_hover_color ) ) : ?>
				background: <?php echo $settings->icon_bg_hover_color; ?>;
				<?php endif; ?>
				<?php if ( $settings->icon_three_d && ! empty( $settings->icon_bg_hover_color ) ) : // 3D Styles. ?>
				background: -moz-linear-gradient(top,  <?php echo $bg_hover_grad_start; ?> 0%, <?php echo $settings->icon_bg_hover_color; ?> 100%); /* FF3.6+ */
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $bg_hover_grad_start; ?>), color-stop(100%,<?php echo $settings->icon_bg_hover_color; ?>)); /* Chrome,Safari4+ */
				background: -webkit-linear-gradient(top,  <?php echo $bg_hover_grad_start; ?> 0%,<?php echo $settings->icon_bg_hover_color; ?> 100%); /* Chrome10+,Safari5.1+ */
				background: -o-linear-gradient(top,  <?php echo $bg_hover_grad_start; ?> 0%,<?php echo $settings->icon_bg_hover_color; ?> 100%); /* Opera 11.10+ */
				background: -ms-linear-gradient(top,  <?php echo $bg_hover_grad_start; ?> 0%,<?php echo $settings->icon_bg_hover_color; ?> 100%); /* IE10+ */
				background: linear-gradient(to bottom,  <?php echo $bg_hover_grad_start; ?> 0%,<?php echo $settings->icon_bg_hover_color; ?> 100%); /* W3C */
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $bg_hover_grad_start; ?>', endColorstr='<?php echo $settings->icon_bg_hover_color; ?>',GradientType=0 ); /* IE6-9 */
				/*<?php if ( 'circle' == $settings->icon_style || 'square' == $settings->icon_style ) : ?>
					border: 1px solid <?php echo $border_hover_color; ?>;
				<?php endif; ?>  */  
				<?php endif; ?>
			<?php endif; ?>

			color: <?php echo $settings->icon_hover_color; ?>;

			<?php /* Border Style */ ?>
			<?php if ( 'custom' == $settings->icon_style && 'none' != $settings->icon_border_style ) : ?>
				<?php if ( ! empty( $settings->icon_border_color ) ) : ?>
					border-color: <?php echo $settings->icon_border_hover_color; ?>;
				<?php endif; ?>
			<?php endif; ?>
		}

		.fl-node-<?php echo $id; ?> .uabb-icon-wrap .uabb-icon i:hover:before {
			background: none;
		}
		/* Icon Css End */
		<?php
	} elseif ( 'photo' == $settings->image_type ) {
		?>

		.fl-node-<?php echo $id; ?> .uabb-image .uabb-photo-img {
			<?php if ( '' !== $settings->img_size ) : ?>
				width: <?php echo $settings->img_size; ?>px;
			<?php endif; ?>
			<?php if ( 'custom' == $settings->image_style && '' !== $settings->img_bg_size ) : ?>
				padding: <?php echo $settings->img_bg_size; ?>px;
			<?php endif; ?>
		}

		.fl-node-<?php echo $id; ?> .uabb-image .uabb-image-content{
			<?php /* Border Style */ ?>
			<?php if ( 'custom' == $settings->image_style ) : ?>

				<?php if ( 'none' != $settings->img_border_style ) : ?>
					border-style: <?php echo $settings->img_border_style; ?>;
				<?php endif; ?>

				background: <?php echo uabb_theme_base_color( $settings->img_bg_color ); ?>;

				border-width: <?php echo ( '' !== $settings->img_border_width ) ? $settings->img_border_width : '1'; ?>px;

				<?php if ( ! empty( $settings->img_border_color ) ) : ?>
					border-color: <?php echo $settings->img_border_color; ?>;
				<?php endif; ?>

				border-radius: <?php echo ( '' !== $settings->img_bg_border_radius ) ? $settings->img_bg_border_radius : '0'; ?>px;
			<?php endif; ?>
		}

		/* Responsive Photo Size */
		<?php if ( isset( $settings->responsive_img_size ) && ! empty( $settings->responsive_img_size ) && $global_settings->responsive_enabled ) { // Global Setting If started. ?> 
				@media ( max-width: <?php echo $global_settings->responsive_breakpoint . 'px'; ?> ) {
					.fl-node-<?php echo $id; ?> .uabb-image .uabb-photo-img{
					<?php if ( is_numeric( $settings->responsive_img_size ) ) : ?>
						width: <?php echo $settings->responsive_img_size; ?>px;
					<?php endif; ?>
					}
				}
		<?php } ?>

		<?php if ( 'custom' == $settings->image_style ) : ?>
		.fl-node-<?php echo $id; ?> .uabb-image-content:hover {

			<?php if ( ! empty( $settings->img_bg_hover_color ) ) : ?>
				background: <?php echo $settings->img_bg_hover_color; ?>;
			<?php endif; ?>

			<?php if ( ! empty( $settings->img_border_hover_color ) ) : ?>
				border-color: <?php echo $settings->img_border_hover_color; ?>;
			<?php endif; ?>
		}
		<?php endif; ?>
	<?php } // Condition for Photo. ?>
<?php endif; ?>
