/*
	
	wp Slack manager JS module

*/

(function (jQuery) { 
    jQuery.wpsm = function ( token ) { 
		this.token = token;
        this.count = 1;
    };

    jQuery.wpsm.prototype = {
    	init_chatbox : function( element, channel ){
    		this.chatbox = (element instanceof jQuery) ? element : jQuery(element);
    		this.animations.scroll_bottom( this.chatbox.children('.content') );
    		this.channel = channel;
    		var self = this;
    		this.start()
    		.then(function(){
                self.start_ws();
                self.chatbox_ws();
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

        start_ws : function(){
            this.socket = new WebSocket( this.url );
            this.socket.onmessage = function(Event){
                var event = Event.event;
                var data = Event.data;

                if ( typeof(this['on_' + event]) == 'function' ) {
                    this['on_' + event]( data );
                }
            };
        },

        chatbox_ws : function(){
            var self = this;

            this.chatbox.children( '#wpsm_send' )
            .submit(function(event){
                event.preventDefault();
                var input = self.chatbox.children( '#wpsm_send' ).children('input');
                    message = input.val();
                    input.val('');

                if ( message == "" ) { return false; }
                self.send_message( message );
                var template = '<div><p>me</p><p>' + message + '</p></div>';
                var content = self.chatbox.children('.content');
                content.append(template);
                self.animations.scroll_bottom( content );
            });        
        },

        send_message : function( value ){
            var msg = {
                id : this.count,
                type : "message",
                channel : this.channel,
                text : value
            };

            this.socket.send( JSON.stringify(msg) );
            this.count += 1;
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