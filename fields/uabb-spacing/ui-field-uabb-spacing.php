<#
var field   = data.field,
    name    = data.name,
    name_new = 'uabb_' + name,
    value = data.value,
    settings = data.settings,
    preview = data.preview,
    default_val = ( 'undefined' != typeof field.default && '' != field.default )
    selected = '',
    selector = '',
    simplify = 'collapse',
    re = /\s*;\s*/,
    uabb_default = value.split( re ),
    mode = ( field.mode != '' ) ? field.mode : 'padding';

value = value.replace( "px", "" );
data_mode = " data-mode="+mode+" ";

var medias = {};
var medias_all = {
    'all' : ( value.all != '' ) ? value.all : '',
};
var medias_options = {
    'top'       : ( value.top != '' && 'undefined' != typeof value.top ) ? value.top : '',
    'right'     : ( value.right != '' && 'undefined' != typeof value.right ) ? value.right : '',
    'bottom'    : ( value.bottom != '' && 'undefined' != typeof value.bottom ) ? value.bottom : '',
    'left'      : ( value.left != '' && 'undefined' != typeof value.left ) ? value.left : '',
};


if( field.placeholder != '' && 'undefined' != typeof field.placeholder ) {
    var placeholder = {
        'all' :  ( 'undefined' != typeof field.placeholder.all && field.placeholder.all != '' ) ? field.placeholder.all : '<?php _e( 'All', 'uabb' ) ?>',
        'top' :  ( 'undefined' != typeof field.placeholder.top && field.placeholder.top != '' ) ? field.placeholder.top : '<?php _e( 'Top', 'uabb' ) ?>',
        'right' :  ( 'undefined' != typeof field.placeholder.right && field.placeholder.right != '' ) ? field.placeholder.right : '<?php _e( 'Right', 'uabb' ) ?>',
        'bottom' :  ( 'undefined' != typeof field.placeholder.bottom && field.placeholder.bottom != '' ) ? field.placeholder.bottom : '<?php _e( 'Bottom', 'uabb' ) ?>',
        'left' :  ( 'undefined' != typeof field.placeholder.left && field.placeholder.left != '' ) ? field.placeholder.left : '<?php _e( 'Left', 'uabb' ) ?>',
    };
} else {
    var placeholder = {
        'all' : '<?php _e( 'All', 'uabb' ) ?>',
        'top' : '<?php _e( 'Top', 'uabb' ) ?>',
        'right' : '<?php _e( 'Right', 'uabb' ) ?>',
        'bottom' : '<?php _e( 'Bottom', 'uabb' ) ?>',
        'left' : '<?php _e( 'Left', 'uabb' ) ?>',
    };
}
if ( uabb_default.length > 0 ) {
    for ( var key in uabb_default ) {
        var temp = uabb_default[key].split( ":" );
        var ch = ( typeof temp != 'undefined' && temp != '' ) ? temp[0] : 'margin' ;
        var array_value = ( typeof temp[1] != 'undefined' && temp[1] != '' ) ? temp[1] : '' ;
        array_value = jQuery.trim( array_value.replace('px','') );
        switch ( ch ) {
            case 'margin-top':
            case 'padding-top':
                medias_options.top = array_value ; 
                break;
            
            case 'margin-right':
            case 'padding-right':
                medias_options.right = array_value ;
                break;
            
            case 'margin-bottom':
            case 'padding-bottom':
                medias_options.bottom = array_value ;
                break;
            
            case 'margin-left':
            case 'padding-left':
                medias_options.left = array_value ;
                break;
            
            case 'margin':
            case 'padding':
                if ( array_value != '' ) {
                    array_value = array_value.split( '/\s+/' );
                    switch ( array_value.length ) {
                        case 1:
                            medias_all.all = jQuery.trim(temp[1].replace('px','')); 
                            break;
                        case 2:
                            medias_options.top      = medias_options.bottom = temp[1][0];
                            medias_options.right    = medias_options.left   = temp[1][1];
                            break;
                        case 3:
                            medias_options.top      = temp[1][0];
                            medias_options.right    = medias_options.left   = temp[1][1];
                            medias_options.bottom   = temp[1][2];
                            break;
                        case 4:
                            medias_options.top      = temp[1][0];
                            medias_options.right    = temp[1][1];
                            medias_options.bottom   = temp[1][2];
                            medias_options.left     = temp[1][3];
                            break;
                    }
                }
                break;
        }
        
    }
}
var medias =  _.extend({}, medias_all, medias_options );
if( medias_options.top != '' || medias_options.right != '' || medias_options.bottom != '' || medias_options.left != '' ){
    simplify = 'expand';
}

simplify = ( value.simplify != '' && 'undefined' != typeof value.simplify ) ? value.simplify : simplify ;

var spacing = '';

if( simplify == 'collapse' ) {
    spacing += ( medias_all.all != '' && medias_all.all != 'undefined' ) ? mode + ': ' + medias_all.all + 'px;' : ''; 
} else {
    spacing += ( medias_options.top != '' ) ? mode + '-top: ' + medias_options.top + 'px; ' : '';
    spacing += ( medias_options.right != '' ) ? mode + '-right: ' + medias_options.right + 'px; ' : '';
    spacing += ( medias_options.bottom != '' ) ? mode + '-bottom: ' + medias_options.bottom + 'px; ' : '';
    spacing += ( medias_options.left != '' ) ? mode + '-left: ' + medias_options.left + 'px;' : '';
}

