(function($){
    function animation(){
        anim.elem('h1', 'animated fadeInUp');
        anim.elem('#dk_filter', 'animated delay-05s fadeInLeft');
        anim.elemsCascade('#goods_show', '.good_show', 'fadeInDown', 3, 0);
        anim.elemsCascade('#main_categories_container', '.category', 'fadeInDown', 3, 0);
        anim.elem('.breadcrumb', 'animated flipInX');

        // если чистый адрес без id категории то прикрепляем анимацию dk_sidenav
        var strGET = window.location.search.replace( '?', '');
        if(strGET.length == 0)
            anim.elem('.dk_sidenav', 'animated fadeInLeft');
    }

    $(function(){
        animation();
    });
    $(document).scroll(function(){
        animation();
    });

})(jQuery);