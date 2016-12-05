<div id="fl-uabb-license-form" class="fl-settings-form uabb-fl-settings-form">
	<h3 class="fl-settings-form-header"><?php _e( 'License', 'uabb' ); ?></h3>

	<?php
		$bsf_product_id = bsf_extract_product_id( BB_ULTIMATE_ADDON_DIR );
		$args = array(
			'product_id'                       => $bsf_product_id,
			'button_text_activate'             => 'Activate License',
			'button_text_deactivate'           => 'Deactivate License',
			'submit_button_class'              => 'button-primary uabb-button-space',
			'form_class'                       => 'uabb-form-wrap',
			'bsf_license_form_heading_class'   => 'uabb-heading-message',
			'bsf_license_active_class'         => 'uabb-success-message',
			'bsf_license_not_activate_message' => 'uabb-license-error',
			'size'                             => 'regular',
		);

		echo bsf_license_activation_form( $args );
	?>

	<?php if(is_multisite()) : ?>
	<p><strong style="color:#ff0000;"><?php _e( 'NOTE:', 'uabb' ); ?></strong> <?php _e('This applies to all sites on the network.', 'uabb'); ?></p>
	<?php endif; ?>

</div>
