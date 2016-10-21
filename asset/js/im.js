jQuery(window).load(function() {
	if (getQueryVariable('page') == "wpsm.im") {
		var wpsm = new jQuery.wpsm( getQueryVariable('wpsm_token'));
		wpsm.init_chatbox( '#chat', getQueryVariable('channel') );
		console.log(wpsm);		
	}

});