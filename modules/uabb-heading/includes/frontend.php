<div class="uabb-module-content uabb-heading-wrapper uabb-heading-align-<?php echo $settings->alignment; ?> <?php echo ( $settings->separator_style == 'line_text' ) ? $settings->responsive_compatibility : ''; ?>">

	<?php if( $settings->separator_position == 'top' ) { ?>
		 <div class="uabb-module-content uabb-separator-parent">
		 	<?php if( $settings->separator_style == 'line_icon' || $settings->separator_style == 'line_image' || $settings->separator_style == 'line_text' ) { ?>
		 		<div class="uabb-separator-wrap <?php echo 'uabb-separator-'.$settings->alignment; ?> <?php echo ( $settings->separator_style == 'line_text' ) ? $settings->responsive_compatibility : ''; ?>" >
		 			<div class="uabb-separator-line uabb-side-left">
		 				<span></span>
		 			</div>			 		    
		 	        <div class="uabb-divider-content uabbi-divider">
		 				<?php $module->render_image(); ?>
		 				<?php if( $settings->separator_style == 'line_text' ) {
	 						echo '<'.$settings->separator_text_tag_selection.' class="uabb-divider-text">'.$settings->text_inline.'</'.$settings->separator_text_tag_selection.'>'; 
	 					}
		 				?>
		 	        </div>			 		    
		 		    <div class="uabb-separator-line uabb-side-right">
		 		    	<span></span>
		 		    </div> 
		 	    </div>
		 	<?php } ?>
		 	<?php if( $settings->separator_style == 'line' ) { ?>
	 			<div class="uabb-separator"></div>
		 	<?php } ?>
		 </div> 
	<?php } ?>

	<<?php echo $settings->tag; ?> class="uabb-heading">
		<?php if( !empty( $settings->link ) ) : ?>
			<a href="<?php echo $settings->link; ?>" title="<?php echo $settings->heading; ?>" target="<?php echo $settings->link_target; ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $settings->link_target, 0, 1 ); ?>>
			<?php endif; ?>
			<span class="uabb-heading-text"><?php echo $settings->heading; ?></span>
			<?php if( !empty( $settings->link ) ) : ?>
			</a>
		<?php endif; ?>
	</<?php echo $settings->tag; ?>>

	<?php if($settings->separator_position == 'center') { ?>
		<div class="uabb-module-content uabb-separator-parent">			
			<?php if( $settings->separator_style == 'line_icon' || $settings->separator_style == 'line_image' || $settings->separator_style == 'line_text' ) { ?>
				<div class="uabb-separator-wrap <?php echo 'uabb-separator-'.$settings->alignment; ?> <?php echo ( $settings->separator_style == 'line_text' ) ? $settings->responsive_compatibility : ''; ?>">
					<div class="uabb-separator-line uabb-side-left">
						<span></span>
					</div>					    
			        <div class="uabb-divider-content uabbi-divider">
						<?php $module->render_image(); ?>
						<?php if( $settings->separator_style == 'line_text' ) {
							echo '<'.$settings->separator_text_tag_selection.' class="uabb-divider-text">'.$settings->text_inline.'</'.$settings->separator_text_tag_selection.'>'; 
						} ?>
			        </div>					    
				    <div class="uabb-separator-line uabb-side-right">
				    	<span></span>
				    </div> 
			    </div>
			<?php } ?>
			<?php if( $settings->separator_style == 'line' ) { ?>
					<div class="uabb-separator"></div>
			<?php } ?>
		</div>
    <?php } ?>

	<?php if( $settings->description != '' ) : ?>
		<div class="uabb-subheading uabb-text-editor">
			<?php echo $settings->description; ?>
		</div>
	<?php endif; ?>

	<?php if($settings->separator_position == 'bottom') { ?>
		<div class="uabb-module-content uabb-separator-parent">			
			<?php if( $settings->separator_style == 'line_icon' || $settings->separator_style == 'line_image' || $settings->separator_style == 'line_text' ) { ?>
				<div class="uabb-separator-wrap <?php echo 'uabb-separator-'.$settings->alignment; ?> <?php echo ( $settings->separator_style == 'line_text' ) ? $settings->responsive_compatibility : ''; ?>">
					<div class="uabb-separator-line uabb-side-left">
						<span></span>
					</div>
				    
			        <div class="uabb-divider-content uabbi-divider">
						<?php $module->render_image(); ?>
						<?php if( $settings->separator_style == 'line_text' ){
								echo '<'.$settings->separator_text_tag_selection.' class="uabb-divider-text">'.$settings->text_inline.'</'.$settings->separator_text_tag_selection.'>'; 
							}
						?>
			        </div>
				    
				    <div class="uabb-separator-line uabb-side-right">
				    	<span></span>
				    </div> 
			    </div>
			<?php } ?>

			<?php if( $settings->separator_style == 'line' ) { ?>
				<div class="uabb-separator"></div>
			<?php } ?>
		</div>
	<?php } ?> 
</div>