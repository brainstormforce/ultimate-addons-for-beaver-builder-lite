(function($){

    UABBGradient = {

        _init: function()
        {   
            $('body').delegate( '.uabb-gradient-wrapper .uabb-gradient-direction-select', 'change', UABBGradient._toggleAngle);
        },
       
                /*  TOGGLE CLICK */
        _toggleAngle: function()
        { 
              var   t = $(this).closest('.uabb-gradient-wrapper'),
                    direction_value = $(this).val(),
                    gradient_angle = t.find('.uabb-gradient-angle');
                  
                  if ( direction_value == 'custom' ) {
                      gradient_angle.show();
                  }else{
                      gradient_angle.hide();
                  }
        },
    };
    
    $(function(){
        UABBGradient._init();
    });
    
})(jQuery);