<?php
/**
 *  UABB Button Module front-end file
 *
 *  @package UABB Button Module
 */

?>

<?php
if ( isset( $settings->link_nofollow ) ) {
	$link_nofollow = $settings->link_nofollow;
} else {
	$link_nofollow = '';
}
?>
<div class="uabb-module-content <?php echo $module->get_classname(); ?>">
	<?php
	if ( isset( $settings->threed_button_options ) && ( 'animate_top' == $settings->threed_button_options || 'animate_bottom' == $settings->threed_button_options || 'animate_left' == $settings->threed_button_options || 'animate_right' == $settings->threed_button_options ) ) {
		?>
		<p class="perspective">
		<?php
	}
	?>
		<a href="<?php echo $settings->link; ?>" target="<?php echo $settings->link_target; ?>" <?php UABB_Helper::get_link_rel( $settings->link_target, $link_nofollow, 1 ); ?>class="uabb-button uabb-creative-button <?php echo 'uabb-creative-' . $settings->style . '-btn'; ?> <?php echo $module->get_button_style(); ?> <?php echo ( isset( $settings->a_class ) ) ? $settings->a_class : ''; ?> " <?php echo ( isset( $settings->a_data ) ) ? $settings->a_data : ''; ?> role="button">
			<?php
			if ( ! empty( $settings->icon ) && ( 'before' == $settings->icon_position || ! isset( $settings->icon_position ) ) ) :

				if ( 'flat' == $settings->style && isset( $settings->flat_button_options ) && ( 'animate_to_right' == $settings->flat_button_options || 'animate_to_left' == $settings->flat_button_options || 'animate_from_top' == $settings->flat_button_options || 'animate_from_bottom' == $settings->flat_button_options ) ) {
					$add_class_to_icon = '';
				} else {
					$add_class_to_icon = 'uabb-button-icon-before uabb-creative-button-icon-before';
				}
				?>
				<i class="uabb-button-icon uabb-creative-button-icon <?php echo $add_class_to_icon; ?> fa <?php echo $settings->icon; ?>"></i>
			<?php endif; ?>
			<span class="uabb-button-text uabb-creative-button-text"><?php echo $settings->text; ?></span>
			<?php
			if ( ! empty( $settings->icon ) && 'after' == $settings->icon_position ) :

				if ( 'flat' == $settings->style && isset( $settings->flat_button_options ) && ( 'animate_to_right' == $settings->flat_button_options || 'animate_to_left' == $settings->flat_button_options || 'animate_from_top' == $settings->flat_button_options || 'animate_from_bottom' == $settings->flat_button_options ) ) {
					$add_class_to_icon = '';
				} else {
					$add_class_to_icon = 'uabb-button-icon-after uabb-creative-button-icon-after';
				}
				?>
				<i class="uabb-button-icon uabb-creative-button-icon <?php echo $add_class_to_icon; ?> fa <?php echo $settings->icon; ?>"></i>
			<?php endif; ?>

		</a>
	<?php
	if ( isset( $settings->threed_button_options ) && ( 'animate_top' == $settings->threed_button_options || 'animate_bottom' == $settings->threed_button_options || 'animate_left' == $settings->threed_button_options || 'animate_right' == $settings->threed_button_options ) ) {
		?>
		</p>
		<?php
	}
	?>
</div>
