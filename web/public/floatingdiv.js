$(document).ready(function() {
    var floatingDiv = $('#floatingDiv');
    var initialOffset = floatingDiv.offset().top;

    $(window).scroll(function() {
        var scrollTop = $(window).scrollTop();
        floatingDiv.css('top', initialOffset + scrollTop + 'px');
    });
});