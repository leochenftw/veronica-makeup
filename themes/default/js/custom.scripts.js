$(document).ready(function(e)
{
    // if (QueryString && QueryString.anchor) {
    //     var anchor      =   QueryString.anchor,
    //         target      =   $('#' + anchor);
    //
    //     if (target.length > 0) {
    //         $.scrollTo(target, 500, {axis: 'y', offset: -52});
    //     }
    // }

    $('.message.notification').removeClass('message').click(function(e)
    {
        var thisNotification = $(this);
        TweenMax.to($(this), 0.3, {opacity: 0, onComplete: function()
        {
            thisNotification.remove();
        }});
    });

    $('#ContactForm_ContactForm_Appointed').removeClass('hide');
    $('input[name="ToBook"]').change(function(e)
    {
        if ($(this).prop('checked')) {
            $('#ContactForm_ContactForm_Appointed_Holder').removeClass('hide');
        } else {
            $('#ContactForm_ContactForm_Appointed').val('');
            $('#ContactForm_ContactForm_Appointed_Holder').addClass('hide');
        }
    }).change();

    $(window).scroll(function(e)
    {
        if ($(window).scrollTop() >= 100) {
            $('#header').addClass('white');
        } else {
            $('#header').removeClass('white');
        }

        if ($('html').height() - $(window).scrollTop() == $(window).height()) {
            if (!$('body').hasClass('touch-bottom')) {
                $('body').addClass('touch-bottom');
            }
        } else {
            if ($('body').hasClass('touch-bottom')) {
                $('body').removeClass('touch-bottom');
            }
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

    $('a:not(.gallery-tab)').click(function(e)
    {
        if ($(this).attr('href').indexOf('anchor=') >= 0) {
            e.preventDefault();
            var anchors =   $(this).attr('href'),
                anchor  =   '',
                target  =   '';

            anchors     =   anchors.split('anchor=');
            anchor      =   anchors[1];
            target      =   $('#' + anchor);

            if (target.length > 0) {
                $.scrollTo(target, 500, {axis: 'y', offset: -52});
            }
        }
    });

    $('a.gallery-tab').click(function(e)
    {
        e.preventDefault();
        var tabs        =   $(this).attr('href'),
            tab         =   '';

        tabs            =   tabs.split('tab=');
        tab             =   tabs[1];
        tab             =   tab == 'all' ? '*' : ('.' + tab);

        $('a.gallery-tab').removeClass('is-active');
        $(this).addClass('is-active');

        if (window.isotope) {

            window.isotope.isotope({filter: tab});
        }

    });

    $('.ajax-content').afetch(function(data, listTo, navTo)
    {
        listTo.addClass('filled');
        var template    =   Handlebars.compile(galleryItem),
            tiles       =   template(data);

        tiles = $($.trim(tiles));


        listTo.append(tiles);

        if (listTo.is('.is-masonry')) {
            if (!window.isotope) {
                window.isotope = listTo = listTo.isotope(
                {
                    itemSelector: '.gallery-item__link',
                    layoutMode: 'packery',
                    columnWidth: 60
                });

                listTo.imagesLoaded().progress( function()
                {
                    listTo.isotope('layout');
                });
            } else {
                listTo.isotope( 'appended', tiles )
                      .imagesLoaded().progress( function()
                      {
                          listTo.isotope('layout');
                        //   var by = $('#knowledge-list-sorter option:selected').val();
                        //   listTo.isotope({ sortBy: by, sortAscending: by == 'date' ? false : true });
                      });
            }
        }

        if (data.pagination.href) {
            navTo.attr('href', data.pagination.href);
            navTo.removeClass('hide');
            navTo.parent().find('.nav-message').addClass('hide');
        } else {
            navTo.addClass('hide').attr('href', '');
            navTo.parent().find('.nav-message').removeClass('hide');
            navTo.parent().find('.nav-message').html(data.pagination.message);
        }

        navTo.parent().removeClass('hide');
    });
});

function recaptchaHandler(token)
{
    $('#ContactForm_ContactForm').submit();
}
