stopRotate = 0;

jQuery(document).ready(function(){
    jQuery('#slider .controls li').click(function(){
        if (jQuery(this).hasClass('active'))
            return false;
        stopRotate = 1;
        slide_id = jQuery(this).attr('id').match(/\d/g);
        gotoSlide(slide_id);
    });
    setTimeout(autoRotate, 4000);
});

function autoRotate() {
    if (!stopRotate) {
        slides = jQuery('#slider .controls li').size();
		if (slides == 1)
			return;
        next_slide = parseInt(jQuery('#slider .controls .active').attr('id').match(/\d/g), 10) + 1;
        if (next_slide > slides)
            next_slide = 1;
        gotoSlide(next_slide);
        setTimeout(autoRotate, 4000);
    }
}

function gotoSlide(slide_id) {
    jQuery('#slider .controls .active').removeClass('active');
    jQuery('#slider .controls #gotoSlide'+slide_id).addClass('active');
    jQuery('#slider .slides #slide'+slide_id).css('z-index', '2');
    jQuery('#slider .slides .active').removeClass('active').fadeOut(300, function(){
        jQuery(this).show().css('z-index', '1');
        jQuery('#slider .slides #slide'+slide_id).addClass('active').css('z-index', '3');
    });
}