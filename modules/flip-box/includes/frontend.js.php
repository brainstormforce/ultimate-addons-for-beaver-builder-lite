<?php
/**
 *  UABB Flip Box Module front-end JS php file
 *
 *  @package UABB Flip Box Module
 */

// Ensure $settings is defined and initialized.
if ( ! isset( $settings ) ) {
	$settings = new stdClass(); // Create an empty object to avoid undefined errors.
}

// Ensure $id is defined and initialized.
if ( ! isset( $id ) ) {
	$id = '';
}

// Ensure $global_settings is defined and initialized.
if ( ! isset( $global_settings ) ) {
	// Create an empty object to avoid undefined errors.
	$global_settings = new stdClass();
}

?>
(function($) {

	var document_width, document_height;

	var args = {
		id: '<?php echo esc_attr( $id ); ?>',
		flip_box_min_height_options: '<?php echo esc_attr( $settings->flip_box_min_height_options ); ?>',
		display_vertically_center: '<?php echo esc_attr( $settings->display_vertically_center ); ?>',
		flip_box_min_height: '<?php echo esc_attr( $settings->flip_box_min_height ); ?>',
		flip_box_min_height_medium: '<?php echo esc_attr( $settings->flip_box_min_height_medium ); ?>',
		flip_box_min_height_small: '<?php echo esc_attr( $settings->flip_box_min_height_small ); ?>',
		small_breakpoint: <?php echo esc_attr( $global_settings->responsive_breakpoint ); ?>,
		medium_breakpoint: <?php echo esc_attr( $global_settings->medium_breakpoint ); ?>,
		responsive_compatibility: '<?php echo esc_attr( $settings->responsive_compatibility ); ?>'
	};

	jQuery(document).ready( function() {

		document_width = $( document ).width();
		document_height = $( document ).height();

		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
			$('.fl-node-<?php echo esc_attr( $id ); ?> .uabb-flip-box-outter').click(function(){
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

	jQuery(window).on('load', function() {
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
