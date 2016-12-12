<?php

$settings->btn_text_color = UABB_Helper::uabb_colorpicker( $settings, 'btn_text_color' );
$settings->btn_text_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'btn_text_hover_color' );
$settings->heading_color = UABB_Helper::uabb_colorpicker( $settings, 'heading_color' );
$settings->sub_heading_color = UABB_Helper::uabb_colorpicker( $settings, 'sub_heading_color' );
$settings->description_color = UABB_Helper::uabb_colorpicker( $settings, 'description_color' );
//$settings->btn_color = UABB_Helper::uabb_colorpicker( $settings, 'btn_color' );

$settings->btn_bg_color = UABB_Helper::uabb_colorpicker( $settings, 'btn_bg_color', true );
$settings->btn_bg_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'btn_bg_hover_color', true );
$settings->heading_back_color = UABB_Helper::uabb_colorpicker( $settings, 'heading_back_color', true );
$settings->desc_back_color = UABB_Helper::uabb_colorpicker( $settings, 'desc_back_color', true );

$settings->icon_size = ( trim( $settings->icon_size ) !== '' ) ? $settings->icon_size : '75';
$settings->icon_bg_size = ( trim( $settings->icon_bg_size ) !== '' ) ? $settings->icon_bg_size : '30';
$settings->img_size = ( trim( $settings->img_size ) !== '' ) ? $settings->img_size : '150';
$settings->icon_bg_border_radius = ( trim( $settings->icon_bg_border_radius ) !== '' ) ? $settings->icon_bg_border_radius : '0';
$settings->icon_border_width = ( trim( $settings->icon_border_width ) !== '' ) ? $settings->icon_border_width : '1';
$settings->img_border_width = ( trim( $settings->img_border_width ) !== '' ) ? $settings->img_border_width : '1';

/* Render image icon css */
$imageicon_array = array(
      
    /* General Section */
    'image_type' => $settings->image_type,
 
    /* Icon Basics */
    'icon' => $settings->icon,
    'icon_size' => $settings->icon_size,
    'icon_align' => 'center',//$settings->icon_align,
 
    /* Image Basics */
    'photo_source' => $settings->photo_source,
    'photo' => $settings->photo,
    'photo_url' => $settings->photo_url,
    'img_size' => $settings->img_size,
    'img_align' => 'center',//$settings->img_align,
    'photo_src' => ( isset( $settings->photo_src ) ) ? $settings->photo_src : '' ,
 
    /* Icon Style */
    'icon_style' => $settings->icon_style,
    'icon_bg_size' => $settings->icon_bg_size,
    'icon_border_style' => $settings->icon_border_style,
    'icon_border_width' => $settings->icon_border_width,
    'icon_bg_border_radius' => $settings->icon_bg_border_radius,
 
    /* Image Style */
    'image_style' => $settings->image_style,
    'img_bg_size' => $settings->img_bg_size,
    'img_border_style' => $settings->img_border_style,
    'img_border_width' => $settings->img_border_width,
    'img_bg_border_radius' => $settings->img_bg_border_radius,
 
    /* Preset Color variable new */
    'icon_color_preset' => $settings->icon_color_preset, 
      
    /* Icon Colors */
    'icon_color' => $settings->icon_color,
    'icon_hover_color' => $settings->icon_hover_color,
    'icon_bg_color' => $settings->icon_bg_color,
    'icon_bg_color_opc' => $settings->icon_bg_color_opc,
    'icon_bg_hover_color' => $settings->icon_bg_hover_color,
    'icon_bg_hover_color_opc' => $settings->icon_bg_hover_color_opc,
    'icon_border_color' => $settings->icon_border_color,
    'icon_border_hover_color' => $settings->icon_border_hover_color,
    'icon_three_d' => $settings->icon_three_d,
 
    /* Image Colors */
    'img_bg_color' => $settings->img_bg_color,
    'img_bg_color_opc' => $settings->img_bg_color_opc,
    'img_bg_hover_color' => $settings->img_bg_hover_color,
    'img_bg_hover_color_opc' => $settings->img_bg_hover_color_opc,
    'img_border_color' => $settings->img_border_color,
    'img_border_hover_color' => $settings->img_border_hover_color,
);
/* CSS Render Function */ 
FLBuilder::render_module_css( 'image-icon', $id, $imageicon_array );
?>



/* Box Styling */
<?php 
	$icon_bg_color = '';
	$bg_color_code = '';
	$bg_head_color_code = '';
	$border_color = '';
	$border_color_top = '';
?>

.fl-node-<?php echo $id;?> .info-table {
	min-height: <?php echo $settings->min_height; ?>px;
}


