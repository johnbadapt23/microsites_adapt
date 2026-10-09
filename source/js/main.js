(function($){
	$(function (){

		// perfect-scrollbar v1+ dropped its jQuery plugin wrapper in favour of
		// a plain JS class (`new PerfectScrollbar(el)` / `.destroy()`); this
		// tracks the #aboutContainer instance across the re-init below.
		var aboutContainerPs = null;

		// STANDARD
		match();
		outsideContainer();
		aos();

		$(document).on( 'nfFormReady', function( e, layoutView ) {
			match();

		    $('select').select2({
				minimumResultsForSearch: -1,
				templateResult: select2CopyClasses,
			    templateSelection: select2CopyClasses
			});
		});

		$('select').select2({
			minimumResultsForSearch: -1,
			templateResult: select2CopyClasses,
			templateSelection: select2CopyClasses
		});

		$('span.scroll-down-button').on( 'click', function(e){
			e.preventDefault();
			var $nextSection = $(this).parent().parent().parent('section').next('section');
			if($(window).width() > 900) {
		    	$('html, body').animate({ scrollTop: $($nextSection).offset().top - 0 }, 1000);
			} else {
				if($($nextSection).hasClass('desktop')){
					$('html, body').animate({ scrollTop: $($nextSection).next('section').offset().top - 60 }, 1000);
				} else {
					$('html, body').animate({ scrollTop: $($nextSection).offset().top - 60 }, 1000);
				}
			}
		});



		// Navigation

		$('.main-menu-toggle').on( 'click', function(e){
			e.preventDefault();
			if($(this).hasClass('active')){
				$(this).removeClass('active');
				$('.headerRight .menu').removeClass('menu-open');
				$('.main-menu-hamburger').removeClass('active');
				$('.main-menu-mask').removeClass('active');
			} else {
				$('.headerRight .menu').addClass('menu-open');
				$(this).addClass('active');
				$('.main-menu-hamburger').addClass('active');
				$('.main-menu-mask').addClass('active');
			}
		});

		// Search

		$('.search-link').on( 'click', function(e){
			e.preventDefault();
			if($(this).hasClass('active')){
				$(this).removeClass('active');
				$('.search-mask').removeClass('active');
			} else {
				$('.main-menu-toggle').removeClass('active');
				$('.main-menu-hamburger').removeClass('active');
				$('.main-menu-mask').removeClass('active');
				$(this).addClass('active');
				$('.search-mask').addClass('active');
			}
		});



		$('.backTop').on('click', function(e) {
			$('html, body').animate({ scrollTop: $('body').offset().top - 0}, 1000);
		});

		$('.popup-vimeo').magnificPopup({
			type: 'iframe',
			mainClass: 'mfp-fade',
			removalDelay: 160,
			preloader: false,
			fixedContentPos: false
		});

		$(document).on('click', '.video-toggle-sound', function(e) {
			e.preventDefault();

			const $btn = $(this);
			const video = $btn.closest('.why-become-image').find('video').get(0);

			if (video) {
				video.muted = !video.muted;
				$btn.find('.icon-sound-off').toggle(video.muted);
				$btn.find('.icon-sound-on').toggle(!video.muted);
			}
		});

		$(document).on('click', '.video-toggle-sound-mobile', function(e) {
			e.preventDefault();

			const $btn = $(this);
			const video = $btn.closest('.image-container.mobile').find('video').get(0);

			if (video) {
				video.muted = !video.muted;
				$btn.find('.icon-sound-off').toggle(video.muted);
				$btn.find('.icon-sound-on').toggle(!video.muted);
			}
		});

		$('.formPopupHubspot').each(function(){
			$(this).magnificPopup({
				type: 'inline',
				mainClass: 'form-container-preview'
			});
		});

		$('a.form-popup-button').magnificPopup({
			type: 'inline',
			preloader: false,
			mainClass: 'mfp-registration'
		});

		$('a.register-button').magnificPopup({
			type: 'inline',
			preloader: false,
			mainClass: 'mfp-registration'
		});

		$('.register-scroll-button').magnificPopup({
			type: 'inline',
			preloader: false,
			mainClass: 'mfp-registration',
			callbacks: {
			  open: function() {
				  $(window).trigger('resize');
			  }
			}
		});

		if (document.getElementById('aboutContainer')) {
			aboutContainerPs = new PerfectScrollbar('#aboutContainer');
		}
		$('a.speaker-popup').magnificPopup({
			type: 'inline',
			mainClass: 'mfp-speakers',
			preloader: false,
			gallery: {
			    enabled: true
			},
			callbacks: {
				change: function() {
					if (aboutContainerPs) {
						aboutContainerPs.destroy();
						aboutContainerPs = null;
					}
					timer = setTimeout(function(){
						var aboutContainerEl = document.getElementById('aboutContainer');
						if (aboutContainerEl) {
							aboutContainerPs = new PerfectScrollbar(aboutContainerEl);
						}
					}, 1);
				},
				buildControls: function() {
				// re-appends controls inside the main container
					this.contentContainer.append(this.arrowLeft.add(this.arrowRight));
				},
			}
		});


		$('a.speaker-popup-text').magnificPopup({
			type: 'inline',
			mainClass: 'mfp-speakers',
			preloader: false,
			gallery: {
			    enabled: true
			},
			callbacks: {
				buildControls: function() {
				// re-appends controls inside the main container
					this.contentContainer.append(this.arrowLeft.add(this.arrowRight));
				}
			}
		});

		$('a.speaker-popup-mobile').magnificPopup({
			type: 'inline',
			mainClass: 'mfp-speakers',
			preloader: false,
			gallery: {
			    enabled: true
			},
			callbacks: {
				buildControls: function() {
				// re-appends controls inside the main container
					this.contentContainer.append(this.arrowLeft.add(this.arrowRight));
				}
			}
		});

		// Sneak Peak

		var peakspeed = "500";
		$('.sneak-peak-container .sneak-title').on( 'click', function(e){
			e.preventDefault();
			$thisParent = $(this).parents();
			$thisIndex = $(this).parents().index();
			// console.log($thisIndex);
			if($(this).hasClass('active')){
				// $(this).siblings('.sneak-peak-text').slideUp(peakspeed);
				// $(this).removeClass('active');
			} else {
				$($thisParent).parents().siblings('.sneak-image-container').children('.sneak-image-inner').children('.sneak-image').removeClass('active');
				$($thisParent).parents().siblings('.sneak-image-container').children('.sneak-image-inner').children('.sneak-image').eq($thisIndex).addClass('active');
				$($thisParent).siblings().children('.sneak-title').removeClass('active');
				$($thisParent).siblings().children('.sneak-peak-text').slideUp(peakspeed);
				$(this).siblings('.sneak-peak-text').slideDown(peakspeed);
				$(this).addClass('active');
			}
		});


		// New Quote SLider

		if ( $('.quote-slider-module').length ) {
			var numSlick = 0;
			$('.quote-slider-module').each(function() {
				var $sliderModuleNumber = $(this).addClass('slider-'+numSlick);
				var $thumbNails = $($sliderModuleNumber).siblings('.quote-slider-thumbnails').addClass('thumbnail-'+numSlick);
		   		var $sliderModule = $($sliderModuleNumber).on('init', function(slick) {
				   $($sliderModuleNumber).fadeIn(1000);
			   }).slick({
				   slidesToShow: 1,
				   slidesToScroll: 1,
				   arrows: false,
				   autoplay: true,
				   infinite: true,
				   fade: true,
		   		   speed: 500,
		   	       cssEase: "linear",
			   });

			   if($($thumbNails).hasClass('three-slides')){
				   var $slider2 = $($thumbNails).on('init', function(slick) {
					  $($thumbNails).fadeIn(1000);
				  }).slick({
					  slidesToShow: 3,
					  slidesToScroll: 1,
					  autoplay: false,
					  asNavFor: $sliderModuleNumber,
					  dots: false,
					  centerMode: false,
					  focusOnSelect: true
				  });
			   }

			   if($($thumbNails).hasClass('four-slides')){
				   var $slider2 = $($thumbNails).on('init', function(slick) {
					  $($thumbNails).fadeIn(1000);
				  }).slick({
					  slidesToShow: 4,
					  slidesToScroll: 1,
					  autoplay: false,
					  asNavFor: $sliderModuleNumber,
					  dots: false,
					  centerMode: false,
					  focusOnSelect: true
				  });
			   }

			   if($($thumbNails).hasClass('five-slides')){
				   var $slider2 = $($thumbNails).on('init', function(slick) {
					  $($thumbNails).fadeIn(1000);
				  }).slick({
					  slidesToShow: 5,
					  slidesToScroll: 1,
					  autoplay: false,
					  asNavFor: $sliderModuleNumber,
					  dots: false,
					  centerMode: false,
					  focusOnSelect: true
				  });
			   }

			   if($($thumbNails).hasClass('six-slides')){
				   var $slider2 = $($thumbNails).on('init', function(slick) {
					  $($thumbNails).fadeIn(1000);
				  }).slick({
					  slidesToShow: 6,
					  slidesToScroll: 1,
					  autoplay: false,
					  asNavFor: $sliderModuleNumber,
					  dots: false,
					  centerMode: false,
					  focusOnSelect: true
				  });
			   }

			//remove active class from all thumbnail slides
			$($thumbNails).find('.slick-slide').removeClass('slick-active');

			//set active class to first thumbnail slides
			$($thumbNails).find('.slick-slide').eq(0).addClass('slick-active');

			var $progressBarQuote = $($sliderModuleNumber).siblings().children('.progress-bar').addClass('progress-'+numSlick);
			var $progressBarActive = $($sliderModuleNumber).siblings().children('.active-bar').addClass('active-'+numSlick);
			// On before slide change match active thumbnail to current slide
			$($sliderModuleNumber).on('beforeChange', function (event, slick, currentSlide, nextSlide) {
			   var mySlideNumber = nextSlide;
			   $($thumbNails).find('.slick-slide').removeClass('slick-active');
			   $($thumbNails).find('.slick-slide').eq(mySlideNumber).addClass('slick-active');
			   var calc = ( (nextSlide) / (slick.slideCount) ) * 100;
			   var left = ( (nextSlide) / (slick.slideCount) ) * 100;
			   $progressBarQuote.css('background-size', calc + '% 100%').attr('aria-valuenow', calc );
			   $progressBarActive.css('left', left + '%');
			   $($thumbNails).find('.slick-slide').eq(currentSlide).removeClass('slick-current');
			   $($thumbNails).find('.slick-slide').eq(nextSlide).addClass('slick-current');
			   $($progressBarQuote).children('.progress-inner').eq(currentSlide).removeClass('animate');
			    $($progressBarQuote).children('.progress-inner').eq(nextSlide).addClass('animate');
			});

			numSlick++

			});

		}

		// Switcher Module

		$('.switcher-container .module-switcher').on( 'click', function(e){
			e.preventDefault();
			$thisIndex = $(this).index();
			if($(this).hasClass('active')){
			} else {
				$(this).siblings().removeClass('active');
				$(this).addClass('active');
				$('.module-container .switch-module').removeClass('active');
				$('.module-container .switch-module').eq($thisIndex).addClass('active');
			}
		});

		// Landing slider 
	
		$('.column-slider-container').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			infinite: true,
			fade: true,
			swipe: false,
			swipeToSlide: false,
			speed: 500,
			cssEase: "linear",
			arrows: true,
			responsive: [
			  {
			   breakpoint: 767,
			   settings: {
				fade: false
			   }
			  }	
			]		
		});

		$('.column-slider-container').on('beforeChange', function(event, slick, currentSlide, nextSlide){
			$('.column-slider-container button.slick-prev').addClass('active');
		});



		// $('select').select2({minimumResultsForSearch: -1});

		// if($('body').hasClass('template-flexible')) {
		// 	if ($(window).width() <= 1023) {
		// 		$.localScroll({
		// 			   duration: 1500,
		// 			   offset: -145
		// 		});
		// 	} else {
		// 		$.localScroll({
		// 			   duration: 1500,
		// 			   offset: -170
		// 		});
		// 	}
		// }

		$('.quote-slider').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			infinite: true,
			arrows: true,
			dots: false
		});

		$('.delegate-slides').slick({
			slidesToShow: 5,
			slidesToScroll: 1,
			infinite: true,
			arrows: true,
			autoplay: false,
		    autoplaySpeed: 2000,
			dots: true,
			swipeToSlide: true,
			responsive: [
			  {
				breakpoint: 1200,
				settings: {
				  slidesToShow: 4,
				}
			  },
			  {
				breakpoint: 1023,
				settings: {
				  slidesToShow: 3,
				}
			  },			  
			  {
			   breakpoint: 767,
			   settings: {
				 slidesToShow: 1,
				 arrows: false,
			   }
			 }
			]
		});

		

		$('.logos-slider').slick({
			slidesToShow: 6,
			slidesToScroll: 1,
			infinite: true,
			arrows: true,
			autoplay: true,
		    autoplaySpeed: 2000,
			dots: false,
			swipeToSlide: true,
			responsive: [
			  {
				breakpoint: 1023,
				settings: {
				  slidesToShow: 3,
				}
			  },
			  {
			   breakpoint: 640,
			   settings: {
				 slidesToShow: 2
			   }
			 }
			]
		});

		$('.logos-slider').on('beforeChange', function(event, slick, currentSlide, nextSlide){
	        $('.logos-slider .slide').addClass('first-click');
			$('.logos-slider button.slick-prev').addClass('active');
		});

		// EVENT SLIDER
		var containerWidth = $('.container').width();
		var windowWidth = $(window).width();
		var paddingWidth = (windowWidth - containerWidth ) / 2 - 8;
		var paddingWidthPx = paddingWidth + 'px';
		// console.log(paddingWidthPx);

		var $status = $('.pagingInfo');
		var $slickElement = $('.content-slider-container .slider');

		$slickElement.on('init reInit afterChange', function (event, slick, currentSlide, nextSlide) {
		  //currentSlide is undefined on init -- set it to 0 in this case (currentSlide is 0 based)
		  var i = (currentSlide ? currentSlide : 0) + 1;
		  $status.html('<span class="count">0'+ i + '</span><span class="divider">/</span>' + '<span class="of-count">0' + slick.slideCount + '</span>');
		});

		var $progressBar = $('.progress');
		var $progressBarLabel = $( '.slider__label' );

		$slickElement.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
			var calc = ( (nextSlide + 1) / (slick.slideCount) ) * 100;
			$progressBar.css('background-size', calc + '% 100%').attr('aria-valuenow', calc );
			$progressBarLabel.text( calc + '% completed' );
		});
		/**
		 * FIX JUMPING ANIMATION
		 * Set special animation class on first or last clone.
		 */
		$slickElement.on('beforeChange', function (event, slick, currentSlide, nextSlide) {
		    var
		        direction,
		        slideCountZeroBased = slick.slideCount - 1;

		    if (nextSlide == currentSlide) {
		        direction = "same";

		    } else if (Math.abs(nextSlide - currentSlide) == 1) {
		        direction = (nextSlide - currentSlide > 0) ? "right" : "left";

		    } else {
		        direction = (nextSlide - currentSlide > 0) ? "left" : "right";
		    }

		    // Add a temp CSS class for the slide animation (.slick-current-clone-animate)
		    if (direction == 'right') {
		        $('.slick-cloned[data-slick-index="' + (nextSlide + slideCountZeroBased + 1) + '"]', $slickElement).addClass('slick-current-clone-animate');
		    }

		    if (direction == 'left') {
		        $('.slick-cloned[data-slick-index="' + (nextSlide - slideCountZeroBased - 1) + '"]', $slickElement).addClass('slick-current-clone-animate');
		    }
		});

		$slickElement.on('afterChange', function (event, slick, currentSlide, nextSlide) {
		    $('.slick-current-clone-animate', $slickElement).removeClass('slick-current-clone-animate');
		    $('.slick-current-clone-animate', $slickElement).removeClass('slick-current-clone-animate');
		});

		$slickElement.slick({
		  // centerMode: false,
		  arrows: true,
		  dots: false,
		  infinite: true,
		  // centerMode: true,
		  // centerPadding: paddingWidthPx,
		  autoplay: false,
		  slidesToShow: 3,
		  focusOnSelect: true,
		  responsive: [
		    {
		      breakpoint: 1023,
		      settings: {
		        slidesToShow: 2,
		      }
		  	},
			{
			 breakpoint: 640,
			 settings: {
			   slidesToShow: 1
			 }
		   }
		  ]
		});

		$('.content-slider .slider').on('beforeChange', function(event, slick, currentSlide, nextSlide){
	        $('.slide').addClass('first-click');
			$('.content-slider-container button.slick-prev').addClass('active');
		});

		var viewportWidth = jQuery(window).width();
	    if (viewportWidth < 768) {
			$('.speakers-bottom.mobile-slider').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				infinite: true,
				arrows: false,
				dots: false
			});
	    } else {
	        // Do some thing
	    }

		// Video quote slider 

		if ($(".video-quote-slider-container").length) {
			$(".video-quote-slider-container").slick({
				dots: true,
				arrows: false,
				autoplay: true,
				autoplaySpeed: 5000,
				pauseOnHover: false,
				pauseOnFocus: false,
				speed: 300,      
				cssEase: "ease-out"
			});

			// Reset only when slide changes
			$(".video-quote-slider-container").on("beforeChange", function () {
			$(".slick-dots li button").removeClass("fill-animate");
			// force reflow so animation restarts smoothly
			var activeBtn = $(".slick-dots li.slick-active button")[0];
			if (activeBtn) {
				void activeBtn.offsetWidth; // force reflow
			}
			});

			$(".video-quote-slider-container").on("afterChange", function () {
			$(".slick-dots li.slick-active button").addClass("fill-animate");
			});

			// Trigger first
			$(".slick-dots li.slick-active button").addClass("fill-animate");
		}

		// Why Become a partner

		var $items = $('.why-become-container .why-become-text-container');

		// initial: open first with animation
		$items.find('.switch-content').hide();
		$items.first().addClass('active').find('.switch-content').slideDown(300);

		// click handler
		$('.why-become-container .why-become-text-container').on('click', function (e) {
			e.preventDefault();
			var $this = $(this);
			var $wrapper = $this.closest('.why-become-container'); // full wrapper
			var $thisIndex = $this.index();

			if ($this.hasClass('active')) {
				// collapse if already active
				$this.removeClass('active').find('.switch-content').slideUp(300);
			} else {
				// update images
				$wrapper.find('.why-become-image-container .why-become-image')
					.removeClass('active')
					.eq($thisIndex)
					.addClass('active');

				// collapse other text blocks
				$this.siblings('.why-become-text-container')
					.removeClass('active')
					.find('.switch-content').slideUp(300);

				// expand this one
				$this.addClass('active').find('.switch-content').slideDown(300);
			}
		});



		// Testimonials Slider New

		var $slickElementTestimonials = $('.testimonials-slider-container .testimonials-slider');
		var $progressBarTestimonials = $('.progress-container-testimonials');
		var $progressBarLabel = $( '.progress-container-testimonials .slider__label' );

		$slickElementTestimonials.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
			var calc = ( (nextSlide + 1) / (slick.slideCount) ) * 100;
			$progressBarTestimonials.css('background-size', calc + '% 100%').attr('aria-valuenow', calc );
			$progressBarLabel.text( calc + '% completed' );
		});

		$slickElementTestimonials.slick({
		  // centerMode: false,
		  arrows: true,
		  dots: false,
		  infinite: true,
		  fade: true,
		  cssEase: 'linear',
		  // centerMode: true,
		  // centerPadding: paddingWidthPx,
		  autoplay: false,
		  slidesToShow: 1,		  
		});


		// Scroll to buttons

		$('.scroll-to').on( 'click', function(e){
		    e.preventDefault();
		    var target = this.hash;
		    $target = $(target);
		    $('html, body').animate({ scrollTop: $target.offset().top-70}, 1000);
		});


		$('.scroll-to-link').on( 'click', function(e){
		    e.preventDefault();
		    var target = this.hash;
		    $target = $(target);
			$(this).addClass('active');
			$(this).siblings().removeClass('active');
		    $('html, body').animate({ scrollTop: $target.offset().top-180}, 1000);
		});

		$('.scroll-to-button').on( 'click', function(e){
		    e.preventDefault();
		    var target = this.hash;
		    $target = $(target);
			$(this).addClass('active');
			$(this).siblings().removeClass('active');
		    $('html, body').animate({ scrollTop: $target.offset().top-70}, 1000);
		});

		// Desktop Search

		$('.search-button').on( 'click', function(e){
			e.preventDefault();
			if($(this).hasClass('active')){
				$(this).removeClass('active');
				$('.header-search-container').slideUp(300);
			} else {
				$(this).addClass('active');
				$('.header-search-container').slideDown(300);
			}
		});


		// Mobile Sub Menu

		$('.main-menu-container ul > li.menu-item-has-children > a').on( 'click', function(e){
			e.preventDefault();
			if($(this).hasClass('active')){
				$(this).removeClass('active');
				$(this).parent('li.menu-item-has-children').removeClass('active');
				$(this).siblings('ul.sub-menu').slideUp(300);
			} else {
				$(this).addClass('active');
				$(this).parent('li.menu-item-has-children').addClass('active');
				$(this).siblings('ul.sub-menu').slideDown(300);
			}
		});

		// Read more / less

		$('.text-excerpt .excerpt-text-more').on('click', function(e) {
			$(this).parents('.text-excerpt').hide();
			$(this).parents('.text-excerpt').siblings('.text-full').show();

			return;
		});

		$('.text-full .excerpt-text-less').on('click', function(e) {
			$(this).parents('.text-full').hide();
			$(this).parents('.text-full').siblings('.text-excerpt').show();

			return;
		});

		// Agenda Multi Day

		$('.day-switcher-container .agenda-days-switcher').on( 'click', function(e){
			e.preventDefault();
			var dayID = $(this).attr('href');
			if($(this).hasClass('active')){
			} else {
				$(this).siblings().removeClass('active');
				$(this).addClass('active');
				$('.agenda-day').removeClass('active');
				$(dayID).addClass('active');
			}
		});


		// Accordion + Expanding Blocks

		var speed = "500";
		var speedExpander = "1000";
		$('.expanding-block .expander-title').on( 'click', function(e){
			e.preventDefault();
			if($(this).hasClass('open')){
				$(this).siblings('.expanding-content').slideUp(speedExpander);
				$(this).removeClass('open');
			} else {
				$(this).siblings('.expanding-content').slideDown(speedExpander);
				$(this).addClass('open');
			}
		});


		$('.faq-item .question').on( 'click', function(e){
			e.preventDefault();
			if($(this).hasClass('open')){
				$(this).next().slideUp(speed);
				$(this).removeClass('open');
			} else {
				$(this).next().slideDown(speed);
				$(this).addClass('open');
			}
		});

		// Read more

		$('.agenda-description').each(function() {
			paragraphCount = $(this).children('.text').children('p').length;
			$(this).children('.read-more-overlay').hide();
			$(this).children('.text').children('p').not(":first").hide();
			$(this).children('.text').children('ul').hide();
			$(this).children('.text').children('ol').hide();

			if (paragraphCount > 1) {
			    $(this).children('.read-more-overlay').show();
			} else {
				$(this).children('.text').children('p').addClass('open');
				$(this).children('.text').children('ul').addClass('open');
				$(this).children('.text').children('ol').addClass('open');
			}
		});

		$('.read-more').on( 'click', function(e){
			e.preventDefault();
			if($(this).hasClass('active')){
				$(this).parents('.read-more-overlay').siblings('.text').children('p:first').removeClass('open');
				$(this).parents('.read-more-overlay').siblings('.text').children('p').not(":first").slideUp(300);
				$(this).parents('.read-more-overlay').siblings('.text').children('ul').slideUp(300);
				$(this).parents('.read-more-overlay').siblings('.text').children('ol').slideUp(300);
				$(this).removeClass('active');
				$(this).text('READ MORE');
				$(this).parents('.read-more-overlay').removeClass('active');
			} else {
				$(this).parents('.read-more-overlay').siblings('.text').children('p:first').addClass('open');
				$(this).parents('.read-more-overlay').siblings('.text').children('p').slideDown(300);
				$(this).parents('.read-more-overlay').siblings('.text').children('ul').slideDown(300);
				$(this).parents('.read-more-overlay').siblings('.text').children('ol').slideDown(300);
				$(this).addClass('active');
				$(this).text('READ LESS');
				$(this).parents('.read-more-overlay').addClass('active');
			}
		});

		$('.expand-all-text').on( 'click', function(e){
			if($(this).hasClass('open')){
				$('.accordion-content').slideUp(speed);
				$('.accordion-title').removeClass('open');
				$(this).removeClass('open');
				$(this).text('Expand all');
			} else {
				$('.accordion-content').slideDown(speed);
				$('.accordion-title').addClass('open');
				$(this).addClass('open');
				$(this).text('Close all');
			}
		});

		// NAV

		$('.parent-link').on( 'click', function(e){
			e.preventDefault();
			if($(this).hasClass('active')) {
				$(this).removeClass('active');
				$(this).next('.child-container').slideUp(300);
			} else {
				$(this).addClass('active');
				$(this).next('.child-container').slideDown(300);
			}

		});

		$('a.nav').on( 'click', function(e){
			e.preventDefault();
			if($(this).hasClass('active')) {
				$(this).removeClass('active');
				$('.day-switcher-container').removeClass('menu-open');
				$('.headerRight .menu').removeClass('menu-open');
				$(this).parent('.buttonWrapper').removeClass('active');
				$('span.ham').removeClass('active');
				$('div.mobileMenu').removeClass('active');
			} else {
				$(this).addClass('active');
				$('.day-switcher-container').addClass('menu-open');
				$('.headerRight .menu').addClass('menu-open');
				$(this).parent('.buttonWrapper').addClass('active');
				$('span.ham').addClass('active');
				$('div.mobileMenu').addClass('active');
			}
		});

		$('span.mobile-toggle').on( 'click', function(e){
			e.preventDefault();
			if($(this).hasClass('active')) {
				$(this).removeClass('active');
				$(this).next('.mega-menu-mobile').slideUp(300);
			} else {
				$(this).addClass('active');
				$(this).next('.mega-menu-mobile').slideDown(300);
			}
		});
	});

	$(window).on( 'scroll', function(){
		if($('body').hasClass('template-landing')){

		} else {
			scroll();
			scrollAgenda();
		}
		
		scrollRotate();		

		if($('#animatedText').length ) {
			animatedText();
		}

		if($('.logo-ticker-tape').length ) {
			$('.logo-ticker-tape .band-container-backwards .moving-text').addClass('play');
		}
    });

	$(window).on('load',function (){
		match();
		outsideContainer();
		$('main').addClass('loaded');
		$('.banner-block').addClass('visible');
	});

	$(window).on( 'resize', function(){
		match();
		outsideContainer();

		var viewportWidth = jQuery(window).width();
	    if (viewportWidth < 768) {
			$('.speakers-bottom.mobile-slider').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				infinite: true,
				arrows: false,
				dots: false
			});
	    } else {
	        $('.speakers-bottom.mobile-slider').slick('unslick');
	    }
	});

	function scroll() {
		var scrollPos = $(document).scrollTop();
		if(scrollPos > 50) {
			$('header').addClass('scrolled');
		} else {
			$('header').removeClass('scrolled');
		}
	}
	var lastScrollTop = 0;

	function scrollAgenda() {
		ww = $(window).width();
		var st = $(this).scrollTop();
		var $el = $('.day-switcher-container');
		var isPositionFixed = ($el.css('position') == 'fixed');
		if( ww > 767 ){
			if ($(this).scrollTop() > lastScrollTop){
				$el.css({'z-index': '100', 'height': '70px', 'background-color': '#121212'});
				$el.css({'top': '0px'});
				if ($(this).scrollTop() > 185 && !isPositionFixed ){
					$el.css({'position': 'fixed', 'top': '0px', 'z-index': '100'});
				}
				if ($(this).scrollTop() < 185 && isPositionFixed){
					$el.css({'position': 'absolute', 'top': '0px', 'z-index': '100'});
				}
			} else {
				if ($(this).scrollTop() < 210 && $(this).scrollTop() > 185 ){
					$el.css({'height': '70px'});
					$el.css({'position': 'fixed', 'top': '0px', 'z-index': '100'});
				} else if ($(this).scrollTop() < 185 ){
					$el.css({'position': 'absolute', 'top': '0px', 'z-index': '100'});
				} else {
					$el.css({'position': 'fixed', 'top': '70px', 'height': '35px'});
				}
			}
		} else {
			if ($(this).scrollTop() > lastScrollTop){
				$el.css({'z-index': '100', 'height': '60px'});
				$el.css({'top': '0px'});
				if ($(this).scrollTop() > 162 && !isPositionFixed ){
					$el.css({'position': 'fixed', 'top': '0px', 'z-index': '100'});
				}
				if ($(this).scrollTop() < 162 && isPositionFixed){
					$el.css({'position': 'absolute', 'top': '0px', 'z-index': '100'});
				}
			} else {
				if ($(this).scrollTop() < 162){
					$el.css({'height': '60px'});
					$el.css({'position': 'absolute', 'top': '0px', 'z-index': '5'});
				} else {
					$el.css({'position': 'fixed', 'top': '60px', 'height': '35px'});
				}
			}

		}


		lastScrollTop = st;
	}

	function isScrolledIntoView(el) {
	    var rect = el.getBoundingClientRect();
	    var elemTop = rect.top;
	    var elemBottom = rect.bottom;

	    // Only completely visible elements return true:
	    var isVisible = (elemTop >= 0) && (elemBottom <= window.innerHeight);
	    // Partially visible elements return true:
	    // var isVisible = elemTop < window.innerHeight && elemBottom >= 0;
	    return isVisible;
	}

	function select2CopyClasses(data, container) {
	    if (data.element) {
	        $(container).addClass($(data.element).attr("class"));
	    }
	    return data.text;
	}

	function outsideContainer() {
		ww = $(window).width();
		container = $('.content-slider .container').width();
		outsideContainerWidth = ww - container;
		slideWidth = $('.content-slider div.slide').width();
		arrowLeftPos = outsideContainerWidth / 2 - 66;
		arrowRightPos = outsideContainerWidth / 2 + 66;
		coverWidth = outsideContainerWidth / 2;
		$('.content-slider .rightSlideCover').css('width', coverWidth);
		$('.content-slider .leftSlideCover').css('width', coverWidth);
	}

	function aos() {
		AOS.init({
			startEvent: 'load',
			disable: 'mobile',
			once: true
		});
	}

	function match() {		
		$('.column:not(main.landing .column, .text-list-column)').matchHeight();
		$('.speaker.one-quarter').matchHeight();
		$('.mega-menu .column .icon-container').matchHeight();
		$('.column .case-study-text').matchHeight();
		$('.column .text-container .text').matchHeight();
	}

	function scrollRotate() {
	    var image = document.getElementById("rotatingImage");
		if(image){
			image.style.transform = "rotate(" + window.pageYOffset/5 + "deg)";
		}
	}

})(window.jQuery);