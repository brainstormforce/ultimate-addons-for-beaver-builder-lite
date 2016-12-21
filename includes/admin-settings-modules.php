<div id="fl-uabb-modules-form" class="fl-settings-form uabb-modules-fl-settings-form">

	<h3 class="fl-settings-form-header"><?php echo sprintf( __( '%s Modules', 'uabb' ), UABB_PREFIX ); ?><span class="uabb-builder-upgrade-button fl-builder-button"><a href="<?php echo BB_ULTIMATE_ADDON_UPGRADE_URL; ?>" target="_blank"><?php _e( 'Unlock All Modules', 'uabb' ); ?><span class="dashicons dashicons-share-alt2"></span></a></span></h3>

	<div id="uabb-modules-form" class="uabb-lite-modules" action="<?php UABBBuilderAdminSettings::render_form_action( 'uabb-modules' ); ?>" method="post">
		<div class="fl-settings-form-content">
			<?php $modules_array   = BB_Ultimate_Addon_Helper::get_all_modules(); ?>
			<?php foreach ( $modules_array as $slug => $name ) : ?>
					<p><label><?php echo $name; ?></label></p>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="uabb-premium-modules">
		<p><label>Spacer / Gap</label></p>
        <p><label>Ribbon</label></p>
        <p><label>Image Separator</label></p>
        <p><label>Simple Separator</label></p>
        <p><label>Info Table</label></p>
        <p><label>Info List</label></p>
        <p><label>Slide Box</label></p>
        <p><label>Flip Box</label></p>
        <p><label>Image / Icon</label></p>
        <p><label>Button</label></p>
        <p><label>Spacer / Gap</label></p>
        <p><label>Ribbon</label></p>
        <p><label>Image Separator</label></p>
        <p><label>Simple Separator</label></p>
        <p><label>Info Table</label></p>
        <p><label>Info List</label></p>
        <p><label>Slide Box</label></p>
        <p><label>Flip Box</label></p>
        <p><label>Image / Icon</label></p>
        <p><label>Button</label></p>
        <p><label>Spacer / Gap</label></p>
        <p><label>Ribbon</label></p>
        <p><label>Image Separator</label></p>
        <p><label>Simple Separator</label></p>
        <p><label>Info Table</label></p>
	</div>
</div>