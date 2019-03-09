(function($){
    $('#comments-rating').on('rating:change', function() {
        $(this).rating('refresh', {
            showCaption: true
        });
    });
})(jQuery);