(function($){

	jQuery(document).ready(function() {

		UABBToggleSwitch = {

			_init : function() {
				$('body').delegate( '.uabb-toggle-switch .uabb_toggle_switch_label', 'click', UABBToggleSwitch._settingsSwitchChanged);

			},

			
			_settingsSwitchChanged: function() {
				var $this 		= $(this),
					switch_wrap = $this.closest(".uabb-toggle-switch"),
					this_attr  	= '#'+ $this.attr('for'),
					this_value  = switch_wrap.find(this_attr).val();

					switch_wrap.find(".uabb_toggle_switch_select").val(this_value).change();
					switch_wrap.find(".uabb_toggle_switch_select").trigger('change');
			},
		};

		UABBToggleSwitch._init();
		
	});
})(jQuery);