<?php if( $settings->image_type != 'none' && $settings->image_type != '' ) { ?>
<div class="uabb-module-content uabb-imgicon-wrap"><?php /* Module Wrap */ ?>
	<?php /*Icon Html */ ?>
	<?php if( $settings->image_type == 'icon' ) { ?>
		<span class="uabb-icon-wrap">
			<span class="uabb-icon">
				<i class="<?php echo $settings->icon; ?>"></i>
			</span>
		</span>
	<?php } // Icon Html End ?>

	<?php if( $settings->image_type == 'photo' ) { // Photo Html ?>
		<?php
			$classes  = $module->get_classes();
			$src      = $module->get_src();
			$alt      = $module->get_alt();
		?>
		<div class="uabb-image<?php if ( ! empty( $settings->image_style ) ) echo ' uabb-image-crop-' . $settings->image_style ; ?>" itemscope itemtype="http://schema.org/ImageObject">
			<div class="uabb-image-content">
				<img class="<?php echo $classes; ?>" src="<?php echo $src; ?>" alt="<?php echo $alt; ?>" itemprop="image"/>
			</div>
		</div>

	<?php } // Photo Html End ?>
	</div><?php /* End Module Wrap */ ?>
<?php } ?>