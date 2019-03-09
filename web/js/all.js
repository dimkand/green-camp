function articlesAnim(){
    var i = 0;
    $('#articles_list > div').each(function(index, elem){
        if(!anim._check('#articles_list'))
            return;

        if($(elem).children('div').is('.article_prev')){
            if(i%2 == 0){
                $(elem).find('.article_prev').addClass('animated fadeInLeft delay-1_'+index);
                $(elem).find('.article_subtext').addClass('animated fadeInRight delay-1_'+index);
            }
            else{
                $(elem).find('.article_subtext').addClass('animated fadeInLeft delay-1_'+index);
                $(elem).find('.article_prev').addClass('animated fadeInRight delay-1_'+index);
            }
            i++;
        }
        else
            $(elem).addClass('animated fadeInRightBig delay-1_'+index);
    });
}

(function ($) {
    function animation() {
        if ($(window).scrollTop() < 20)
            anim.elem('.main_menu', 'animated fadeInUp');
        // anim.elem('footer', 'animated flipInX');
    }

    $(function () {
        $('body').removeClass('hide');
        animation();
        // Корзина
        $(document).on('click', '.good_show_cart a, #good_card_cart', function () {
            var id = $(this).attr('data-attr');
            $.post('/cart/add',
                {'id': id},
                function (count) {
                    if (count) {
                        $('#cart_count span').text(count);
                        $('#cart').removeClass('animated pulse');
                        anim.elem('#cart', 'animated pulse');
                    }
                }, 'json');
            return false;
        });

        $('#clear_cart').click(function () {
            $.post('/cart/clear',
                function (data) {
                    if (data) {
                        $('#cart_count span').text(0);
                        $.pjax.reload('#pjax-cart-container');
                    }
                });
            return false;
        });
//    Главное меню
        $(window).bind('scroll', function () {
            if ($(window).scrollTop() > 20) {
                $('#cart').addClass('cart_scroll');
                $('.main_menu').addClass('scrolling');
            }
            else {
                $('#cart').removeClass('cart_scroll');
                $('.main_menu').removeClass('scrolling');
            }
        });
    });

    $(document).scroll(function () {
        animation();
    });

})(jQuery);