<?php if ( $settings->color_scheme != "custom" ) { ?>
	<?php 
		if ( $settings->color_scheme == "black" ) {
			if ( $settings->box_design == "design01" || $settings->box_design == "design03") {
				$bg_color_code = "#333333";
				$icon_bg_color = "#333333";
			}elseif( $settings->box_design == "design02" ){
				$icon_bg_color = "#fbfbfb"; 
				$border_color = "#dcdcdc";
				$bg_color_code = "#f0f0f0";
				$bg_head_color_code = "#333333";
			}elseif( $settings->box_design == "design04" ){
				$bg_color_code = "#f9f9f9";
				$border_color = "#dddddd";
				$border_color_top = "#333333";
			}elseif( $settings->box_design == "design05" ){
				$bg_head_color_code = "#333333";
				$bg_color_code = "#f7f7f7";
				$border_color = "#dddddd";
			}elseif( $settings->box_design == "design06" ){
				$bg_head_color_code = "#333333";
				$bg_color_code = "#ffffff";
				$border_color = "#efefef";
			}
			$bg_grad_start = "#" .FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $bg_color_code ), 30, 'lighten' );
		}elseif ( $settings->color_scheme == "red" ) {
			if ( $settings->box_design == "design01" || $settings->box_design == "design03" ) {
				$bg_color_code = "#df4130";
				$icon_bg_color = "#333333";
			}elseif( $settings->box_design == "design02" ){
				$icon_bg_color = "#fbfbfb"; 
				$border_color = "#dcdcdc";
				$bg_color_code = "#f0f0f0";
				$bg_head_color_code = "#df4130";
			}elseif( $settings->box_design == "design04" ){
				$bg_color_code = "#f9f9f9";
				$border_color = "#dddddd";
				$border_color_top = "#df4130";
			}elseif( $settings->box_design == "design05" ){
				$bg_head_color_code = "#df4130";
				$bg_color_code = "#f7f7f7";
				$border_color = "#dddddd";
			}elseif( $settings->box_design == "design06" ){
				$bg_head_color_code = "#df4130";
				$bg_color_code = "#ffffff";
				$border_color = "#efefef";
			}
			$bg_grad_start = "#" .FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $bg_color_code ), 30, 'lighten' );
		}elseif ( $settings->color_scheme == "blue" ) {
			if ( $settings->box_design == "design01" || $settings->box_design == "design03" ) {
				$bg_color_code = "#2867b6";
				$icon_bg_color = "#333333";
			}elseif( $settings->box_design == "design02" ){
				$icon_bg_color = "#fbfbfb"; 
				$border_color = "#dcdcdc";
				$bg_color_code = "#f0f0f0";
				$bg_head_color_code = "#2867b6";
			}elseif( $settings->box_design == "design04" ){
				$bg_color_code = "#f9f9f9";
				$border_color = "#dddddd";
				$border_color_top = "#2867b6";
			}elseif( $settings->box_design == "design05" ){
				$bg_head_color_code = "#2867b6";
				$bg_color_code = "#f7f7f7";
				$border_color = "#dddddd";
			}elseif( $settings->box_design == "design06" ){
				$bg_head_color_code = "#2867b6";
				$bg_color_code = "#ffffff";
				$border_color = "#efefef";
			}
			$bg_grad_start = "#" .FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $bg_color_code ), 30, 'lighten' );
		}elseif ( $settings->color_scheme == "yellow" ) {
			if ( $settings->box_design == "design01" || $settings->box_design == "design03" ) {
				$bg_color_code = "#f1a90f";
				$icon_bg_color = "#333333";
			}elseif( $settings->box_design == "design02" ){
				$icon_bg_color = "#fbfbfb"; 
				$border_color = "#dcdcdc";
				$bg_color_code = "#f0f0f0";
				$bg_head_color_code = "#f1a90f";
			}elseif( $settings->box_design == "design04" ){
				$bg_color_code = "#f9f9f9";
				$border_color = "#dddddd";
				$border_color_top = "#f1a90f";
			}elseif( $settings->box_design == "design05" ){
				$bg_head_color_code = "#f1a90f";
				$bg_color_code = "#f7f7f7";
				$border_color = "#dddddd";
			}elseif( $settings->box_design == "design06" ){
				$bg_head_color_code = "#f1a90f";
				$bg_color_code = "#ffffff";
				$border_color = "#efefef";
			}
			$bg_grad_start = "#" .FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $bg_color_code ), 30, 'lighten' );
		}elseif ( $settings->color_scheme == "green" ) {
			if ( $settings->box_design == "design01" || $settings->box_design == "design03" ) {
				$bg_color_code = "#17924b";
				$icon_bg_color = "#333333";
			}elseif( $settings->box_design == "design02" ){
				$icon_bg_color = "#fbfbfb"; 
				$border_color = "#dcdcdc";
				$bg_color_code = "#f0f0f0";
				$bg_head_color_code = "#17924b";
			}elseif( $settings->box_design == "design04" ){
				$bg_color_code = "#f9f9f9";
				$border_color = "#dddddd";
				$border_color_top = "#17924b";
			}elseif( $settings->box_design == "design05" ){
				$bg_head_color_code = "#17924b";
				$bg_color_code = "#f7f7f7";
				$border_color = "#dddddd";
			}elseif( $settings->box_design == "design06" ){
				$bg_head_color_code = "#17924b";
				$bg_color_code = "#ffffff";
				$border_color = "#efefef";
			}
			$bg_grad_start = "#" .FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $bg_color_code ), 30, 'lighten' );
		}elseif ( $settings->color_scheme == "gray" ) {
			if ( $settings->box_design == "design01" || $settings->box_design == "design03" ) {
				$bg_color_code = "#d9dee0";
				$icon_bg_color = "#333333";
			}elseif( $settings->box_design == "design02" ){
				$icon_bg_color = "#fbfbfb"; 
				$border_color = "#dcdcdc";
				$bg_color_code = "#f0f0f0";
				$bg_head_color_code = "#d9dee0";
			}elseif( $settings->box_design == "design04" ){
				$bg_color_code = "#f9f9f9";
				$border_color = "#dddddd";
				$border_color_top = "#d9dee0";
			}elseif( $settings->box_design == "design05" ){
				$bg_head_color_code = "#d9dee0";
				$bg_color_code = "#f7f7f7";
				$border_color = "#dddddd";
			}elseif( $settings->box_design == "design06" ){
				$bg_head_color_code = "#d9dee0";
				$bg_color_code = "#ffffff";
				$border_color = "#efefef";
			}
			$bg_grad_start = "#" .FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $bg_color_code ), 30, 'lighten' );
		}
	?>
	.fl-node-<?php echo $id;?> .info-table-<?php echo $settings->box_design; ?>.info-table-cs-<?php echo $settings->color_scheme; ?> {
		background: -moz-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%, <?php echo $bg_color_code; ?> 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $bg_grad_start; ?>), color-stop(100%,<?php echo $bg_color_code; ?>)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%,<?php echo $bg_color_code; ?> 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%,<?php echo $bg_color_code; ?> 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%,<?php echo $bg_color_code; ?> 100%); /* IE10+ */
		background: linear-gradient(to bottom,  <?php echo $bg_grad_start; ?> 0%,<?php echo $bg_color_code; ?> 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $bg_grad_start; ?>', endColorstr='<?php echo $bg_color_code; ?>',GradientType=0 ); /* IE6-9 */
	}
		
	/* Design Two */
	.fl-node-<?php echo $id;?> .info-table-design02.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-heading {
		background: <?php echo $bg_head_color_code;?>;
	}
	.fl-node-<?php echo $id;?> .info-table-design02.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-icon {
		background: <?php echo $icon_bg_color;?>;
		border-bottom: 4px double <?php echo $border_color;?>;
	}
	
	<?php if ( $settings->hover_effect == 'shadow' ) { ?>
	.fl-node-<?php echo $id;?> .info-table:hover {
	    box-shadow: 0 0 7px rgba(167,167,167,.5);
	}
	<?php } ?>
	

	/* Design Three */
	.fl-node-<?php echo $id;?> .info-table-design03.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-icon {
		background: <?php echo $icon_bg_color;?>;
	}
	

	/* Design Four */
	.fl-node-<?php echo $id;?> .info-table-design04.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table {
		border-top: 5px solid <?php echo $border_color_top;?>;
		border-bottom: 5px solid <?php echo $border_color;?>;
	}
	.fl-node-<?php echo $id;?> .info-table-design04.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-icon {
		border-bottom: 2px solid #e5e5e5;
	}


	/* Design Five */
	.fl-node-<?php echo $id;?> .info-table-design05.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-heading,
	.fl-node-<?php echo $id;?> .info-table-design05.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-icon {
		background: <?php echo $bg_head_color_code;?>;
	}
	.fl-node-<?php echo $id;?> .info-table-design05.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table {
		border-bottom: 5px solid <?php echo $border_color;?>;
	}


	/* Design Six */
	.fl-node-<?php echo $id;?> .info-table-design06.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table {
		border: 1px solid <?php echo $border_color;?>;
	}
	.fl-node-<?php echo $id;?> .info-table-design06.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-heading {
		background: <?php echo $bg_head_color_code;?>;
	}
	.fl-node-<?php echo $id;?> .info-table-design06.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-icon {
		background: <?php echo $bg_head_color_code;?>;
		<?php
		if ( $settings->image_type == "icon" ) {
			$spacing = ( $settings->icon_size / 2 ) + 25;
		}elseif ( $settings->image_type == "photo" ) {
			$spacing = ( $settings->img_size / 2 ) + 25;
		}

		if ( $settings->image_type == "icon" && $settings->icon_style == "custom" ) {
			$spacing = $spacing + ( $settings->icon_bg_size / 2 );
		}elseif ( $settings->image_type == "photo" && $settings->image_style == "custom" ) {
			$spacing = $spacing + $settings->img_bg_size;
		}

		if ( $settings->image_type == "icon" && $settings->icon_style != "simple" && $settings->icon_style != "custom" ) {
			$spacing = $spacing + 40;
		}elseif ( $settings->image_type == "photo" &&  $settings->image_style != "simple" &&  $settings->image_style != "custom" ) {
			$spacing = $spacing;
		}
		?>
		height: <?php echo $spacing ;?>px;
		margin-bottom: <?php echo $spacing;?>px;
	}


	/* Button Design */
	<?php if( $settings->it_link_type == "cta") { ?>
		.fl-node-<?php echo $id;?> .info-table-wrap .info-table-button a {
			color: <?php echo uabb_theme_button_text_color( $settings->btn_text_color ); ?>;
			background: <?php echo uabb_theme_base_color( $settings->btn_bg_color ); ?>;
			padding: <?php echo uabb_theme_button_padding( '' ); ?>
		}

		<?php if ( $settings->box_design != 'design02' ) { ?>
			.fl-node-<?php echo $id;?> .info-table-wrap .info-table-button a {
				border-radius: <?php echo ( $settings->btn_radius != '' ) ? $settings->btn_radius : '3'; ?>px;
			}
		<?php } ?>

		<?php if ( $settings->btn_text_hover_color != '' || $settings->btn_bg_hover_color != '' ) { ?>
		.fl-node-<?php echo $id;?> .info-table-wrap .info-table-button a:hover {
			color: <?php echo $settings->btn_text_hover_color; ?>;
			background: <?php echo $settings->btn_bg_hover_color; ?>;
		}
		<?php } ?>

		<?php if ( $settings->box_design == 'design01' ) { ?>
			.fl-node-<?php echo $id;?> .info-table-design01 .info-table-button {
				background: #333333;
			}
		<?php }elseif ( $settings->box_design == 'design02' ) { ?>
			.fl-node-<?php echo $id;?> .info-table-wrap.info-table-design02 .info-table-button {
			    position: absolute;
			    right: 0;
			    width: 100%;
			    top: 50%;
			    transform: translateY(-50%);
			}
			.fl-node-<?php echo $id;?> .info-table-design02 .info-table-button a {
				padding: 7px;
			    position: absolute;
			    right: -8px;
			    top: 0;
			    transform: translateY(-50%);
			}
			.fl-node-<?php echo $id;?> .info-table-design02 .info-table-button a:after {
				content: "";
			    display: block;
			    position: absolute;
			    width: 0;
			    height: 0;
			    bottom: -6px;
			    right: 0;
			    border-bottom: 8px solid transparent;
			    border-left: 8px solid <?php echo uabb_theme_base_color( $settings->btn_bg_color ); ?>;
			    -webkit-transition: all 200ms ease-in-out;
	       	       -moz-transition: all 200ms ease-in-out;
	    				transition: all 200ms ease-in-out
			}
			.fl-node-<?php echo $id;?> .info-table-design02 .info-table-heading {
			    position: relative;
			}

			<?php if ( $settings->btn_bg_hover_color != '' ) { ?>
			.fl-node-<?php echo $id;?> .info-table-design02 .info-table-button a:hover::after {
				border-left: 8px solid <?php echo $settings->btn_bg_hover_color; ?>;
			}
			<?php } ?>
		<?php }elseif ( $settings->box_design == 'design04' ) { ?>
		<?php }elseif ( $settings->box_design == 'design05' ) { ?>
		<?php }elseif ( $settings->box_design == 'design06' ) { ?>
		<?php } ?>
	<?php } ?>
