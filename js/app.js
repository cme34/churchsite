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
	
	function resize() {
		
	}
	
	$(window).resize(function(){
		resize();
	});
	resize();
})();