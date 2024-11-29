<?php
/**
 *  UABB Image Separator Module front-end file
 *
 *  @package UABB Image Separator Module
 */

	// Ensure $settings is defined and initialized.
if ( ! isset( $settings ) ) {
	$settings = new stdClass(); // Create an empty object to avoid undefined errors.
}

// Ensure $module is defined and initialized.
if ( ! isset( $module ) ) {
	$module = new stdClass(); // Create an empty object to avoid undefined errors.
}

	$classes = $module->get_classes();
	$src     = $module->get_src();
	$alt     = $module->get_alt();
?>
<div class="uabb-module-content uabb-imgseparator-wrap">
	<?php if ( $settings->enable_link === 'yes' ) { ?>
	<a class="imgseparator-link" href="<?php echo esc_url( $settings->link ); ?>" target="<?php echo esc_attr( $settings->link_target ); ?>"></a>
	<?php } ?>
	<div class="uabb-image-separator uabb-image
	<?php
	if ( ! empty( $settings->image_style ) ) {
		echo ' uabb-image-crop-' . esc_attr( $settings->image_style );
	}
	?>
	" itemscope itemtype="http://schema.org/ImageObject">
		<img class="<?php echo esc_attr( $classes ); ?> <?php echo $settings->img_animation_repeat === '0' ? 'infinite' : ''; ?>" src="<?php echo esc_url( $src ); ?>" alt="<?php echo esc_attr( $alt ); ?>" itemprop="image"/>
	</div>
</div>
