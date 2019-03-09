$(function(){
    var url = document.location.origin + '/cart/changequantity';
    function getData(inst){
        var data = {};
        var parent = $(inst).parent();
        data.id = parent.find('.hidden').text();
        data.input_tag = parent.find('.quantity_input');
        data.value = data.input_tag.val();
        return data;
    }
    function checkForZero(input_tag, value){
        if(value == false){
            value = 1;
            input_tag.val(value);
        }
        return value;
    }

    $(document).on('click', '.quantity_prev, .quantity_next', function(){
        var data = getData(this);
        if($(this).hasClass('quantity_prev'))
            data.value--;
        else
            data.value++;

        if($(this).hasClass('quantity_prev'))
            data.value = checkForZero(data.input_tag, data.value);

        if(data.value < 0 || data.value > 999)
            return;

        $.post(url, {'id': data.id, 'value': data.value}, function(answer){
            if(answer == false)
                return;
            $.pjax.reload('#pjax-cart-container');
        }, 'json');
    });

    $(document).on('keydown', '.quantity_input', function(e){
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105) && e.keyCode != 8)
            e.preventDefault();
    });

    $(document).on('change', '.quantity_input', function(){
        var data = getData(this);
        data.value = checkForZero($(this), data.value);
        $.post(url, {'id': data.id, 'value': data.value}, function(answer){
            if(answer == false)
                return;
            $.pjax.reload('#pjax-cart-container');
        }, 'json');
    });

    $(document).on('click', '.cart_goors_delete', function(){
        var url = document.location.origin + '/cart/delete';
        var id = $(this).attr('data-id');
        $.post(url, {'id': id}, function(answer){
            if(answer == false)
                return;
            $.pjax.reload('#pjax-cart-container');
        }, 'json');
        return false;
    });
});