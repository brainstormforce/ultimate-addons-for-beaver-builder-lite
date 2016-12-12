<?php
/*
 *	Static Message Box Param
 */

/**
 * 'iconmsgs'     => array(
*                       'type'           => 'uabb-msgbox',
*                       'label'          => '',
*                       'msg-type'       => 'success',
*                       'class'          => 'my-custom-class'
*                       'content'        => 'This alert box could indicate a neutral informative change or action.'
*					),
 **/

if(!class_exists('UABB_MSG_Field'))
{
	class UABB_MSG_Field
	{
		function __construct()
		{	
			add_action( 'fl_builder_control_uabb-msgbox', array($this, 'uabb_msgbox'), 1, 4 );
			//add_action( 'wp_enqueue_scripts', array( $this, 'msg_field_scripts' ) );
		}

		/*function msg_field_scripts() {
	    	      if ( class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_active() ) {
	    		wp_enqueue_style( 'msg_field-styles', plugins_url( 'css/uabb-msg-field.css', __FILE__ ) );
	      	}
		}*/
		
		function uabb_msgbox($name, $value, $field, $settings) {
      		
      		$msg_type = isset( $field['msg-type'] ) ? $field['msg-type'] : 'info';
                  $custom_class = isset( $field['class'] ) ? $field['class'] : '';
      		$custom_class .= ' uabb-msg-'.$msg_type; 

      		$msg_content = '';

                  if( isset( $field['content'] ) ) {
                        if( $field['content'] != '' ) {

                              switch ( $msg_type ) {
                                    case 'info':
                                          $msg_content = '<strong>Info!</strong> ';
                                          break;
                                    case 'success':
                                          $msg_content = '<strong>Success!</strong> ';
                                          break;
                                    case 'warning':
                                          $msg_content = '<strong>Warning!</strong> ';
                                          break;
                                    case 'danger':
                                          $msg_content = '<strong>Danger!</strong> ';
                                          break;
                              }

                              $msg_content .= $field['content'];

                              $output = "<div class='uabb-msg " . $custom_class . " uabb-msg-field'>";
                              $output .= $msg_content;
                              $output .= '</div>';
                              
                              echo $output;
                        }
                  }
            }
	}

	new UABB_MSG_Field();
}
