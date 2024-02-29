jQuery(document).ready(function($){
	$(document).keyup(function(a){if(a.keyCode==27)$('.lgtbxbg-pofi').fadeOut(150);});	
	$('.lgtbxbg-pofi').click(function(event){event.preventDefault();$('.lgtbxbg-pofi').fadeOut(150);});	
	$(".trnlgt").click(function(event){event.preventDefault();$('.lgtbxbg-pofi').fadeIn(150);});
	$('.lgtbxbg-pofi').css("opacity", 0.7);
});