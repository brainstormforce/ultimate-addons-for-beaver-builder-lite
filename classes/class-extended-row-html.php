<?php 

$separator_class = 'uabb-row-separator';
$separator_class .= ' uabb-'.$row->separator_flag.'-row-separator';
$is_svg 		 = false;
$svg_html		 = '';

if ( $row->separator_flag == 'bottom' ) {
	$row->separator_color = UABB_Helper::uabb_colorpicker( $row, 'bot_separator_color', true );
	$row->separator_shape = $row->bot_separator_shape;
	$row->separator_shape_height = $row->bot_separator_shape_height;
}else{
	$row->separator_color = UABB_Helper::uabb_colorpicker( $row, 'separator_color', true );
}

if( $row->separator_shape == 'triangle_svg' ) {
	$is_svg = true;
	$separator_class .= ' uabb-svg-triangle uabb-has-svg';
	$svg_html = '<svg class="uasvg-svg-triangle" xmlns="http://www.w3.org/2000/svg" version="1.1" fill="'.$row->separator_color.'" width="100%" height="'.$row->separator_shape_height.'" viewBox="0 0 0.156661 0.1"><polygon points="0.156661,3.93701e-006 0.156661,0.000429134 0.117665,0.05 0.0783307,0.0999961 0.0389961,0.05 -0,0.000429134 -0,3.93701e-006 0.0783307,3.93701e-006 "/></svg>';
}else if($row->separator_shape == 'xlarge_triangle') {
	$is_svg = true;
	$separator_class .= ' uabb-xlarge-triangle uabb-has-svg';
	$svg_html = '<svg class="uasvg-xlarge-triangle" xmlns="http://www.w3.org/2000/svg" version="1.1" fill="'.$row->separator_color.'" width="100%" height="'.$row->separator_shape_height.'" viewBox="0 0 4.66666 0.333331" preserveAspectRatio="none"><path class="fil0" d="M-0 0.333331l4.66666 0 0 -3.93701e-006 -2.33333 0 -2.33333 0 0 3.93701e-006zm0 -0.333331l4.66666 0 0 0.166661 -4.66666 0 0 -0.166661zm4.66666 0.332618l0 -0.165953 -4.66666 0 0 0.165953 1.16162 -0.0826181 1.17171 -0.0833228 1.17171 0.0833228 1.16162 0.0826181z"/></svg>';
}else if($row->separator_shape == 'xlarge_triangle_left') {
	$is_svg = true;
	$separator_class .= ' uabb-xlarge-triangle-left uabb-has-svg';
	$svg_html = '<svg class="uasvg-xlarge-triangle-left" xmlns="http://www.w3.org/2000/svg" version="1.1" fill="'.$row->separator_color.'" width="100%" height="'.$row->separator_shape_height.'" viewBox="0 0 2000 90" preserveAspectRatio="none"><polygon xmlns="http://www.w3.org/2000/svg" points="535.084,64.886 0,0 0,90 2000,90 2000,0 "></polygon></svg>';
}else if($row->separator_shape == 'xlarge_triangle_right') {
	$is_svg = true;
	$separator_class .= ' uabb-xlarge-triangle-right uabb-has-svg';
	$svg_html = '<svg class="uasvg-xlarge-triangle-right" xmlns="http://www.w3.org/2000/svg" version="1.1" fill="'.$row->separator_color.'" width="100%" height="'.$row->separator_shape_height.'" viewBox="0 0 2000 90" preserveAspectRatio="none"><polygon xmlns="http://www.w3.org/2000/svg" points="535.084,64.886 0,0 0,90 2000,90 2000,0 "></polygon></svg>';
}else if($row->separator_shape == 'circle_svg') {
	$is_svg = true;
	$separator_class .= ' uabb-svg-circle uabb-has-svg';
	$svg_html = '<svg class="uvc-svg-circle" xmlns="http://www.w3.org/2000/svg" version="1.1" fill="'.$row->separator_color.'" width="100%" height="'.$row->separator_shape_height.'" viewBox="0 0 0.2 0.1"><path d="M0.200004 0c-3.93701e-006,0.0552205 -0.0447795,0.1 -0.100004,0.1 -0.0552126,0 -0.0999921,-0.0447795 -0.1,-0.1l0.200004 0z"/></svg>';
}else if($row->separator_shape == 'xlarge_circle') {
	$is_svg = true;
	$separator_class .= ' uabb-xlarge-circle uabb-has-svg';
	$svg_html = '<svg class="uasvg-x-large-circle" xmlns="http://www.w3.org/2000/svg" version="1.1" fill="'.$row->separator_color.'" width="100%" height="'.$row->separator_shape_height.'" viewBox="0 0 4.66666 0.333331" preserveAspectRatio="none"><path class="fil1" d="M4.66666 0l0 7.87402e-006 -3.93701e-006 0c0,0.0920315 -1.04489,0.166665 -2.33333,0.166665 -1.28844,0 -2.33333,-0.0746339 -2.33333,-0.166665l-3.93701e-006 0 0 -7.87402e-006 4.66666 0z"/></svg>';
}else if($row->separator_shape == 'curve_up') {
	$is_svg = true;
	$separator_class .= ' uabb-curve-up-separator uabb-has-svg';
	$svg_html = '<svg class="curve-up-inner-separator uasvg-curve-up-separator" xmlns="http://www.w3.org/2000/svg" version="1.1" fill="'.$row->separator_color.'" width="100%" height="'.$row->separator_shape_height.'" viewBox="0 0 4.66666 0.333331" preserveAspectRatio="none"><path class="fil0" d="M-7.87402e-006 0.0148858l0.00234646 0c0.052689,0.0154094 0.554437,0.154539 1.51807,0.166524l0.267925 0c0.0227165,-0.00026378 0.0456102,-0.000582677 0.0687992,-0.001 1.1559,-0.0208465 2.34191,-0.147224 2.79148,-0.165524l0.0180591 0 0 0.166661 -7.87402e-006 0 0 0.151783 -4.66666 0 0 -0.151783 -7.87402e-006 0 0 -0.166661z"/></svg>';
}else if($row->separator_shape == 'curve_down') {
	$is_svg = true;
	$separator_class .= ' uabb-curve-down-separator uabb-has-svg';
	$svg_html = '<svg class="curve-down-inner-separator uasvg-curve-down-separator" xmlns="http://www.w3.org/2000/svg" version="1.1" fill="'.$row->separator_color.'" width="100%" height="'.$row->separator_shape_height.'" viewBox="0 0 4.66666 0.333331" preserveAspectRatio="none"><path class="fil0" d="M-7.87402e-006 0.0148858l0.00234646 0c0.052689,0.0154094 0.554437,0.154539 1.51807,0.166524l0.267925 0c0.0227165,-0.00026378 0.0456102,-0.000582677 0.0687992,-0.001 1.1559,-0.0208465 2.34191,-0.147224 2.79148,-0.165524l0.0180591 0 0 0.166661 -7.87402e-006 0 0 0.151783 -4.66666 0 0 -0.151783 -7.87402e-006 0 0 -0.166661z"/></svg>';
}else if($row->separator_shape == 'tilt_left') {
	$is_svg = true;
	$separator_class .= ' uabb-tilt-left-separator uabb-has-svg';
	$svg_html = '<svg class="uasvg-tilt-left-separator" xmlns="http://www.w3.org/2000/svg" version="1.1" fill="'.$row->separator_color.'" width="100%" height="'.$row->separator_shape_height.'" viewBox="0 0 4 0.266661" preserveAspectRatio="none"><polygon class="fil0" points="4,0 4,0.266661 -0,0.266661 "/></svg>';
}else if($row->separator_shape == 'tilt_right') {
	$is_svg = true;
	$separator_class .= ' uabb-tilt-right-separator uabb-has-svg';
	$svg_html = '<svg class="uvc-tilt-right-separator" xmlns="http://www.w3.org/2000/svg" version="1.1" fill="'.$row->separator_color.'" width="100%" height="'.$row->separator_shape_height.'" viewBox="0 0 4 0.266661" preserveAspectRatio="none"><polygon class="fil0" points="4,0 4,0.266661 -0,0.266661 "/></svg>';
}else if($row->separator_shape == 'waves') {
	$is_svg = true;
	$separator_class .= ' uabb-wave-separator uabb-has-svg';
	$svg_html = '<svg class="wave-inner-separator uasvg-wave-separator" xmlns="http://www.w3.org/2000/svg" version="1.1" fill="'.$row->separator_color.'" width="100%" height="'.$row->separator_shape_height.'" viewBox="0 -0.5 300 21" enable-background="new 0 -0.5 300 21" preserveAspectRatio="none">
			<path fill="'.$row->separator_color.'" d="M9.997-0.5c0,11.044,2.239,20,5,20h-10C2.292,19.5,0.087,10.898,0,0.16V19.5h4.997
				C7.758,19.5,9.997,10.544,9.997-0.5z M19.998-0.5c0,11.044,2.239,20,5,20h-10C17.758,19.5,19.997,10.544,19.998-0.5z M29.998-0.5
				c0,11.044,2.239,20,5,20h-10C27.759,19.5,29.998,10.544,29.998-0.5z M39.998-0.5c0,11.044,2.239,20,5,20h-10
				C37.758,19.5,39.998,10.544,39.998-0.5z M49.998-0.5c0,11.044,2.239,20,5,20h-10C47.759,19.5,49.998,10.544,49.998-0.5z M59.998-0.5
				c0,11.044,2.24,20,5,20h-10C57.759,19.5,59.998,10.544,59.998-0.5z M69.999-0.5c0,11.044,2.239,20,5,20h-10
				C67.759,19.5,69.998,10.544,69.999-0.5z M79.999-0.5c0,11.044,2.239,20,5,20h-10C77.759,19.5,79.998,10.544,79.999-0.5z M89.999-0.5
				c0,11.044,2.239,20,5,20h-10C87.76,19.5,89.999,10.544,89.999-0.5z M99.999-0.5c0,11.044,2.239,20,5,20h-10
				C97.76,19.5,99.999,10.544,99.999-0.5z M200.001-0.5c0.001,11.044,2.239,20,5,20h-10C197.762,19.5,200,10.544,200.001-0.5z
				 M195.001,19.5H185c-2.76,0-4.999-8.956-5-20c0,11.044-2.238,20-5,20h10c2.762,0,5-8.956,5.001-20
				C190.001,10.544,192.24,19.5,195.001,19.5L195.001,19.5z M175,19.5h-10c-2.76,0-5-8.956-5-20c0,11.044-2.239,20-5,20h10
				c2.762,0,5-8.956,5-20C170,10.544,172.239,19.5,175,19.5L175,19.5z M155,19.5h-10c-2.761,0-5-8.956-5-20c0,11.044-2.239,20-5,20h10
				c2.761,0,5-8.956,5-20C150,10.544,152.239,19.5,155,19.5L155,19.5z M135,19.5h-10c-2.761,0-5-8.956-5-20c0,11.044-2.239,20-5,20h10
				c2.761,0,5-8.956,5-20C130,10.544,132.239,19.5,135,19.5L135,19.5z M115,19.5h-10c2.761,0,5-8.956,5-20
				C110,10.544,112.238,19.5,115,19.5z M210.002-0.5c0,11.044,2.238,20,5,20h-10C207.763,19.5,210.002,10.544,210.002-0.5L210.002-0.5z
				 M220.002-0.5c0,11.044,2.239,20,5,20h-10C217.762,19.5,220.002,10.544,220.002-0.5z M230.002-0.5c0,11.044,2.238,20,5,20h-10
				C227.763,19.5,230.002,10.544,230.002-0.5L230.002-0.5z M240.002-0.5c0,11.044,2.239,20,5,20h-10
				C237.763,19.5,240.002,10.544,240.002-0.5z M250.002-0.5c0,11.044,2.239,20,5,20h-10C247.764,19.5,250.002,10.544,250.002-0.5
				L250.002-0.5z M260.002-0.5c0.001,11.044,2.24,20,5,20h-10C257.764,19.5,260.002,10.544,260.002-0.5z M270.003-0.5
				c0,11.044,2.239,20,5,20h-10.001C267.764,19.5,270.002,10.544,270.003-0.5L270.003-0.5z M280.003-0.5c0.001,11.044,2.239,20,5,20
				h-10C277.764,19.5,280.002,10.544,280.003-0.5z M290.003-0.5c0.001,11.044,2.239,20,5.001,20h-10.001
				C287.764,19.5,290.003,10.544,290.003-0.5L290.003-0.5z M300,0.16V19.5h-4.996C297.709,19.5,299.913,10.898,300,0.16z"/>
			</svg>';
}else if($row->separator_shape == 'clouds') {
	$is_svg = true;
	$separator_class .= ' uabb-cloud-separator uabb-has-svg';
	$svg_html = '<svg class="cloud-inner-separator uasvg-cloud-separator" xmlns="http://www.w3.org/2000/svg" version="1.1" fill="'.$row->separator_color.'" width="100%" height="'.$row->separator_shape_height.'" viewBox="0 0 2.23333 0.1" preserveAspectRatio="none"><path class="fil0" d="M2.23281 0.0372047c0,0 -0.0261929,-0.000389764 -0.0423307,-0.00584252 0,0 -0.0356181,0.0278268 -0.0865354,0.0212205 0,0 -0.0347835,-0.00524803 -0.0579094,-0.0283701 0,0 -0.0334252,0.0112677 -0.0773425,-0.00116929 0,0 -0.0590787,0.0524724 -0.141472,0.000779528 0,0 -0.0288189,0.0189291 -0.0762362,0.0111535 -0.00458268,0.0141024 -0.0150945,0.040122 -0.0656811,0.0432598 -0.0505866,0.0031378 -0.076126,-0.0226614 -0.0808425,-0.0308228 -0.00806299,0.000854331 -0.0819961,0.0186969 -0.111488,-0.022815 -0.0076378,0.0114843 -0.059185,0.0252598 -0.083563,-0.000385827 -0.0295945,0.0508661 -0.111996,0.0664843 -0.153752,0.019 -0.0179843,0.00227559 -0.0571181,0.00573622 -0.0732795,-0.0152953 -0.027748,0.0419646 -0.110602,0.0366654 -0.138701,0.00688189 0,0 -0.0771732,0.0395709 -0.116598,-0.0147677 0,0 -0.0497598,0.02 -0.0773346,-0.00166929 0,0 -0.0479646,0.0302756 -0.0998937,0.00944094 0,0 -0.0252638,0.0107874 -0.0839488,0.00884646 0,0 -0.046252,0.000775591 -0.0734567,-0.0237087 0,0 -0.046252,0.0101024 -0.0769567,-0.00116929 0,0 -0.0450827,0.0314843 -0.118543,0.0108858 0,0 -0.0715118,0.0609803 -0.144579,0.00423228 0,0 -0.0385787,0.00770079 -0.0646299,0.000102362 0,0 -0.0387559,0.0432205 -0.125039,0.0206811 0,0 -0.0324409,0.0181024 -0.0621457,0.0111063l-3.93701e-005 0.0412205 2.2323 0 0 -0.0627953z"/></svg>';
}else if($row->separator_shape == 'multi_triangle') {
	$is_svg = true;
	$separator_class .= ' uabb-multi-triangle uabb-has-svg';
	//Check if has hex color
	if( preg_match('/^#[a-f0-9]{3,6}$/i', $row->separator_color) ) {
		$rgb = UABB_Helper::uabb_hex2rgba( $row->separator_color, false, true );
	}else{
		$rgb = uabb_parse_color_to_hex( $row->separator_color );
		$rgb = UABB_Helper::uabb_hex2rgba( $rgb, false, true );
	}
	

	$svg_html = '<svg class="uasvg-multi-triangle-svg" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none" width="100%" height="'.$row->separator_shape_height.'">\
				            <path class="large left" d="M0 0 L50 50 L0 100" fill="rgba('.$rgb[0].','.$rgb[1].','.$rgb[2].', .1)"></path>\
				            <path class="large right" d="M100 0 L50 50 L100 100" fill="rgba('.$rgb[0].','.$rgb[1].','.$rgb[2].', .1)"></path>\
				            <path class="medium left" d="M0 100 L50 50 L0 33.3" fill="rgba('.$rgb[0].','.$rgb[1].','.$rgb[2].', .3)"></path>\
				            <path class="medium right" d="M100 100 L50 50 L100 33.3" fill="rgba('.$rgb[0].','.$rgb[1].','.$rgb[2].', .3)"></path>\
				            <path class="small left" d="M0 100 L50 50 L0 66.6" fill="rgba('.$rgb[0].','.$rgb[1].','.$rgb[2].', .5)"></path>\
				            <path class="small right" d="M100 100 L50 50 L100 66.6" fill="rgba('.$rgb[0].','.$rgb[1].','.$rgb[2].', .5)"></path>\
				            <path d="M0 99.9 L50 49.9 L100 99.9 L0 99.9" fill="rgba('.$rgb[0].','.$rgb[1].','.$rgb[2].', 1)"></path>\
				            <path d="M48 52 L50 49 L52 52 L48 52" fill="rgba('.$rgb[0].','.$rgb[1].','.$rgb[2].', 1)"></path>\
				        </svg>';
}else if($row->separator_shape == 'round_split') {
	$separator_class .= ' uabb-round-split';
}

?>

<div class="<?php echo $separator_class; ?>" >
<?php echo $svg_html; ?>
</div>