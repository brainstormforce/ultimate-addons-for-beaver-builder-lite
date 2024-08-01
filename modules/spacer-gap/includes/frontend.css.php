<?php
/**
 *  UABB Spacer Gap Module front-end CSS php file
 *
 *  @package UABB Spacer Gap Module
 */

?>
.fl-node-<?php echo esc_attr( $id ); ?> {
	width: 100%;
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-spacer-gap-preview.uabb-spacer-gap {
	height: <?php echo esc_attr( ( '' !== $settings->desktop_space ) ? $settings->desktop_space : 10 ); ?>px;
	clear: both;
	width: 100%;
} 

<?php /* responsive layout starts here*/ ?>
<?php
if ( $global_settings->responsive_enabled ) { // Global Setting If started.
	if ( is_numeric( $settings->medium_device ) ) {
		/* Medium Breakpoint media query */
		?>

		@media ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ) . 'px'; ?> ) {
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-spacer-gap-preview.uabb-spacer-gap {
				height: <?php echo esc_attr( ( '' !== $settings->medium_device ) ? $settings->medium_device : 10 ); ?>px;
				clear: both;
				width: 100%;
			}
		}		
	<?php } ?>

	<?php
	if ( is_numeric( $settings->small_device ) ) {
		/* Small Breakpoint media query */
		?>
		@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ) . 'px'; ?> ) {
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-spacer-gap-preview.uabb-spacer-gap {
				height: <?php echo esc_attr( ( '' !== $settings->small_device ) ? $settings->small_device : 10 ); ?>px;
				clear: both;
				width: 100%;
			}
		}		
		<?php
	}
}
