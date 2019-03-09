(function($){
    function animation(){
        anim.elem('.breadcrumb', 'animated flipInX');
    }

    $(function(){
        animation();
    });

    $(document).scroll(function(){
        animation();
    });

})(jQuery);