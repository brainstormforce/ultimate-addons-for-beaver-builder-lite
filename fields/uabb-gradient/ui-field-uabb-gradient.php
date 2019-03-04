<?php
/**
 * For UI Field Gradient
 *
 * @package Gradient Field
 */

?>
<#
var field   = data.field,
	name    = data.name,
	name_new = 'uabb_' + name,
	value = data.value,
	settings = data.settings,
	preview = data.preview,
	default_val = ( 'undefined' != typeof field.default && '' != field.default )
	selected = '',
	sel = '',
	color_one_class = ( value.color_one == '' ) ? 'fl-color-picker-empty' : '',
	color_two_class = ( value.color_two == '' ) ? 'fl-color-picker-empty' : '',
	direction = {
		'left_right' : '<?php _e( 'Left to Right', 'uabb' ); ?>',
		'right_left' : '<?php _e( 'Right to Left', 'uabb' ); ?>',
		'top_bottom' : '<?php _e( 'Top to Bottom', 'uabb' ); ?>',
		'bottom_top' : '<?php _e( 'Bottom to Top', 'uabb' ); ?>',
		'custom'     : '<?php _e( 'Custom', 'uabb' ); ?>'
	},
	yr = parseInt( '<?php echo date( 'Y' ); ?>' );
#>

<div class="uabb-gradient-wrapper bb-colorpick">
	<div class="uabb-gradient-item bb-color uabb-gradient-color-one fl-field" data-type="color" data-preview="{{preview}}">
		<label for="uabb-gradient-color-one" class="uabb-gradient-label"><?php _e( 'Color 1', 'uabb' ); ?></label>
		<div class="fl-color-picker">
			<div class="fl-color-picker-color {{color_one_class}}">
				<svg class="fl-color-picker-icon" width="18px" height="18px" viewBox="0 0 18 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
					<g fill-rule="evenodd">
						<path d="M17.7037706,2.62786498 L15.3689327,0.292540631 C14.9789598,-0.0975135435 14.3440039,-0.0975135435 13.954031,0.292540631 L10.829248,3.41797472 L8.91438095,1.49770802 L7.4994792,2.91290457 L8.9193806,4.33310182 L0,13.2493402 L0,18 L4.74967016,18 L13.6690508,9.07876094 L15.0839525,10.4989582 L16.4988542,9.08376163 L14.5789876,7.16349493 L17.7037706,4.03806084 C18.0987431,3.64800667 18.0987431,3.01791916 17.7037706,2.62786498 Z M3.92288433,16 L2,14.0771157 L10.0771157,6 L12,7.92288433 L3.92288433,16 Z"></path>
					</g>
				</svg>
			</div>
			<div class="fl-color-picker-clear"><div class="fl-color-picker-icon-remove"></div></div>
			<input name="{{name}}[][color_one]" type="hidden" value="{{value.color_one}}" class="fl-color-picker-value" />
		</div>
	</div>
	<div class="uabb-gradient-item bb-color uabb-gradient-color-two fl-field" data-type="color" data-preview="{{preview}}">
		<label for="uabb-gradient-color-two" class="uabb-gradient-label"><?php _e( 'Color 2', 'uabb' ); ?></label>
		<div class="fl-color-picker">
			<div class="fl-color-picker-color {{color_two_class}}">
				<svg class="fl-color-picker-icon" width="18px" height="18px" viewBox="0 0 18 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
					<g fill-rule="evenodd">
						<path d="M17.7037706,2.62786498 L15.3689327,0.292540631 C14.9789598,-0.0975135435 14.3440039,-0.0975135435 13.954031,0.292540631 L10.829248,3.41797472 L8.91438095,1.49770802 L7.4994792,2.91290457 L8.9193806,4.33310182 L0,13.2493402 L0,18 L4.74967016,18 L13.6690508,9.07876094 L15.0839525,10.4989582 L16.4988542,9.08376163 L14.5789876,7.16349493 L17.7037706,4.03806084 C18.0987431,3.64800667 18.0987431,3.01791916 17.7037706,2.62786498 Z M3.92288433,16 L2,14.0771157 L10.0771157,6 L12,7.92288433 L3.92288433,16 Z"></path>
					</g>
				</svg>
			</div>
			<div class="fl-color-picker-clear"><div class="fl-color-picker-icon-remove"></div></div>
			<input name="{{name}}[][color_two]" type="hidden" value="{{value.color_two}}" class="fl-color-picker-value" />
		</div>
	</div>
	<div class="uabb-gradient-item uabb-gradient-direction fl-field" data-type="select" data-preview="{{preview}}">
		<label for="uabb-gradient-direction" class="uabb-gradient-label"><?php _e( 'Direction', 'uabb' ); ?></label>
		<select name="{{name}}[][direction]" class="uabb-gradient-direction-select">
		<#
		for ( var direction_key in direction ) {
			selected = '';
			if ( value.direction == direction_key ) {
				selected = 'selected="selected"';
			}
			#>
			<option value="{{direction_key}}" {{selected}}>{{direction[direction_key]}}</option>
			<#
		}
		#>
		</select>
	</div>
	<div class="uabb-gradient-item uabb-gradient-angle fl-field" data-type="text" data-preview="{{preview}}">
		<label for="uabb-gradient-angle" class="uabb-gradient-label"><?php _e( 'Angle', 'uabb' ); ?></label>
		<input type="text" class="uabb-gradient-angle-input" name="{{name}}[][angle]" maxlength="3" size="6" value="{{value.angle}}" />
		<span class="fl-field-description"><?php _e( 'deg', 'uabb' ); ?></span>
	</div>
</div>
