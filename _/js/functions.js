// Browser detection for when you get desparate. A measure of last resort.
// http://rog.ie/post/9089341529/html5boilerplatejs

// var b = document.documentElement;
// b.setAttribute('data-useragent',  navigator.userAgent);
// b.setAttribute('data-platform', navigator.platform);

// sample CSS: html[data-useragent*='Chrome/13.0'] { ... }


// remap jQuery to $
(function($){


/* trigger when page is ready */
$(document).ready(function (){
    $('#mobile-menu-icon').click(function() {
        $('#mobile-nav').slideToggle();
    });
    
    $('#mobile-search-icon').click(function() {
        $('#mobile-search-form').slideToggle();
    });

    $("#mobile-nav .page_item_has_children > a").each(function() {
        $(this).after( "<div class='dashicons dashicons-arrow-down-alt2 jpm-expand'></div>" );
    });

    $(".jpm-expand").click( function() {
        if( $(this).parent().parent().parent().attr('id') == 'mobile-nav' ){
            $(".jpm-expanded").not($(this).next()).removeClass("jpm-expanded").slideUp();
            $(".jpm-expand").not($(this)).addClass("dashicons-arrow-down-alt2").removeClass("dashicons-arrow-up-alt2");
        }
        $(this).next().toggleClass("jpm-expanded").slideToggle();
        $(this).toggleClass("dashicons-arrow-up-alt2 dashicons-arrow-down-alt2");
    });

    $("#mobile-nav .current_page_ancestor > .children").addClass("jpm-expanded").slideToggle();
});


/* optional triggers

$(window).load(function() {
	
});

$(window).resize(function() {
	
});

*/


})(window.jQuery);