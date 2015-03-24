jQuery("input").each(function(){
    if (jQuery(this).val()=="" && jQuery(this).attr("placeholder")!="") {
        jQuery(this).val(jQuery(this).attr("placeholder"));
        jQuery(this).focus(function(){
            if(jQuery(this).val()==jQuery(this).attr("placeholder"))
                jQuery(this).val("");
        });
        jQuery(this).blur(function(){
            if(jQuery(this).val()=="")
                jQuery(this).val(jQuery(this).attr("placeholder"));
        });
    }
});

jQuery("textarea").each(function(){
    if (jQuery(this).text()=="" && jQuery(this).attr("placeholder")!="") {
        jQuery(this).text(jQuery(this).attr("placeholder"));
        jQuery(this).focus(function(){
            if(jQuery(this).text()==jQuery(this).attr("placeholder"))
                jQuery(this).text("");
        });
        jQuery(this).blur(function(){
            if(jQuery(this).text()=="")
                jQuery(this).text(jQuery(this).attr("placeholder"));
        });
    }
});