// remap jQuery to $
(function($){


/* trigger when page is ready */
$(document).ready(function (){
    $('#mobile-menu-icon').click(function() {
        $(this).toggleClass('active');
        $('#mobile-nav').slideToggle('fast').toggleClass('active');
        if($('#mobile-search-form').hasClass('active')) {
            $('#mobile-search-form').hide().toggleClass('active');
            $('#mobile-search-icon').removeClass('active');
        }
    });
    
    $('#mobile-search-icon').click(function() {
        $(this).toggleClass('active');
        $('#mobile-search-form').slideToggle('fast').toggleClass('active');
        if($('#mobile-nav').hasClass('active')) {
            $('#mobile-nav').hide().toggleClass('active');
            $('#mobile-menu-icon').removeClass('active');
        }
    });

    $('#mobile-nav').find('.page_item_has_children > a').each(function() {
        $(this).wrap( '<div></div>' );
    });

    $("#mobile-nav .page_item_has_children > div > a").each(function() {
        $(this).after( "<div class='dashicons dashicons-arrow-down-alt2 expand'></div>" );
    });

    $(".expand").click( function() {
        if( $(this).parent().parent().parent().parent().attr('id') == 'mobile-nav' ){
            $(".expanded").not($(this).parent().next()).removeClass("expanded").slideUp();
            $(".expand").not($(this)).addClass("dashicons-arrow-down-alt2").removeClass("dashicons-arrow-up-alt2");
        }
        $(this).parent().next().toggleClass("expanded").slideToggle('fast');
        $(this).toggleClass("dashicons-arrow-up-alt2 dashicons-arrow-down-alt2");
    });

    $("#mobile-nav .current_page_ancestor > .children").addClass("expanded").slideToggle();
    $("#mobile-nav .current_page_ancestor > div .dashicons-arrow-down-alt2").toggleClass("dashicons-arrow-up-alt2 dashicons-arrow-down-alt2");

    if($('#lists > div').length == 1) {
        $('#col1').css('width', 'auto');
    }
});

})(window.jQuery);