<?php 
/*
	Declaration op array  For - Font Size, Line Height or Responsive Width, Height
	
	Ex.	'font_responsive'     => array(
                        'type'          => 'uabb-simplify',
                        'label'         => __( 'Font Size', 'uabb' ),
                        'default'       => array(				
                            'desktop'           => '32',  	//optional 
                            'medium'            => '28',	//optional	
                            'small'            	=> '18'		//optional
                        ),
                        'preview'         => array(			//optional
                            'type'             => 'css',
                            'selector'         => '.ultit-title',
                            'property'          => 'font-size',
                            'unit'              => 'px'
                        )
                    )

    How to access variables

        .fl-builder-content .fl-node-<?php echo $id; ?> .ultit-title{
	    	font-size: <?php echo $settings->font_respnsive['desktop'] ?>px;
	   }
*/

if(!class_exists('UABB_Simplify'))
{
	class UABB_Simplify
	{
		function __construct()
		{	
			add_action( 'fl_builder_control_uabb-simplify', array($this, 'uabb_simplify'), 1, 4 );
			// add_action( 'wp_enqueue_scripts', array( $this, 'uabb_simplify_assets' ) );

		}
		
		function uabb_simplify($name, $value, $field, $settings) {
			if ( is_object( $value ) ) {
			    	$value = json_decode(json_encode( $value ), True); 
			}
			$preview = isset($field['preview']) ? json_encode($field['preview']) : json_encode(array('type' => 'refresh'));
			$selector = '';
			$simplify = 'collapse';

			//tablet_portrait
			$medias = array(
				'desktop'	=> ( isset($value['desktop']) ) ? $value['desktop'] : '',
				'medium_device'	=> ( isset($value['medium']) ) ? $value['medium'] : '', // Medium Device
				'small_device'	=> ( isset($value['small']) ) ? $value['small'] : '', 	// Small Device
			);

			if( $medias['medium_device'] != '' || $medias['small_device'] != '' ){
				$simplify = 'expand';
			}
			
			$simplify = ( isset($value['simplify']) ) ? $value['simplify'] : $simplify ;
			$simplify_style = ( $simplify == 'collapse' ) ? 'style="display:none;"' : 'style="display:inline-block;"';

			$html  = '<div class="uabb-simplify-wrapper">';
				$html .= '  <div class="uabb-simplify-items" >';
				
				foreach($medias as $key => $default_value ) {
					//$html .= $key;
					switch ($key) {
						case 'desktop': 
							$style = '';
							$selector = ' data-type="text" data-preview=\'' . $preview . '\''; 
							$class = 'fl-field require';
							$data_id  = strtolower((preg_replace('/\s+/', '_', $key)));
							$dashicon = "<i class='dashicons dashicons-desktop uabb-help-tooltip'></i>";
							
							$html .= "<div class='uabb-size-wrap'>";
							$html .= $this->uabb_simplify_param_media($name, $class, $dashicon, $key, $default_value ,$selector, $data_id, $style);
							$html .= "<div class='simplify' uabb-toggle='".$simplify."'>
										<input type='hidden' class='simplify_toggle' name='".$name."[][simplify]' value='".$simplify."'>
										<i class='simplify-icon dashicons dashicons-arrow-right-alt2 uabb-help-tooltip'></i>
										<div class='uabb-tooltip simplify-options'>".__("Responsive Options","uabb")."</div>
									  </div>";
							$html .= "</div>";
						break;
						case 'medium_device':   
							$style = $simplify_style;
							$selector = '';
							$class = 'optional';
							$data_id  = strtolower((preg_replace('/\s+/', '_', $key)));
							$dashicon = "<i class='dashicons dashicons-tablet uabb-help-tooltip' style='transform: rotate(90deg);'></i>";
							$html .= "<div class='uabb-simplify-size-wrap'>";
							$html .= $this->uabb_simplify_param_media($name, $class, $dashicon, $key, $default_value ,$selector, $data_id, $style);
						break;
						
						case 'small_device':        
							$style = $simplify_style;
							$selector = '';
							$class = 'optional';
							$data_id  = strtolower((preg_replace('/\s+/', '_', $key)));
							$dashicon = "<i class='dashicons dashicons-smartphone uabb-help-tooltip'></i>";
							$html .= $this->uabb_simplify_param_media($name, $class, $dashicon, $key, $default_value , $selector, $data_id, $style);
							$html .= "</div>";
						break;
					}
				}
			$html .= '  </div>';
			//$html .= $this->get_units($unit);
			//$html .= '  <input type="hidden" data-unit="'.$unit.'"  name="'.$settings['param_name'].'" class="wpb_vc_param_value ultimate-responsive-value '.$settings['param_name'].' '.$settings['type'].'_field" value="'.$value.'" '.$dependency.' />';
	
			$html .= '</div>';
		
			echo $html;
		}
		
		/*function uabb_simplify_assets() {
		    if ( class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_active() ) {
		    	wp_enqueue_style( 'uabb-simplify', BB_ULTIMATE_ADDON_URL . 'fields/uabb-simplify/css/uabb-simplify.css', array(), '' );
		        wp_enqueue_script( 'uabb-simplify', BB_ULTIMATE_ADDON_URL . 'fields/uabb-simplify/js/uabb-simplify.js', array(), '', true );
		    }
		}*/

		function uabb_simplify_param_media($name, $class, $dashicon, $key, $default_value, $selector, $data_id, $style) {
			$tooltipVal  = str_replace('_', ' ', $data_id);
			$html  = '<div class="uabb-simplify-item '.$class.' '.$data_id.' "'.$selector.' '.$style.'>';
				$html .= '<span class="uabb-icon">';
					$html .=          $dashicon;
        			$html .= '<div class="uabb-tooltip '.$data_id.'">'.ucwords($tooltipVal).'</div>';
				$html .= '</span>';
				$html .= '    <input type="text" name="'.$name.'[]['.str_replace('_device', '', $key).']" class="uabb-simplify-input" maxlength="3" size="6" value="'.$default_value.'" />';
			$html .= '  </div>';
			return $html;
		}
	}
	new UABB_Simplify();
}