<?php
/**
 * Write Your Dynamic CSS Below This
 *
 * @package UABB Theme Dynamic CSS file
 */

ob_start();
?>

/* Theme Button
------------------------------------------------------ */
<?php $uabb_theme_btn_family = apply_filters( 'uabb/theme/button_font_family', '' ); // @codingStandardsIgnoreLine. ?>
<?php
$font_size_array = array();
$font_size       = '';
$font_size_unit  = '';
$font_size_array = uabb_theme_button_font_size( '' );
if ( is_array( $font_size_array ) && ! empty( $font_size_array ) ) {

	$font_size = ( array_key_exists( 'desktop', $font_size_array ) && ! empty( $font_size_array['desktop'] ) ) ? $font_size_array['desktop'] : '';

	$font_size_unit = ( array_key_exists( 'desktop-unit', $font_size_array ) && ! empty( $font_size_array['desktop-unit'] ) ) ? $font_size_array['desktop-unit'] : '';
}
?>
/*.fl-builder-content a.uabb-button,
.fl-builder-content a.uabb-button:visited,
.fl-builder-content a.uabb-creative-button,
.fl-builder-content a.uabb-creative-button:visited*/

.uabb-creative-button-wrap a,
.uabb-creative-button-wrap a:visited {

	<?php if ( isset( $uabb_theme_btn_family['family'] ) ) { ?>
	font-family: <?php echo $uabb_theme_btn_family['family']; ?>;
	<?php } ?> 

	<?php if ( isset( $uabb_theme_btn_family['weight'] ) ) { ?>
	font-weight: <?php echo $uabb_theme_btn_family['weight']; ?>;
	<?php } ?>

	<?php if ( $font_size != '' ) { ?>
	font-size: <?php echo $font_size . $font_size_unit; ?>;
	<?php } ?>

	<?php if ( uabb_theme_button_line_height( '' ) != '' ) { ?>
	line-height: <?php echo uabb_theme_button_line_height( '' ); ?>;
	<?php } ?>

	<?php if ( uabb_theme_button_letter_spacing( '' ) != '' ) { ?>
	letter-spacing: <?php echo uabb_theme_button_letter_spacing( '' ); ?>;
	<?php } ?>

	<?php if ( uabb_theme_button_text_transform( '' ) != '' ) { ?>
	text-transform: <?php echo uabb_theme_button_text_transform( '' ); ?>;
	<?php } ?>
}

.uabb-dual-button .uabb-btn,
.uabb-dual-button .uabb-btn:visited {
	<?php if ( isset( $uabb_theme_btn_family['family'] ) ) { ?>
	font-family: <?php echo $uabb_theme_btn_family['family']; ?>;
	<?php } ?> 

	<?php if ( isset( $uabb_theme_btn_family['weight'] ) ) { ?>
	font-weight: <?php echo $uabb_theme_btn_family['weight']; ?>;
	<?php } ?>

	<?php if ( $font_size != '' ) { ?>
	font-size: <?php echo $font_size . $font_size_unit; ?>;
	<?php } ?>

	<?php if ( uabb_theme_button_line_height( '' ) != '' ) { ?>
	line-height: <?php echo uabb_theme_button_line_height( '' ); ?>;
	<?php } ?>

	<?php if ( uabb_theme_button_letter_spacing( '' ) != '' ) { ?>
	letter-spacing: <?php echo uabb_theme_button_letter_spacing( '' ); ?>;
	<?php } ?>

	<?php if ( uabb_theme_button_text_transform( '' ) != '' ) { ?>
	text-transform: <?php echo uabb_theme_button_text_transform( '' ); ?>;
	<?php } ?>
}


/* Responsive Js Breakpoint Css */

#uabb-js-breakpoint { 
	content:"default"; 
	display:none;
}
<?php if ( $global_settings->responsive_enabled ) { ?>
@media screen and (max-width: <?php echo $global_settings->medium_breakpoint . 'px'; ?>) {
	#uabb-js-breakpoint {
		content:"<?php echo $global_settings->medium_breakpoint; ?>";
	}
}

@media screen and (max-width: <?php echo $global_settings->responsive_breakpoint . 'px'; ?>) {
	#uabb-js-breakpoint {
		content:"<?php echo $global_settings->responsive_breakpoint; ?>";
	}
}
<?php } ?>


<?php
/**
 * Write Your Dynamic CSS Above This
 */

	return ob_get_clean();
?>
