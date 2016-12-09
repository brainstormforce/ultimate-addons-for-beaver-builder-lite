<div id="fl-uabb-modules-form" class="fl-settings-form uabb-modules-fl-settings-form">

	<h3 class="fl-settings-form-header"><?php _e('Enabled Modules', 'uabb'); ?></h3>

	<form id="uabb-modules-form" action="<?php UABBBuilderAdminSettings::render_form_action( 'uabb-modules' ); ?>" method="post">

		<div class="fl-settings-form-content">

			<p><?php _e('Check or uncheck modules below to enable or disable them.', 'uabb'); ?></p>
			<?php

			$modules_array   = BB_Ultimate_Addon_Helper::get_all_modules();
			$enabled_modules = BB_Ultimate_Addon_Helper::get_builder_uabb_modules();
			$checked     	 = in_array('all', $enabled_modules) ? 'checked' : '';

			unset( $modules_array['image-icon'] );
			unset( $modules_array['uabb-separator' ] );
			unset( $modules_array['uabb-button' ] );
			
			?>
			<label>
				<input class="uabb-module-all-cb" type="checkbox" name="uabb-modules[all]" value="all" <?php echo $checked; ?> />
				<?php _ex( 'All', 'Plugin setup page: Modules.', 'uabb' ); ?>
			</label>
			
			<h3><?php echo sprintf( __( '%s Modules', 'uabb' ), UABB_PREFIX ); ?></h3>
			<?php foreach ( $modules_array as $slug => $name ) : ?>
					
					<?php 
						$checked = '';
						if ( array_key_exists( $slug, $enabled_modules ) && $enabled_modules[$slug] != 'false' ){
							$checked = 'checked';
						}
					?>
					<p>
						<label>
							<input class="uabb-module-cb" type="checkbox" name="uabb-modules[<?php echo $slug; ?>]" value="<?php echo $slug; ?>" <?php echo $checked; ?> />
							<?php echo $name; ?>
						</label>
					</p>
			<?php endforeach; ?>
		</div>
		<p class="submit">
			<input type="submit" name="update" class="button-primary" value="<?php esc_attr_e( 'Save Module Settings', 'uabb' ); ?>" />
			<?php wp_nonce_field('uabb-modules', 'fl-uabb-modules-nonce'); ?>
		</p>
	</form>
</div>