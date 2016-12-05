<?php

$settings->bg_color = uabb_theme_button_bg_color( $settings->bg_color );
$settings->bg_hover_color = uabb_theme_button_bg_hover_color( $settings->bg_hover_color );
$settings->text_color = uabb_theme_button_text_color( $settings->text_color );
$settings->text_hover_color = uabb_theme_button_text_hover_color( $settings->text_hover_color );

$settings->bg_color 		= UABB_Helper::uabb_colorpicker( $settings, 'bg_color', true );
$settings->bg_hover_color 	= UABB_Helper::uabb_colorpicker( $settings, 'bg_hover_color', true );
$settings->text_color 		= UABB_Helper::uabb_colorpicker( $settings, 'text_color');
$settings->text_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'text_hover_color');

// Border Size
if ( 'transparent' == $settings->style ) {
	$border_size = ( trim( $settings->border_size ) !== '' ) ? $settings->border_size : '2';
}
else {
	$border_size = 1;
}
// Border Color
if ( ! empty( $settings->bg_color ) ) {
	$border_color = $settings->bg_color;
}
if ( ! empty( $settings->bg_hover_color ) ) {
	$border_hover_color = $settings->bg_hover_color;
}

// Old Background Gradient Setting
if ( isset( $settings->three_d ) && $settings->three_d ) {
	$settings->style = 'gradient';
}

// Background Gradient
if ( ! empty( $settings->bg_color ) ) {
	$bg_grad_start = "#" .FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $settings->bg_color ), 30, 'lighten' );
}
if ( ! empty( $settings->bg_hover_color ) ) {
	$bg_hover_grad_start = "#" . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $settings->bg_hover_color ), 30, 'lighten' );
}

?>

<?php if ( $settings->threed_button_options == 'animate_top' || $settings->threed_button_options == 'animate_bottom' ) { ?>
/* 3D Fix */

	.fl-node-<?php echo $id; ?> .uabb-creative-button-wrap.uabb-creative-button-width-auto .perspective, 
	.fl-node-<?php echo $id; ?> .uabb-creative-button-wrap.uabb-creative-button-width-custom .perspective {
	   display: inline-block;
	   max-width: 100%;
	}
<?php } ?>

<?php 
	
    $settings->font_family = (array)$settings->font_family; 
    $settings->font_size = (array)$settings->font_size; 
    $settings->line_height = (array)$settings->line_height; 

?>

.fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a,
.fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a:visited {
	
	<?php if( $settings->font_family['family'] != "Default") : ?>
		<?php UABB_Helper::uabb_font_css( $settings->font_family ); ?>
	<?php endif; ?>
	<?php if( $settings->font_size['desktop'] != '' ) : ?>
	font-size: <?php echo $settings->font_size['desktop']; ?>px;
	line-height: <?php echo $settings->font_size['desktop'] + 2; ?>px;
	<?php endif; ?>
		
	<?php if( $settings->line_height['desktop'] != '' ) : ?>
	line-height: <?php echo $settings->line_height['desktop']; ?>px;
	<?php endif; ?>
	


	
	<?php if( $settings->width == 'custom' ) { 
			$padding_top_bottom = ( $settings->padding_top_bottom !== '' ) ? $settings->padding_top_bottom : '0';
			$padding_left_right = ( $settings->padding_left_right !== '' ) ? $settings->padding_left_right : '0';
		?>

		padding-top: <?php echo $padding_top_bottom; ?>px;
		padding-bottom: <?php echo $padding_top_bottom; ?>px;
		padding-left: <?php echo $padding_left_right; ?>px;
		padding-right: <?php echo $padding_left_right; ?>px;
	<?php } else {
		echo "padding:". uabb_theme_button_padding( '' ).";";
	}
	
	$settings->border_radius = uabb_theme_button_border_radius( $settings->border_radius );
	if( $settings->border_radius != '' ) : ?>
	border-radius: <?php echo $settings->border_radius; ?>px;
	-moz-border-radius: <?php echo $settings->border_radius; ?>px;
	-webkit-border-radius: <?php echo $settings->border_radius; ?>px;
	<?php endif; ?>
	
	<?php if ( 'custom' == $settings->width ) : ?>
	width: <?php echo $settings->custom_width; ?>px;
	min-height: <?php echo $settings->custom_height; ?>px;
	display: -webkit-inline-box;
	display: -ms-inline-flexbox;
	display: inline-flex;
	-webkit-box-align: center;
	-ms-flex-align: center;
	align-items: center;
	-webkit-box-pack: center;
	-ms-flex-pack: center;
	justify-content: center;	
	<?php endif; ?>

	<?php if ( ! empty( $settings->bg_color ) ) : ?>
	background: <?php echo $settings->bg_color; ?>;
	border: <?php echo $border_size; ?>px solid <?php echo $border_color; ?>;
	
		<?php if ( 'transparent' == $settings->style ) : // Transparent 
//background-color: rgba(<?php echo implode( ',', "#" . FLBuilderColor::hex_to_rgb( $settings->bg_color ) ) , 0);
		?>
			background: none;
		<?php endif; ?>

		<?php if( 'gradient' == $settings->style ) : // Gradient ?>
		background: -moz-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%, <?php echo $settings->bg_color; ?> 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $bg_grad_start; ?>), color-stop(100%,<?php echo $settings->bg_color; ?>)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%,<?php echo $settings->bg_color; ?> 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%,<?php echo $settings->bg_color; ?> 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%,<?php echo $settings->bg_color; ?> 100%); /* IE10+ */
		background: linear-gradient(to bottom,  <?php echo $bg_grad_start; ?> 0%,<?php echo $settings->bg_color; ?> 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $bg_grad_start; ?>', endColorstr='<?php echo $settings->bg_color; ?>',GradientType=0 ); /* IE6-9 */
		<?php endif; ?>
	
	<?php endif; ?>
}

<?php if ( 'custom' == $settings->width && $settings->custom_height != '' && ( $settings->line_height['desktop'] == '' || ( intval($settings->custom_height) > intval($settings->line_height['desktop']) ) ) ) : ?>
html.internet-explorer .fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a,
html.internet-explorer .fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a:visited {
	line-height: <?php echo $settings->custom_height; ?>px;
}
<?php endif; ?>

<?php if ( 'custom' == $settings->width && $settings->custom_height != '' ) : 
	$translateText = intval($settings->custom_height) + ($padding_top_bottom * 2) + 50;
?>
.fl-node-<?php echo $id; ?> .uabb-creative-flat-btn.uabb-animate_from_top-btn:hover .uabb-button-text {
	-webkit-transform: translateY(<?php echo $translateText; ?>px);
	-moz-transform: translateY(<?php echo $translateText; ?>px);
	-ms-transform: translateY(<?php echo $translateText; ?>px);
	-o-transform: translateY(<?php echo $translateText; ?>px);
	transform: translateY(<?php echo $translateText; ?>px);
}

.fl-node-<?php echo $id; ?> .uabb-creative-flat-btn.uabb-animate_from_bottom-btn:hover .uabb-button-text {
	-webkit-transform: translateY(-<?php echo $translateText; ?>px);
	-moz-transform: translateY(-<?php echo $translateText; ?>px);
	-ms-transform: translateY(-<?php echo $translateText; ?>px);
	-o-transform: translateY(-<?php echo $translateText; ?>px);
	transform: translateY(-<?php echo $translateText; ?>px);
}
<?php endif; ?>

<?php if ( ! empty( $settings->text_color ) ) : ?>
.fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a,
.fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a *,
.fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a:visited,
.fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a:visited * {
	color: <?php echo $settings->text_color; ?>;
}
<?php endif; ?>

