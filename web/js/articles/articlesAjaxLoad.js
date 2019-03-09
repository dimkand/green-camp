(function ($) {
    var load_permission = true; // Чтобы небыло многократной загрузки одного и того же контента

    function articlesAjaxLoad(){
        if(!load_permission)
            return;

        var baseUrl = document.location.origin;

        if(anim.isVisible('footer')){
            var path = baseUrl + '/articles/showall';
            var page = $('.article_page:last').text();
            page++;

            load_permission = false;

            $.get(path,
                {'page' : ++page, 'per-page' : 2},
                function(html_data){
                    if(html_data != false)
                        $('#articles_list').append(html_data);
                    load_permission = true;
                }, 'html');
        }
    }

    $(window).bind('scroll', function(){
        articlesAjaxLoad();
    });

    $(document).bind('ready', function(){
        articlesAjaxLoad();
    });
})(jQuery);