var simplify_style = ( simplify == 'collapse' ) ? 'style=display:inline-block;' : 'style=display:none;';
var simplify_option_style = ( simplify == 'collapse' ) ? 'style=display:none;' : 'style=display:inline-block;';
#>

<div class="uabb-spacing-wrapper">
    <div class="uabb-spacing-items" >
        <input type='hidden' class='hidden-spacing' name='{{name}}' value='{{spacing}}'>
       
    <div class='spacing-toggle-wrap'>
        <div class='simplify' uabb-toggle='{{simplify}}'>
            <input type='hidden' class='simplify_toggle' name='{{name}}[][simplify]' value='{{simplify}}'>
            <i class='simplify-icon dashicons dashicons-no-alt uabb-help-tooltip'></i>
            <div class='uabb-tooltip simplify-options'>".__("Expand/Collapse Options","uabb")."</div>
        </div> 
    </div>
    
    <#
    for ( var key in medias ) {   
        switch (key) {
            case 'all': 
                input_class = 'all';
                replace_key = key.replace('/\s+/', '_');
                data_id  = replace_key.toLowerCase();
                #>  
                <div class='uabb-size-wrap ' {{simplify_style}} {{data_mode}}>
                    <div class="uabb-spacing-item fl-field require {{data_id}}" data-type="text" data-preview="{{data.preview}}">
                        <input type="text" placeholder="{{placeholder[key]}}" name="{{name}}[][key]" class="uabb-spacing-input {{input_class}}" maxlength="3" size="6" value="{{(medias[key] != 'undefined' ) ? medias[key] : ''}}" data-field="{{key}}"/>
                    </div>
                </div>
                <div class='uabb-spacing-size-wrap' {{simplify_option_style}} {{data_mode}}>
                <#
            break;            
            case 'top':

                if ( field.preview != undefined ) {
                    field.preview['property'] = mode+'-'+key;
                } else {
                    field.preview = {type:"refresh"};
                }

                input_class = 'expanded';
                replace_key = key.replace('/\s+/', '_');
                data_id  = replace_key.toLowerCase();
                #>  
                <div class="uabb-spacing-item fl-field optional {{data_id}}" data-type="text" data-preview="{{data.preview}}">
                    <input type="text" placeholder="{{placeholder[key]}}" name="{{name}}[][key]" class="uabb-spacing-input {{input_class}}" maxlength="3" size="6" value="{{(medias[key] != 'undefined' ) ? medias[key] : ''}}" data-field="{{key}}"/>
                </div>
                <# 
            break;
            case 'right':       
                if ( field['preview'] != undefined ) {
                    field['preview']['property'] = mode+'-'+key;
                } else {
                    field['preview'] = {type:"refresh"};
                }

                input_class = 'expanded';
                replace_key = key.replace('/\s+/', '_');
                data_id  = replace_key.toLowerCase();
                #>  
                <div class="uabb-spacing-item fl-field optional {{data_id}}" data-type="text" data-preview="{{data.preview}}">
                    <input type="text" placeholder="{{placeholder[key]}}" name="{{name}}[][key]" class="uabb-spacing-input {{input_class}}" maxlength="3" size="6" value="{{(medias[key] != 'undefined' ) ? medias[key] : ''}}" data-field="{{key}}"/>
                </div>
                <# 
            break;
            case 'bottom':        
                if ( field['preview'] != undefined ) {
                    field['preview']['property'] = mode+'-'+key;
                } else {
                    field['preview'] = {type:"refresh"};
                }

                input_class = 'expanded';
                replace_key = key.replace('/\s+/', '_');
                data_id  = replace_key.toLowerCase();
                #>  
                <div class="uabb-spacing-item fl-field optional {{data_id}}" data-type="text" data-preview="{{data.preview}}">
                    <input type="text" placeholder="{{placeholder[key]}}" name="{{name}}[][key]" class="uabb-spacing-input {{input_class}}" maxlength="3" size="6" value="{{(medias[key] != 'undefined' ) ? medias[key] : ''}}" data-field="{{key}}"/>
                </div>
                <# 
            break;
            case 'left':        
                if ( field['preview'] != undefined ) {
                    field['preview']['property'] = mode+'-'+key;
                } else {
                    field['preview'] = {type:"refresh"};
                }

                input_class = 'expanded';
                replace_key = key.replace('/\s+/', '_');
                data_id  = replace_key.toLowerCase();
                #>  
                <div class="uabb-spacing-item fl-field optional {{data_id}}" data-type="text" data-preview="{{data.preview}}">
                    <input type="text" placeholder="{{placeholder[key]}}" name="{{name}}[][key]" class="uabb-spacing-input {{input_class}}" maxlength="3" size="6" value="{{(medias[key] != 'undefined' ) ? medias[key] : ''}}" data-field="{{key}}"/>
                </div>
                <# 
            break;
        }
    } #>

        </div>

    </div>

</div>
