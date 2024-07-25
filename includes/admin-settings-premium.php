<?php
/**
 * General Settings Page
 *
 * @package UABB Settings Premium
 */

?>

<div id="fl-uabb-premium-form" class="fl-settings-form uabb-fl-settings-form">

	<h3 class="fl-settings-form-header"><?php esc_html_e( 'Premium Features', 'uabb' ); ?></h3>

	<form id="uabb-form" action="<?php UABBBuilderAdminSettings::render_form_action( 'uabb-premium' ); ?>" method="post">

		<div class="fl-settings-form-content">
			<!-- Load Panels -->
			<div class="uabb-form-setting">
				<h3><?php esc_html_e( 'Why Beavers love Ultimate Addons?', 'uabb' ); ?></h3>
				<ul>
					<li><h4><?php esc_html_e( 'White Label', 'uabb' ); ?></h4><p><?php esc_html_e( 'You can White Label Ultimate Addons and provide a seamless experience to your clients without any extra cost.', 'uabb' ); ?></p></li>
					<li><h4><?php esc_html_e( 'Lightweight', 'uabb' ); ?></h4><p><?php esc_html_e( 'Like Beaver Builder, Ultimate Addons is built for performance. It follows the best WordPress development standards.', 'uabb' ); ?></p></li>
					<li><h4><?php esc_html_e( 'Professional Support', 'uabb' ); ?></h4><p><?php esc_html_e( 'Our dedicated support team is friendly and has experience of helping thousands of customers with consistent five star ratings.', 'uabb' ); ?></p></li>
					<li><h4><?php esc_html_e( 'Regular Updates', 'uabb' ); ?></h4><p><?php esc_html_e( 'We strive to keep Ultimate Addons on the cutting edge of functionality. Get free updates with bug fixes and new features.', 'uabb' ); ?></p></li>
					<li><h4><?php esc_html_e( 'Template Cloud', 'uabb' ); ?></h4><p><?php esc_html_e( 'Template Cloud is one of our flagship feature! It provides access to hundreds of templates right in the WordPress backend.', 'uabb' ); ?></p></li>
					<li><h4><?php esc_html_e( 'WordPress Multisite', 'uabb' ); ?></h4><p><?php esc_html_e( 'Ultimate Addons is 100% compatible and well tested on WordPress multisite network installations .', 'uabb' ); ?></p></li>
					<li><h4><?php esc_html_e( 'All Beaver Builder Editions', 'uabb' ); ?></h4><p><?php esc_html_e( 'Ultimate Addons work with free as well paid editions of Beaver Builder. It nicely complements agency version too.', 'uabb' ); ?></p></li>
					<li><h4><?php esc_html_e( 'All WordPress Themes', 'uabb' ); ?></h4><p><?php esc_html_e( 'Our plugin can be used with any theme. Genesis, GeneratePress & Beaver Builder themes are popular among our users.', 'uabb' ); ?></p></li>
					<li><h4><?php esc_html_e( 'From Brainstorm Force', 'uabb' ); ?></h4><p><?php esc_html_e( 'Over past many years, we have delivered several products that are used by thousands of businesses.', 'uabb' ); ?></p></li>
				</ul>
			</div>
		</div>

		<p class="submit">
			<a class="button-primary" href="<?php echo esc_url( BB_ULTIMATE_ADDON_UPGRADE_URL ); ?>" target="_blank"><?php esc_attr_e( 'Upgrade Today', 'uabb' ); ?></a>
		</p>

	</form>
</div>
