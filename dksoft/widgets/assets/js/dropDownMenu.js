let dropDown = {};
(function () {
    dropDown.openClose = function () {
        const PLUS_CLASS = 'glyphicon-plus';
        const MINUS_CLASS = 'glyphicon-minus';
        $('.drop_down li a').click(function () {
            let inner_ul = $(this).parent().next('ul');
            let icon = $(this).next();
            if (inner_ul.is(':hidden')) {
                inner_ul.slideDown();
                icon.removeClass(PLUS_CLASS).addClass(MINUS_CLASS);
            }
            else {
                inner_ul.slideUp();
                icon.removeClass(MINUS_CLASS).addClass(PLUS_CLASS);
            }
            return false;
        });
    };

    dropDown.addRemoveTag = function () {
        $('.drop_down input').click(function () {
            let elem = $(this);
            const id = elem.val();
            const type = elem.attr('data-type');
            const className = type == 4 ? 'chars_tag' : 'category_tag';
            let tags_conteiner = elem.closest('.drop_down').next();
            if (elem.is(':checked')) {
                var label = elem.next().text();
                tags_conteiner.append("<a data-tag = '" + id + "' href='#' class='" + className + "'><span class='glyphicon glyphicon-remove'></span>" + label + "</a>");
            } else {
                tags_conteiner.find('a[data-tag = ' + id + ']').remove();
                charsOff(elem);
            }
        });
    };

    /*
    Снятие флажков у значений характеристик если кодкатегория off
     */
    function charsOff(elem) {
        if (elem.attr('data-type') != 2) {
            return;
        }
        let charsValues = elem.closest('li').next('.inner_ul').find('.inner_ul input');
        charsValues.attr('checked', false);
        charsValues.each(function () {
            const id = $(this).val();
            $('.drop_down_tags').find('a[data-tag = ' + id + ']').remove();

        });
    }

    dropDown.tagsClose = function () {
        $('.drop_down_tags').on('click', 'a', function (e) {
            const id = $(this).attr('data-tag');
            const elem = $(this).parent().prev().find('input[value = ' + id + ']');
            elem.attr('checked', false);
            charsOff(elem);
            elem[0].dispatchEvent(new Event('change'));

            $(this).remove();
            e.preventDefault();
        });
    };
})();

$(function () {
    dropDown.openClose();
    dropDown.addRemoveTag();
    dropDown.tagsClose();
});