(function($){

    UABBSpacing = {

        _init: function()
        {   
            UABBSpacing._spacingReady();
            $('body').delegate( '.uabb-spacing-wrapper .simplify', 'click', UABBSpacing._toggleExapndCollapse);
            $('body').delegate( '.uabb-size-wrap .uabb-spacing-input.all', 'keyup', UABBSpacing._allChange);
            $('body').delegate( '.uabb-spacing-size-wrap .uabb-spacing-input.expanded', 'keyup', UABBSpacing._expandChange);

        },

        _spacingReady: function(){
          var   t = $('.uabb-spacing-wrapper'),
                    status = t.find('.simplify').attr('uabb-toggle'),
                    h_value = t.find('.simplify_toggle'),
                    icon = t.find('.simplify-icon');

              switch( status ) {
                case 'expand':    t.find('.uabb-size-wrap').hide();
                                  t.find('.uabb-spacing-size-wrap').show();
                                  if( icon.hasClass('dashicons-no-alt') ){
                                    icon.toggleClass('dashicons-no-alt dashicons-minus');
                                  }
                                  break;
                case 'collapse':  t.find('.uabb-size-wrap').show();
                                  t.find('.uabb-spacing-size-wrap').hide();
                                  if( icon.hasClass('dashicons-minus') ){
                                    icon.toggleClass('dashicons-no-alt dashicons-minus');
                                  }
                                  break;
                default:          t.find('.simplify').attr('uabb-toggle', 'collapse');
                                  t.find('.uabb-spacing-size-wrap').hide();
                                  t.find('.uabb-size-wrap').show();
                                  if( icon.hasClass('dashicons-no-alt') ){
                                    icon.toggleClass('dashicons-no-alt dashicons-minus');
                                  }
                                  break;
              }
        }, 
       
                /*  TOGGLE CLICK */
        _toggleExapndCollapse: function()
        {
              var   $this = $(this),
                    t = $this.closest('.uabb-spacing-wrapper'),
                    status = $this.attr('uabb-toggle'),
                    h_value = $this.find('.simplify_toggle'),
                    icon = $this.find('.simplify-icon'),
                    hidden_spacing = t.find('.hidden-spacing');

                    icon.toggleClass('dashicons-no-alt dashicons-minus');
                    
              switch(status) {
                case 'expand':    t.find('.simplify').attr('uabb-toggle', 'collapse');
                                  t.find('.uabb-size-wrap').show();           //for ALL
                                  t.find('.uabb-spacing-size-wrap').hide();
                                     //for Options
                                  h_value.val('collapse');

                                  var field = t.find('.uabb-size-wrap .fl-field'),
                                      target = field.find( 'input' ),
                                      preview = field.data('preview');
                                      if ( preview.type == 'css' ) {
                                        UABBSpacing._uabbPreviewCSS( field, target, preview );
                                      };

                                  t.find('.uabb-size-wrap').find('.uabb-spacing-input.all').trigger('keyup');
                                  break;
                case 'collapse':  t.find('.simplify').attr('uabb-toggle', 'expand');
                                  t.find('.uabb-size-wrap').hide();                                 
                                  t.find('.uabb-spacing-size-wrap').show();
                                  h_value.val('expand');

                                  var fields = t.find('.uabb-spacing-size-wrap .fl-field'),
                                      i = 0;

                                  for( ; i < fields.length; i++) {
                                      field   = fields.eq(i);
                                      target = field.find( 'input' ),
                                      preview = field.data('preview');
                                      if ( preview.type == 'css' ) {
                                        UABBSpacing._uabbPreviewCSS( field, target, preview );
                                      };
                                  }
                                  t.find('.uabb-spacing-size-wrap').find('.uabb-spacing-input.expanded').trigger('keyup');
                                  break;
                default:          t.find('.simplify').attr('uabb-toggle', 'collapse');
                                  t.find('.uabb-size-wrap').show();
                                  t.find('.uabb-spacing-size-wrap').hide();
                                  h_value.val('collapse');
                                  break;
              }
        },

        _allChange: function()
        { 
          //console.log('fired');
          var t = $(this).closest('.uabb-spacing-wrapper'),
              mode = t.find('.uabb-size-wrap').data('mode'),
              hidden_spacing = t.find(".hidden-spacing"),
              value = ( $(this).val() != '' ) ? mode +': '+ $(this).val() + 'px;' : '';

          hidden_spacing.val( value );
        },

        _expandChange: function()
        {
          var t = $(this).closest('.uabb-spacing-wrapper'),
              mode = t.find('.uabb-size-wrap').data('mode'),
              hidden_spacing = t.find(".hidden-spacing");

          hidden_spacing.val(""); 
          t.find(".uabb-spacing-input.expanded").each(function(){ 
            var field = $(this).data('field'),
                css_prop = mode+'-'+field+': ',
                value = ( $(this).val() != '' ) ? css_prop + $(this).val() + 'px; ' : '';
    
            hidden_spacing.val( hidden_spacing.val()+value ); 
          });
        },
        _uabbPreviewCSS: function(field, target, preview)
        { 
          /*** Imp Note ***
              Here we used "FLBuilder.preview" object from "fl-builder.js" file to call methods.
              Imp file for previw is "fl-builder-preview.js". Both files from Beaver Builder.
          ***/
          //console.log( FLBuilder );
          var uabb_node = FLBuilder._contentClass+' .fl-node-' + field.closest('.fl-builder-settings').data('node'),
              selector = FLBuilder.preview._getPreviewSelector( uabb_node, preview.selector ),
              property = preview.property,
              unit     = typeof preview.unit == 'undefined' ? '' : preview.unit,
              value    = target.val();
            
          if(unit == '%') {
            value = parseInt(value)/100;
          }
          else {
            value += unit;
          }
          
          FLBuilder.preview.updateCSSRule(selector, property, value);
        },
    };
    
    $(function(){

      UABBSpacing._init();
      /*var initSettingsForms = FLBuilder._initSettingsForms;
      FLBuilder._initSettingsForms = function() {
        //alert('sandy');

        /*if( FLBuilder.preview == null || FLBuilder.preview !== undefined  ) {
          setTimeout(UABBSpacing._init, 500);
        } else{*/
        /*initSettingsForms();
      };*/
        
    });
    
})(jQuery);