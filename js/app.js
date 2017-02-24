function slideShow(slideShowID, holdTime, transitionTime) {
	var curr = 0;
	var slides = $('#' + slideShowID).find(".slide");
	
	$('#' + slides[0].id).show();
	stay();
	
	function stay() {
		setTimeout(fade, holdTime);
	}
	
	function fade() {
		next = curr + 1;
		if (next >= slides.length) {
			next = 0;
		}
		$('#' + slides[curr].id).fadeOut('slow');
		$('#' + slides[next].id).fadeIn('slow');
		curr = next;
		setTimeout(stay, transitionTime);
	}
}

(function() {
	$(document).foundation();
	
	$('#toolBoxButton').click(function(){
		$('#toolBox').toggle();
	});
	
	//Adjust nav size between two give widths 
	function navResize() {
		var curWidth = $(window).width();
		var minWidth = 800;
		var maxWidth = 1280;
		var curNavHeight = $('#nav').height();
		var minNavHeight = parseInt($('#nav').css('min-height'));
		var maxNavHeight = parseInt($('#nav').css('max-height'));
		var minFontSize = 10;
		var maxFontSize = 16;
		if ( (curWidth > minWidth && curWidth < maxWidth) || (curWidth >= maxWidth && curNavHeight < maxNavHeight)) {
			var ratio = (curWidth - minWidth) / (maxWidth - minWidth);
			if (ratio > 1) {ratio = 1;}
			else if (ratio < 0) {ratio = 0;}
			var newHeight = Math.round(ratio * (maxNavHeight - minNavHeight)) + minNavHeight;
			var newFont = Math.round(ratio * (maxFontSize - minFontSize)) + minFontSize;
			$('#nav').css('height', (newHeight) + "px");
			$('.buttonNav').css('height', (newHeight) + "px");
			$('.buttonNav').css('font-size', (newFont) + "pt");
		}
	}
	
	function toolBoxResize() {
		$('#toolBox').css('top', $('#nav').height() + 'px');
	}
	
	$(window).resize(function(){
		navResize();
		toolBoxResize();
	});
	navResize();
	toolBoxResize();
	
	//$(window).resize(function() {
	//	$('#slideShow1Frame').height($('#slideShow1Frame').width() * 9/16);
	//	console.log($('#slideShow1Frame').height());
	//});
	//$('#slideShow1Frame').height($('#slideShow1Frame').width() * 9/16);
})();