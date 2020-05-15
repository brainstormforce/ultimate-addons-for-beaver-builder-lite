<?php

$settings->title_color = UABB_Helper::uabb_colorpicker( $settings, 'title_color' );
$settings->rating_unmarked_color  = UABB_Helper::uabb_colorpicker( $settings, 'rating_unmarked_color' );
$settings->rating_color    = UABB_Helper::uabb_colorpicker( $settings, 'rating_color' );


FLBuilderCSS::typography_field_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'title_typography',
		'selector'     => ".fl-node-$id .uabb-rating-title",
	)
);
?>

.fl-module-uabb-star-rating.fl-node-<?php echo $id; ?> .uabb-rating i {
	font-size: <?php echo $settings->star_icon_size . 'px'; ?>;
	color: <?php echo ( $settings->rating_unmarked_color ); ?>;
}


.fl-module-uabb-star-rating.fl-node-<?php echo $id; ?> .uabb-rating i:not(.uabb-star-empty):before {
	content: "\002605";
}

<?php
if ( '' !== $settings->star_icon_spacing ) {
	?>
	.fl-module-uabb-star-rating.fl-node-<?php echo $id; ?> .uabb-rating i:not(:last-of-type) {
		margin-right: <?php echo $settings->star_icon_spacing . 'px'; ?>;
	}
	<?php
}
?>

.fl-module-uabb-star-rating.fl-node-<?php echo $id; ?> .uabb-rating i:before {
	color: <?php echo ( $settings->rating_color ); ?>;
}

.fl-module-uabb-star-rating.fl-node-<?php echo $id; ?> .uabb-rating-content {

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
	.fl-module-uabb-star-rating.fl-node-<?php echo $id; ?> .uabb-rating-content {
		text-align: <?php echo $settings->alignment; ?>;
	}
	<?php
}
?>
.fl-module-uabb-star-rating.fl-node-<?php echo $id; ?> .uabb-rating-content .uabb-rating-title {
	color: <?php echo ( $settings->title_color ); ?>;

	<?php
	if ( 'inline' === $settings->rating_layout ) {
		if ( 'justify' === $settings->alignment ) {
			?>
		margin-right: auto;
			<?php
		} else {

			if ( 'top' === $settings->star_position ) {
				?>
				margin-left: <?php echo $settings->title_spacing . 'px'; ?>;
				<?php
			} else {
				?>
				margin-right: <?php echo $settings->title_spacing . 'px'; ?>;
				<?php
			}
		}
	}
	?>
}

<?php
if ( 'inline' === $settings->rating_layout && 'justify' !== $settings->alignment ) {
	?>
	.fl-module-uabb-star-rating.fl-node-<?php echo $id; ?> .uabb-rating-content > div {
		display: inline-block;
	}
	<?php
}
?>
