<?php
/**
 * Render JavaScript to check function the various settings of module
 *
 * @package UABB Info List Module
 */

?>
(function($) {

	jQuery(document).ready(function() {
		<?php if ( 'yes' == $settings->list_icon_animation ) : ?>
			if(typeof jQuery.fn.waypoint !== 'undefined' ) {

			$( '.fl-node-<?php echo $id; ?> .uabb-info-list-icon' ).waypoint({
					offset: '90%',
					handler: function( e ) {
						jQuery(this.element).addClass('pulse animated');
					}
				});
			}

		<?php endif; ?>
	});

})(jQuery);
