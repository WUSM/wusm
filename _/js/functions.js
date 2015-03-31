// remap jQuery to $
(function($){


/* trigger when page is ready */
$(document).ready(function (){
    $('#mobile-menu-icon').click(function() {
        $('#mobile-nav').slideToggle();
        $(".dashicons-arrow-down-alt2").each(function() {
            if($(this).parent().height() != 0)
                $(this).height($(this).parent().height() - 26);
        });
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
    $("#mobile-nav .current_page_ancestor > .dashicons-arrow-down-alt2").toggleClass("dashicons-arrow-up-alt2 dashicons-arrow-down-alt2");

    if($('#lists > div').length == 1) {
        $('#col1').css('width', 'auto');
    }


});



})(window.jQuery);