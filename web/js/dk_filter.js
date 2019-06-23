var filter = {};

(function () {
    filter.addHtml = function(html){
        if(html){
            $('#goods_wrapper').empty().append(html);
            if($('.rating-loading').length != 0) {
                $('.rating-loading').rating('refresh', {
                    'disabled': true,
                    'showClear': false,
                    'theme': 'krajee-uni',
                    'size': 'sm',
                    'showCaption': false
                });
            }
            anim.elemsCascade('#goods_show', '.good_show', 'fadeInDown', 3, 0);
        }
    };

    /**
     * Получить товары
     */
    filter.getContent = function () {
        let form = $('#dk_filter form');
        $.get('categories/show', form.serialize(), function(html){
            if(html){
                filter.addHtml(html);
            }
        }, 'html');
    };

    /**
     * Установить алиас в скрытый input
     */
    filter.setAlias = function () {
        let input = $('#dk_filter form .dk_filter_alias');
        let alias = location.pathname.substr(1);
        input.val(alias);
    };

    /**
     * Получить GET параметры из запроса
     */
    filter.params = function () {
        return window
            .location
            .search
            .replace('?', '')
            .split('&')
            .reduce(
                function (p, e) {
                    var a = e.split('=');
                    p[decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
                    return p;
                },
                {}
            );
    }

    /**
     * Механика работы
     * Открытие закрытие элеменов фильтра
     */
    filter.motion = function() {
        $(function () {// Если есть в GET параметры фильтра то он открыт
            let params = filter.params ();
            Object.keys(params).forEach(function (e) {
                const match = e.match(/value_\d*/i);
                if (match !== null) {
                    let m = match[0];
                    if (m) {
                        $('input[name=' + m + ']').closest('.dk_filter_values').css('display', 'block');
                    }
                }

            });
        });

        $('#dk_filter ul a').click(function(){
            $(this).next().slideToggle();
            $(this).find('span').toggleClass('glyphicon-chevron-right glyphicon-chevron-down');
            return false;
        });
    };

    /**
     * Запуск
     */
    filter.run = function () {
        $(function () {
            filter.setAlias();
        });

        $('.dk_filter_values input').change(function(){
            filter.getContent();
        });

        filter.motion();
    };

})();