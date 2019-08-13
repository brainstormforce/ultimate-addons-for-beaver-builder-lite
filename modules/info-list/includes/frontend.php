<?php
/**
 * Render the frontend content.
 *
 * @package UABB Info List Module
 */

?>
<div class="uabb-module-content uabb-info-list">
	<ul class="uabb-info-list-wrapper uabb-info-list-<?php echo $settings->icon_position; ?>">
		<?php
		$module->render_list();
		?>
	</ul>
</div>
