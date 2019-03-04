<?php
/**
 * General Settings Page
 *
 * @package UABB Settings Modules
 */

?>
<div id="fl-uabb-modules-form" class="fl-settings-form uabb-modules-fl-settings-form">

	<h3 class="fl-settings-form-header"><?php echo sprintf( __( '%s Modules', 'uabb' ), UABB_PREFIX ); // @codingStandardsIgnoreLine. ?></h3>

	<div id="uabb-modules-form" class="uabb-lite-modules" action="<?php UABBBuilderAdminSettings::render_form_action( 'uabb-modules' ); ?>" method="post">
		<div class="fl-settings-form-content">
			<?php $modules_array = BB_Ultimate_Addon_Helper::get_all_modules(); ?>
			<?php foreach ( $modules_array as $slug => $name ) : ?>
				<p><label><?php echo $name; ?></label></p>
			<?php endforeach; ?>
		</div>
	</div>
		<h4 class="fl-settings-form-header"><?php echo sprintf( __( 'Upgrade to Premium version to get these modules', 'uabb' ), UABB_PREFIX ); ?><span class="uabb-builder-upgrade-button fl-builder-button"><a href="<?php echo BB_ULTIMATE_ADDON_UPGRADE_URL; ?>" title="Upgrade" target="_blank"><?php _e( 'Unlock All Modules', 'uabb' ); ?><i class="dashicons dashicons-share-alt2"></i></a></span></h4>
	<div class="uabb-premium-modules">
		<?php $modules_array = BB_Ultimate_Addon_Helper::get_premium_modules(); ?>
		<?php foreach ( $modules_array as $slug => $module ) : ?>
				<p class="<?php echo $module['class']; ?>"><a href="<?php echo $module['demo_url']; ?>" target="_blank" title="<?php echo $module['label']; ?>"><label title="<?php echo $module['tag_title']; ?>"><?php echo $module['label']; ?></label></a></p>
		<?php endforeach; ?>
	</div>
</div>