<?php if ( ! empty( $settings->bg_hover_color ) ) : ?>
.fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a:hover {
	<?php if( $settings->style != "transparent" && $settings->style != "gradient"  ){ ?>
		background: <?php echo $settings->bg_hover_color; ?>;
	<?php } ?>
	border: <?php echo $border_size; ?>px solid <?php echo $border_hover_color; ?>;
	
	<?php /*if ( 'transparent' == $settings->style ) : // Transparent ?>
	background-color: rgba(<?php echo implode( ',', FLBuilderColor::hex_to_rgb( $settings->bg_hover_color ) ) ?>, 1 );
	<?php endif; */?>

	<?php if ( 'gradient' == $settings->style ) : // Gradient ?>
	background: -moz-linear-gradient(top,  <?php echo $bg_hover_grad_start; ?> 0%, <?php echo $settings->bg_hover_color; ?> 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $bg_hover_grad_start; ?>), color-stop(100%,<?php echo $settings->bg_hover_color; ?>)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  <?php echo $bg_hover_grad_start; ?> 0%,<?php echo $settings->bg_hover_color; ?> 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  <?php echo $bg_hover_grad_start; ?> 0%,<?php echo $settings->bg_hover_color; ?> 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  <?php echo $bg_hover_grad_start; ?> 0%,<?php echo $settings->bg_hover_color; ?> 100%); /* IE10+ */
	background: linear-gradient(to bottom,  <?php echo $bg_hover_grad_start; ?> 0%,<?php echo $settings->bg_hover_color; ?> 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $bg_hover_grad_start; ?>', endColorstr='<?php echo $settings->bg_hover_color; ?>',GradientType=0 ); /* IE6-9 */
	<?php endif; ?>
}
<?php endif; ?>

<?php if ( ! empty( $settings->text_hover_color ) ) : ?>
.fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a:hover,
.fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a:hover * {
	color: <?php echo $settings->text_hover_color; ?>;
}
<?php endif; ?>

<?php 
// Responsive button Alignment
if( $global_settings->responsive_enabled ) : ?>	
@media ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {
	.fl-node-<?php echo $id; ?> .uabb-creative-button-wrap.uabb-creative-button-reponsive-<?php echo $settings->mob_align; ?> {
		text-align: <?php echo $settings->mob_align; ?>;
	}
}
<?php endif; ?>

<?php /* Typography responsive layout starts here*/ ?>

<?php if($global_settings->responsive_enabled) { // Global Setting If started 
	if( $settings->font_size['medium'] != "" || $settings->line_height['medium'] != "" )
	{
		/* Medium Breakpoint media query */	
	?>
		@media ( max-width: <?php echo $global_settings->medium_breakpoint .'px'; ?> ) {
			.fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a,
			.fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a:visited {
				<?php if( $settings->font_size['medium'] != '' ) : ?>
				font-size: <?php echo $settings->font_size['medium']; ?>px;
					<?php if( $settings->width != 'custom' ) : ?>
					line-height: <?php echo $settings->font_size['medium'] + 2; ?>px;
					<?php endif; ?>
				<?php endif; ?>
				
				<?php if ( $settings->line_height['medium'] != '' ) : ?>
				line-height: <?php echo $settings->line_height['medium']; ?>px;
				<?php endif; ?>
				
			}

			<?php if ( 'custom' == $settings->width && $settings->custom_height != '' && ( $settings->line_height['medium'] == '' || ( intval($settings->custom_height) > intval($settings->line_height['medium']) ) ) ) : ?>
			html.internet-explorer .fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a,
			html.internet-explorer .fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a:visited {
				line-height: <?php echo $settings->custom_height; ?>px;
			}
			<?php else: ?>
			html.internet-explorer .fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a,
			html.internet-explorer .fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a:visited {
				line-height: <?php echo $settings->line_height['medium']; ?>px;
			}
			<?php endif; ?>
		}		
	<?php
	}
	if( $settings->font_size['small'] != "" || $settings->line_height['small'] != "" )
	{
		/* Small Breakpoint media query */	
	?>
		@media ( max-width: <?php echo $global_settings->responsive_breakpoint .'px'; ?> ) {
			.fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a,
			.fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a:visited {
				<?php if( $settings->font_size['small'] != '' ) : ?>
				font-size: <?php echo $settings->font_size['small']; ?>px;
					<?php if( $settings->width != 'custom' ) : ?>
					line-height: <?php echo $settings->font_size['small'] + 2; ?>px;
					<?php endif; ?>
				<?php endif; ?>

				<?php if ( $settings->line_height['small'] != '' ) : ?>
				line-height: <?php echo $settings->line_height['small']; ?>px;
				<?php endif; ?>
			}

			<?php if ( 'custom' == $settings->width && $settings->custom_height != '' && ( $settings->line_height['small'] == '' || ( intval($settings->custom_height) > intval($settings->line_height['small']) ) ) ) : ?>
			html.internet-explorer .fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a,
			html.internet-explorer .fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a:visited {
				line-height: <?php echo $settings->custom_height; ?>px;
			}
			<?php else: ?>
			html.internet-explorer .fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a,
			html.internet-explorer .fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a:visited {
				line-height: <?php echo $settings->line_height['small']; ?>px;
			}
			<?php endif; ?>
		}		
	<?php
	}
}

