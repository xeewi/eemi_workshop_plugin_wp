/*
	
	wp Slack manager JS module

*/

(function (jQuery) { 
    jQuery.wpsm = function ( token ) { 
		this.token     = token;
    };

    jQuery.wpsm.prototype = {
    	init_chatbox : function( element, channel ){
    		this.chatbox = (element instanceof jQuery) ? element : jQuery(element);
    		this.animations.scroll_bottom( this.chatbox.children('.content') );
    		this.channel = channel;
    		var self = this;
    		this.start()
    		.then(function(){
    			console.log(self.url);
    		})
    		.fail(function(e){
    			self.animations.chat_error( self.chatbox );
    		});
		},

    	start : function (){
    		var dfd = jQuery.Deferred();
    		var self = this;
    		jQuery.ajax({
    			url: 'https://slack.com/api/rtm.start?token=' + this.token,
    			type: 'GET',
    		})
    		.done(function(json) {
    			if (json.ok == false) { dfd.reject( json.error ); return; }
    			self.url = json.url;
    			dfd.resolve();
    		})
    		.fail(function() {
    			dfd.reject( "HTTP error" );
    		});

    		return dfd.promise();
    	},

    	animations : {
    		scroll_bottom : function( element ){		
    			element.scrollTop( element.height() );
    		},
    		chat_error : function ( element ){
    			element.addClass( 'connect_error' );
    			element.children( '#wpsm_send' ).children('input').attr( 'name');
    			element.children( '#wpsm_send' ).children('input').val('Error, refresh please.');
    		}
    	},
    };

}(jQuery));

function getQueryVariable(variable) {
		var query = window.location.search.substring(1);
		var vars = query.split("&");
		for (var i=0;i<vars.length;i++) {
			var pair = vars[i].split("=");
			if(pair[0] == variable){return pair[1];}
		}
		return(false);
}