<?php
/**
 *  UABB Flip Box Module front-end file
 *
 *  @package UABB Flip Box Module
 */

?>
<div class="uabb-module-content uabb-flip-box-wrap">
	<div class="uabb-flip-box  <?php echo $settings->flip_type; ?> <?php echo $settings->flip_box_min_height_options; ?>">
		<div class="uabb-flip-box uabb-flip-box-outter">
			<div class="uabb-face uabb-front ">
				<?php
					$allowed_tags = array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div', 'p', 'span' );
					$front_tag    = in_array( $settings->front_title_typography_tag_selection, $allowed_tags ) ? $settings->front_title_typography_tag_selection : 'h2';
				?>
				<div class="uabb-flip-box-section <?php echo ( 'no' != $settings->display_vertically_center ) ? 'uabb-flip-box-section-vertical-middle' : ''; ?>">
					<?php $module->render_icon(); ?>
					<?php
					if ( '' != $settings->title_front ) {
						?>
					<<?php echo esc_attr( $front_tag ); ?> class="uabb-face-text-title"><?php echo $settings->title_front; ?></<?php echo esc_attr( $front_tag ); ?>>
						<?php
					}
					if ( '' != $settings->desc_front ) {
						?>
					<div class="uabb-flip-box-section-content uabb-text-editor" >
						<?php echo $settings->desc_front; ?>
					</div>
						<?php
					}
					?>
				</div>
			</div><!-- END .front -->
			<div class="uabb-face uabb-back">
				<?php
					$allowed_tags = array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div', 'p', 'span' );
					$tag          = in_array( $settings->back_title_typography_tag_selection, $allowed_tags ) ? $settings->back_title_typography_tag_selection : 'h2';
				?>
				<div class="uabb-flip-box-section <?php echo ( 'no' != $settings->display_vertically_center ) ? 'uabb-flip-box-section-vertical-middle' : ''; ?>">
					<?php
					if ( '' != $settings->title_back ) {
						?>
					<<?php echo esc_attr( $tag ); ?> class="uabb-back-text-title"><?php echo esc_attr( $settings->title_back ); ?></<?php echo esc_attr( $tag ); ?>>
						<?php
					}
					if ( '' != $settings->desc_back ) {
						?>
					<div class="uabb-back-flip-box-section-content uabb-text-editor">
						<?php echo $settings->desc_back; ?>
					</div>
						<?php
					}
					$module->render_button();
					?>
				</div>
			</div><!-- END .back -->
		</div> <!-- ifb-flip-box -->
	</div> <!-- flip-box -->
</div>
