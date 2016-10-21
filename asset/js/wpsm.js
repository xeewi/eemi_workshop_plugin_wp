/*
	
	wp Slack manager JS module

*/

(function (jQuery) { 
    jQuery.wpsm = function () { 
		this.token     = jQuery.wpsm.getQueryVariable('wpsm_token');
		this.channel   = jQuery.wpsm.getQueryVariable('channel');
		this.slack_uri = "https://slack.com/api/rtm.start";
    };

    jQuery.wpsm.prototype = {
    	init_chatbox : function( element ){
    		this.animations.scroll_bottom( element );
    	},
    	animations : {
    		scroll_bottom : function( element ){
    			this.chatbox = (element instanceof jQuery) ? element : jQuery(element);
    			console.log(this.chatbox);
    			this.chatbox.scrollTop(this.chatbox.height());
    		}
    	},
    };

   	jQuery.wpsm.getQueryVariable = function(variable) {
		var query = window.location.search.substring(1);
		var vars = query.split("&");
		for (var i=0;i<vars.length;i++) {
			var pair = vars[i].split("=");
			if(pair[0] == variable){return pair[1];}
		}
		return(false);
	}

}(jQuery));