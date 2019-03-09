(function ($) {
    var anim = {
        isVisible: function (elem) {
            var e = $(elem);
            var w = $(window);
            if (e.offset() === undefined)
                return false;

            return ((e.offset().top <= w.scrollTop() + w.height())
                && (e.offset().top >= w.scrollTop())) ||
                ((e.offset().top + e.height() >= w.scrollTop()) && (e.offset().top <= w.scrollTop() + w.height()));
        },
        _check: function (elem) {
            // if(anim.isVisible(elem) && !$(elem).hasClass('animated') && $(window).width() > 1111)
            if(anim.isVisible(elem) && $(window).width() > 1111)
                return true;
            return false;
        },
        elem: function (elem, class_name) {
            if (anim._check(elem))
                $(elem).addClass(class_name);
        },
        elems : function (elem, class_name){
            $(elem).each(function(index, e){
                if (anim._check(elem))
                    $(e).addClass(class_name);
            });
        },
        elemsCascade: function (wrapper, elem, anim_class, num, factor) {
            $(wrapper).find(elem).each(function (index, e) {
                if (!anim._check(e))
                    return;

                $(e).addClass('animated ' + anim_class + ' delay-' + factor + '_' + Math.floor(index / num));
            });
        },
    }
    window.anim = anim;
})(jQuery);