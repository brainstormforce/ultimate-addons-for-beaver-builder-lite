<?php
/**
 *  Preset Templates - ( categorized & uncategorized )
 *
 *  Showing imported preset templates from /templates/presets-*.dat
 *
 *  @package Imported preset templates
 */

?>

<div class="fl-builder-panel fl-builder-panel-ultimate-presets">
	<div class="fl-builder-panel-actions">
		<i class="fl-builder-panel-close fa fa-times"></i>
	</div>
	<div class="fl-builder-panel-content-wrap fl-nanoscroller">
		<div class="fl-builder-panel-content fl-nanoscroller-content">
			<div class="fl-builder-blocks">

				<!-- Search Presets -->
				<div id="fl-builder-blocks-rows" class="fl-builder-blocks-section">
					<input type="text" id="presets_search" placeholder="Search Preset..." style="width: 100%;">
					<div class="filter-count"></div>
				</div><!-- Search Presets -->

				<?php do_action( 'uabb_fl_builder_ui_panel_before_presets' ); ?>

				<?php

				/**
				 * Renders UABB categorized module templates in the UI panel.
				 *
				 * @see render_ui_panel_modules_templates()
				 */
				if ( ! $is_module_template && $has_editing_cap ) {

					$uabb_module_templates = UABB_UI_Panels::uabb_templates_data( $module_templates, 'includes' );

					if ( count( $uabb_module_templates ) > 0 ) :
						foreach ( $uabb_module_templates['categorized'] as $cat ) :

							// avoid 'Uncategorized'.
							if ( trim( $cat['name'] ) != 'Uncategorized' ) :
								?>
								<div class="fl-builder-blocks-section">
									<span class="fl-builder-blocks-section-title">
										<?php echo __( $cat['name'], 'uabb' ); // @codingStandardsIgnoreLine.?>
										<i class="fa fa-chevron-down"></i>
									</span>
									<div class="fl-builder-blocks-section-content fl-builder-module-templates">

										<?php
										foreach ( $cat['templates'] as $template ) :

											// Get tags.
											$tags = '';
											if ( is_array( $template['tags'] ) && count( $template['tags'] ) > 0 ) {
												$tags = implode( ', ', $template['tags'] );
											}
											?>

											<span class="fl-builder-block fl-builder-block-template fl-builder-block-module-template" data-id="<?php echo $template['id']; ?>" data-type="<?php echo $template['type']; ?>">
												<?php if ( ! stristr( $template['image'], 'blank.jpg' ) ) : ?>
												<img class="fl-builder-block-template-image" src="<?php echo $template['image']; ?>" />
												<?php endif; ?>
												<span class="fl-builder-block-title" data-tags="<?php echo $tags; ?>" data-cat-name="<?php echo $cat['name']; ?>"><?php echo $template['name']; ?></span>
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

				<?php do_action( 'uabb_fl_builder_ui_panel_after_presets' ); ?>

				<div class="fl-builder-modules-cta">
					<a href="#" onclick="window.open('<?php echo admin_url(); ?>options-general.php?page=fl-builder-settings#uabb-template-manager');" target="_blank"><i class="fa fa-external-link-square"></i> <?php echo sprintf( __( 'Note - You can enable, disable and manage %s presets here.', 'uabb' ), UABB_PREFIX ); // @codingStandardsIgnoreLine. ?></a>
				</div>
				<div class="fl-builder-modules-cta">
					<a href="#" target="_self"><?php echo __( 'Note - Images used in the templates are hotlinked from our server and are subject to copyright. It is strongly recommended that you replace them with your own.', 'uabb' ); ?></a>
				</div>
			</div>
		</div>
	</div>
</div>
