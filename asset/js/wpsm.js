/*
	
	wp Slack manager JS module

*/

(function (jQuery) { 
    jQuery.wpsm = function () { 
        this.token = jQuery.wpsm.getQueryVariable('wpsm_token');
    };

    jQuery.wpsm.prototype = {

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