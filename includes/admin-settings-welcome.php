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
					<li><?php _e( '<a href="https://www.wpbeaverbuilder.com/go/bb-facebook" target="_blank">Join the Ultimate Addon for Beaver Builder\'s Group on Facebook</a>', 'fl-builder' ); ?></li>
					<li><?php _e( '<a href="https://www.wpbeaverbuilder.com/go/bb-slack" target="_blank">Join the Ultimate Addon for Beaver Builder\'s Group on Slack</a>', 'fl-builder'); ?></li>
				</ul>

				<p><?php _e('Come by and share a project, ask a question, or just say hi! For news about new features and updates, like our <a href="https://www.facebook.com/wpbeaverbuilder/" target="_blank">Facebook Page</a> or follow us <a href="https://twitter.com/beaverbuilder" target="_blank">on Twitter</a>.', 'fl-builder'); ?></p>

			</div>

			<div class="fl-welcome-col">
				<img class="fl-welcome-img" src="<?php echo FL_BUILDER_URL; ?>img/screenshot-getting-started.jpg" alt="">
			</div>

		</div>

		<hr>

		<div class="fl-welcome-col-wrap">

			<div class="fl-welcome-col">

				<h4><?php _e('What\'s New in Ultimate Addon for Beaver Builder 1.9 Shasta', 'fl-builder'); ?></h4>

				<p><?php _e('Ultimate Addon for Beaver Builder 1.9 is out and it has some epic new features:', 'fl-builder'); ?></p>

				<ul>
					<li><?php _e('The ability to drag, drop and nest columns.', 'fl-builder'); ?></li>
					<li><?php _e('A revamped editor with more accurate dragging and dropping.', 'fl-builder'); ?></li>
					<li><?php _e('Responsive settings for margins, paddings and borders.', 'fl-builder'); ?></li>
					<li><?php _e('New content page templates available in the template selector.', 'fl-builder'); ?></li>
				</ul>

				<p><?php printf( __('There\'s a whole lot more, too! Read about everything else on our <a href="%s" target="_blank">update post</a> or <a href="%s" target="_blank">change logs</a>.', 'fl-builder'), $blog_post_url, $change_logs_url ); ?></p>

			</div>

			<div class="fl-welcome-col">

				<h4><?php _e('Need Some Help?', 'fl-builder');  ?></h4>

				<p><?php _e('We take pride in offering outstanding support.', 'fl-builder');  ?></p>

				<p><?php _e('The fastest way to find an answer to a question is to see if someone\'s already answered it!', 'fl-builder');  ?></p>

				<p><?php printf( __('For that, check our <a href="%s" target="_blank">Knowledge Base</a>, <a href="%s" target="_blank">FAQ page</a>, or search our legacy <a href="%s" target="_blank">support forum.</a>', 'fl-builder'), $docs_url, $faqs_url, $forums_url );  ?></p>

				<p><?php printf( __('If you can\'t find an answer, consider upgrading to a premium version of Ultimate Addon for Beaver Builder. Our expert support team is waiting to answer your questions and help you build your website. <a href="%s" target="_blank">Learn More</a>.', 'fl-builder'), $upgrade_url ); ?></p>
			</div>

		</div>

	</div>
</div>
