function filterRun(baseUrl){
    function _addHtml(html){
        if(html){
            $('#goods_wrapper').empty().append(html);
            if($('.rating-loading').length != 0)
                $('.rating-loading').rating('refresh', {
                    'disabled': true,
                    'showClear': false,
                    'theme': 'krajee-uni',
                    'size': 'sm',
                    'showCaption': false
                });
            anim.elemsCascade('#goods_show', '.good_show', 'fadeInDown', 3, 0);
        }
    }
    // Открытие закрытие элеменов фильтра
    $('#dk_filter ul a').click(function(){
        $(this).next().slideToggle();
        $(this).find('span').toggleClass('glyphicon-chevron-right glyphicon-chevron-down');
        return false;
    });

// Механника работы всплывающего #dk_filter_submit
    $('.dk_filter_values input').change(function(){
        var all_inputs = $('#dk_filter').find('input');
        var window = $('#dk_filter_window');
        if(!all_inputs.is(':checked')){
            window.fadeOut('slow');
            return;
        }
        var dk_filter_top = $('#dk_filter').offset().top;
        var input_top = $(this).offset().top;
        var top = input_top - dk_filter_top - 23;

        if(window.is(':hidden')){
            window.css('top', top);
            window.fadeIn('slow').css('display', 'flex');
        }else
            window.animate({'top': top}, 600, 'easeInOutExpo');

    });
    $('#dk_filter_reset').click(function(){
        $('#dk_filter').find('input').removeAttr('checked');
        $('#dk_filter_window').fadeOut('slow');
        return false;
    });
    $('#dk_filter form').submit(function(){
            $.get(baseUrl + '/categories/show', $(this).serialize(), function(html){
            if(html){
                _addHtml(html);
            }
        }, 'html');
        $('#dk_filter_window').fadeOut('slow');
        return false;
    });
    $(document).on('click', '.ajax_pagination a', function(){
        var li = $(this).parent();
        if(li.hasClass('active') || li.hasClass('disabled'))
            return false;

        $.get($(this).attr('href'),  function(html){
            _addHtml(html);
        }, 'html');
        return false;
    });
}