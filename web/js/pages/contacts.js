(function($){
    function animation(){
        anim.elem('.breadcrumb', 'animated flipInX');
        anim.elem('h1', 'animated flipInY');
        anim.elem('.alert', 'animated fadeInLeft');
        anim.elem('#contact_p', 'animated fadeInUp');
        anim.elem('#contact_form textarea, #contact_form input', 'animated fadeInRight');
        anim.elem('#contact_form label', 'animated fadeInLeft');
        anim.elem('#contact_form img', 'animated flipInX');
        anim.elem('#contact_form button', 'animated fadeInDown');
    }

    $(function(){
        animation();
    });

    $(document).scroll(function(){
        animation();
    });

})(jQuery);