<?php }else{

	if( $settings->box_design == "design01" ) {
		$bg_color_code = ( $settings->desc_back_color ) ? $settings->desc_back_color : "#333333";
		$bg_grad_start = "#" .FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $bg_color_code ), 30, 'lighten' );
	}elseif( $settings->box_design == "design02" ) {
		$icon_bg_color = "#fbfbfb"; 
		$border_color = "#dcdcdc";
		$bg_head_color_code = ( $settings->heading_back_color ) ? $settings->heading_back_color : "#333333";
		$bg_color_code = ( $settings->desc_back_color ) ? $settings->desc_back_color : "#f0f0f0";
	}elseif( $settings->box_design == "design03" ) {
		$icon_bg_color = ( $settings->heading_back_color ) ? $settings->heading_back_color : "#333333";
		$bg_color_code = ( $settings->desc_back_color ) ? $settings->desc_back_color : "#333333";
		$bg_grad_start = "#" .FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $bg_color_code ), 30, 'lighten' );
	}elseif( $settings->box_design == "design04" ) {
		$border_color_top = ( $settings->desc_back_color ) ? $settings->desc_back_color : "#333333";
		$bg_color_code = ( $settings->heading_back_color ) ? $settings->heading_back_color : "#f9f9f9";
		$bg_grad_start = "#" .FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $bg_color_code ), 30, 'lighten' );
	}elseif( $settings->box_design == "design05" ) {
		$border_color = "#dddddd";
		$bg_head_color_code = ( $settings->desc_back_color ) ? $settings->desc_back_color :"#333333";
		$bg_color_code = ( $settings->heading_back_color ) ? $settings->heading_back_color : "#f7f7f7";
		$bg_grad_start = "#" .FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $bg_color_code ), 30, 'lighten' );
	}elseif( $settings->box_design == "design06" ) {
		$border_color = "#efefef";
		$bg_head_color_code = ( $settings->desc_back_color ) ? $settings->desc_back_color :"#333333";
		$bg_color_code = ( $settings->heading_back_color ) ? $settings->heading_back_color : "#ffffff";
		$bg_grad_start = "#" .FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $bg_color_code ), 30, 'lighten' );
	}

	if ( $settings->box_design == "design01" || $settings->box_design == "design03" || $settings->box_design == "design04" || $settings->box_design == "design05" || $settings->box_design == "design06" ) { ?>
		.fl-node-<?php echo $id;?> .info-table-<?php echo $settings->box_design; ?>.info-table-cs-<?php echo $settings->color_scheme; ?> {
			background: -moz-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%, <?php echo $bg_color_code; ?> 100%); /* FF3.6+ */
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $bg_grad_start; ?>), color-stop(100%,<?php echo $bg_color_code; ?>)); /* Chrome,Safari4+ */
			background: -webkit-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%,<?php echo $bg_color_code; ?> 100%); /* Chrome10+,Safari5.1+ */
			background: -o-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%,<?php echo $bg_color_code; ?> 100%); /* Opera 11.10+ */
			background: -ms-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%,<?php echo $bg_color_code; ?> 100%); /* IE10+ */
			background: linear-gradient(to bottom,  <?php echo $bg_grad_start; ?> 0%,<?php echo $bg_color_code; ?> 100%); /* W3C */
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $bg_grad_start; ?>', endColorstr='<?php echo $bg_color_code; ?>',GradientType=0 ); /* IE6-9 */
		}
	<?php } ?>
	
	/* Design Two */
	.fl-node-<?php echo $id;?> .info-table-design02.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-heading {
		background: <?php echo $bg_head_color_code;?>;
	}
	.fl-node-<?php echo $id;?> .info-table-design02.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-icon {
		background: <?php echo $icon_bg_color;?>;
		border-bottom: 4px double <?php echo $border_color;?>;
	}
	.fl-node-<?php echo $id;?> .info-table-design02.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-description {
		background: <?php echo $bg_color_code;?>;
	}
	.fl-node-<?php echo $id;?> .info-table-wrap.info-table-design02 .info-table-heading {
	    position: relative;
	}
	.fl-node-<?php echo $id;?> .info-table-wrap.info-table-design02 .info-table-button {
	    position: absolute;
	    right: 0;
	    width: 100%;
	    top: 50%;
	    transform: translateY(-50%);
	}
	.fl-node-<?php echo $id;?> .info-table-design02 .info-table-button a {
		/*background: <?php echo $bg_head_color_code;?>;*/
		border-radius: 3px;
		padding: 7px;
	    position: absolute;
	    right: -8px;
	    /*bottom: 70px;*/
	    top: 0;
	    transform: translateY(-50%);
	}

	<?php if ( $settings->hover_effect == 'shadow' ) { ?>
	.fl-node-<?php echo $id;?> .info-table-design02 .info-table:hover,
	.fl-node-<?php echo $id;?> .info-table-design04 .info-table:hover,
	.fl-node-<?php echo $id;?> .info-table-design05 .info-table:hover,
	.fl-node-<?php echo $id;?> .info-table-design06 .info-table:hover {
	    box-shadow: 0 0 7px rgba(167,167,167,.5);
	}
	<?php } ?>
	

	/* Design Three */
	.fl-node-<?php echo $id;?> .info-table-design03.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-icon {
		background: <?php echo $icon_bg_color;?>;
	}
	

	/* Design Four */
	.fl-node-<?php echo $id;?> .info-table-design04.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table {
		border-top: 5px solid <?php echo $border_color_top;?>;
		border-bottom: 5px solid <?php echo $border_color;?>;
	}
	.fl-node-<?php echo $id;?> .info-table-design04.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-icon {
		border-bottom: 2px solid #e5e5e5;
	}


	/* Design Five */
	.fl-node-<?php echo $id;?> .info-table-design05.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-heading,
	.fl-node-<?php echo $id;?> .info-table-design05.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-icon {
		background: <?php echo $bg_head_color_code;?>;
	}
	.fl-node-<?php echo $id;?> .info-table-design05.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table {
		border-bottom: 5px solid <?php echo $border_color;?>;
	}


	/* Design Six */
	.fl-node-<?php echo $id;?> .info-table-design06.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table {
		border: 1px solid <?php echo $border_color;?>;
	}
	.fl-node-<?php echo $id;?> .info-table-design06.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-heading {
		background: <?php echo $bg_head_color_code;?>;
	}

	<?php 
	$cal_width = 0;
	$original_width = 0;
	if ( $settings->image_type == 'icon' ) {
		$cal_width = $settings->icon_size;
		if ( $settings->icon_style != 'simple' ) {
			$cal_width = $settings->icon_size * 2;
			if ( $settings->icon_style == 'custom' ) {
				$cal_width = $settings->icon_size + intval($settings->icon_bg_size);
				if ( $settings->icon_border_style != 'none' ) {
					$cal_width = $cal_width + ( intval($settings->icon_border_width) * 2 );
				}
			}
		}
		$original_width = intval( $cal_width ); 
		$cal_width = ( intval( $cal_width ) / 2 ) + 25;
	}

	if ( $settings->image_type == 'photo' ) {
		$cal_width = $settings->img_size;
		if ( $settings->image_style == 'custom' ) {
			$cal_width = $cal_width + intval($settings->img_bg_size) * 2;
			if ( $settings->img_border_style != 'none' ) {
				$cal_width = $cal_width + ( intval($settings->img_border_width) * 2 );
			}
		}
		$original_width = intval( $cal_width );
		$cal_width = ( intval( $cal_width ) / 2 ) + 25;
	}
	?>

	<?php if ( $settings->box_design == "design06" ) {  ?>
		.fl-node-<?php echo $id;?> .info-table .uabb-imgicon-wrap {
			<?php if ( $settings->image_type == "icon" || $settings->image_type == "photo" ) { ?>
			width: <?php echo $original_width; ?>px;
			<?php } ?>
		}
	<?php } ?>

	.fl-node-<?php echo $id;?> .info-table-design06.info-table-cs-<?php echo $settings->color_scheme; ?> .info-table-icon {
		background: <?php echo $bg_head_color_code;?>;
		height: <?php echo $cal_width ;?>px;
		margin-bottom: <?php echo $cal_width;?>px;
	}


	/* Button Design */
	<?php if( $settings->it_link_type == "cta") { ?>
		.fl-node-<?php echo $id;?> .info-table-wrap .info-table-button a {
			color: <?php echo $settings->btn_text_color; ?>;
			background: <?php echo uabb_theme_base_color( $settings->btn_bg_color ); ?>;
			padding: <?php echo uabb_theme_button_padding( '' ); ?>;
		}
		
		<?php if ( $settings->box_design != 'design02' ) { ?>
			.fl-node-<?php echo $id;?> .info-table-wrap .info-table-button a {
				border-radius: <?php echo ( $settings->btn_radius != '' ) ? $settings->btn_radius : '3'; ?>px;
			}
		<?php } ?>

		<?php if ( $settings->btn_text_hover_color != '' || $settings->btn_bg_hover_color != '' ) { ?>
			.fl-node-<?php echo $id;?> .info-table-wrap .info-table-button a:hover {
				color: <?php echo $settings->btn_text_hover_color; ?>;
				background: <?php echo $settings->btn_bg_hover_color; ?>;
			}
		<?php } ?>

		<?php if ( $settings->box_design == 'design01' ) { ?>
			.fl-node-<?php echo $id;?> .info-table-design01 .info-table-button {
				background: #333333;
				<?php echo ( $settings->heading_back_color != '' ) ? 'background: ' . $settings->heading_back_color . ';' : ''; ?>
			}
		<?php }elseif ( $settings->box_design == 'design02' ) { ?>
			.fl-node-<?php echo $id;?> .info-table-design02 .info-table-button a {
				padding: 7px;
			    position: absolute;
			    right: -8px;
			    top: 0;
			    transform: translateY(-50%);
			}
			.fl-node-<?php echo $id;?> .info-table-design02 .info-table-button a:after {
				content: "";
			    display: block;
			    position: absolute;
			    width: 0;
			    height: 0;
			    bottom: -6px;
			    right: 0;
			    border-bottom: 8px solid transparent;
			    border-left: 8px solid <?php echo uabb_theme_base_color( $settings->btn_bg_color ); ?>;
			    -webkit-transition: all 200ms ease-in-out;
	       	       -moz-transition: all 200ms ease-in-out;
	    				transition: all 200ms ease-in-out
			}

			<?php if ( $settings->btn_bg_hover_color != '' ) { ?>
			.fl-node-<?php echo $id;?> .info-table-design02 .info-table-button a:hover::after {
				border-left: 8px solid <?php echo $settings->btn_bg_hover_color; ?>;
			}
			<?php } ?>
		<?php }elseif ( $settings->box_design == 'design03' ) { ?>
		<?php }elseif ( $settings->box_design == 'design04' ) { ?>
			.fl-node-<?php echo $id;?> .info-table-design04 .info-table-button a {
				background: <?php echo $border_color_top;?>;*/
			}
		<?php }elseif ( $settings->box_design == 'design05' ) { ?>
		<?php }elseif ( $settings->box_design == 'design06' ) { ?>
		<?php } ?>
	<?php } ?>
	/* Button Design Ends */
