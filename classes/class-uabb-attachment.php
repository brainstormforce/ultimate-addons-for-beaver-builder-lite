<?php

/**
 * Attachment Data Extra fields
 */
if( !class_exists( "UABB_Attachment" ) ) {
	
	class UABB_Attachment {

		/*
		* Constructor function that initializes required actions and hooks
		* @Since 1.0
		*/
		function __construct() {

			add_filter( 'attachment_fields_to_edit', array( $this, 'uabb_attachment_field_cta' ), 10, 2 );
			add_filter( 'attachment_fields_to_save', array( $this, 'uabb_attachment_field_cta_save' ), 10, 2 );
		}

			/**
			 * Add CTA Link field to media uploader
			 *
			 * @param $form_fields array, fields to include in attachment form
			 * @param $post object, attachment record in database
			 * @return $form_fields, modified form fields
			 */
			 
			function uabb_attachment_field_cta( $form_fields, $post ) {
				$form_fields['uabb-cta-link'] = array(
					'label' => __( 'Image Link', 'uabb' ),
					'input' => 'text',
					'value' => get_post_meta( $post->ID, 'uabb-cta-link', true ),
					/*'helps' => 'Add cta link to photo',*/
				);

				return $form_fields;
			}


			/**
			 * Save values of CTA Link field in media uploader
			 *
			 * @param $post array, the post data for database
			 * @param $attachment array, attachment fields from $_POST form
			 * @return $post array, modified post data
			 */

			function uabb_attachment_field_cta_save( $post, $attachment ) {
				if( isset( $attachment['uabb-cta-link'] ) )
					update_post_meta( $post['ID'], 'uabb-cta-link', $attachment['uabb-cta-link'] );

				return $post;
			}
			
		
	}
	new UABB_Attachment();
}