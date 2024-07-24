<?php
/**
 * This file should be used to render each module instance.
 * You have access to two variables in this file:
 *
 * $module An instance of your module class.
 * $settings The module's settings.
 *
 * @package UABB Ribbon Module
 */

?>
<?php
// Define a whitelist of allowed tags.
	$allowed_tags = array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div', 'p', 'span' );
	$ribbon_tag   = in_array( $settings->text_tag_selection, $allowed_tags ) ? $settings->text_tag_selection : 'h3';
?>
<div class="uabb-ribbon-wrap">
	<<?php echo esc_attr( $ribbon_tag ); ?> class="uabb-ribbon">		
		<span class="uabb-left-ribb flips"><i class="<?php echo $settings->left_icon; ?>"></i></span>
		<span class="uabb-ribbon-text">
			<?php
			if ( 'yes' == $settings->stitching ) {
				?>
				<div class="uabb-ribbon-stitches-top"></div> <?php } ?>
				<span class="uabb-ribbon-text-title"><?php echo $settings->title; ?></span>
			<?php
			if ( 'yes' == $settings->stitching ) {
				?>
				<div class="uabb-ribbon-stitches-bottom"></div> <?php } ?>
		</span>		
		<span class="uabb-right-ribb flips"><i class="<?php echo $settings->right_icon; ?>"></i></span>
	</<?php echo esc_attr( $ribbon_tag ); ?>>
</div>
