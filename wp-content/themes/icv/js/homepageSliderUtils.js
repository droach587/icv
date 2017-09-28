//Sets Active Date Range on Lists
var homepageSliderUtils = {
	
	init : function(){
		
		var $elementsToFit = $('.js-hero-slider, .js-hero-fit'),
			windowHeight = $(window).height();
		
		var setHeight = function(){
			$elementsToFit.css('height',windowHeight);
		}
		
		//recalc on scroll
		$(window).on('resize',function(){
			windowHeight = $(window).height();
			setHeight();
		});
		
		//Pop off on init
		setHeight();
		
	}//Init
	
};


var testimonySliderUtils = {
	
	init : function(){
		
		$('.js-quotes').on( 'cycle-initialized', function( event, API ) {
			setTimeout(function(){
				var sentinelHeight = $('.js-quotes').find('.cycle-sentinel').outerHeight(),
					$slides = $('.js-quotes');
					$slides.each(function(){
						$(this).css('height',sentinelHeight);
					});
			}, 100);	
		});
	}
}


var gallerySliderFilters = {
	
	init	:	function(){
		var $filters = $('.js-gallery-filters > li > a'),
			$filtersParent = $('.js-gallery-filters'),
			$gallery = $('.js-gallery');
			
		$filters.each(function(){
			$(this).on('click',function(e){
				
				$filtersParent.find('a.active').removeClass('active');
				$(this).addClass('active');
				filter = $(this).attr('data-filter');

				$gallery.find('.slide').addClass('hidden');
				$gallery.find('.'+filter).removeClass('hidden');
				$gallery.cycle('reinit');						
				e.preventDefault();
			});
		});
	}
}

var setupArrows = {
	
	init : function(){
		
		
		//Setup Hero Slider
		heroSlidesLen = $('.js-hero-slider .hero-slide').length;
		if(heroSlidesLen > 1){
			$('.hero-slider-controls').removeClass('hidden');
		}else{
			$('.slide-details').css('right',20);
		}
		
		//Setup Portfolio Slider
		portfolioSlidesLen = $('.portfolio-items .slide').length;
		if(portfolioSlidesLen > 1){
			$('.js-portfolio-control').removeClass('hidden');
		}
		
		//Setup Testimonials Slider
		testSlidesLen = $('.js-quotes .slide').length;
		if(testSlidesLen > 1){
			$('.js-testimony-control').removeClass('hidden');
		}
		
		//Setup Team Slider
		teamSlidesLen = $('.js-team .slide').length;
		if(teamSlidesLen > 1){
			$('.js-team-control').removeClass('hidden');
		}
		
		//Setup News Slider
		newsSlidesLen = $('.js-news .slide').length;
		if(newsSlidesLen > 1){
			$('.js-news-control').removeClass('hidden');
		}
		
		//Setup Gallery Slider
		gallerySlidesLen = $('.js-gallery .slide').length;
		if(gallerySlidesLen > 1){
			$('.js-gallery-control').removeClass('hidden');
		}
	}
}

var setupFancyBox = {
	
	init : function(){
		$(".fancybox-thumb").fancybox({});
	}
}

$(document).ready(function(){
	homepageSliderUtils.init();
	testimonySliderUtils.init();
	gallerySliderFilters.init();
	setupArrows.init();
	setupFancyBox.init();
});