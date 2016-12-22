<?php
	
function fl_welcome_utm( $campaign ) {
	return array(
		'utm_medium'   => true === BB_ULTIMATE_ADDON_LITE ? 'bb-lite' : 'bb-pro',
		'utm_source'   => 'welcome-settings-page',
		'utm_campaign' => $campaign
	);
}

$blog_post_url     = FLBuilderModel::get_store_url( 'beaver-builder-1-9-shasta', fl_welcome_utm('settings-welcome-blog-post' ) );
$change_logs_url   = FLBuilderModel::get_store_url( 'change-logs', fl_welcome_utm( 'settings-welcome-change-logs' ) );
$upgrade_url       = FLBuilderModel::get_store_url( '', fl_welcome_utm( 'settings-welcome-upgrade' ) );
$support_url       = FLBuilderModel::get_store_url( 'beaver-builder-support', fl_welcome_utm( 'settings-welcome-support' ) );
$faqs_url          = FLBuilderModel::get_store_url( 'frequently-asked-questions', fl_welcome_utm( 'settings-welcome-faqs' ) );
$forums_url        = FLBuilderModel::get_store_url( 'support', fl_welcome_utm( 'settings-welcome-forums' ) );
$docs_url          = 'http://kb.wpbeaverbuilder.com/';
	
?>
<div id="fl-uabb-welcome-form" class="fl-settings-form">

	<h3 class="fl-settings-form-header"><?php _e('Welcome to Ultimate Addon for Beaver Builder!', 'fl-builder'); ?></h3>

	<div class="fl-settings-form-content fl-welcome-page-content">

		<p><?php _e('Thank you for choosing Ultimate Addon for Beaver Builder and welcome to the colony! Find some helpful information below. Also, to the left are the Page Builder settings options.', 'fl-builder'); ?>

			<?php printf( __('For more time-saving features and access to our expert support team, <a href="%s" target="_blank">upgrade today</a>.', 'fl-builder'), $upgrade_url ); ?>

		</p>

		<h4><?php _e('Getting Started - Building your first page.', 'fl-builder'); ?></h4>

		<div class="fl-welcome-col-wrap">

			<div class="fl-welcome-col">

				<p><a href="<?php echo admin_url(); ?>post-new.php?post_type=page" class="fl-welcome-big-link"><?php _e('Pages → Add New', 'fl-builder'); ?></a></p>

				<p><?php _e('Ready to start building? Add a new page and jump into Ultimate Addon for Beaver Builder by clicking the Page Builder tab shown on the image.', 'fl-builder'); ?></p>

				<h4><?php _e('Join the Community', 'fl-builder'); ?></h4>

				<p><?php _e('There\'s a wonderful community of "Ultimate Addon for Beaver Builders" out there and we\'d love it if <em>you</em> joined us!', 'fl-builder'); ?></p>

				<ul>
					<li><?php _e( '<a href="' . BB_ULTIMATE_ADDON_FB_URL . '" target="_blank">Join the Ultimate Addon for Beaver Builder\'s Group on Facebook</a>', 'fl-builder' ); ?></li>
					<li><?php _e( '<a href="https://www.wpbeaverbuilder.com/go/bb-slack" target="_blank">Join the Ultimate Addon for Beaver Builder\'s Group on Slack</a>', 'fl-builder'); ?></li>
				</ul>

				<p><?php _e('Come by and share a project, ask a question, or just say hi! For news about new features and updates, like our <a href="' . BB_ULTIMATE_ADDON_FB_URL . '" target="_blank">Facebook Page</a> or follow us <a href="' . BB_ULTIMATE_ADDON_TWITTER_URL . '" target="_blank">on Twitter</a>.', 'fl-builder'); ?></p>

			</div>

			<div class="fl-welcome-col">
				<img class="fl-welcome-img" src="<?php echo BB_ULTIMATE_ADDON_URL; ?>/assets/images/welcome-uabb.jpg" alt="">
			</div>

		</div>

	</div>
</div>
