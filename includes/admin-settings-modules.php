<div id="fl-uabb-modules-form" class="fl-settings-form uabb-modules-fl-settings-form">

	<h3 class="fl-settings-form-header"><?php echo sprintf( __( '%s Modules', 'uabb' ), UABB_PREFIX ); ?><span class="uabb-builder-upgrade-button fl-builder-button"><a href="<?php echo BB_ULTIMATE_ADDON_UPGRADE_URL; ?>" target="_blank"><?php _e( 'Unlock All Modules', 'uabb' ); ?><i class="dashicons dashicons-share-alt2"></i></a></span></h3>

	<div id="uabb-modules-form" class="uabb-lite-modules" action="<?php UABBBuilderAdminSettings::render_form_action( 'uabb-modules' ); ?>" method="post">
		<div class="fl-settings-form-content">
			<?php $modules_array   = BB_Ultimate_Addon_Helper::get_all_modules(); ?>
			<?php foreach ( $modules_array as $slug => $name ) : ?>
					<p><label><?php echo $name; ?></label></p>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="uabb-premium-modules">
		<p><label>Advanced Accordion</label></p>
                <p><label>Advanced Icons</label></p>
                <p><label>Advanced Posts</label></p>
                <p><label>Advanced Separator</label></p>
                <p><label>Advanced Tabs</label></p>
                <p><label>Call to Action</label></p>
                <p><label>Contact Form</label></p>
                <p><label>Counter</label></p>
                <p><label>Creative Link</label></p>
                <p><label>Dual Button</label></p>
                <p><label>Dual Color Heading</label></p>
                <p><label>Fancy Text</label></p>
                <p><label>Google Map</label></p>
                <p><label>Heading</label></p>
                <p><label>Info Banner</label></p>
                <p><label>Info Box</label></p>
                <p><label>Info Circle</label></p>
                <p><label>Info List</label></p>
                <p><label>Info Table</label></p>
                <p><label>Interactive Banner 1</label></p>
                <p><label>Interactive Banner 2</label></p>
                <p><label>List Icon</label></p>
                <p><label>MailChimp Subscription Form</label></p>
                <p><label>Modal Popup</label></p>
                <p><label>Photo</label></p>
                <p><label>Photo Gallery</label></p>
                <p><label>Price Box</label></p>
                <p><label>Progress Bar</label></p>
                <p><label>Team</label></p>
                <p><label>Testimonials</label></p>
                <p><label>iHover</label></p>
	</div>
</div>