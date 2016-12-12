<?php
/*
 *	Switch Param
 */

if(!class_exists('UABB_Blank_Spacer'))
{
	class UABB_Blank_Spacer
	{
		function __construct()
		{	
			add_action( 'fl_builder_control_uabb-blank-spacer', array($this, 'uabb_blank_spacer'), 1, 4 );
			//add_action( 'wp_enqueue_scripts', array( $this, 'blank_spacer_scripts' ) );
		}

		/*function blank_spacer_scripts() {
      		if ( class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_active() ) {
        		wp_enqueue_style( 'blank_spacer-styles', plugins_url( 'css/uabb-blank-spacer.css', __FILE__ ) );
      		}		
		}*/
		
		function uabb_blank_spacer($name, $value, $field) {

      
      		$spacer_height = isset( $field['height'] ) ? $field['height'] : '50px' ;
      
			$output = "<div class='uabb-blank-spacer'>";
      
      		/* Dynamic Style */
      		$output .= '<style>';
      		$output .= '.uabb-blank-spacer .uabb-spacer-'.$name.'{';
      		$output .= 'height: '.$spacer_height.';';
      		$output .= '}';
      		$output .= '</style>';
    		
    		$output .= '<div class="uabb-spacer-' . $name . '"></div>';
    		$output .= '</div>';
		
      		echo $output;
    	}
	}

	new UABB_Blank_Spacer();
}
