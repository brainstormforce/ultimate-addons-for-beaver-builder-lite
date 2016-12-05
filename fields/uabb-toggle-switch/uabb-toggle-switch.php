<?php
/*
 *	Switch Param
 */

if(!class_exists('UABB_Toggle_Switch'))
{
	class UABB_Toggle_Switch
	{
		function __construct()
		{	
			add_action( 'fl_builder_control_uabb-toggle-switch', array($this, 'uabb_toggle_switch'), 1, 4 );
			//add_action( 'wp_enqueue_scripts', array( $this, 'toggle_switch_scripts' ) );
		}

		/*function toggle_switch_scripts() {
      if ( class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_active() ) {
        wp_enqueue_style( 'toggle_switch-styles', plugins_url( 'css/uabb-toggle-switch.css', __FILE__ ) );
        wp_enqueue_script( 'toggle_switch-scripts', plugins_url( 'js/uabb-toggle-switch.js', __FILE__ ), array('jquery'), '', true );
      }
		}*/
		
		function uabb_toggle_switch($name, $value, $field) {

      
      $buttoncount = isset( $field['options'] ) ? count($field['options']) : 0 ;
      $option_counter = 1;
      $toggle_options = array();
      $uabb_preview = isset($field['preview']) ? json_encode($field['preview']) : json_encode(array('type' => 'refresh'));
      $uabb_toggle = isset( $field['toggle'] ) ? " data-toggle='".json_encode($field['toggle'])."'" : '';
      $label_width = isset( $field['width'] ) ? $field['width'] : '';
    
      if (array_key_exists('options', $field)) {
          
          $options = $field['options'];
          
          foreach ($options as $t_key => $t_value) {
            $toggle_options[$t_key] = $t_value;
          }
      } else {
          $toggle_options['yes'] = 'Yes';
          $toggle_options['no'] = 'No';
      }
      
			$output = "<div class='uabb-toggle-switch fl-field' data-type='select' data-preview='".$uabb_preview."'>";
      
      /* Dynamic Style */
      $output .= '<style>';
      $output .= '.uabb-toggle-switch .'.$name.'{';
      $output .= 'background: #f7f7f7;';
      $output .= 'border-color: #ccc;';
      $output .= '}';
      
      $output .= '.uabb-toggle-switch .'. $name .':checked + .'.$name.'{';
      $output .= 'background: #1e8cbe;';
      $output .= 'border-color: #0074a2;';
      $output .= 'color: #fff;';    
      $output .= '}';
      if ( $label_width != '' ) {
        $output .= '.uabb_toggle_switch_label.'. $name .'{';
        $output .= 'width: '.$label_width.';';
        $output .= '}';
      }
      $output .= '</style>';
    
      foreach ($toggle_options as $t_key => $t_value) {
        $t_pos = 'uabb_toggle_'.$option_counter; 
        
        $output .= $this->get_input_field( $name, $value, $t_key, $t_value, $t_pos );

        $option_counter = $option_counter + 1;

      }

      $output .= '<select class="uabb_toggle_switch_select uabb_switch_' . $name . '" style="display:none;" name="' . $name . '"'. $uabb_toggle .'>';
        
        foreach ($options as $t_key => $t_value) {
          
          $selected = '';
          if( $value == $t_key ) {
            $selected = ' selected="selected"';
          }
          $output .= '<option value="'. $t_key .'" '. $selected .'>'. $t_value .'</option>';  
        }
      $output .= '</select>';
    
      $output .= '</div>';

      echo $output;
    }
  
    function get_input_field( $name, $value, $option_key, $option_value, $pos  ){
      $checked = '';
      if ( $value == $option_key ) {
        $checked = 'checked';
      }
      $html = '<input type="radio" class="uabb_toggle_switch_radio '.$name.'" id="'.$name.'_'.$pos.'" name="'.$name.'" value="'.$option_key.'" '.$checked.'/>';
      $html .= '<label class="uabb_toggle_switch_label '.$name.'" for="'.$name.'_'.$pos.'">'.$option_value.'</label>';

      return $html;
    }
	}

	new UABB_Toggle_Switch();
}
