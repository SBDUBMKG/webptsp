jQuery(document).ready(function() {

	// Scroll to Top
	jQuery('.scrolltotop').click(function(){
		jQuery('html').animate({'scrollTop' : '0px'}, 400);
		return false;
	});

	jQuery(window).scroll(function(){
		var upto = jQuery(window).scrollTop();
		if(upto > 500) {
			jQuery('.scrolltotop').fadeIn();
		} else {
			jQuery('.scrolltotop').fadeOut();
		}
	});




window.onload = function() {
//-- Your code here

};



// main-content2
	$("#owl-csel2").owlCarousel({
		items: 4,
		autoplay: false,
		autoplayTimeout: 3000,
		autoplaySpeed: 2000,
		startPosition: 0,
		autoplayHoverPause: true,
		ltr: true,
		loop: true,
		margin: 15,
		dots: false,
		nav: true,
		navText: [
					'<i class="fa fa-angle-left" aria-hidden="true"></i>',
					'<i class="fa fa-angle-right" aria-hidden="true"></i>'
				],
		navContainer: '.main-content2 .custom-nav',
		responsive:{
			0: {
				items: 1,
			},
			768: {
				items: 2,
			},
			992: {
				items: 3,
			},
			1200: {
				items: 4,
			}
		}

	});

// main-content3
	$("#owl-csel3").owlCarousel({
		items: 3,
		autoplay: true,
		autoplayTimeout: 8000,
		autoplaySpeed: 1500,
		startPosition: 0,
		autoplayHoverPause: true,
		ltr: true,
		loop: true,
		margin: 15,
		dots: false,
		nav: true,
		navText: [
					'<i class="fa fa-angle-left" aria-hidden="true"></i>',
					'<i class="fa fa-angle-right" aria-hidden="true"></i>'
				],
		navContainer: '.main-content3 .custom-nav',
		responsive:{
			0: {
				items: 1,
			},
			768: {
				items: 1,
			},
			1200: {
				items: 1,
			}
		}

	});

	$("#owl-csel4").owlCarousel({
		items: 4,
		autoplay: false,
		autoplayTimeout: 3000,
		autoplaySpeed: 2000,
		startPosition: 0,
		autoplayHoverPause: true,
		ltr: true,
		loop: true,
		margin: 15,
		dots: false,
		nav: true,
		navText: [
					'<i class="fa fa-angle-left" aria-hidden="true"></i>',
					'<i class="fa fa-angle-right" aria-hidden="true"></i>'
				],
		navContainer: '.main-content2 .custom-nav-4',
		responsive:{
			0: {
				items: 1,
			},
			768: {
				items: 2,
			},
			992: {
				items: 3,
			},
			1200: {
				items: 4,
			}
		}

	});
	$("#owl-csel5").owlCarousel({
		items: 4,
		autoplay: false,
		autoplayTimeout: 3000,
		autoplaySpeed: 2000,
		startPosition: 0,
		autoplayHoverPause: true,
		ltr: true,
		loop: true,
		margin: 15,
		dots: false,
		nav: true,
		navText: [
					'<i class="fa fa-angle-left" aria-hidden="true"></i>',
					'<i class="fa fa-angle-right" aria-hidden="true"></i>'
				],
		navContainer: '.main-content2 .custom-nav-5',
		responsive:{
			0: {
				items: 1,
			},
			768: {
				items: 2,
			},
			992: {
				items: 3,
			},
			1200: {
				items: 4,
			}
		}

	});



	$(".owl-carousel-slider").owlCarousel({
	loop: true,
	margin: 10,
	autoplay: true,
	nav: true,
	dots: false, // Disable dots
	autoplayTimeout: 2000, // 2 seconds
	autoplayHoverPause: true,
	responsive: {
	  0: {
		items: 1
	  },
	  600: {
		items: 2
	  },
	  1000: {
		items: 4
	  }
	}
  });





});
