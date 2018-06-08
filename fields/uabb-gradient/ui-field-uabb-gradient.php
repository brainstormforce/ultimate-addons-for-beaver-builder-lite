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
		<label for="uabb-gradient-color-one" class="uabb-gradient-label"><?php _e( 'Color 1', 'uabb'); ?></label>
		<div class="fl-color-picker">
			<div class="fl-color-picker-color {{color_one_class}}"></div>
			<div class="fl-color-picker-clear"><div class="fl-color-picker-icon-remove"></div></div>
			<input name="{{name}}[][color_one]" type="hidden" value="{{value.color_one}}" class="fl-color-picker-value" />
		</div>
	</div>
	<div class="uabb-gradient-item bb-color uabb-gradient-color-two fl-field" data-type="color" data-preview="{{preview}}">
		<label for="uabb-gradient-color-two" class="uabb-gradient-label"><?php _e( 'Color 2', 'uabb'); ?></label>
		<div class="fl-color-picker">
			<div class="fl-color-picker-color {{color_two_class}}"></div>
			<div class="fl-color-picker-clear"><div class="fl-color-picker-icon-remove"></div></div>
			<input name="{{name}}[][color_two]" type="hidden" value="{{value.color_two}}" class="fl-color-picker-value" />
		</div>
	</div>
	<div class="uabb-gradient-item uabb-gradient-direction fl-field" data-type="select" data-preview="{{preview}}">
		<label for="uabb-gradient-direction" class="uabb-gradient-label"><?php _e( 'Direction', 'uabb'); ?></label>
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