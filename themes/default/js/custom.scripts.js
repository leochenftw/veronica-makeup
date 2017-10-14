$(document).ready(function(e)
{
    $(window).scroll(function(e)
    {
        if ($(window).scrollTop() >= 100) {
            $('#header').addClass('white');
        } else {
            $('#header').removeClass('white');
        }
    });

    $('.btn-item-remover').click(function(e)
    {
        e.preventDefault();
        var row = $(this).parents('.columns:eq(0)');
        $.post($(this).attr('href'), function(data)
        {
            data = JSON.parse(data);
            if (data.success) {
                row.remove();
                $('#sum').html(data.message);
                if ($('.cart-content .columns.item').length == 0) {
                    $('.cart-content .container').html('<p class="has-text-centered">The cart is empty</p>');
                }
            } else {

            }
        });
    });
});
