(function($){

    UABBResponsive = {

        _init: function()
        {   
            $('body').delegate( '.uabb-simplify-wrapper .simplify', 'click', UABBResponsive._toggleExapndCollapse);
            /*$('body').delegate('.uabb-help-tooltip', 'mouseover', UABBResponsive._showHelpTooltip);
            $('body').delegate('.uabb-help-tooltip', 'mouseout', UABBResponsive._hideHelpTooltip);*/
        },
       
                /*  TOGGLE CLICK */
        _toggleExapndCollapse: function()
        {
              var   t = $(this).closest('.uabb-simplify-wrapper'),
                    status = $(this).attr('uabb-toggle');
                    h_value = $(this).find('.simplify_toggle');
              switch(status) {
                case 'expand':    t.find('.simplify').attr('uabb-toggle', 'collapse');
                                  t.find('.uabb-simplify-item.optional').hide();
                                  h_value.val('collapse');
                                  break;
                case 'collapse':  t.find('.simplify').attr('uabb-toggle', 'expand');
                                  t.find('.uabb-simplify-item.optional').show();
                                  h_value.val('expand');
                                  break;
                default:          t.find('.simplify').attr('uabb-toggle', 'collapse');
                                  t.find('.uabb-simplify-item.optional').hide();
                                  h_value.val('collapse');
                                  break;
              }
        },
         
        /*_showHelpTooltip: function()
        {   
            var h = $(this).closest('.uabb-icon, .simplify');
            h.find('.uabb-tooltip').fadeIn();
        },
        
        _hideHelpTooltip: function()
        {
            var h = $(this).closest('.uabb-icon, .simplify');
            h.find('.uabb-tooltip').fadeOut();
        },*/
    };
    
    $(function(){
        UABBResponsive._init();
    });
    
})(jQuery);