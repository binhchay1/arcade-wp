/* * Progress Bar Plugin for jQuery * Version: Alpha 2 * Release: 2007-02-26 */ 
(function($) {	
	//Main Method
	$.fn.reportprogress = function(val,maxVal) {			
		var max=100;
		if(maxVal)
			max=maxVal;
		return this.each(
			function(){		
				var div=$(this);
				var innerdiv=div.find(".progress");
				
				if(innerdiv.length!=1){						
					innerdiv=$("<div class='progress'></div>");					
					$("<span class='text'>&nbsp;</span>").css("width",div.width()).appendTo(innerdiv);					
					div.append(innerdiv);					
				}
				var width=Math.round(val/max*100);
				innerdiv.css("width",width+"%");	
				div.find(".text").html(width+" %");
			}
		);
	};
})(jQuery);
var pct=0; var handle=0;
function update(){jQuery("#progressbar").reportprogress(++pct);if(pct==100){clearInterval(handle);pct=0;jQuery(".gameload").css('display','none');jQuery("#object_juego").css('display','block');}}jQuery(function($){handle=setInterval("update()",100);});