/* Typography responsive layout Ends here*/ ?>

<?php /* Transparent New Style CSS*/ ?>
<?php
if( !empty( $settings->style ) && $settings->style == "transparent" ) {
?>
	.fl-node-<?php echo $id; ?> a.uabb-creative-transparent-btn.uabb-none-btn:hover{
		<?php
		if( $settings->transparent_button_options == 'none' ) {
			if( $settings->hover_attribute == 'border' ) {
		?>
			border-color:<?php echo uabb_theme_base_color( $settings->bg_hover_color ); ?>;
		<?php
			} else {
		?>
			background:<?php echo uabb_theme_base_color( $settings->bg_hover_color ); ?>;
		<?php
			}
		} else {
		?>
		background:<?php echo uabb_theme_base_color( $settings->bg_hover_color ); ?>;
		<?php
		}
		?>
	}
	.fl-node-<?php echo $id; ?> a.uabb-creative-transparent-btn.uabb-none-btn:hover .uabb-creative-button-icon {
		<?php if ( $settings->text_hover_color != "" && $settings->text_hover_color != "FFFFFF" && $settings->transparent_button_options == "none") { ?>
			color: <?php echo $settings->text_hover_color; ?>
		<?php } else { ?>
			color: <?php echo $settings->text_color; ?>;
		<?php } ?>
	}
	.fl-node-<?php echo $id; ?> .uabb-creative-button-wrap a.uabb-creative-transparent-btn.uabb-none-btn:hover .uabb-creative-button-text {
		<?php if ( $settings->text_hover_color != "" && $settings->text_hover_color != "FFFFFF" && $settings->transparent_button_options == "none") { ?>
			color: <?php echo $settings->text_hover_color; ?>
		<?php } else { ?>
			color: <?php echo $settings->text_color; ?>;
		<?php } ?>
	}
	
	

	
	
	.fl-node-<?php echo $id; ?> a.uabb-creative-transparent-btn.uabb-transparent-fade-btn:hover{
		background: <?php echo uabb_theme_base_color( $settings->bg_hover_color ); ?>;
	}

	/*transparent-fill-top*/
	.fl-node-<?php echo $id; ?> a.uabb-creative-transparent-btn.uabb-transparent-fill-top-btn:hover:after{
		background: <?php echo uabb_theme_base_color( $settings->bg_hover_color ); ?>;
	    height: 100%;
	}

	/*transparent-fill-bottom*/
	.fl-node-<?php echo $id; ?> a.uabb-creative-transparent-btn.uabb-transparent-fill-bottom-btn:hover:after{
		background: <?php echo uabb_theme_base_color( $settings->bg_hover_color ); ?>;
	    height: 100%;
	}

	/*transparent-fill-left*/
	.fl-node-<?php echo $id; ?> a.uabb-creative-transparent-btn.uabb-transparent-fill-left-btn:hover:after{
		background: <?php echo uabb_theme_base_color( $settings->bg_hover_color ); ?>;
	    width: 100%;
	}
	/*transparent-fill-right*/
	.fl-node-<?php echo $id; ?> a.uabb-creative-transparent-btn.uabb-transparent-fill-right-btn:hover:after{
		background: <?php echo uabb_theme_base_color( $settings->bg_hover_color ); ?>;
	    width: 100%;
	}

	/*transparent-fill-center*/
	.fl-node-<?php echo $id; ?> a.uabb-creative-transparent-btn.uabb-transparent-fill-center-btn:hover:after{
		background: <?php echo uabb_theme_base_color( $settings->bg_hover_color ); ?>;
	    height: calc( 100% + <?php echo $border_size."px";?> );
	    width: calc( 100% + <?php echo $border_size."px";?> );
	}

	/* transparent-fill-diagonal */
	.fl-node-<?php echo $id; ?> a.uabb-creative-transparent-btn.uabb-transparent-fill-diagonal-btn:hover:after{
		background: <?php echo uabb_theme_base_color( $settings->bg_hover_color ); ?>;
	    height: 260%;
	}

	/*transparent-fill-horizontal*/
	.fl-node-<?php echo $id; ?> a.uabb-creative-transparent-btn.uabb-transparent-fill-horizontal-btn:hover:after{
		background: <?php echo uabb_theme_base_color( $settings->bg_hover_color ); ?>;
	    height: calc( 100% + <?php echo $border_size."px";?> );
	    width: calc( 100% + <?php echo $border_size."px";?> );
	}



	.fl-node-<?php echo $id; ?> a.uabb-transparent-fill-diagonal-btn:hover {
		background: none;
	}

	.fl-node-<?php echo $id; ?> a.uabb-creative-transparent-btn.uabb-<?php echo $settings->transparent_button_options;?>-btn:hover .uabb-creative-button-text{
		color: <?php echo uabb_theme_button_text_color( $settings->text_hover_color ); ?>;

		position: relative;
    	z-index: 9;
	}
	.fl-node-<?php echo $id; ?> .uabb-<?php echo $settings->transparent_button_options;?>-btn:hover .uabb-creative-button-icon {
		color: <?php echo uabb_theme_button_text_color( $settings->text_hover_color ); ?>;
		position: relative;
    	z-index: 9;
	}
<?php
}
?>

