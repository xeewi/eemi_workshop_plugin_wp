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
                console.log(e);
    			self.animations.chat_error( self.chatbox, e.responseText );
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
                var users = new Array;

                for( var x in json.users ){
                    users[json.users[x].id] = json.users[x];
                } 

                self.users = users;
                self.current_user = users[json.self.id];
                self.channels = json.channels;
                self.ims = json.ims;
                self.team = json.team;
                self.url = json.url;
    			dfd.resolve();
    		})
    		.fail(function(e) {
    			dfd.reject(e);
    		});

    		return dfd.promise();
    	},

        start_ws : function(){
            this.socket = new WebSocket( this.url );
            var self = this;
            this.socket.onmessage = function(e){
                var data = JSON.parse(e.data);
                var event = data.type;
                var data = data;

                if ( typeof(self['on_' + event]) == 'function' ) {
                    self['on_' + event]( data );
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
                var template = '<div><p style="color: #' + self.current_user.color + '" >' + self.current_user.name + '</p><p>' + message + '</p></div>';
                var content = self.chatbox.children('.content');
                content.append(template);
                self.animations.scroll_bottom( content );
            });

            this.on_message = this.event_current_message;    
        },

        event_current_message : function( data ){
            console.log(data);
            if ( data.channel != this.channel ) { return false; }
            var template = '<div><p style="color: #' + this.users[data.user].color + '" >' + this.users[data.user].name + '</p><p>' + data.text + '</p></div>';
            var content = this.chatbox.children('.content');
            content.append(template);
            this.animations.scroll_bottom( content );           
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
    			element.scrollTop( 100000000000 );
    		},
    		chat_error : function ( element, text ){
                if (!text) { text = "Error, refresh please"; }
    			element.addClass( 'connect_error' );
    			element.children( '#wpsm_send' ).children('input').attr( 'name');
    			element.children( '#wpsm_send' ).children('input').val( text );
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