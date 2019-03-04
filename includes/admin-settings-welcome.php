<?php
/**
 * General Settings Page
 *
 * @package UABB Settings WelCome
 */

?>

<div id="fl-uabb-welcome-form" class="fl-settings-form">

	<h3 class="fl-settings-form-header"><?php _e( 'Welcome to the Ultimate Addon for Beaver Builder!', 'uabb' ); ?></h3>

	<div class="fl-settings-form-content fl-welcome-page-content">

		<p><?php _e( 'Thank you for choosing the Ultimate Addons for Beaver Builder and welcome on board! We promise to take you through an ultimate journey of website building. You’ll find a few settings in the column on the left. Need some more time-saving and advanced modules to play with? You can avail all of them with 200+ page & section templates and dedicated support from our team.', 'uabb' ); // @codingStandardsIgnoreLine. ?></p>

		<div class="fl-welcome-col-wrap">

			<div class="fl-welcome-col">

				<p><?php printf( __( 'For more time-saving features and access to our expert support team, <a href="%s" target="_blank">upgrade now!</a> With regular updates, helpful tutorials, we promise to make website building an ultimate journey for you!', 'uabb' ), BB_ULTIMATE_ADDON_UPGRADE_URL ); // @codingStandardsIgnoreLine. ?>

				</p>


				<p><?php _e( 'The Ultimate Addon for Beaver Builder comes with a number of custom modules to enhance your experience of website creation with Beaver Builder. Inheriting the drag & drop functionality and the performance oriented objective of Beaver Builder, the Ultimate Addons are now the best addons to be used with the page builder.', 'uabb' ); // @codingStandardsIgnoreLine. ?>

				</p>

				<p><?php printf( __( 'With <a href="%1$s" target="_blank">regular updates</a>, <a href="%2$s" target="_blank">helpful tutorials</a>, we promise to make website building an ultimate journey for you!', 'uabb' ), 'https://www.ultimatebeaver.com/blog/?utm_source=uabb-dashboard&amp;utm_campaign=Lite&amp;utm_medium=welcome-page', 'https://www.ultimatebeaver.com/docs/?utm_source=uabb-dashboard&amp;utm_campaign=Lite&amp;utm_medium=welcome-page' ); // @codingStandardsIgnoreLine. ?></p>

			</div>

			<div class="fl-welcome-col">
				<img class="fl-welcome-img" src="<?php echo BB_ULTIMATE_ADDON_URL; ?>/assets/images/welcome-uabb.jpg" alt="">
			</div>
		</div>

		<h4><?php _e( 'Join our Community!', 'uabb' ); ?></h4>
		<p><?php printf( __( 'Want to connect with us to know more? Or have some suggestions we can take forward? <a href="%s" target="_blank">Join our Facebook community</a>, where a number of professional and newbie Beavers share their views and suggestions for the Ultimate Addons.', 'uabb' ), BB_ULTIMATE_ADDON_FB_URL );  // @codingStandardsIgnoreLine. ?></p>

	</div>
</div>
