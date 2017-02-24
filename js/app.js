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
	
	$('#buttonLogin').click(function(){
		$('#loginBox').toggle();
	});
	
	$(window).resize(function(){
		$('#loginBox').css({top: $('#nav').height() + 'px'});
	});
	$('#loginBox').css({top: $('#nav').height() + 'px'});
	
	//$(window).resize(function() {
	//	$('#slideShow1Frame').height($('#slideShow1Frame').width() * 9/16);
	//	console.log($('#slideShow1Frame').height());
	//});
	//$('#slideShow1Frame').height($('#slideShow1Frame').width() * 9/16);
})();