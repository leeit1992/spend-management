/**
 * Handle page admin spend
 *
 * @version 	1.0
 * @author 		HaLe
 * @package 	ATL
 */
(function($){
	"use strict";
	var ATL_SPEND = Backbone.View.extend({
		el : '#atl-page-handle-spend',

		formClassError : 'md-input-danger',

		events: {
			'submit #atl-form-spend' : 'handleForm',
			'click .atl-manage-spend-filter-js li' : 'handleFilterByType',
			'click .atl-manage-spend-delete-js' : 'removeSpend',
			'click .atl-action-apply-js' : 'actionManage',
			'keyup .atl-spend-manage-search-js' : 'searchManage',
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
				this.handleSpend( event );
				return false;
			}else{
				return false;
			}
		},
		
		/**
		 * handleForm
		 * Handle form submit spend
		 * @return void
		 */
		handleSpend: function( event ){
			var self     = this,
				data = { formData :  $('#atl-form-spend', this.el).serialize() };

			altair_helpers.content_preloader_show();
			// Send to server handle.
            $.ajax( {
			    url: ATLDATA.adminUrl + '/validate-spend',
			    type: "POST",
			    data: data,
			    success: function ( res ) {
			    	altair_helpers.content_preloader_hide();	
			    	var dataResult = JSON.parse( res );
			    	if( dataResult.status ) {
			    		window.location = location.href = ATLDATA.adminUrl + '/edit-spend/' + dataResult.id;
			    	}
			    }
			} );
		},
		/**
		 * handleFilterByType
		 * Handle form by Type spend
		 * @return void
		 */
		handleFilterByType: function(e){
			var self = this;
			altair_helpers.content_preloader_show();
			$(".atl-manage-spend-filter-js li", this.el).each(function(index, el){
				$(el).removeClass('uk-active');
			});
			$( e.currentTarget ).addClass('uk-active');
			var data = {
                getBy: "type",
                typeStatus: $( 'a', e.currentTarget ).attr('data-type')
          	};
          	// Send to server handle.
    		$.get(ATLDATA.adminUrl + '/ajax-manage-spend', data, function(result) {
            	
            	var dataResult = JSON.parse( result );
            	$(".atl-list-spend-js", self.el).html( dataResult.output );
            	$(".atl-list-spend-not-js", self.el).hide();
            	altair_helpers.content_preloader_hide();
            });
            return false;
		},
		/**
		 * Handle remove spend
		 * 
		 * @return void
		 */
		removeSpend: function(e){
			var dataID = $( e.currentTarget ).attr('data-id');
			UIkit.modal.confirm('Are you sure?', function(){ 
				var data = { id: dataID	};
				// Send to server handle.
				$.post(ATLDATA.adminUrl + '/delete-spend', data, function(result) {

					$( e.currentTarget ).closest('tr').remove();

					UIkit.modal.alert('Delete Success!');
	            });
			})
			return false;
		},

		/**
		 * Handle remove multi spend
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
				$.post(ATLDATA.adminUrl + '/delete-spend', data, function(result) {
					var dataResult = JSON.parse( result );
					$.each(argsID,function(i, el){
						$(".atl-spend-item-" + el).remove();
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
		 * Handle search spend
		 * 
		 * @return void
		 */
		searchManage: function(e){
			var keyup = $(e.currentTarget).val(),
			 	data = {
			 		getBy: "search",
	    			keyup: keyup
	            }; 
            if( 0 < keyup.length ) {
            	$(".atl-list-spend-not-js",this.el).fadeOut();
	            $(".atl-list-spend-js",this.el).fadeIn();
            	altair_helpers.content_preloader_show();
            }else{
            	$(".tl-list-spend-not-js",this.el).fadeIn();
	            $(".tl-list-spend-js",this.el).fadeOut();
            	altair_helpers.content_preloader_hide();
            }
            $.get(ATLDATA.adminUrl + '/ajax-manage-spend', data, function(result) {
            	var dataResult = JSON.parse( result );
            	$(".atl-list-spend-js", self.el).html( dataResult.output );
            	altair_helpers.content_preloader_hide();
            });
		},
	});
	new ATL_SPEND;
	
})(jQuery);