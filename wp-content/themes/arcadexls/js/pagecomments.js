jQuery(document).ready(function($){
	// tabs pagination comments
	$( "#commentstab .navcom a" ).click(function(e) {
		e.preventDefault();
		$('#commentstab').append('<div class="bx-loading"></div>');
		$('#cmtcnt').hide();
		var href = $(this).attr('href');		
		$( "#commentstab" ).load( href+" #cmtcnt", function(html) {
		  $.getScript(PagecommentsAjax.file);
		  var height = $("#cmtcnt").height();
		  $('.bx-viewport').attr('style', 'width: 100%; overflow: hidden; position: relative; height: '+height+' !important');
		  $('#commentstab .bx-loading').remove();
		  $('#cmtcnt').show();		  
		});
	});
});