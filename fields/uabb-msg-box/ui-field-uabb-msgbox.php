<#
var field   = data.field,
    name    = data.name,
    value   = data.value,
    msg_type = ( typeof field.msg_type != 'undefined' && field.msg_type != '' ) ? field.msg_type : 'info',
    custom_class = ( typeof field.class != 'undefined' && field.class != '' ) ? field.class : '',
    msg_content = '';

custom_class += ' uabb-msg-' + msg_type;

if( typeof field.content != 'undefined' && field.content != '' ) {
	switch ( msg_type ) {
		case 'info':
			msg_content = 'Info!';
			break;
		case 'success':
			msg_content = 'Success!';
			break;
		case 'warning':
			msg_content = 'Warning!';
			break;
		case 'danger':
			msg_content = 'Danger!';
			break;
	}
#>
<div class='uabb-msg {{custom_class}} uabb-msg-field'>
	<strong>{{msg_content}}</strong> {{field.content}}
</div>
<# } #>