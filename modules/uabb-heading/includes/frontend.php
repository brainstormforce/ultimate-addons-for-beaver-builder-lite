<?php
/**
 *  UABB Heading Module front-end file
 *
 *  @package UABB Heading Module
 */

global $wp_embed;

// Ensure $settings is defined and initialized.
if ( ! isset( $settings ) ) {
	$settings = new stdClass(); // Create an empty object to avoid undefined errors.
}

// Ensure $module is defined and initialized.
if ( ! isset( $module ) ) {
	$module = new stdClass(); // Create an empty object to avoid undefined errors.
}

?>
<div class="uabb-module-content uabb-heading-wrapper uabb-heading-align-<?php echo esc_attr( $settings->alignment ); ?> <?php echo $settings->separator_style === 'line_text' ? esc_attr( $settings->responsive_compatibility ) : ''; ?>">
	<?php if ( $settings->separator_position === 'top' ) { ?>
		<div class="uabb-module-content uabb-separator-parent">
			<?php if ( $settings->separator_style === 'line_icon' || $settings->separator_style === 'line_image' || $settings->separator_style === 'line_text' ) { ?>
				<div class="uabb-separator-wrap <?php echo 'uabb-separator-' . esc_attr( $settings->alignment ); ?> <?php echo $settings->separator_style === 'line_text' ? esc_attr( $settings->responsive_compatibility ) : ''; ?>" >
					<div class="uabb-separator-line uabb-side-left">
						<span></span>
					</div>			 		    
					<div class="uabb-divider-content uabbi-divider">
						<?php $module->render_image(); ?>
						<?php
						if ( $settings->separator_style === 'line_text' ) {
							echo '<' . esc_attr( $settings->separator_text_tag_selection ) . ' class="uabb-divider-text">' . esc_attr( $settings->text_inline ) . '</' . esc_attr( $settings->separator_text_tag_selection ) . '>';
						}
						?>
					</div>			 		    
					<div class="uabb-separator-line uabb-side-right">
						<span></span>
					</div> 
				</div>
			<?php } ?>
			<?php if ( $settings->separator_style === 'line' ) { ?>
				<div class="uabb-separator"></div>
			<?php } ?>
		</div> 
	<?php } ?>
	<?php
	// Define a whitelist of allowed tags.
		$allowed_tags = [ 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ];
		$heading_tag  = in_array( $settings->tag, $allowed_tags, true ) ? $settings->tag : 'h3';
	?>
	<<?php echo esc_attr( $heading_tag ); ?> class="uabb-heading">
		<?php if ( ! empty( $settings->link ) ) { ?>
			<a href="<?php echo esc_url( $settings->link ); ?>" title="<?php echo esc_attr( $settings->heading ); ?>" target="<?php echo esc_attr( $settings->link_target ); ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( esc_attr( $settings->link_target ), $settings->link_nofollow, 1 ); ?>>
        <?php } ?>
			<span class="uabb-heading-text"><?php echo wp_kses_post( $settings->heading ); ?></span>
			<?php if ( ! empty( $settings->link ) ) { ?>
			</a>
            <?php } ?>
	</<?php echo esc_attr( $heading_tag ); ?>>

	<?php if ( $settings->separator_position === 'center' ) { ?>
		<div class="uabb-module-content uabb-separator-parent">			
			<?php if ( $settings->separator_style === 'line_icon' || $settings->separator_style === 'line_image' || $settings->separator_style === 'line_text' ) { ?>
				<div class="uabb-separator-wrap <?php echo 'uabb-separator-' . esc_attr( $settings->alignment ); ?> <?php echo $settings->separator_style === 'line_text' ? esc_attr( $settings->responsive_compatibility ) : ''; ?>">
					<div class="uabb-separator-line uabb-side-left">
						<span></span>
					</div>					    
					<div class="uabb-divider-content uabbi-divider">
						<?php $module->render_image(); ?>
						<?php
						if ( $settings->separator_style === 'line_text' ) {
							echo '<' . esc_attr( $settings->separator_text_tag_selection ) . ' class="uabb-divider-text">' . esc_html( $settings->text_inline ) . '</' . esc_attr( $settings->separator_text_tag_selection ) . '>';
						}
						?>
					</div>					    
					<div class="uabb-separator-line uabb-side-right">
						<span></span>
					</div> 
				</div>
			<?php } ?>
			<?php if ( $settings->separator_style === 'line' ) { ?>
					<div class="uabb-separator"></div>
			<?php } ?>
		</div>
	<?php } ?>

	<?php if ( $settings->description !== '' ) { ?>
		<div class="uabb-subheading uabb-text-editor">
			<?php echo wp_kses_post( wpautop( $wp_embed->autoembed( $settings->description ) ) ); ?>
		</div>
	<?php } ?>

	<?php if ( $settings->separator_position === 'bottom' ) { ?>
		<div class="uabb-module-content uabb-separator-parent">			
			<?php if ( $settings->separator_style === 'line_icon' || $settings->separator_style === 'line_image' || $settings->separator_style === 'line_text' ) { ?>
				<div class="uabb-separator-wrap <?php echo 'uabb-separator-' . esc_attr( $settings->alignment ); ?> <?php echo $settings->separator_style === 'line_text' ? esc_attr( $settings->responsive_compatibility ) : ''; ?>">
					<div class="uabb-separator-line uabb-side-left">
						<span></span>
					</div>
					<div class="uabb-divider-content uabbi-divider">
						<?php $module->render_image(); ?>
						<?php
						if ( $settings->separator_style === 'line_text' ) {
								echo '<' . esc_attr( $settings->separator_text_tag_selection ) . ' class="uabb-divider-text">' . esc_html( $settings->text_inline ) . '</' . esc_attr( $settings->separator_text_tag_selection ) . '>';
						}
						?>
					</div>
					<div class="uabb-separator-line uabb-side-right">
						<span></span>
					</div> 
				</div>
			<?php } ?>

			<?php if ( $settings->separator_style === 'line' ) { ?>
				<div class="uabb-separator"></div>
			<?php } ?>
		</div>
	<?php } ?> 
</div>
