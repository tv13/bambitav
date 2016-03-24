/**
 * Created by aleks on 14.03.16.
 */

var ProfileBase = {
    get_image_carousel_size: function() {
        return $('#car_inner').width() + 'x' + $('#car_inner').height();
    },
    load_user_images: function() {
        $.get('profile.php',
            {
                action: 'load_user_images',
                size  : ProfileBase.get_image_carousel_size(),
                id: $('#profile_content').data('profile_id')
            }, handle_response).error(ajax_error_handler).handler = ProfileBase.load_user_images_ajax_handler;
    },
    load_user_images_ajax_handler: function(response) {
        if (response.status == 1 && response.data && response.data.length)
        {
            ProfileBase.add_images_to_carousel(response.data);
        }
        else
        {
            $('#car_ol').html('');

            var txt_elem_no_photo =
                '<div class="item active no_photo">'
                +   '<div class="carousel-caption">'
                +       ''
                +   '</div>'
                + '</div>';
            $('#car_inner').html(txt_elem_no_photo);
        }
    },
    add_images_to_carousel: function(files) {
        $('#car_ol').html('');
        $('#car_inner').html('');

        $.each(files, function (i, obj) {
            ProfileBase.add_one_image_to_carousel(i, obj);
        });
        ProfileBase. carousel_setFirst_addEvents();
    },
    add_one_image_to_carousel: function(i, obj)
    {
        var content_indi = '<li data-target="#carousel-example-generic" data-slide-to="' + i + '"></li>';
        var content_inner = '<div class="item">'
            + '<img src="' + obj.url + '" alt="image" id="' + obj.id + '">'
            + '<div class="carousel-caption active">'
            +       'Фото ' + (i+1)
            + '</div>'
            + '</div>';
        $('#car_ol').append(content_indi);
        $('#car_inner').append(content_inner);
    },
    carousel_setFirst_addEvents: function()
    {
        if ($('#car_inner .item.active').length == 0)
        {
            $('#car_ol > li').first().addClass('active');
            $('#car_inner .item').first().addClass('active');
        }
        $('#carousel-example-generic').carousel('pause');
        $('.carousel_set_main')
            .unbind('click')
            .bind('click', ProfileBase.set_main_image);
        $('.carousel_remove')
            .unbind('click')
            .bind('click', ProfileBase.carousel_image_remove);
        if ($('#car_inner .item').length > 1)
        {
            $('a.arrow').removeClass('hide');
        }
        else
        {
            $('a.arrow').addClass('hide');
        }
    },
    load_profile_data: function() {
        $.get('profile.php',
            {
                action: 'load_profile_info',
                id: $('#profile_content').data('profile_id')
            }, handle_response).error(ajax_error_handler).handler = ProfileBase.load_profile_ajax_handler;
    },
    load_profile_ajax_handler: function(response)
    {
        if (response.status == 1 && response.data) {

            var data = response.data;

            $('#name').html(data.name);
            if (data.birthdate != '0000-00-00')
            {
                $('#age').html(data.birthdate);
            }

            $('#sex').html('<i class="fa fa-' + (response.sex == 'm' ? 'mars':'venus') + ' profile_ico"></i>');

            $('#phone').html(data.phone);

            $('#text').html(data.text);

            if (data.country > 0)
            {
                Vk.get_countries_by_id(data.country);
            }

            if (data.city > 0)
            {
                Vk.get_cities_by_id(data.city);
            }

            $('#city_main').html('user_val', data.city);
        }
    },
    carousel_image_remove: function() {
        if (confirm('Вы действительно хотите удалить это изображение?')) {
            if ($('.item.active').find('img').length > 0 && $($('.item.active').find('img')[0]).attr('id') != undefined) {

                var image_id = $($('.item.active').find('img')[0]).attr('id');
                $.post('profile.php',
                    {
                        action: 'image_remove',
                        id: image_id
                    }, handle_response).error(ajax_error_handler).handler = ProfileBase.image_remove_ajax_handler;
            }
        }
    },
    set_main_image: function()
    {
        if ($('.item.active').find('img').length > 0 && $($('.item.active').find('img')[0]).attr('id') != undefined) {
            var image_id = $($('.item.active').find('img')[0]).attr('id');
            $.post('profile.php',
                {
                    action: 'set_main',
                    id: image_id
                }, handle_response).error(ajax_error_handler).handler = ProfileBase.set_main_image_ajax_handler;
        }
    }

};