var homePageJumpNavi = (function () {
 
		function checkPathName(){
			return document.location.hash
		}
		
		function setFixed(set){
			var $target = $('.js-primary-nav-container'),
				isFixed = $target.hasClass('fixed');
			
			if(set){
				$target.addClass('fixed');
			}else{
				$target.removeClass('fixed');
			}
			
		}
		
		function jumpNav(){

			var target = $('#'+checkPathName().split('#')[1]+'-section'),
				allowedHash = [
					'#portfolio',
					'#team',
					'#gallery',
					'#press',
					'#contact'
				];
			
			if($.inArray(checkPathName(), allowedHash) != '-1'){
				$('html,body').animate({
		          scrollTop: target.offset().top - $('.js-primary-nav-container').outerHeight()
		        }, 1000);	
	        }else{
				history.pushState('', document.title, window.location.pathname);
	        }
		}
		
		function init(){
			
			$(document).ready(function(){
			
				var standardOffset = 88;
				
				if(checkPathName().length > 1){
					window.scrollTo(0,0);
					setTimeout(function(){
						jumpNav();
					},300);
				}
				
				$(window).on('hashchange', function(){
					jumpNav();
				});
				
				
				$(window).on('scroll', function(){
					setTimeout(function(){
						scrolledDistance = $(window).scrollTop();
						if(scrolledDistance >= 400){
							set = true;
							setFixed(set);
							standardOffset = $('.js-primary-nav-container').outerHeight();
						}else if(scrolledDistance <= 399){
							set = false;
							setFixed(set);
							standardOffset = $('.js-primary-nav-container').outerHeight();
						}
					}, 100);
				});
				
				$('.js-primary-nav li a').on('click',function(){
					mainJs.closeOverlayMethod({});
				});
				
				$('#portfolio-section').waypoint({ offset: standardOffset });
				$('#team-section').waypoint({ offset: standardOffset });
				$('#press-section').waypoint({ offset: standardOffset });
				$('#gallery-section').waypoint({ offset: standardOffset });
				$('#contact-section').waypoint({ offset: '40%' });
				
				$('body').delegate('#portfolio-section, #team-section, #press-section, #gallery-section, #contact-section', 'waypoint.reached', function(event, direction) {
					

					
					var $activeTitle = $(this).attr('id'),
						$activeElement = $('.js-primary-nav li').find('a#'+$activeTitle+'-nav'),
						$prevActive = $('.js-primary-nav li').find('a.active');
					
															
					if (direction === "up") {
						$('.js-primary-nav li').each(function(){
							$(this).find('a').removeClass('active');
						})
						$prevActive.parent().prev().find('a').addClass('active');
					}else{
						$('.js-primary-nav li').each(function(){
							$(this).find('a').removeClass('active');
						})
						$('.js-primary-nav li').find('a#'+$activeTitle+'-nav').addClass('active');
					}		
				});
					
			});
			
		}
		
        return {
            init : init
        };
 
    })();

homePageJumpNavi.init();