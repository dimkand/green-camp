var filter = {};

(function () {
    function _addHtml(html){
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
    }

    /**
     * Получить товары
     */
    filter.getContent = function () {
        let form = $('#dk_filter form');
        $.get('categories/show', form.serialize(), function(html){
            if(html){
                _addHtml(html);
            }
        }, 'html');
    };

    function _setAlias () {
        let input = $('#dk_filter form .dk_filter_alias');
        let alias = location.pathname.substr(1);
        input.val(alias);
    }

    /**
     * Запуск
     */
    filter.run = function () {
        $(function () {
            _setAlias();
        });

        $('.dk_filter_values input').change(function(){
            filter.getContent();
        });

        // Открытие закрытие элеменов фильтра
        $('#dk_filter ul a').click(function(){
            $(this).next().slideToggle();
            $(this).find('span').toggleClass('glyphicon-chevron-right glyphicon-chevron-down');
            return false;
        });
    };

})();