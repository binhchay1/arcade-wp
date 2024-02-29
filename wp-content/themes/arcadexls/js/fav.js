jQuery(document).ready( function($) {
	$('#lnkfav').on("click", ".wpfp-link", function(e) {
		e.preventDefault();

        $('.wpfp-img').show();
		var type = $(this).data("type");
		var tp = $( ".wpfp-linkmt" ).data("tp");
		if(type=='remove'){
			var lnkshow = 'mtfavsecadd';
			var lnkhide = 'mtfavsecremove';
		}else{
			var lnkhide = 'mtfavsecadd';
			var lnkshow = 'mtfavsecremove';			
		}

		url = document.location.href.split('#')[0];
		params = $(this).attr('href').replace('?', '') + '&ajax=1';
        jQuery.get(url, params, function(data) {
			$('[data-tooltip=tooltip]').tooltip({container:'body'});
			$( ".game_opts .mtfav-remove" ).on( "click", function() {
				var text = $( "#lnkfav" ).data( "tremove" );
				$('div.tooltip-inner:contains('+text+')').parent().remove();
			});
			$( ".game_opts .mtfav-add" ).on( "click", function() {
				var text = $( "#lnkfav" ).data( "tadd" );
				$('div.tooltip-inner:contains('+text+')').parent().remove();
			});
			if(tp==1){$('.wpfp-linkmt').remove();}
				$('#'+lnkshow).show();
				$('#'+lnkhide).hide();
				$('.wpfp-img').hide();
            }
        );
    });
});