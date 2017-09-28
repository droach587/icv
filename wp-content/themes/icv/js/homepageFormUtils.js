//Sets Active Date Range on Lists
var homepageFormUtils = {
	
	init : function(){
		
		var $uploadWatch = $('.js-file-upload'),
			$uploadChange = $('.js-file-upload-placeholder'),
			$popupMenu = $('.js-popupmenu'),
			$popupMenuOptions = $('.js-popupmenu-options'),
			$popupPlaceholder= $('.js-popuplaceholder');
			
			$uploadWatch.on('change',function(){
				theVal = $(this).val();
				$uploadChange.val(theVal);
			});
			
			$popupMenu.on('mouseenter',function(){
				$popupMenuOptions.removeAttr('style');
			});
			$popupMenuOptions.find('li').each(function(){
				$(this).on('click',function(){
					menuValue = $(this).text();
					$popupMenuOptions.stop().animate({
						'opacity':0
					},function(){
						$(this).css('visibility','hidden');
					});
					$popupPlaceholder.val(menuValue);
				});
			})
		
	}//Init
	
};

$(document).ready(function(){
	homepageFormUtils.init();
});