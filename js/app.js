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
		if ($('#toolBoxMobile').is(":visible")) {
			$('#toolBoxMobile').hide();
		}
	});
	
	$('#toolBoxMobileButton').click(function(){
		$('#toolBoxMobile').toggle();
		if ($('#toolBox').is(":visible")) {
			$('#toolBox').hide();
		}
	});
	
	function resize() {
		var width = window.innerWidth;
		if (width <= 800) {
			//All Pages
			$('#footerMobile').show();
			$('#footer').hide();
			$('#navPagesMobile').show();
			$('#navPages').hide();
			//Home Page
			$('#newsFeed').removeClass('small-6 columns').addClass('small-12 columns');
			$('#weeklySchedule').removeClass('small-6 columns').addClass('small-12 columns');
			//Directions Page
			$('#mapContainer').removeClass('small-8 columns').addClass('small-12 columns');
			$('#addressContainer').removeClass('small-4 columns').addClass('small-12 columns');
			//News Page
			$('.newsTitle').removeClass('small-4 columns').addClass('small-12 columns');
			$('.newsTime').removeClass('small-4 columns').addClass('small-6 columns');
		}
		else {
			//All Pages
			$('#footerMobile').hide();
			$('#footer').show();
			$('#navPagesMobile').hide();
			$('#navPages').show();
			$('#toolBoxMobile').hide();
			//Home Page
			$('#newsFeed').removeClass('small-12 columns').addClass('small-6 columns');
			$('#weeklySchedule').removeClass('small-12 columns').addClass('small-6 columns');
			//Directions Page
			$('#mapContainer').removeClass('small-12 columns').addClass('small-8 columns');
			$('#addressContainer').removeClass('small-12 columns').addClass('small-4 columns');
			//News Page
			$('.newsTitle').removeClass('small-12 columns').addClass('small-4 columns');
			$('.newsTime').removeClass('small-6 columns').addClass('small-4 columns');
		}
	}
	
	$(window).resize(function(){
		resize();
	});
	resize();
})();