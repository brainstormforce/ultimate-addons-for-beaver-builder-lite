<?php
/**
 * Analytics Settings Page
 *
 * @package UABB Settings Analytics
 */

?>
<div id="fl-uabb-analytics-form" class="fl-settings-form uabb-fl-settings-form">
	<br>
	<b><?php esc_html_e( 'Help Us Improve Your Experience', 'uabb' ); ?></b>
	<br>
	<br>
	<form id="uabb-analytics-form" action="<?php UABBBuilderAdminSettings::render_form_action( 'uabb-analytics' ); ?>" method="post">

		<div class="fl-settings-form-content">

			<?php
				$analytics_option = get_option( 'uabb_analytics_optin', false );
				$analytics_enabled = ( isset( $analytics_option )  && $analytics_option === 'yes' ) ? 'yes' : 'no';
			?>
			<div class="uabb-form-setting">
				<label>					
					<input type="checkbox" name="uabb-analytics-enabled" value="1" <?php checked( $analytics_enabled, 'yes' ); ?> />
					<?php esc_html_e( 'Collect non-sensitive information from your website, such as the PHP version and features used, to help us fix bugs faster, make smarter decisions, and build features that actually matter to you.', 'uabb' ); ?>
					<a target="_blank" rel="noopener" href="https://store.brainstormforce.com/usage-tracking/?utm_source=wp_dashboard&utm_medium=general_settings&utm_campaign=usage_tracking"><?php esc_html_e( 'Learn More', 'uabb' ); ?></a>
				</label>
			</div>
		</div>

		<p class="submit">
			<input type="submit" name="fl-save-uabb-analytics" class="button-primary" value="<?php esc_attr_e( 'Save Settings', 'uabb' ); ?>" />
		</p>

		<?php wp_nonce_field( 'uabb-analytics', 'fl-uabb-analytics-nonce' ); ?>

	</form>
</div>
