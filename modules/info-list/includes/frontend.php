<?php
/**
 * Render the frontend content.
 *
 * @package UABB Info List Module
 */

// Ensure $settings is defined and initialized.
if ( ! isset( $settings ) ) {
	$settings = new stdClass(); // Create an empty object to avoid undefined errors.
}

// Ensure $settings is defined and initialized.
if ( ! isset( $module ) ) {
	$module = new stdClass(); // Create an empty object to avoid undefined errors.
}

?>
<div class="uabb-module-content uabb-info-list">
	<ul class="uabb-info-list-wrapper uabb-info-list-<?php echo esc_attr( $settings->icon_position ); ?>">
		<?php
		$module->render_list();
		?>
	</ul>
</div>
