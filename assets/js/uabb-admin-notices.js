/**
 * Customizer controls toggles
 *
 * @package UABB
 */

( function( $ ) {

	/**
	 * Helper class for the main Customizer interface.
	 *
	 * @since 1.8.0
	 * @class UABBNotices
	 */
	UABBNotices = {

		/**
		 * Initializes our custom logic for the Customizer.
		 *
		 * @since 1.8.0
		 * @method init
		 */
		init: function()
		{
			this._bind()
		},

		/**
		 * Binds events for the UABB.
		 *
		 * @since 1.8.0
		 * @access private
		 * @method _bind
		 */
		_bind: function()
		{
			$( document ).on("click", ".uabb-notice-close", UABBNotices._dismissNoticeNew )
			$( document ).on("click", ".uabb-notice .notice-dismiss", UABBNotices._dismissNotice )
		},

		_dismissNotice: function( event ) {
			console.log( 'hello' );
			event.preventDefault()
			var repeat_notice_after = $( this ).parents(".uabb-notice").data( "repeat-notice-after" ) || ""
			var notice_id = $( this ).parents(".uabb-notice").attr( "id" ) || ""

			UABBNotices._ajax( notice_id, repeat_notice_after )
		},

		_dismissNoticeNew: function( event ) {
			event.preventDefault()

			var repeat_notice_after = $( this ).attr( "data-repeat-notice-after" ) || ""
			var notice_id = $( this ).parents(".uabb-notice").attr( "id" ) || ""

			var $el = $( this ).parents(".uabb-notice")
			
			$el.fadeTo( 100, 0, function() {
				$el.slideUp( 100, function() {
					$el.remove()
				})
			})

			UABBNotices._ajax( notice_id, repeat_notice_after )

			var link   = $( this ).attr( "href" ) || ""
			var target = $( this ).attr( "target" ) || ""
			if( "" !== link && "_blank" === target ) {
				window.open(link , "_blank")
			}
		},

		_ajax: function( notice_id, repeat_notice_after ) {

			if( "" === notice_id ) {
				return
			}

			$.ajax({
				url: ajaxurl,
				type: "POST",
				data: {
					action            : "uabb-notice-dismiss",
					notice_id         : notice_id,
					repeat_notice_after : parseInt( repeat_notice_after ),
				},
			})

		}
	}

	$( function() {
		UABBNotices.init()
	} )
} )( jQuery )
