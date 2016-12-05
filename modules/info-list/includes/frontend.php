<?php //echo '<xmp>'; print_r($settings); echo '</xmp>'; ?>
<div class="uabb-module-content uabb-info-list">
	<ul class="uabb-info-list-wrapper uabb-info-list-<?php echo $settings->icon_position;?>">
		<?php
		$module->render_list();
		?>
	</ul>
</div>