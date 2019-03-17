(function($){
    function animation(){
        anim.elem('h1', 'animated fadeInUp');
        anim.elem('#js-line_1', 'animated delay-06s fadeInDown');
        anim.elem('#main_categories h2', 'animated delay-08s fadeInDown');
        anim.elemsCascade('#main_categories_container', '.category', 'fadeInDown', 3, 1);
        anim.elem('#history h2', 'animated fadeInDown');
        anim.elem('#history div', 'animated delay-02s fadeInDown');
        anim.elem('#js-line_3', 'animated fadeInDown');
        anim.elem('#why_us h2', 'animated delay-02s fadeInDown');
        anim.elem('#why_us div', 'animated delay-04s fadeInDown');
        anim.elem('#popular_goods h2', 'animated delay-02s fadeInDown');
        anim.elemsCascade('#popular_goods > div', '.good_show', 'fadeInDown', 1, 0);
        anim.elem('#js-line_5', 'animated fadeInDown');
        anim.elem('#info h2', 'animated delay-02s fadeInDown');
        anim.elem('#info div', 'animated delay-04s fadeInDown');
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