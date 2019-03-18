<?php
/**
 * General Settings Page
 *
 * @package UABB Settings Template Cloud
 */

?>
<div id="fl-uabb-cloud-templates-form" class="fl-settings-form uabb-cloud-templates-fl-settings-form">

	<h3 class="fl-settings-form-header"><?php _e( 'Template Cloud', 'uabb' ); ?></h3>

	<div class="uabb-go-premium"><?php _e( '<a href="' . BB_ULTIMATE_ADDON_UPGRADE_URL . '" target="_blank">Go Premium</a> and get access to all Page Templates and Sections.', 'uabb' ); // @codingStandardsIgnoreLine. ?></div>

	<form id="uabb-cloud-templates-form" action="<?php UABBBuilderAdminSettings::render_form_action( 'uabb-cloud-templates' ); ?>" method="post">

		<?php if ( FLBuilderAdminSettings::multisite_support() && ! is_network_admin() ) : ?>
		<label>
			<input class="fl-override-ms-cb" type="checkbox" name="fl-override-ms" value="1" 
			<?php
			if ( get_option( '_fl_builder_uabb_cloud_templates' ) ) {
				echo 'checked="checked"';}
			?>
			/>
			<?php _e( 'Override network settings?', 'uabb' ); ?>
		</label>
		<?php endif; ?>

		<div class="fl-settings-form-content">

			<!-- Append all templates -->
			<div id="uabb-cloud-templates-tabs">

				<div id="uabb-cloud-templates-inner" class="wp-filter">

					<div class="filter-count">
						<span class="count"><?php echo UABB_Cloud_Templates::get_cloud_templates_count( 'page-templates' ); ?></span>
					</div>
					<ul class="uabb-filter-links">
						<li><a href="#uabb-cloud-templates-page-templates" data-count="<?php echo UABB_Cloud_Templates::get_cloud_templates_count( 'page-templates' ); ?>"> <?php _e( 'Page Templates', 'uabb' ); ?> </a></li>
						<li><a href="#uabb-cloud-templates-sections" data-count="<?php echo UABB_Cloud_Templates::get_cloud_templates_count( 'sections' ); ?>"> <?php _e( 'Sections', 'uabb' ); ?> </a></li>
					</ul>
					<div class="uabb-fetch-templates">
						<span class="button button-secondary uabb-cloud-process" data-operation="fetch">
							<i class="dashicons dashicons-update " style="padding: 3px;"></i>
							<span class="msg"> <?php _e( 'Refresh', 'uabb' ); ?> </span>
						</span>
					</div>

				</div>
				<div class="uabb-cloud-templates-tabs-container">
					<div id="uabb-cloud-templates-page-templates">
						<?php
							// Print Templates HTML.
							UABB_Cloud_Templates::template_html( 'page-templates' );
						?>
					</div>
					<div id="uabb-cloud-templates-sections">
						<?php
							// Print Templates HTML.
							UABB_Cloud_Templates::template_html( 'sections' );
						?>
					</div>
				</div>
			</div>


			<br/>

		</div>
	</form>
</div>
