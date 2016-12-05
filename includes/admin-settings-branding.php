<div id="fl-uabb-branding-form" class="fl-settings-form uabb-branding-fl-settings-form">

	<h3 class="fl-settings-form-header"><?php _e( 'Branding', 'uabb' ); ?></h3>

	<form id="uabb-branding-form" action="<?php UABBBuilderAdminSettings::render_form_action( 'uabb-branding' ); ?>" method="post">

		<?php if ( FLBuilderAdminSettings::multisite_support() && ! is_network_admin() ) : ?>
		<label>
			<input class="fl-override-ms-cb" type="checkbox" name="fl-override-ms" value="1" <?php if(get_option('_fl_builder_uabb_branding')) echo 'checked="checked"'; ?> />
			<?php _e('Override network settings?', 'uabb'); ?>
		</label>
		<?php endif; ?>
		
		<div class="fl-settings-form-content">

			<?php
				// FLBuilderModel::update_admin_settings_option( '_fl_builder_uabb_branding', '' );
				$uabb    = BB_Ultimate_Addon_Helper::get_builder_uabb_branding();
				$checked = '';

				$uabb_plugin_name = $uabb_plugin_desc = $uabb_author_name = $uabb_author_url = $uabb_plugin_short_name = $uabb_knowledge_base_url = $uabb_contact_support_url = $uabb_hide_branding = $uabb_enable_template_cloud = '';

				if( is_array($uabb) ) {

					//	Check Neble Disable branding
					$uabb_plugin_name         = ( array_key_exists( 'uabb-plugin-name', $uabb ) ) ? $uabb['uabb-plugin-name'] : '';
					$uabb_plugin_short_name   = ( array_key_exists( 'uabb-plugin-short-name', $uabb ) ) ? $uabb['uabb-plugin-short-name'] : '';
					$uabb_plugin_desc         = ( array_key_exists( 'uabb-plugin-desc' , $uabb ) ) ? $uabb['uabb-plugin-desc' ] : '';
					$uabb_author_name         = ( array_key_exists( 'uabb-author-name' , $uabb ) ) ? $uabb['uabb-author-name' ] : '';
					$uabb_author_url          = ( array_key_exists( 'uabb-author-url' , $uabb ) ) ? $uabb['uabb-author-url' ] : '';
					$uabb_knowledge_base_url  = ( array_key_exists( 'uabb-knowledge-base-url' , $uabb ) ) ? $uabb['uabb-knowledge-base-url' ] : '';
					$uabb_contact_support_url = ( array_key_exists( 'uabb-contact-support-url' , $uabb ) ) ? $uabb['uabb-contact-support-url' ] : '';

					$uabb_hide_branding		  = ( get_option( 'uabb_hide_branding' ) != false ) ? ' checked' : '' ;
					
					$uabb_enable_template_cloud = ( array_key_exists( 'uabb-enable-template-cloud' , $uabb ) && $uabb['uabb-enable-template-cloud'] == 1 ) ? ' checked' : '';
				} ?>

			<?php /* Plugin Name*/ ?> 
			<div class="uabb-branding-fields" style="margin-top: 30px;">
			<h4 class="field-title"><?php _e( 'Plugin Name', 'uabb' ); ?></h4>
			<input type="text" name="uabb-plugin-name" placeholder="Ultimate Addon for Beaver Builder" value="<?php echo $uabb_plugin_name; ?>" class="regular-text uabb-plugin-name" />
			</div>

			<?php /* Plugin Short Name*/ ?> 
			<div class="uabb-branding-fields">
			<h4 class="field-title"><?php _e( 'Plugin Short Name', 'uabb' ); ?></h4>
			<input type="text" name="uabb-plugin-short-name" placeholder="UABB" value="<?php echo $uabb_plugin_short_name; ?>" class="regular-text uabb-plugin-short-name" />
			</div>
		
			<?php /* Plugin Description */ ?> 
			<div class="uabb-branding-fields">
			<h4 class="field-title"><?php _e( 'Plugin Description', 'uabb' ); ?></h4>
			<input type="text" name="uabb-plugin-desc" placeholder="Ultimate Addons is a premium extension for Beaver Builder that adds 30+ modules, 100+ templates and works on top of any Beaver Builder Package. (Free, Standard, Pro and Agency) You can use it with on any WordPress theme." value="<?php echo $uabb_plugin_desc; ?>" class="regular-text uabb-plugin-desc" />
			</div>
			
			<?php /* Author Name */ ?> 
			<div class="uabb-branding-fields">
			<h4 class="field-title"><?php _e( 'Author / Agency Name', 'uabb' ); ?></h4>
			<input type="text" name="uabb-author-name" placeholder="Brainstorm Force" value="<?php echo $uabb_author_name; ?>" class="regular-text uabb-author-name" />
			</div>

			<?php /* Author URL */ ?>
			<div class="uabb-branding-fields">
			<h4 class="field-title"><?php _e( 'Author / Agency URL', 'uabb' ); ?></h4>
			<input type="text" name="uabb-author-url" placeholder="http://www.brainstormforce.com" value="<?php echo $uabb_author_url; ?>" class="regular-text uabb-author-url" />
			</div>

			<?php /* Knowledge Base URL */ ?>
			<div class="uabb-branding-fields">
			<h4 class="field-title"><?php _e( 'Knowledge Base URL', 'uabb' ); ?></h4>
			<input type="text" name="uabb-knowledge-base-url" placeholder="https://www.ultimatebeaver.com/docs/" value="<?php echo $uabb_knowledge_base_url; ?>" class="regular-text uabb-knowledge-base-url" />
			</div>

			<?php /* Contact Support URL */ ?>
			<div class="uabb-branding-fields">
			<h4 class="field-title"><?php _e( 'Contact Support URL', 'uabb' ); ?></h4>
			<input type="text" name="uabb-contact-support-url" placeholder="https://store.brainstormforce.com/support/" value="<?php echo $uabb_contact_support_url; ?>" class="regular-text uabb-contact-support-url" />
			</div>

			<?php /* Enable Template Cloud */ ?>

 			<div class="uabb-form-setting">
 				<h4><?php echo _e( 'Enable Template Cloud', 'uabb' ); ?></h4>
 				<p class="uabb-admin-help"><?php _e('Enable this option to activate Template Cloud functionality.', 'uabb'); ?></p>
 				<label>					
 					<input type="checkbox" class="uabb-enable-template-cloud" name="uabb-enable-template-cloud" value="" <?php echo $uabb_enable_template_cloud; ?> ><?php _e( 'Enable Template Cloud Settings', 'uabb' ); ?>
 				</label>
 			</div>
 		
			<?php /* Hide This Form */ ?>
			<div class="uabb-form-setting">
				<h4><?php echo _e( 'Hide White Label Settings', 'uabb' ); ?></h4>
				<p class="uabb-admin-help"><?php _e('Enable this option to hide White Label settings. Re-activate the plugin to enable this form again.', 'uabb'); ?></p>
				<label>					
					<input type="checkbox" class="uabb-hide-branding" name="uabb-hide-branding" value="" <?php echo $uabb_hide_branding; ?> ><?php _e( 'Hide White Label Settings', 'uabb' ); ?>
				</label>
			</div>

		</div>

		<p class="submit">
			<input type="submit" name="fl-save-uabb-branding" class="button-primary" value="<?php esc_attr_e( 'Save Settings', 'uabb' ); ?>" />
			
			<?php wp_nonce_field('uabb-branding', 'fl-uabb-branding-nonce'); ?>
		</p>
	</form>
</div>