<?php	
} ?>

<?php
if( $settings->box_design != 'design02' ) {
?>
.fl-node-<?php echo $id;?> .info-table-wrap .info-table .info-table-button {
	padding: <?php echo ( $settings->btn_top_margin != '' ) ? $settings->btn_top_margin : '15'; ?>px 0 <?php echo ( $settings->btn_bottom_margin != '' ) ? $settings->btn_bottom_margin : '15'; ?>px;
}
<?php
}
?>

<?php 
/* Typography style starts here  */ 
if ( $settings->heading_font_family['family'] != "Default" || $settings->heading_font_size['desktop'] != '' || $settings->heading_line_height['desktop'] != '' || $settings->heading_color != '' ) { ?>
	.fl-node-<?php echo $id;?> .info-table-heading .info-table-main-heading {
		<?php if( $settings->heading_font_family['family'] != "Default") : ?>
			<?php UABB_Helper::uabb_font_css( $settings->heading_font_family ); ?>
		<?php endif; ?>
		<?php if( $settings->heading_font_size['desktop'] != '' ) : ?>
			font-size: <?php echo $settings->heading_font_size['desktop']; ?>px;
		<?php endif; ?>
		<?php if( $settings->heading_line_height['desktop'] != '' ) : ?>
			line-height: <?php echo $settings->heading_line_height['desktop']; ?>px;
		<?php endif; ?>
		<?php if( $settings->heading_color != '' ) : ?>
			color: <?php echo $settings->heading_color; ?>;
		<?php endif; ?>
	}
<?php }
if ( $settings->sub_heading_font_family['family'] != "Default" || $settings->sub_heading_font_size['desktop'] != '' || $settings->sub_heading_line_height['desktop'] != '' || $settings->sub_heading_color != '' ) { ?>
	.fl-node-<?php echo $id;?> .info-table-heading .info-table-sub-heading {
		<?php if( $settings->sub_heading_font_family['family'] != "Default") : ?>
			<?php UABB_Helper::uabb_font_css( $settings->sub_heading_font_family ); ?>
		<?php endif; ?>
		<?php if( $settings->sub_heading_font_size['desktop'] != '' ) : ?>
			font-size: <?php echo $settings->sub_heading_font_size['desktop']; ?>px;
		<?php endif; ?>
		<?php if( $settings->sub_heading_line_height['desktop'] != '' ) : ?>
			line-height: <?php echo $settings->sub_heading_line_height['desktop']; ?>px;
		<?php endif; ?>
		<?php if( $settings->sub_heading_color != '' ) : ?>
			color: <?php echo $settings->sub_heading_color; ?>;
		<?php endif; ?>
	}
<?php }
if ( $settings->description_font_family['family'] != "Default" || $settings->description_font_size['desktop'] != '' || $settings->description_line_height['desktop'] != '' || $settings->description_color != '' ) { ?>
	.fl-node-<?php echo $id;?> .info-table .info-table-description {
		<?php if( $settings->description_font_family['family'] != "Default") : ?>
			<?php UABB_Helper::uabb_font_css( $settings->description_font_family ); ?>
		<?php endif; ?>
		<?php if( $settings->description_font_size['desktop'] != '' ) : ?>
			font-size: <?php echo $settings->description_font_size['desktop']; ?>px;
		<?php endif; ?>
		<?php if( $settings->description_line_height['desktop'] != '' ) : ?>
			line-height: <?php echo $settings->description_line_height['desktop']; ?>px;
		<?php endif; ?>
		<?php if( $settings->description_color != '' ) : ?>
			color: <?php echo $settings->description_color; ?>;
		<?php endif; ?>
	}
<?php }

