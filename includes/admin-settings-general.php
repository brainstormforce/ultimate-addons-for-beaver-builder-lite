<?php
/**
 * General Settings Page
 *
 * @package UABB Settings General
 */

?>
<div id="fl-uabb-form" class="fl-settings-form uabb-fl-settings-form">

	<h3 class="fl-settings-form-header"><?php esc_html_e( 'General Settings', 'uabb' ); ?></h3>

	<form id="uabb-form" action="<?php UABBBuilderAdminSettings::render_form_action( 'uabb' ); ?>" method="post">

		<div class="fl-settings-form-content">

			<?php

				$uabb                = BB_Ultimate_Addon_Helper::get_builder_uabb();
				$branding_name       = BB_Ultimate_Addon_Helper::get_builder_uabb_branding( 'uabb-plugin-name' );
				$branding_short_name = BB_Ultimate_Addon_Helper::get_builder_uabb_branding( 'uabb-plugin-short-name' );

				$is_load_templates = '';
				$is_load_panels    = '';
				$uabb_live_preview = '';
			if ( is_array( $uabb ) ) {
				$is_load_panels    = ( array_key_exists( 'load_panels', $uabb ) && 1 === $uabb['load_panels'] ) ? ' checked' : '';
				$uabb_live_preview = ( array_key_exists( 'uabb-live-preview', $uabb ) && 1 === $uabb['uabb-live-preview'] ) ? ' checked' : '';
			}
			?>

			<!-- Load Panels -->
			<div class="uabb-form-setting">
				<h4><?php esc_html_e( 'Enable UI Design', 'uabb' ); ?></h4>
				<p class="uabb-admin-help">
					<?php esc_html_e( 'Enable this setting for applying UI effects such as - Section panel, Search box etc. to frontend page builder. ', 'uabb' ); ?>
					<?php
					if ( empty( $branding_name ) && empty( $branding_short_name ) ) :
						esc_html_e( 'Read ', 'uabb' );
						?>
						<a target="_blank" href="https://www.ultimatebeaver.com/docs/how-to-enable-disable-beaver-builders-ui/"><?php esc_html_e( 'this article', 'uabb' ); ?></a>
						<?php
						esc_html_e( ' for more information.', 'uabb' );
					endif;
					?>
				</p>
				<label>					
					<input type="checkbox" class="uabb-enabled-panels" name="uabb-enabled-panels" value="" <?php echo esc_attr( $is_load_panels ); ?> ><?php esc_html_e( 'Enable UI Design', 'uabb' ); ?>
				</label>
			</div>

			<!-- Load Panels -->
			<div class="uabb-form-setting">
				<h4><?php esc_html_e( 'Enable Live Preview', 'uabb' ); ?></h4>
				<p class="uabb-admin-help"><?php esc_html_e( 'Enable this setting to see live preview of a page without leaving the editor.', 'uabb' ); ?></p>
				<label>					
					<input type="checkbox" class="uabb-live-preview" name="uabb-live-preview" value="" <?php echo esc_attr( $uabb_live_preview ); ?> ><?php esc_html_e( 'Enable Live Preview', 'uabb' ); ?>
				</label>
			</div>
		</div>

		<p class="submit">
			<input type="submit" name="fl-save-uabb" class="button-primary" value="<?php esc_attr_e( 'Save Settings', 'uabb' ); ?>" />
		</p>

		<?php wp_nonce_field( 'uabb', 'fl-uabb-nonce' ); ?>

	</form>
</div>
