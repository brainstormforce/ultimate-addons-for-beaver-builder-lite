<?php
/**
 *  UABB Star Ratting Module front-end CSS php file
 *
 *  @package UABB Star Ratting Module
 */

$settings->title_color           = UABB_Helper::uabb_colorpicker( $settings, 'title_color' );
$settings->rating_unmarked_color = UABB_Helper::uabb_colorpicker( $settings, 'rating_unmarked_color' );
$settings->rating_color          = UABB_Helper::uabb_colorpicker( $settings, 'rating_color' );

if ( class_exists( 'FLBuilderCSS' ) ) {

	FLBuilderCSS::typography_field_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'title_typography',
			'selector'     => ".fl-node-$id .uabb-rating-title",
		)
	);

	FLBuilderCSS::responsive_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'star_icon_size',
			'selector'     => ".fl-node-$id .uabb-rating i",
			'prop'         => 'font-size',
			'unit'         => 'px',
		)
	);

	FLBuilderCSS::responsive_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'star_icon_spacing',
			'selector'     => ".fl-node-$id .uabb-rating i:not(:last-of-type)",
			'prop'         => 'margin-right',
			'unit'         => 'px',
		)
	);
}
?>

.fl-module-uabb-star-rating.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rating i {
	color: <?php echo esc_attr( $settings->rating_unmarked_color ); ?>;
}


.fl-module-uabb-star-rating.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rating i:not(.uabb-star-empty):before {
	content: "\002605";
}

.fl-module-uabb-star-rating.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rating i:before {
	color: <?php echo esc_attr( $settings->rating_color ); ?>;
}

.fl-module-uabb-star-rating.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rating-content {

	<?php
	if ( 'inline' === $settings->rating_layout && 'justify' === $settings->alignment ) {
		?>
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		flex-direction: row;
		justify-content: space-between;
		<?php
	} elseif ( 'inline' === $settings->rating_layout && 'justify' !== $settings->alignment ) {
		?>
		display: block;
		<?php
	}
	?>
}

<?php
if ( 'justify' !== $settings->alignment ) {
	?>
	.fl-module-uabb-star-rating.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rating-content {
		text-align: <?php echo esc_attr( $settings->alignment ); ?>;
	}
	<?php
}
?>
.fl-module-uabb-star-rating.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rating-content .uabb-rating-title {
	color: <?php echo esc_attr( $settings->title_color ); ?>;

	<?php
	if ( 'inline' === $settings->rating_layout ) {
		if ( 'justify' !== $settings->alignment ) {

			if ( 'top' === $settings->star_position ) {
				?>
				margin-left: <?php echo esc_attr( $settings->title_spacing ) . 'px'; ?>;
				<?php
			} else {
				?>
				margin-right: <?php echo esc_attr( $settings->title_spacing ) . 'px'; ?>;
				<?php
			}
		}
	}
	?>
}

<?php
if ( 'inline' === $settings->rating_layout && 'justify' !== $settings->alignment ) {
	?>
	.fl-module-uabb-star-rating.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rating-content > div {
		display: inline-block;
	}
	<?php
}
?>
<?php /* Global Setting If started */ ?>
<?php if ( $global_settings->responsive_enabled ) { ?>

		<?php /* Medium Breakpoint media query */ ?>
		@media ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ) . 'px'; ?> ) {

			<?php
			if ( 'justify' !== $settings->alignment_medium ) {
				?>
	.fl-module-uabb-star-rating.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rating-content {
		text-align: <?php echo esc_attr( $settings->alignment_medium ); ?>;
	}
				<?php
			}
			?>

}


	<?php /* Small Breakpoint media query */ ?>
		@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ) . 'px'; ?> ) {
		<?php
		if ( 'justify' !== $settings->alignment_responsive ) {
			?>
	.fl-module-uabb-star-rating.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rating-content {
		text-align: <?php echo esc_attr( $settings->alignment_responsive ); ?>;
	}
			<?php
		}
		?>

	}

		<?php
}
?>
