(function($){
    function animation(){
        anim.elem('.breadcrumb', 'animated flipInX');
        anim.elem('#clear_cart', 'animated fadeInLeft');
        anim.elem('#pjax-cart-container', 'animated fadeInRight');
    }

    $(function(){
        animation();
    });

    $(document).scroll(function(){
        animation();
    });

})(jQuery);