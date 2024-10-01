<?php
/**
 *  Row and Module Categorized & UnCategorized Templates
 *
 *  Showing Row and Module Templates from sections-*.dat, presets-*.dat
 *
 *  @package Templates from sections and presets
 */

// Ensure required variables are set.
$has_editing_cap    = isset( $has_editing_cap ) ? $has_editing_cap : false;
$is_module_template = isset( $is_module_template ) ? $is_module_template : false;
$is_row_template    = isset( $is_row_template ) ? $is_row_template : false;
$row_templates      = isset( $row_templates ) ? $row_templates : array();

// Defining the constant.
if ( ! defined( 'UABB_PREFIX' ) ) {
	define( 'UABB_PREFIX', '' );
}

?>

<div class="fl-builder-panel fl-builder-panel-ultimate-rows">
	<div class="fl-builder-panel-actions">
		<i class="fl-builder-panel-close fa fa-times"></i>
	</div>
	<div class="fl-builder-panel-content-wrap fl-nanoscroller">
		<div class="fl-builder-panel-content fl-nanoscroller-content">
			<div class="fl-builder-blocks">

				<!-- Search Section -->
				<div id="fl-builder-blocks-rows" class="fl-builder-blocks-section">
					<input type="text" id="section_search" placeholder="<?php esc_attr_e( 'Search Section...', 'uabb' ); ?>" style="width: 100%;">
					<div class="filter-count"></div>
				</div><!-- Search Section -->

				<?php do_action( 'uabb_fl_builder_ui_panel_before_rows' ); ?>

				<?php

				/**
				 * Renders UABB categorized row templates in the UI panel.
				 *
				 * @see render_ui_panel_row_templates()
				 */
				if ( ! $is_row_template && ! $is_module_template && $has_editing_cap ) {

					$uabb_row_templates = UABB_UI_Panels::uabb_templates_data( $row_templates, 'includes' );

					if ( count( $uabb_row_templates ) > 0 ) :

						foreach ( $uabb_row_templates['categorized'] as $cat ) :

							// avoid 'Uncategorized'.
							if ( 'Uncategorized' !== trim( $cat['name'] ) ) :
								?>
								<div class="fl-builder-blocks-section">
									<span class="fl-builder-blocks-section-title">
										<?php echo __( $cat['name'], 'uabb' ); // @codingStandardsIgnoreLine.?>
										<i class="fa fa-chevron-down"></i>
									</span>
									<div class="fl-builder-blocks-section-content fl-builder-row-templates">
										<?php
										foreach ( $cat['templates'] as $template ) :

											// Get tags.
											$tags = '';
											if ( is_array( $template['tags'] ) && count( $template['tags'] ) > 0 ) {
												$tags = implode( ', ', $template['tags'] );
											}
											?>

											<span class="fl-builder-block fl-builder-block-template fl-builder-block-row-template" data-id="<?php echo esc_attr( $template['type'] ); ?>" data-type="<?php echo esc_attr( $template['type'] ); ?>">
												<?php if ( ! stristr( $template['image'], 'blank.jpg' ) ) : ?>
												<img class="fl-builder-block-template-image" src="<?php echo esc_url( $template['image'] ); ?>" />
												<?php endif; ?>
												<span class="fl-builder-block-title" data-tags="<?php echo esc_attr( $tags ); ?>" data-cat-name="<?php echo esc_attr( $cat['name'] ); ?>"><?php echo esc_html( $template['name'] ); ?></span>
											</span>

										<?php endforeach; ?>
									</div>
								</div>
								<?php
							endif;
						endforeach;
					endif;
				}
				?>

				<?php do_action( 'uabb_fl_builder_ui_panel_after_rows' ); ?>

				<?php if ( BB_Ultimate_Addon_Helper::get_builder_uabb_branding( 'uabb-enable-template-cloud' ) ) { ?>
				<div class="fl-builder-modules-cta">
					<a href="#" onclick="window.open('<?php echo admin_url(); ?>options-general.php?page=uabb-builder-settings#uabb-cloud-templates');" target="_blank"><i class="fa fa-external-link-square"></i> <?php echo sprintf( __( 'Note - You can enable, disable and manage %s sections here.', 'uabb' ), UABB_PREFIX ); // @codingStandardsIgnoreLine. ?></a>
				</div>
				<?php } ?>
				<div class="fl-builder-modules-cta">
					<a href="#" target="_self"><?php echo esc_html__( 'Note - Images used in the templates are hotlinked from our server and are subject to copyright. It is strongly recommended that you replace them with your own.', 'uabb' ); ?></a>
				</div>
			</div>
		</div>
	</div>
</div>
