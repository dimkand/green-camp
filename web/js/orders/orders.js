(function($){
    function animation(){
        anim.elem('.breadcrumb', 'animated flipInX');
        anim.elem('.orders-create h1', 'animated flipInX');
        anim.elem('.field-orders-method_id .control-label', 'animated fadeInLeft');
        anim.elem('#orders-method_id label', 'animated fadeInRight');
        anim.elem('.orders-form-bottom input', 'animated fadeInRight');
        anim.elem('.orders-form-bottom label', 'animated fadeInLeft');
        anim.elem('.orders-form button', 'animated fadeInDown');
    }

    $(function(){
        animation();
    });

    $(document).scroll(function(){
        animation();
    });

})(jQuery);