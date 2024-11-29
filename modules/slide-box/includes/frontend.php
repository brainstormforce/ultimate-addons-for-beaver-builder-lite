<?php
/**
 * This file should be used to render each module instance.
 * You have access to two variables in this file:
 *
 * $module An instance of your module class.
 * $settings The module's settings.
 *
 * @package Slide Box
 */

// Ensure $settings is defined and initialized.
if ( ! isset( $settings ) ) {
	$settings = new stdClass(); // Create an empty object to avoid undefined errors.
}

// Ensure $settings is defined and initialized.
if ( ! isset( $module ) ) {
	$module = new stdClass(); // Create an empty object to avoid undefined errors.
}

$pos = $settings->front_img_icon_position;
?>
<div class="uabb-module-content uabb-slide-box-wrap">
	<div class="uabb-slide-type uabb-<?php echo esc_attr( $settings->slide_type ); ?>" data-style="<?php echo esc_attr( $settings->slide_type ); ?>">
		<div id="uabb-slide-box-wrap-<?php echo esc_attr( $module->node ); ?>" class="uabb-slide-box">
			<div class="uabb-slide-face uabb-slide-front uabb-slide-
			<?php
			echo esc_attr( $settings->image_type ) . '-' . esc_attr( $pos );
			?>
">
				<div class="uabb-slide-box-section "><!-- Inline Block Space Fix
					<?php if ( $settings->image_type !== 'none' ) { ?>
						<?php if ( $pos === 'left' ) { ?>
							--><div class="uabb-slide-front-left-img">
								<?php $module->render_image( 'left' ); ?>
							</div><!-- Inline Block Space Fix
							<?php if ( $settings->front_icon_border === 'yes' ) { ?>
							--><span class="uabb-slide-icon-border"></span><!-- Inline Block Space Fix
							<?php } ?>
						<?php } ?>
						<?php if ( $pos === 'above-title' ) { ?>
							--><div class="uabb-slide-front-above-img">
								<?php $module->render_image( 'above-title' ); ?>
							</div><!-- Inline Block Space Fix
						<?php } ?>
					<?php } ?>
					--><div class="uabb-slide-front-right-text"><!-- Inline Block Space Fix
						<?php if ( $settings->image_type !== 'none' && $pos === 'left-title' ) { ?>
							--><div class="uabb-slide-front-left-title-img">
								<?php $module->render_image( 'left-title' ); ?>
							</div><!-- Inline Block Space Fix
						<?php } ?>
						<?php
							// Define a whitelist of allowed tags.
							$allowed_tags    = [ 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div', 'p', 'span' ];
							$front_title_tag = in_array( $settings->front_title_tag_selection, $allowed_tags, true ) ? $settings->front_title_tag_selection : 'h3';
						?>
						<?php if ( $settings->title_front !== '' ) { ?>
							--><<?php echo esc_attr( $front_title_tag ); ?> class="uabb-slide-face-text-title"><?php echo wp_kses_post( $settings->title_front ); ?></<?php echo esc_attr( $front_title_tag ); ?>><!-- Inline Block Space Fix
						<?php } ?>
						<?php if ( $settings->image_type !== 'none' && $pos === 'right-title' ) { ?>
							--><div class="uabb-slide-front-right-title-img">
								<?php $module->render_image( 'right-title' ); ?>
							</div><!-- Inline Block Space Fix
						<?php } ?>
						<?php if ( $settings->desc_front !== '' ) { ?>
							--><div class="uabb-slide-box-section-content uabb-text-editor">
								<?php echo wp_kses_post( trim( $settings->desc_front ) ); ?>
							</div><!-- Inline Block Space Fix
						<?php } ?>
					--></div><!-- Inline Block Space Fix
					<?php if ( $settings->image_type !== 'none' && $pos === 'right' ) { ?>
						<?php if ( $settings->front_icon_border === 'yes' ) { ?>
							--><span class="uabb-slide-icon-border"></span><!-- Inline Block Space Fix
						<?php } ?>
						--><div class="uabb-slide-front-right-img">
							<?php $module->render_image( 'right' ); ?>
						</div><!-- Inline Block Space Fix
					<?php } ?>
					--><?php $module->render_dropdown_icon(); ?><!-- Inline Block Space Fix
				--></div>

				<!-- Overlay for Style 1 -->
				<?php $module->render_overlay_icon(); ?>

			</div><!-- END .front -->
			<div class="uabb-slide-face uabb-slide-down">
				<div class="uabb-slide-box-section- ">
				<?php
				// Define a whitelist of allowed tags.
					$allowed_tags   = [ 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div', 'p', 'span' ];
					$back_title_tag = in_array( $settings->back_title_tag_selection, $allowed_tags, true ) ? $settings->back_title_tag_selection : 'h3';
				?>
				<?php
				if ( $settings->title_back !== '' ) {
					?>
					<<?php echo esc_attr( $back_title_tag ); ?> class="uabb-slide-back-text-title"><?php echo wp_kses_post( $settings->title_back ); ?></<?php echo esc_attr( $back_title_tag ); ?>>
					<?php
				}
				if ( $settings->desc_back !== '' ) {
					?>
					<div class="uabb-slide-down-box-section-content uabb-text-editor">
						<?php echo wp_kses_post( trim( $settings->desc_back ) ); ?>
					</div>
					<?php
				}
				?>
					<?php
					if ( $settings->cta_type !== 'none' ) {
						// Link CTA.
						$module->render_link();

						// Button CTA.
						$module->render_button();
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
