(function($){
    function animation(){
        anim.elem('h1', 'animated fadeInUp');
        anim.elem('#line_1', 'animated delay-06s bounceInUp');
        anim.elem('h2', 'animated delay-08s bounceInUp');
        anim.elemsCascade('#main_categories_container', '.category', 'bounceInUp', 3, 1);
        anim.elem('#line_2', 'animated bounceInUp');
        anim.elem('#main_text', 'animated delay-02s bounceInUp');
        anim.elem('#line_4', 'animated delay-05s fadeIn');
        anim.elem('#main_articles h2', 'animated flipInY');
        anim.elem('.button', 'animated flipInY');
    }

    $(function(){
        animation();
        articlesAnim();
    });

    $(document).scroll(function(){
        animation();
        articlesAnim();
    });

})(jQuery);