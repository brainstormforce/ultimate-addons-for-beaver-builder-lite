<?php
/**
 *  UABB Separator Module front-end CSS php file
 *
 *  @package UABB Separator Module
 */

?>
<?php

	// Define the $settings.
if ( ! isset( $settings ) ) {
	$settings = new stdClass(); // Create an empty object to avoid undefined errors.
}

	// Define and initialize the $id.
if ( ! isset( $id ) ) {
	$id = '';
}

	$settings->color  = uabb_theme_base_color( FLBuilderColor::hex_or_rgb( $settings->color ) );
	$settings->height = ( '' !== trim( $settings->height ) ) ? $settings->height : '1';
	$settings->width  = ( '' !== trim( $settings->width ) ) ? $settings->width : '100';

?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-separator {
	border-top:<?php echo esc_attr( $settings->height ); ?>px <?php echo esc_attr( $settings->style ); ?> <?php echo esc_attr( $settings->color ); ?>;
	width: <?php echo esc_attr( $settings->width ); ?>%;
	display: inline-block;
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-separator-parent {
	text-align: <?php echo esc_attr( $settings->alignment ); ?>;
}
