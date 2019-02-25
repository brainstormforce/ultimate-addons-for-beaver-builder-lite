<?php
/**
 *  UABB Heading Module front-end file
 *
 *  @package UABB Heading Module
 */

?>
<div class="uabb-module-content uabb-heading-wrapper uabb-heading-align-<?php echo $settings->alignment; ?> <?php echo ( 'line_text' == $settings->separator_style ) ? $settings->responsive_compatibility : ''; ?>">
	<?php if ( 'top' == $settings->separator_position ) { ?>
		<div class="uabb-module-content uabb-separator-parent">
			<?php if ( 'line_icon' == $settings->separator_style || 'line_image' == $settings->separator_style || 'line_text' == $settings->separator_style ) { ?>
				<div class="uabb-separator-wrap <?php echo 'uabb-separator-' . $settings->alignment; ?> <?php echo ( 'line_text' == $settings->separator_style ) ? $settings->responsive_compatibility : ''; ?>" >
					<div class="uabb-separator-line uabb-side-left">
						<span></span>
					</div>			 		    
					<div class="uabb-divider-content uabbi-divider">
						<?php $module->render_image(); ?>
						<?php
						if ( 'line_text' == $settings->separator_style ) {
							echo '<' . $settings->separator_text_tag_selection . ' class="uabb-divider-text">' . $settings->text_inline . '</' . $settings->separator_text_tag_selection . '>';
						}
						?>
					</div>			 		    
					<div class="uabb-separator-line uabb-side-right">
						<span></span>
					</div> 
				</div>
			<?php } ?>
			<?php if ( 'line' == $settings->separator_style ) { ?>
				<div class="uabb-separator"></div>
			<?php } ?>
		</div> 
	<?php } ?>

	<<?php echo $settings->tag; ?> class="uabb-heading">
		<?php if ( ! empty( $settings->link ) ) : ?>
			<a href="<?php echo $settings->link; ?>" title="<?php echo $settings->heading; ?>" target="<?php echo $settings->link_target; ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $settings->link_target, $settings->link_nofollow, 1 ); ?>>
			<?php endif; ?>
			<span class="uabb-heading-text"><?php echo $settings->heading; ?></span>
			<?php if ( ! empty( $settings->link ) ) : ?>
			</a>
		<?php endif; ?>
	</<?php echo $settings->tag; ?>>

	<?php if ( 'center' == $settings->separator_position ) { ?>
		<div class="uabb-module-content uabb-separator-parent">			
			<?php if ( 'line_icon' == $settings->separator_style || 'line_image' == $settings->separator_style || 'line_text' == $settings->separator_style ) { ?>
				<div class="uabb-separator-wrap <?php echo 'uabb-separator-' . $settings->alignment; ?> <?php echo ( 'line_text' == $settings->separator_style ) ? $settings->responsive_compatibility : ''; ?>">
					<div class="uabb-separator-line uabb-side-left">
						<span></span>
					</div>					    
					<div class="uabb-divider-content uabbi-divider">
						<?php $module->render_image(); ?>
						<?php
						if ( 'line_text' == $settings->separator_style ) {
							echo '<' . $settings->separator_text_tag_selection . ' class="uabb-divider-text">' . $settings->text_inline . '</' . $settings->separator_text_tag_selection . '>';
						}
						?>
					</div>					    
					<div class="uabb-separator-line uabb-side-right">
						<span></span>
					</div> 
				</div>
			<?php } ?>
			<?php if ( 'line' == $settings->separator_style ) { ?>
					<div class="uabb-separator"></div>
			<?php } ?>
		</div>
	<?php } ?>

	<?php if ( '' != $settings->description ) : ?>
		<div class="uabb-subheading uabb-text-editor">
			<?php echo $settings->description; ?>
		</div>
	<?php endif; ?>

	<?php if ( 'bottom' == $settings->separator_position ) { ?>
		<div class="uabb-module-content uabb-separator-parent">			
			<?php if ( 'line_icon' == $settings->separator_style || 'line_image' == $settings->separator_style || 'line_text' == $settings->separator_style ) { ?>
				<div class="uabb-separator-wrap <?php echo 'uabb-separator-' . $settings->alignment; ?> <?php echo ( 'line_text' == $settings->separator_style ) ? $settings->responsive_compatibility : ''; ?>">
					<div class="uabb-separator-line uabb-side-left">
						<span></span>
					</div>
					<div class="uabb-divider-content uabbi-divider">
						<?php $module->render_image(); ?>
						<?php
						if ( 'line_text' == $settings->separator_style ) {
								echo '<' . $settings->separator_text_tag_selection . ' class="uabb-divider-text">' . $settings->text_inline . '</' . $settings->separator_text_tag_selection . '>';
						}
						?>
					</div>
					<div class="uabb-separator-line uabb-side-right">
						<span></span>
					</div> 
				</div>
			<?php } ?>

			<?php if ( 'line' == $settings->separator_style ) { ?>
				<div class="uabb-separator"></div>
			<?php } ?>
		</div>
	<?php } ?> 
</div>
