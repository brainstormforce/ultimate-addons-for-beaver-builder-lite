<?php
$title  = $settings->rating_title;
$rating = $settings->rating;
$layout = 0;
?>
<div class="uabb-rating-content">

<?php
if ( 'bottom' === $settings->star_position ) {
	?>
	<div class="uabb-rating-title"><?php echo $title; ?></div>
	<?php
}
?>
	<div class="uabb-rating">
	<?php
	$icon = '&#9733;';

	if ( 'outline' === $settings->star_style ) {
		$icon = '&#9734;';
	}

	$rating         = (float) $rating > $settings->rating_scale ? $settings->rating_scale : $rating;
	$floored_rating = (int) $rating;
	$stars_html     = '';

	for ( $stars = 1; $stars <= $settings->rating_scale; $stars++ ) {
		if ( $stars <= $floored_rating ) {
			$stars_html .= '<i class="uabb-star-full">' . $icon . '</i>';
		} elseif ( $floored_rating + 1 === $stars && $rating !== $floored_rating ) {
			$stars_html .= '<i class="uabb-star-' . ( $rating - $floored_rating ) * 10 . '">' . $icon . '</i>';
		} else {
			$stars_html .= '<i class="uabb-star-empty">' . $icon . '</i>';
		}
	}

		echo $stars_html;
	?>
	</div>

<?php
if ( 'top' === $settings->star_position ) {
	?>
	<div class="uabb-rating-title"><?php echo $title; ?></div>
	<?php
}
?>
</div>
