jQuery(document).ready(function($){
	
	/////////////////////////////////////
    //      Main navigation sub menus         
    /////////////////////////////////////
	
    $('#mainNav li').hover(function(){
        $(this).find('.sub-menu').stop().show(200);
        $(this).find('.children').stop().show(200);
    }, function(){
        $(this).find('.sub-menu').stop().hide(200);
        $(this).find('.children').stop().hide(200);
    });
	
	/////////////////////////////////////
    //      Go To Top Link         
    /////////////////////////////////////
	
    $('#footer .gotoTop').click(function(){
		$("html, body").animate({ scrollTop: 0 }, 300);
		return false;
	});
	
	/////////////////////////////////////
    //      Safari placeholders support         
    /////////////////////////////////////
	
    if($.browser.safari) {
        $('input[type=text]').addClass('safariInput');
    }
	
});