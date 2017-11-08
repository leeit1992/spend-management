/**
 * Handle page admin user
 *
 * @version 	1.0
 * @author 		HaLe
 * @package 	ATL
 */
(function($){
	"use strict";
	var ATL_USER = Backbone.View.extend({
		el : '#atl-page-handle-user',

		formClassError : 'md-input-danger',

		events: {
			'submit #atl-form-user' : 'handleForm'
		},

		errorFormTpl: _.template('<div class="uk-notify-message <%= classes %>">\
								        <a class="uk-close"></a>\
								        <div>\
								           <%= message %>\
								        </div>\
								    </div>'),

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

			var formUserPass   = $('input[name=atl_user_pass]', this.el),
				formUserCfPass = $( 'input[name=atl_user_cf_pass]', this.el );

			if( 0 === formUserPass.val().length || ( formUserPass.val() != formUserCfPass.val() ) ){
			
				formUserPass.addClass( self.formClassError );
				formUserCfPass.addClass( self.formClassError );
				
				error.push(1);
			}else{
				formUserPass.removeClass( self.formClassError );
				formUserCfPass.removeClass( self.formClassError );
			}

			if( 0 === error.length ){
				this.handleUser( event );
				return false;
			}else{
				return false;
			}
		},

		/**
		 * handleForm
		 * Handle form submit user
		 * @return void
		 */
		handleUser: function( event ){
			var self     = this,
				file     = $('input[name=atl_user_avatar]', this.el)[0].files[0],
				formdata = new FormData();

			formdata.append("avatar", file);
			formdata.append("formData", $('#atl-form-user', this.el).serialize() );
			
			altair_helpers.content_preloader_show();
			// Send to server handle.
            $.ajax({
			    url: ATLDATA.adminUrl + '/validate-user',
			    type: "POST",
			    data: formdata,
			    processData: false,
			    contentType: false,
			    success: function ( res ) {
			    	altair_helpers.content_preloader_hide();	
			    	var dataResult = JSON.parse( res );

			    	if( false === dataResult.status ) {

			    		var output = '';
			    		$.each(dataResult.message, function(i, el){
			    			output += self.errorFormTpl( {message : el, classes: 'uk-notify-message-danger'} );
			    		});

			    		$('.atl-notify-js', self.el).html( output ).show();
			    		setTimeout( function(){
			    			$('.atl-notify-js', self.el).fadeOut();
			    		},3000 );
			    	}else{
			    		window.location = location.href = ATLDATA.adminUrl + '/edit-user/' + dataResult.id;
			    	}
			    }
			});
		}
	});
	new ATL_USER;
	
})(jQuery);