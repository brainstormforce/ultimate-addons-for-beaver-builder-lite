<?php
/**
 *  UABB Image Icon Module front-end file
 *
 *  @package UABB Image Icon Module
 */

// Ensure $settings is defined and initialized.
if ( ! isset( $settings ) ) {
	$settings = new stdClass(); // Create an empty object to avoid undefined errors.
}

// Ensure $module is defined and initialized.
if ( ! isset( $module ) ) {
	$module = new stdClass(); // Create an empty object to avoid undefined errors.
}

?>
<?php if ( $settings->image_type !== 'none' && $settings->image_type !== '' ) { ?>
<div class="uabb-module-content uabb-imgicon-wrap"><?php /* Module Wrap */ ?>
	<?php /*Icon Html */ ?>
	<?php if ( $settings->image_type === 'icon' ) { ?>
		<span class="uabb-icon-wrap">
			<span class="uabb-icon">
				<i class="<?php echo esc_attr( $settings->icon ); ?>"></i>
			</span>
		</span>
	<?php } // Icon Html End. ?>

	<?php if ( $settings->image_type === 'photo' ) { // Photo Html. ?>
		<?php
			$classes = $module->get_classes();
			$src     = $module->get_src();
			$alt     = $module->get_alt();
		?>
		<div class="uabb-image
		<?php
		if ( ! empty( $settings->image_style ) ) {
			echo ' uabb-image-crop-' . esc_attr( $settings->image_style );
		}
		?>
		" itemscope itemtype="http://schema.org/ImageObject">
			<div class="uabb-image-content">
				<img class="<?php echo esc_attr( $classes ); ?>" src="<?php echo esc_url( $src ); ?>" alt="<?php echo esc_attr( $alt ); ?>" itemprop="image"/>
			</div>
		</div>

	<?php } // Photo Html End. ?>
	</div><?php /* End Module Wrap */ ?>
<?php } ?>
