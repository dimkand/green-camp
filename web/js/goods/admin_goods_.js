var admin_goods = {
    baseUrl : '',
    addEmptyMessage: function(){
        var text = '';
        if ($('#goods_form_chars div').length == 0)
            text = 'В данной  категории характеристики отсутствуют';    autoFill: function() {
        $(function(){
            document.getElementById('goods_form_title').addEventListener('blur', function(){
                var text = this.value;
                document.getElementById('goods_form_description').setAttribute('value', text);
                document.getElementById('goods_form_keywords').setAttribute('value', text);
            });
        });
    }
        $('#chars_message').text(text);
    },
    addDelChars: function () {
        $('.drop_down input').change(function () {
            var id = $(this).val();
            if(!$(this).is(':checked')){
                $('#goods_form_chars').find('div[data-id = '+id+']').remove();
                admin_goods.addEmptyMessage();
            }else{
                $.post(
                    admin_goods.baseUrl + '/goods/addchars', {'id': id}, function (html) {
                        $('#goods_form_chars').append(html);
                        admin_goods.addEmptyMessage();
                    }, 'html');
            }
        });
        $('.drop_down_tags').on('click', 'a', function(){
            var id = $(this).data('tag');
            $('#goods_form_chars').find('div[data-id = '+id+']').remove();
            admin_goods.addEmptyMessage();
        });
    },
};