jQuery(document).ready(function($){
	// register
	$( "#registerfrmmt button" ).click(function(e) {
		e.preventDefault();
		$("#registerfrmmt button").text(ArcadexlsAccountAjax.textb);
		$("#registerfrmmt button").prop("disabled",true);
		$.post(ArcadexlsAccountAjax.ajaxurl, $( "#registerfrmmt" ).serialize()).done(function(html) {
			$("#registerfrmmt button").text(ArcadexlsAccountAjax.text);
			$("#registerfrmmt button").prop("disabled",false);
			$("#registerfrmmt .error").remove();
			$("#registerfrmmt").prepend(html);
		});
	});
});