/**
 * Handle page admin debt
 *
 * @version 	1.0
 * @author 		HaLe
 * @package 	ATL
 */
(function($){
	"use strict";
	var ATL_DEBT = Backbone.View.extend({
		el : '#atl-page-handle-debt',

		formClassError : 'md-input-danger',

		events: {
			'submit #atl-form-debt' : 'handleForm',
			'click .atl-manage-debt-delete-js' : 'removeDebt',
			'click .atl-action-apply-js' : 'actionManage',
			'click .atl-manage-debt-day-js' : 'searchManageDay',
			'click .atl-manage-debt-month-js' : 'searchManageMonth',
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

			$(".atl_debt_expire_un").on('ifChecked',function(){
				
				var debtTime = $(".atl_debt_expire");
				
				debtTime.attr('disabled', 'disabled');
				debtTime.val('');
			});

			$(".atl_debt_expire_un").on('ifUnchecked',function(){
	
				var debtTime = $(".atl_debt_expire");
				
				debtTime.removeAttr("disabled");
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
				this.handleDebt( event );
				return false;
			}else{
				return false;
			}
		},
		
		/**
		 * handleForm
		 * Handle form submit debt
		 * @return void
		 */
		handleDebt: function( event ){
			var self     = this,
				data = { formData :  $('#atl-form-debt', this.el).serialize() };

			altair_helpers.content_preloader_show();
			// Send to server handle.
            $.ajax( {
			    url: ATLDATA.adminUrl + '/validate-debt',
			    type: "POST",
			    data: data,
			    success: function ( res ) {
			    	altair_helpers.content_preloader_hide();	
			    	var dataResult = JSON.parse( res );
			    	if( dataResult.status ) {
			    		window.location = location.href = ATLDATA.adminUrl + '/edit-debt/' + dataResult.id;
			    	}
			    }
			} );
		},
		/**
		 * Handle remove debt
		 * 
		 * @return void
		 */
		removeDebt: function(e){
			var dataID = $( e.currentTarget ).attr('data-id');
			UIkit.modal.confirm('Are you sure?', function(){ 
				var data = { id: dataID	};
				// Send to server handle.
				$.post(ATLDATA.adminUrl + '/delete-debt', data, function(result) {

					$( e.currentTarget ).closest('tr').remove();

					UIkit.modal.alert('Delete Success!');
	            });
			})
			return false;
		},

		/**
		 * Handle remove multi debt
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
				$.post(ATLDATA.adminUrl + '/delete-debt', data, function(result) {
					var dataResult = JSON.parse( result );
					$.each(argsID,function(i, el){
						$(".atl-debt-item-" + el).remove();
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
		 * Handle form by Type debt
		 * @return void
		 */
		searchManageDay: function(e){
			var self = this;
			altair_helpers.content_preloader_show();
			var data = {
                getBy: "day",
                startDate: $('.atl-debt-start-day').val(),
                endDate: $('.atl-debt-end-day').val()
          	};
          	// Send to server handle.
    		$.get(ATLDATA.adminUrl + '/ajax-manage-debt', data, function(result) {
            	
            	var dataResult = JSON.parse( result );
            	$(".atl-list-debt-js", self.el).html( dataResult.output );
            	$(".atl-list-debt-not-js", self.el).hide();
            	altair_helpers.content_preloader_hide();
				$("ul.uk-pagination", self.el).hide();
            });
            return false;
		},
		/**
		 * Handle search debt
		 * 
		 * @return void
		 */
		searchManageMonth: function(e){
			var self = this;
			altair_helpers.content_preloader_show();
			var data = {
                getBy: "month",
                dataMonth: $('.atl-debt-month').val(),
                dataYear: $('.atl-debt-year').val()
          	};
          	// Send to server handle.
    		$.get(ATLDATA.adminUrl + '/ajax-manage-debt', data, function(result) {
            	
            	var dataResult = JSON.parse( result );
            	$(".atl-list-debt-js", self.el).html( dataResult.output );
            	$(".atl-list-debt-not-js", self.el).hide();
            	altair_helpers.content_preloader_hide();
            	$("ul.uk-pagination", self.el).hide();
            });
            return false;
		},

		changeDayExpire: function(e){
			var self = this;
			var debtTime = $(".atl_debt_expire");
			
			if ( $('.atl_debt_expire_un').is(':checked') ) {
				debtTime.attr('disabled', 'disabled');
				debtTime.val('');
			} else {
				debtTime.removeAttr("disabled");
			}
		}
		
	});
	new ATL_DEBT;
	
})(jQuery);