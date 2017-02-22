(function() {
	$(document).foundation();
	
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
	
	slideShow('slideShow1', 4000, 1000);
	
	//$(window).resize(function() {
	//	$('#slideShow1Frame').height($('#slideShow1Frame').width() * 9/16);
	//	console.log($('#slideShow1Frame').height());
	//});
	//$('#slideShow1Frame').height($('#slideShow1Frame').width() * 9/16);
})();