if ( $settings->btn_font_family['family'] != "Default" || $settings->btn_font_size['desktop'] != '' || $settings->btn_line_height['desktop'] != '' ) { ?>
	.fl-node-<?php echo $id;?> .info-table-wrap .info-table-button a {
		<?php if( $settings->btn_font_family['family'] != "Default") : ?>
			<?php UABB_Helper::uabb_font_css( $settings->btn_font_family ); ?>
		<?php endif; ?>
		<?php if( $settings->btn_font_size['desktop'] != '' ) : ?>
			font-size: <?php echo $settings->btn_font_size['desktop']; ?>px;
			line-height: <?php echo $settings->btn_font_size['desktop']+5; ?>px;
		<?php endif; ?>
		<?php if( $settings->btn_line_height['desktop'] != '' ) : ?>
			line-height: <?php echo $settings->btn_line_height['desktop']; ?>px;
		<?php endif; ?>
	}
<?php }

if($global_settings->responsive_enabled) { // Global Setting If started 
	?>
		@media ( max-width: <?php echo $global_settings->medium_breakpoint .'px'; ?> ) {
			<?php if( $settings->heading_font_size['medium'] !="" || $settings->heading_line_height['medium'] != "" ) { ?>
				.fl-node-<?php echo $id;?> .info-table-heading .info-table-main-heading {
					<?php if( $settings->heading_font_size['medium'] != '' ) : ?>
						font-size: <?php echo $settings->heading_font_size['medium']; ?>px;
					<?php endif; ?>
					<?php if( $settings->heading_line_height['medium'] != '' ) : ?>
						line-height: <?php echo $settings->heading_line_height['medium']; ?>px;
					<?php endif; ?>
				}
			<?php } ?>

			<?php if( $settings->sub_heading_font_size['medium'] !="" || $settings->sub_heading_line_height['medium'] != "" ) { ?>
				.fl-node-<?php echo $id;?> .info-table-heading .info-table-sub-heading {
					<?php if( $settings->sub_heading_font_size['medium'] != '' ) : ?>
						font-size: <?php echo $settings->sub_heading_font_size['medium']; ?>px;
					<?php endif; ?>
					<?php if( $settings->sub_heading_line_height['medium'] != '' ) : ?>
						line-height: <?php echo $settings->sub_heading_line_height['medium']; ?>px;
					<?php endif; ?>
				}
			<?php } ?>

			<?php if( $settings->description_font_size['medium'] !="" || $settings->description_line_height['medium'] != "" ) { ?>
				.fl-node-<?php echo $id;?> .info-table .info-table-description {
					<?php if( $settings->description_font_size['medium'] != '' ) : ?>
						font-size: <?php echo $settings->description_font_size['medium']; ?>px;
					<?php endif; ?>
					<?php if( $settings->description_line_height['medium'] != '' ) : ?>
						line-height: <?php echo $settings->description_line_height['medium']; ?>px;
					<?php endif; ?>
				}
			<?php } ?>

			<?php if( $settings->btn_font_size['medium'] !="" || $settings->btn_line_height['medium'] != "" ) { ?>
				.fl-node-<?php echo $id;?> .info-table-wrap .info-table-button a {
					<?php if( $settings->btn_font_size['medium'] != '' ) : ?>
						font-size: <?php echo $settings->btn_font_size['medium']; ?>px;
					<?php endif; ?>
					<?php if( $settings->btn_line_height['medium'] != '' ) : ?>
						line-height: <?php echo $settings->btn_line_height['medium']; ?>px;
					<?php endif; ?>
				}
			<?php } ?>
	    }
	<?php

	if( $settings->heading_font_size['small'] !="" || $settings->heading_line_height['small'] != "" || $settings->sub_heading_font_size['small'] !="" || $settings->sub_heading_line_height['small'] != "" || $settings->description_font_size['small'] !="" || $settings->description_line_height['small'] != "" || $settings->btn_font_size['small'] !="" || $settings->btn_line_height['small'] != "" ) {
	?>
		@media ( max-width: <?php echo $global_settings->responsive_breakpoint .'px'; ?> ) {
			<?php if( $settings->heading_font_size['small'] !="" || $settings->heading_line_height['small'] != "" ) { ?>
				.fl-node-<?php echo $id;?> .info-table-heading .info-table-main-heading {
					<?php if( $settings->heading_font_size['small'] != '' ) : ?>
						font-size: <?php echo $settings->heading_font_size['small']; ?>px;
					<?php endif; ?>
					<?php if( $settings->heading_line_height['small'] != '' ) : ?>
						line-height: <?php echo $settings->heading_line_height['small']; ?>px;
					<?php endif; ?>
				}
			<?php } ?>

			<?php if( $settings->sub_heading_font_size['small'] !="" || $settings->sub_heading_line_height['small'] != "" ) { ?>
				.fl-node-<?php echo $id;?> .info-table-heading .info-table-sub-heading {
					<?php if( $settings->sub_heading_font_size['small'] != '' ) : ?>
						font-size: <?php echo $settings->sub_heading_font_size['small']; ?>px;
					<?php endif; ?>
					<?php if( $settings->sub_heading_line_height['small'] != '' ) : ?>
						line-height: <?php echo $settings->sub_heading_line_height['small']; ?>px;
					<?php endif; ?>
				}
			<?php } ?>

			<?php if( $settings->description_font_size['small'] !="" || $settings->description_line_height['small'] != "" ) { ?>
				.fl-node-<?php echo $id;?> .info-table .info-table-description {
					<?php if( $settings->description_font_size['small'] != '' ) : ?>
						font-size: <?php echo $settings->description_font_size['small']; ?>px;
					<?php endif; ?>
					<?php if( $settings->description_line_height['small'] != '' ) : ?>
						line-height: <?php echo $settings->description_line_height['small']; ?>px;
					<?php endif; ?>
				}
				.fl-node-<?php echo $id;?> .info-table-description * {
					<?php if( $settings->description_font_size['small'] != '' ) : ?>
						font-size: inherit;
					<?php endif; ?>
					<?php if( $settings->description_line_height['small'] != '' ) : ?>
						line-height: inherit;
					<?php endif; ?>
				}
			<?php } ?>

			<?php if( $settings->btn_font_size['small'] !="" || $settings->btn_line_height['small'] != "" ) { ?>
				.fl-node-<?php echo $id;?> .info-table-wrap .info-table-button a {
					<?php if( $settings->btn_font_size['small'] != '' ) : ?>
						font-size: <?php echo $settings->btn_font_size['small']; ?>px;
					<?php endif; ?>
					<?php if( $settings->btn_line_height['small'] != '' ) : ?>
						line-height: <?php echo $settings->btn_line_height['small']; ?>px;
					<?php endif; ?>
				}
			<?php } ?>
	    }
	<?php
	}
}
?>