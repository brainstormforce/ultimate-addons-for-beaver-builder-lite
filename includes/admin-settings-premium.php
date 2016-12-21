<div id="fl-uabb-premium-form" class="fl-settings-form uabb-fl-settings-form">

	<h3 class="fl-settings-form-header"><?php _e( 'Premium Features', 'uabb' ); ?><span class="uabb-builder-upgrade-button fl-builder-button"><a href="<?php echo BB_ULTIMATE_ADDON_UPGRADE_URL; ?>" target="_blank"><?php _e( 'Upgrade Today', 'uabb' ); ?><i class="dashicons dashicons-share-alt2"></i></a></span></h3>

	<form id="uabb-form" action="<?php UABBBuilderAdminSettings::render_form_action( 'uabb-premium' ); ?>" method="post">

		<div class="fl-settings-form-content">
			<!-- Load Panels -->
			<div class="uabb-form-setting">
				<h3><?php _e( 'Why Beavers love Ultimate Addons?', 'uabb' ); ?></h3>
				<ul>
					<li><h4>White Label</h4><p>You can White Label Ultimate Addons and provide a seamless experience to your clients without any extra cost.</p></li>
					<li><h4>Lightweight</h4><p>Like Beaver Builder, Ultimate Addons is built for performance. It follows the best WordPress development standards.</p></li>
					<li><h4>Professional Support</h4><p>Our dedicated support team is friendly and has experience of helping thousands of customers with consistent five star ratings.</p></li>
					<li><h4>Regular Updates</h4><p>We strive to keep Ultimate Addons on the cutting edge of functionality. Get free updates with bug fixes and new features.</p></li>
					<li><h4>Template Cloud</h4><p>Template Cloud is one of our flagship feature! It provides access to hundreds of templates right in the WordPress backend.</p></li>
					<li><h4>WordPress Multisite</h4><p>Ultimate Addons is 100% compatible and well tested on WordPress multisite network installations .</p></li>
					<li><h4>All Beaver Builder Editions</h4><p>Ultimate Addons work with free as well paid editions of Beaver Builder. It nicely complements agency version too.</p></li>
					<li><h4>All WordPress Themes</h4><p>Our plugin can be used with any theme. Genesis, GeneratePress & Beaver Builder themes are popular among our users.</p></li>
					<li><h4>From Brainstorm Force</h4><p>Over past many years, we have delivered several products that are used by thousands of businesses.</p></li>
				</ul>
			</div>
		</div>

		<p class="submit">
			<a class="button-primary" href="<?php echo BB_ULTIMATE_ADDON_UPGRADE_URL; ?>" target="_blank"><?php esc_attr_e( 'Upgrade', 'uabb' ); ?></a>
		</p>

	</form>
</div>
