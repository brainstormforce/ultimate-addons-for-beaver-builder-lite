<div class="uabb-module-content uabb-heading-wrapper uabb-heading-align-<?php echo $settings->alignment; ?> <?php echo ( $settings->separator_style == 'line_text' ) ? $settings->responsive_compatibility : ''; ?>">

	<<?php echo $settings->tag; ?> class="uabb-heading">
		<?php if(!empty($settings->link)) : ?>
		<a href="<?php echo $settings->link; ?>" title="<?php echo $settings->heading; ?>" target="<?php echo $settings->link_target; ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $settings->link_target, 0, 1 ); ?>>
		<?php endif; ?>
		<span class="uabb-heading-text"><?php echo $settings->heading; ?></span>
		<?php if(!empty($settings->link)) : ?>
		</a>
		<?php endif; ?>
	</<?php echo $settings->tag; ?>>
	
	
	<?php if( $settings->description != '' ) : ?>
	<div class="uabb-subheading uabb-text-editor">
		<?php echo $settings->description; ?>
	</div>
	<?php endif; ?>

</div>