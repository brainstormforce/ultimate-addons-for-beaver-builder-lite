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

$pos = $settings->front_img_icon_position;
?>
<div class="uabb-module-content uabb-slide-box-wrap">
	<div class="uabb-slide-type uabb-<?php echo $settings->slide_type; ?>" data-style="<?php echo $settings->slide_type; ?>">
		<div id="uabb-slide-box-wrap-<?php echo $module->node; ?>" class="uabb-slide-box">
			<div class="uabb-slide-face uabb-slide-front uabb-slide-<?php echo $settings->image_type . '-' . $pos; ?>">
				<div class="uabb-slide-box-section "><!-- Inline Block Space Fix
					<?php if ( 'none' != $settings->image_type ) : ?>
						<?php if ( 'left' == $pos ) { ?>
							--><div class="uabb-slide-front-left-img">
								<?php $module->render_image( 'left' ); ?>
							</div><!-- Inline Block Space Fix
							<?php if ( 'yes' == $settings->front_icon_border ) { ?>
							--><span class="uabb-slide-icon-border"></span><!-- Inline Block Space Fix
							<?php } ?>
						<?php } ?>
						<?php if ( 'above-title' == $pos ) { ?>
							--><div class="uabb-slide-front-above-img">
								<?php $module->render_image( 'above-title' ); ?>
							</div><!-- Inline Block Space Fix
						<?php } ?>
					<?php endif; ?>
					--><div class="uabb-slide-front-right-text"><!-- Inline Block Space Fix
						<?php if ( 'none' != $settings->image_type && 'left-title' == $pos ) : ?>
							--><div class="uabb-slide-front-left-title-img">
								<?php $module->render_image( 'left-title' ); ?>
							</div><!-- Inline Block Space Fix
						<?php endif; ?>
						<?php if ( '' != $settings->title_front ) { ?>
							--><<?php echo $settings->front_title_tag_selection; ?> class="uabb-slide-face-text-title"><?php echo $settings->title_front; ?></<?php echo $settings->front_title_tag_selection; ?>><!-- Inline Block Space Fix
						<?php } ?>
						<?php if ( 'none' != $settings->image_type && 'right-title' == $pos ) : ?>
							--><div class="uabb-slide-front-right-title-img">
								<?php $module->render_image( 'right-title' ); ?>
							</div><!-- Inline Block Space Fix
						<?php endif; ?>
						<?php if ( '' != $settings->desc_front ) { ?>
							--><div class="uabb-slide-box-section-content uabb-text-editor">
								<?php echo trim( $settings->desc_front ); ?>
							</div><!-- Inline Block Space Fix
						<?php } ?>
					--></div><!-- Inline Block Space Fix
					<?php if ( 'none' != $settings->image_type && 'right' == $pos ) : ?>
						<?php if ( 'yes' == $settings->front_icon_border ) { ?>
							--><span class="uabb-slide-icon-border"></span><!-- Inline Block Space Fix
						<?php } ?>
						--><div class="uabb-slide-front-right-img">
							<?php $module->render_image( 'right' ); ?>
						</div><!-- Inline Block Space Fix
					<?php endif; ?>
					--><?php $module->render_dropdown_icon(); ?><!-- Inline Block Space Fix
				--></div>

				<!-- Overlay for Style 1 -->
				<?php $module->render_overlay_icon(); ?>

			</div><!-- END .front -->
			<div class="uabb-slide-face uabb-slide-down">
				<div class="uabb-slide-box-section- ">
				<?php
				if ( '' != $settings->title_back ) {
					?>
					<<?php echo $settings->back_title_tag_selection; ?> class="uabb-slide-back-text-title"><?php echo $settings->title_back; ?></<?php echo $settings->back_title_tag_selection; ?>>
					<?php
				}
				if ( '' != $settings->desc_back ) {
					?>
					<div class="uabb-slide-down-box-section-content uabb-text-editor">
						<?php echo trim( $settings->desc_back ); ?>
					</div>
					<?php
				}
				?>
					<?php
					if ( 'none' != $settings->cta_type ) {
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
