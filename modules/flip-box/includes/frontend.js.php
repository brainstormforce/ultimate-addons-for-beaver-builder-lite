<?php
/**
 *  UABB Flip Box Module front-end JS php file
 *
 *  @package UABB Flip Box Module
 */

?>
(function($) {

	var document_width, document_height;

	var args = {
		id: '<?php echo $id; ?>',
		flip_box_min_height_options: '<?php echo $settings->flip_box_min_height_options; ?>',
		display_vertically_center: '<?php echo $settings->display_vertically_center; ?>',
		flip_box_min_height: '<?php echo $settings->flip_box_min_height; ?>',
		flip_box_min_height_medium: '<?php echo $settings->flip_box_min_height_medium; ?>',
		flip_box_min_height_small: '<?php echo $settings->flip_box_min_height_small; ?>',
		small_breakpoint: <?php echo $global_settings->responsive_breakpoint; ?>,
		medium_breakpoint: <?php echo $global_settings->medium_breakpoint; ?>,
		responsive_compatibility: '<?php echo $settings->responsive_compatibility; ?>'
	};

	jQuery(document).ready( function() {

		document_width = $( document ).width();
		document_height = $( document ).height();

		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
			$('.fl-node-<?php echo $id; ?> .uabb-flip-box-outter').click(function(){
				if( $(this).hasClass( 'uabb-hover' ) ){
					$(this).removeClass('uabb-hover');
				} else {
					$(this).addClass('uabb-hover');
				}
			});
		}
		/* Accordion Click Trigger */
		UABBTrigger.addHook( 'uabb-accordion-click', function( argument, selector ) {
			new UABBFlipBox( args );
		});

		/* Tab Click Trigger */
		UABBTrigger.addHook( 'uabb-tab-click', function( argument, selector ) {
			new UABBFlipBox( args );
		});

	});

	jQuery(window).load( function() {
		new UABBFlipBox( args );
	});

	jQuery(window).resize( function() {
		if( document_width != $( document ).width() || document_height != $( document ).height() ) {
			document_width = $( document ).width();
			document_height = $( document ).height();
			new UABBFlipBox( args );
		}
	});

	new UABBFlipBox( args );

})(jQuery);