<?php /* 3D New Style CSS*/ ?>
<?php
if( !empty( $settings->style ) && $settings->style == "threed" ) {
?>
	<?php /* 3D Move Down*/ ?>
	.fl-node-<?php echo $id; ?> a.uabb-creative-threed-btn.uabb-threed_down-btn{
		<?php $shadow_color = "#" . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $settings->bg_color ), 10, 'darken' ); ?>
		box-shadow: 0 6px <?php echo uabb_theme_base_color( $shadow_color ); ?>;
	}
	.fl-node-<?php echo $id; ?> a.uabb-creative-threed-btn.uabb-threed_down-btn:hover{
		<?php $shadow_color = "#" . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $settings->bg_hover_color ), 10, 'darken' ); ?>
		top: 2px;
		box-shadow: 0 4px <?php echo uabb_theme_base_color( $shadow_color ); ?>;
	}

	.fl-node-<?php echo $id; ?> a.uabb-creative-threed-btn.uabb-threed_down-btn:active{
		box-shadow:none!important;
		-webkit-transition:all 50ms linear;
		   -moz-transition:all 50ms linear;
				transition:all 50ms linear;
		top: 6px;
	}


	<?php /* 3D Move Up*/ ?>
	.fl-node-<?php echo $id; ?> a.uabb-creative-threed-btn.uabb-threed_up-btn{
		<?php $shadow_color = "#" . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $settings->bg_color ), 10, 'darken' ); ?>
		box-shadow: 0 -6px <?php echo uabb_theme_base_color( $shadow_color ); ?>;
	}
	
	.fl-node-<?php echo $id; ?> a.uabb-creative-threed-btn.uabb-threed_up-btn:hover{
		<?php $shadow_color = "#" . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $settings->bg_hover_color ), 10, 'darken' ); ?>
		top: -2px;
		box-shadow: 0 -4px <?php echo uabb_theme_base_color( $shadow_color ); ?>;
	}

	.fl-node-<?php echo $id; ?> a.uabb-creative-threed-btn.uabb-threed_up-btn:active{
		box-shadow:none!important;
		-webkit-transition:all 50ms linear;
		   -moz-transition:all 50ms linear;
				transition:all 50ms linear;
		top: -6px;
	}

	<?php /* 3D Move Left*/ ?>
	.fl-node-<?php echo $id; ?> a.uabb-creative-threed-btn.uabb-threed_left-btn{
		<?php $shadow_color = "#" . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $settings->bg_color ), 10, 'darken' ); ?>
		box-shadow: -6px 0 <?php echo uabb_theme_base_color( $shadow_color ); ?>;
	}
	
	.fl-node-<?php echo $id; ?> a.uabb-creative-threed-btn.uabb-threed_left-btn:hover{
		<?php $shadow_color = "#" . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $settings->bg_hover_color ), 10, 'darken' ); ?>
		left: -2px;
		box-shadow: -4px 0 <?php echo uabb_theme_base_color( $shadow_color ); ?>;
	}

	.fl-node-<?php echo $id; ?> a.uabb-creative-threed-btn.uabb-threed_left-btn:active {
		box-shadow:none!important;
		-webkit-transition:all 50ms linear;
		   -moz-transition:all 50ms linear;
				transition:all 50ms linear;
		left: -6px;
	}


	<?php /* 3D Move Right*/ ?>
	.fl-node-<?php echo $id; ?> a.uabb-creative-threed-btn.uabb-threed_right-btn{
		<?php $shadow_color = "#" . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $settings->bg_color ), 10, 'darken' ); ?>
		box-shadow: 6px 0 <?php echo uabb_theme_base_color( $shadow_color ); ?>;
	}

	.fl-node-<?php echo $id; ?> a.uabb-creative-threed-btn.uabb-threed_right-btn:hover{
		<?php $shadow_color = "#" . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $settings->bg_hover_color ), 10, 'darken' ); ?>
		left: 2px;
		box-shadow: 4px 0 <?php echo uabb_theme_base_color( $shadow_color ); ?>;
	}

	.fl-node-<?php echo $id; ?> a.uabb-creative-threed-btn.uabb-threed_right-btn:active {
		box-shadow:none!important;
		-webkit-transition:all 50ms linear;
		   -moz-transition:all 50ms linear;
				transition:all 50ms linear;
		left: 6px;
	}

	<?php /* Animate Background Color */ ?>
	.fl-node-<?php echo $id; ?> a.uabb-creative-threed-btn.uabb-<?php echo $settings->threed_button_options;?>-btn:hover:after{
		<?php $background_color = "#" . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $settings->bg_hover_color ), 10, 'darken' ); ?>
		background: <?php echo $background_color;?>;
	}


	<?php /* Text Color*/?>
	.fl-node-<?php echo $id; ?> a.uabb-creative-threed-btn.uabb-<?php echo $settings->threed_button_options;?>-btn:hover .uabb-creative-button-text{
		color: <?php echo uabb_theme_base_color( $settings->text_hover_color ); ?>;
	}

	<?php /* 3D Padding for Shadow */ ?>
	.fl-node-<?php echo $id; ?> .uabb-creative-button-wrap {
		<?php if( $settings->threed_button_options == 'threed_down' ) : ?>
			padding-bottom: 6px;
		<?php elseif( $settings->threed_button_options == 'threed_up' ) : ?>
			padding-top: 6px;
		<?php elseif( $settings->threed_button_options == 'threed_left' ) : ?>
			padding-left: 6px;
		<?php elseif( $settings->threed_button_options == 'threed_right' ) : ?>
			padding-right: 6px;
		<?php endif; ?>

	}
<?php
}
?>