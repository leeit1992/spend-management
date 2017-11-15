/**
 * Handle page admin collected
 *
 * @version 	1.0
 * @author 		HaLe
 * @package 	ATL
 */
(function($){
	"use strict";
	var ATL_COLLECTED = Backbone.View.extend({
		el : '#atl-page-handle-collected',

		formClassError : 'md-input-danger',

		events: {
			'submit #atl-form-collected' : 'handleForm',
			'click .atl-manage-collected-delete-js' : 'removeCollected',
			'click .atl-action-apply-js' : 'actionManage',
			'click .atl-manage-collected-day-js' : 'searchManageDay',
			'click .atl-manage-collected-month-js' : 'searchManageMonth',
		},

		errorFormTpl: _.template( '<div class="uk-notify-message <%= classes %>">\
								        <a class="uk-close"></a>\
								        <div>\
								           <%= message %>\
								        </div>\
								    </div>' ),

		initialize: function() {
			var self = this;
			$(window).load(function(){
				var message = $( '.atl-notify-js', self.el ).attr('data-notify');
				
				if(message){
					var output = self.errorFormTpl( {message : message, classes: 'uk-notify-message-success'} );
					$('.atl-notify-js', self.el).html( output ).show();
	
					setTimeout( function(){
		    			$('.atl-notify-js', self.el).fadeOut();
		    		},3000 )
				}
			});
			// Auto check all
			ATLLIB.checkAll(this.el);
		},
		/**
	     * Handle form data before save to database.
	     * @return void
	     */
		handleForm: function( event ){
			var self 		= this,
				$formData 	= $(".atl-required-js", this.el),
				error 		= new Array();

			$.each( $formData, function( index, el ){
				var getValInput = $(el).val();

				if( 0 === getValInput.length ){
					$(el).addClass( self.formClassError );
					error.push(index);
				}else{
					$(el).removeClass( self.formClassError );
					error.splice(index, 1);
				}
			});
			if( 0 === error.length ){
				this.handleCollected( event );
				return false;
			}else{
				return false;
			}
		},
		
		/**
		 * handleForm
		 * Handle form submit collected
		 * @return void
		 */
		handleCollected: function( event ){
			var self     = this,
				data = { formData :  $('#atl-form-collected', this.el).serialize() };

			altair_helpers.content_preloader_show();
			// Send to server handle.
            $.ajax( {
			    url: ATLDATA.adminUrl + '/validate-collected',
			    type: "POST",
			    data: data,
			    success: function ( res ) {
			    	altair_helpers.content_preloader_hide();	
			    	var dataResult = JSON.parse( res );
			    	if( dataResult.status ) {
			    		window.location = location.href = ATLDATA.adminUrl + '/edit-collected/' + dataResult.id;
			    	}
			    }
			} );
		},
		/**
		 * Handle remove collected
		 * 
		 * @return void
		 */
		removeCollected: function(e){
			var dataID = $( e.currentTarget ).attr('data-id');
			UIkit.modal.confirm('Are you sure?', function(){ 
				var data = { id: dataID	};
				// Send to server handle.
				$.post(ATLDATA.adminUrl + '/delete-collected', data, function(result) {

					$( e.currentTarget ).closest('tr').remove();

					UIkit.modal.alert('Delete Success!');
	            });
			})
			return false;
		},

		/**
		 * Handle remove multi collected
		 * 
		 * @return void
		 */
		actionManage: function( e ){
			// Get action.
			var action = $( e.currentTarget ).closest('.atl-action-manage').find("select[name=atl-action-manage]").val();
			var argsID = new Array;
			if( 'delete' == action ) {
				altair_helpers.content_preloader_show();
				// Get list id remove checked.
				$(".atl-checkbox-child-js", this.el).each(function(){
					if(this.checked){
						argsID.push($(this).val());
					}
				})
				// Send to server handle.
				var data = { id: argsID };
				$.post(ATLDATA.adminUrl + '/delete-collected', data, function(result) {
					var dataResult = JSON.parse( result );
					$.each(argsID,function(i, el){
						$(".atl-collected-item-" + el).remove();
					})

					altair_helpers.content_preloader_hide();

					if( dataResult.status ){
						UIkit.modal.alert('Delete Success!');
					}else{
						UIkit.modal.alert('Delete False!');
					}
	            });
			}else{
				UIkit.modal.alert('Please choose Action!');
			}
		},
		/**
		 * handleFilterByType
		 * Handle form by Type collected
		 * @return void
		 */
		searchManageDay: function(e){
			var self = this;
			altair_helpers.content_preloader_show();
			var data = {
                getBy: "day",
                startDate: $('.atl-collected-start-day').val(),
                endDate: $('.atl-collected-end-day').val()
          	};
          	// Send to server handle.
    		$.get(ATLDATA.adminUrl + '/ajax-manage-collected', data, function(result) {
            	
            	var dataResult = JSON.parse( result );
            	$(".atl-list-collected-js", self.el).html( dataResult.output );
            	$(".atl-list-collected-not-js", self.el).hide();
            	altair_helpers.content_preloader_hide();
				$("ul.uk-pagination", self.el).hide();
            });
            return false;
		},
		/**
		 * Handle search collected
		 * 
		 * @return void
		 */
		searchManageMonth: function(e){
			var self = this;
			altair_helpers.content_preloader_show();
			var data = {
                getBy: "month",
                dataMonth: $('.atl-collected-month').val(),
                dataYear: $('.atl-collected-year').val()
          	};
          	// Send to server handle.
    		$.get(ATLDATA.adminUrl + '/ajax-manage-collected', data, function(result) {
            	
            	var dataResult = JSON.parse( result );
            	$(".atl-list-collected-js", self.el).html( dataResult.output );
            	$(".atl-list-collected-not-js", self.el).hide();
            	altair_helpers.content_preloader_hide();
            	$("ul.uk-pagination", self.el).hide();
            });
            return false;
		},
	});
	new ATL_COLLECTED;
	
})(jQuery);