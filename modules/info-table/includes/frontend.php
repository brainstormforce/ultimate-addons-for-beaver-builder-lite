<?php
/**
 * Render the frontend content.
 *
 * @package UABB Info Table Module
 */

// Ensure $settings is defined and initialized.
if ( ! isset( $settings ) ) {
	$settings = new stdClass(); // Create an empty object to avoid undefined errors.
}

if ( isset( $settings->it_link_nofollow ) ) {
	$link_nofollow = $settings->it_link_nofollow;
} else {
	$link_nofollow = '';
}
?>
<?php if ( $settings->it_link_type === 'complete_link' ) { ?>
<a href="<?php echo esc_attr( $settings->it_link ); ?>" target="<?php echo esc_attr( $settings->it_link_target ); ?>" <?php UABB_Helper::get_link_rel( $settings->it_link_target, $link_nofollow, 1 ); ?>>
<?php } ?>
<div class="uabb-module-content info-table-wrap info-table-<?php echo esc_attr( $settings->box_design ); ?> info-table-cs-<?php echo esc_attr( $settings->color_scheme ); ?>">
	<div class="info-table">
		<?php
		// Define a whitelist of allowed tags.
		$allowed_tags  = [ 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div', 'p', 'span' ];
		$infotable_tag = in_array( $settings->heading_tag_selection, $allowed_tags, true ) ? $settings->heading_tag_selection : 'h3';
		?>
		<div class="info-table-heading">
			<?php echo '<' . esc_attr( $infotable_tag ) . " class='info-table-main-heading'>"; ?>
			<?php echo wp_kses_post( $settings->it_title ); ?>
			<?php echo '</' . esc_attr( $infotable_tag ) . '>'; ?>

			<?php echo '<' . esc_attr( $settings->sub_heading_tag_selection ) . " class='info-table-sub-heading'>"; ?>
			<?php echo wp_kses_post( $settings->sub_heading ); ?>
			<?php echo '</' . esc_attr( $settings->sub_heading_tag_selection ) . '>'; ?>
			<?php if ( $settings->it_link_type === 'cta' && $settings->box_design === 'design02' ) { ?>
			<div class="info-table-button">
				<a href="<?php echo esc_url( $settings->it_link ); ?>" target="<?php echo esc_attr( $settings->it_link_target ); ?>" <?php UABB_Helper::get_link_rel( esc_attr( $settings->it_link_target ), $link_nofollow, 1 ); ?>><?php echo esc_html( $settings->button_text ); ?></a>
			</div>
			<?php } ?>	
		</div>
		<div class="info-table-icon">
			<?php
			$imageicon_array = [

				/* General Section */
				'image_type'            => $settings->image_type,

				/* Icon Basics */
				'icon'                  => $settings->icon,
				'icon_size'             => $settings->icon_size,
				'icon_align'            => 'center', // $settings->icon_align.

			/* Image Basics */
				'photo_source'          => $settings->photo_source,
				'photo'                 => $settings->photo,
				'photo_url'             => $settings->photo_url,
				'img_size'              => $settings->img_size,
				'img_align'             => 'center', // $settings->img_align.
				'photo_src'             => $settings->photo_src ?? '',

				/* Icon Style */
				'icon_style'            => $settings->icon_style,
				'icon_bg_size'          => $settings->icon_bg_size,
				'icon_border_style'     => $settings->icon_border_style,
				'icon_border_width'     => $settings->icon_border_width,
				'icon_bg_border_radius' => $settings->icon_bg_border_radius,

				/* Image Style */
				'image_style'           => $settings->image_style,
				'img_bg_size'           => $settings->img_bg_size,
				'img_border_style'      => $settings->img_border_style,
				'img_border_width'      => $settings->img_border_width,
				'img_bg_border_radius'  => $settings->img_bg_border_radius,
			];
			/* Render HTML Function */
			FLBuilder::render_module_html( 'image-icon', $imageicon_array );
			?>
		</div>
		<div class="info-table-description uabb-text-editor">
			<?php echo wp_kses_post( $settings->it_long_desc ); ?>
		</div>
		<?php if ( $settings->it_link_type === 'cta' && $settings->box_design !== 'design02' ) { ?>
		<div class="info-table-button">
			<a href="<?php echo esc_url( $settings->it_link ); ?>" target="<?php echo esc_attr( $settings->it_link_target ); ?>"><?php echo esc_html( $settings->button_text ); ?></a>
		</div>
		<?php } ?>
	</div>
</div>
<?php if ( $settings->it_link_type === 'complete_link' ) { ?>
</a>
<?php } ?>
