<?php
	$classes  = $module->get_classes();
	$src      = $module->get_src();
	$alt      = $module->get_alt();
?>
<div class="uabb-module-content uabb-imgseparator-wrap">
	<?php if( $settings->enable_link == 'yes' ) : ?>
	<a class="imgseparator-link" href="<?php echo $settings->link; ?>" target="<?php echo $settings->link_target; ?>"></a>
	<?php endif; ?>
	<div class="uabb-image-separator uabb-image<?php if ( ! empty( $settings->image_style ) ) echo ' uabb-image-crop-' . $settings->image_style ; ?>" itemscope itemtype="http://schema.org/ImageObject">
		<img class="<?php echo $classes; ?> <?php echo ( $settings->img_animation_repeat == '0' ) ? 'infinite' : ''; ?>" src="<?php echo $src; ?>" alt="<?php echo $alt; ?>" itemprop="image"/>
	</div>
</div>