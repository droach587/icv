/* ------------------------------------------------------------------------
Global Function Setlist
------------------------------------------------------------------------- */
var mainJs = (function($){

	// Avoid `console` errors in browsers that lack a console.
	(function() {
	    var method;
	    var noop = function () {};
	    var methods = [
	        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
	        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
	        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
	        'timeStamp', 'trace', 'warn'
	    ];
	    var length = methods.length;
	    var console = (window.console = window.console || {});
	
	    while (length--) {
	        method = methods[length];
	
	        // Only stub undefined methods.
	        if (!console[method]) {
	            console[method] = noop;
	        }
	    }

	}());
	
	var $overlay = $('.js-folio-overlay'),
		$overlayTeam = $('.js-overlay-team');
	
	$('.js-flyout-trigger').on('click',function(e){
			e.preventDefault();
			
			var slideIndex = parseInt($(this).attr('data-index'));
			
			if($overlay.hasClass('hidden')){
				$overlay.css('opacity',0).removeClass('hidden');
				setTimeout(function(){
					$overlay.css('opacity',1);
				}, 10);
			}
			$('.js-portfolio-exp-control').removeClass('hidden');
			$('.js-portfolio-control').addClass('hidden');
			
			$('.js-folio-overlay').cycle({
				'slides': '.folio-expanded-slide',
				'timeout':0,
				'speed':10,
				'prev': '.js-portfolio-exp-control.left',
				'next' : '.js-portfolio-exp-control.right',
			});
			$('.js-folio-overlay').addClass('hidden');
			setTimeout(function(){
			   $('.js-folio-overlay').cycle('goto', slideIndex);
			   setTimeout(function(){
				   $('.js-folio-overlay').removeClass('hidden');
			   }, 50);
			}, 10);
	});
	
	$('.js-flyout-team-trigger').on('click',function(e){
			e.preventDefault();
			
			var slideIndex = parseInt($(this).attr('data-index'));
			
			if($overlayTeam.hasClass('hidden')){
				$overlayTeam.css('opacity',0).removeClass('hidden');
				setTimeout(function(){
					$overlayTeam.css('opacity',1);
				}, 10);
			}
			$('.js-team-exp-control').removeClass('hidden');
			$('.js-team-control').addClass('hidden');
			
			$('.js-overlay-team').cycle({
				'slides': '.team-expanded-slide',
				'timeout':0,
				'speed':10,
				'prev': '.js-team-exp-control.left',
				'next' : '.js-team-exp-control.right',
			});
			
			$('.js-overlay-team').addClass('hidden');
			setTimeout(function(){
			   $('.js-overlay-team').cycle('goto', slideIndex);
			   setTimeout(function(){
				   $('.js-overlay-team').removeClass('hidden');
			   }, 50);
			}, 10);
	});
	
	function closeOverlay(){
		$('.js-portfolio-exp-control').addClass('hidden');
		$('.js-portfolio-control').removeClass('hidden');
		$('.js-team-exp-control').addClass('hidden');
		$('.js-team-control').removeClass('hidden');
		$overlay.css('opacity',0);
		$overlayTeam.css('opacity',0);
		setTimeout(function(){
			$overlay.addClass('hidden');
			$overlay.removeAttr('style');
			$overlayTeam.addClass('hidden');
			$overlayTeam.removeAttr('style');
		}, 10);	
	}
	
	$('.js-overlay-close').on('click',function(e){
		e.preventDefault();
		closeOverlay();
	});
	
	var mobileTouch = function(){
		function toggleMenu(){
			isVisible = $('.js-primary-nav').hasClass('visible');
			if(!isVisible){
				$('.js-primary-nav').css({
					'display':'block',
					'visibility':'visible'
				}).addClass('visible');
				$('.js-mobile-nav').addClass('active');
			}else{
				$('.js-primary-nav').removeClass('visible').removeAttr('style');					
				$('.js-mobile-nav').removeClass('active');
			}
		}
		$('.js-mobile-nav').on('click',function(e){
			toggleMenu();
		});
		$('.js-primary-nav li a').on('click', function(){
			toggleMenu();
			
		})
	};
	
	$(document).keyup(function(e) {
		e.preventDefault();
		if (e.keyCode == 27) {
			closeOverlay();
		}
	});

	// PUBLIC METHODS
	return {
			
		init: function(options) {
			
			var defaults = {}
			options = $.extend(defaults, options);	

		},
		closeOverlayMethod: function(){
			closeOverlay();
		},
		mobileTouch : function(){
			mobileTouch();
		}	
	}
     
})(jQuery);