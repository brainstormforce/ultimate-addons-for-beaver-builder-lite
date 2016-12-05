(function($) {

	jQuery(document).ready(function() {
		<?php if ( $settings->list_icon_animation == "yes" ) : ?>
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