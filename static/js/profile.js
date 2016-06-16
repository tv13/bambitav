
$(window).on('load', preloader_close);

var form = $('#formProfile');
var submit = $('#send_data');

var setUnchangedF = function () {
    submit.prop('disabled', true);
};
var setChangedF = function () {
    submit.prop('disabled', false);
    $('.custom_close').click();
};

$(document).ready(function(){

    form.on('keyup', setChangedF);
    form.on('change', setChangedF);
    $('.bfh-datepicker').datepicker();
    showModalConfirmEmail();

    var img_size = get_image_carousel_size();

    load_profile_data();
    load_user_images();
    $('#profile_btn, #filter_btn').addClass('hide');
    $('form#formProfile').submit(profile_submit);
    $('#country').change(Vk.load_main_cities);
    //$('#region').change(Vk.load_cities);
    $('#city_main').change(Vk.load_other_cities);
    $('#city_other').autocomplete({
        source: Vk.get_cities_by_name,
        minLength: 2,
        maxHeight: 10,
        select: Vk.process_autocomplete
    });
    $('#btnPublishingCost').click(count_publishing_cost);
    $('#editPublishDays').click(show_btn_publishing_cost).change(count_publishing_cost);
    $('#photoModal').on('show.bs.modal', show_photo_modal);

    var url = window.location.hostname === 'blueimp.github.io' ?
        '//jquery-file-upload.appspot.com/' : 'profile.php?action=file_upload';

    $('#start')
        .on('click', function () {
            $('#start').attr('disabled',false);
            var $this = $(this);

            if ($this.data().files != undefined) {

                $('#pr_status').text('Подождите, идет загрузка...');
                var total = $this.data().files.length;
                var i = 0;

                $('#progress').css(
                    'width',
                    '0%'
                ).attr(
                    'aria-valuenow',
                    0
                ).html(0 + '%');

                $($this.data().files).each(function( index, elem ) {

                    io_upload(elem, function(response) {
                        i++;
                        var progress =parseInt(i*100/total);
                        $('#progress').css(
                            'width',
                            progress + '%'
                        ).attr(
                            'aria-valuenow',
                            progress
                        ).html(progress + '%');
                        response.number = i;
                        response.total = total;
                        response.size = img_size;

                        $.ajax({
                            type: "POST",
                            url: "profile.php?action=file_upload",
                            data: response,
                            beforeSend: function () {
                            },
                            success: function(response) {
                                if (response.status == 1)
                                {
                                    if ($('#car_inner div').first().hasClass('no_photo'))
                                    {
                                        i = 0;
                                        $('#car_ol').html('');
                                        $('#car_inner').html('');
                                        $('#car_inner div').first().removeClass('no_photo');
                                    }
                                    else
                                    {
                                        i = $('#car_ol li').length;
                                    }
                                    add_one_image_to_carousel(i, response.data);
                                    carousel_setFirst_addEvents();
                                    if ($('#start').data().files != undefined) {
                                        $('#start').data().files = undefined;
                                    }
                                    $('#pr_status').text('Файлы успешно загружены!');
                                    bootstrap_alert.success('Файлы успешно загружены!', '_image');
                                    $('#photoModal').modal('hide');
                                }
                                else
                                {
                                    bootstrap_alert.warning(response.statusMessage, '_image');
                                }
                            },
                            complete: function () {
                            }
                        });
                    });
                });
            }
        });

    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 999000,
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        imageMinWidth: 700,
        imageMinHeight: 400,
        previewCrop: true
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index];
        if (file.error) {
            alert(file.error);
        }
        else {
            add_image_to_preview_table(data);
            /*if (file.error) {
             node
             .append('<br>')
             .append($('<span class="text-danger"/>').text(file.error));
             }*/
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css(
            'width',
            progress + '%'
        );
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');

});
function add_image_to_preview_table(data)
{
    var index = data.index,
        file = data.files[index];
    if ($('#start').data().files == undefined || $('#start').data().files.length < 5) {

        data.context = $('<tr/>').appendTo('#files');

        var node = $('<td/>')
            .append($('</span>'));
        if (!index) {
            node
                .append('<br>');
        }
        node.appendTo(data.context);
        if (file.preview) {
            node
                .prepend(file.preview);
        }

        var node = $('<td/>')
            .append($('<p class="name"></p>').text(file.name));
        if (!index) {
            node
                .append('<br>');
        }
        node.appendTo(data.context);
        if ($('#start').data().files != undefined) {
            var btn_data = $('#start').data();
            btn_data.files.push(data.files[0]);
            $('#start').data(btn_data);
        } else {
            $('#start').data(data);
        }
        $('#start').attr('disabled',false);
        if ($('#start').data().files.length == 5) {
            $('#fileupload').prop('disabled', true).parent().addClass('disabled');
        } else {
            $('#fileupload').prop('disabled', false).parent().removeClass('disabled');
        }
    }
}

function get_image_carousel_size()
{
    return $('#car_inner').width() + 'x' + $('#car_inner').height();
}

function load_user_images()
{
    $.get('profile.php',
        {
            action: 'load_user_images',
            size  : get_image_carousel_size()
        }, handle_response).error(ajax_error_handler).handler = load_user_images_ajax_handler;
}

function load_user_images_ajax_handler(response)
{
    if (response.data.length)
    {
        add_images_to_carousel(response.data);
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
}

function add_images_to_carousel(files)
{
    $('#car_ol').html('');
    $('#car_inner').html('');

    $.each(files, function (i, obj) {
        add_one_image_to_carousel(i, obj);
    });
    carousel_setFirst_addEvents();
}

function add_one_image_to_carousel(i, obj)
{
    var content_indi = '<li data-target="#carousel-example-generic" data-slide-to="' + i + '"></li>';
    var content_inner = '<div class="item">'
        + '<img src="' + obj.url + '" alt="image" id="' + obj.id + '">'
        + '<div class="carousel-control top left">'
        +       '<span class="glyphicon '
        +               (obj.main == 0 ? 'carousel_set_main glyphicon-ok' : 'main')
        +               '" aria-hidden="true">'
        +           (obj.main == 0 ? 'Сделать главной' : 'Главная')
        +       '</span>'
        + '</div>'
        + '<div class="carousel-control remove">'
        +       '<span class="glyphicon glyphicon-remove carousel_remove" aria-hidden="true">'
        +           'Удалить'
        +       '</span>'
        +       '<span class="sr-only">Remove</span>'
        + '</div>'
        + '<div class="carousel-caption active">'
        +       'Фото ' + (i+1)
        + '</div>'
        + '</div>';
    $('#car_ol').append(content_indi);
    $('#car_inner').append(content_inner);
}

function carousel_setFirst_addEvents()
{
    if ($('#car_inner .item.active').length == 0)
    {
        $('#car_ol > li').first().addClass('active');
        $('#car_inner .item').first().addClass('active');
    }
    $('#carousel-example-generic').carousel('pause');
    $('.carousel_set_main')
        .unbind('click')
        .bind('click', set_main_image);
    $('.carousel_remove')
        .unbind('click')
        .bind('click', carousel_image_remove);
    if ($('#car_inner .item').length > 1)
    {
        $('a.arrow').removeClass('hide');
    }
    else
    {
        $('a.arrow').addClass('hide');
    }
}

function load_profile_data()
{
    $.get('profile.php',
        {
            'action': 'load_profile_info'
        }, handle_response).error(ajax_error_handler).handler = load_profile_ajax_handler;
}

function load_profile_ajax_handler(response)
{
    if (response.status == 1) {
        var data = response.data;
        $('#name').val(data.name);
        if (data.birthdate != '0000-00-00')
        {
            $('#birthdate').val(data.birthdate);
        }
        $('#sex').val(data.sex);
        $('#phone').val(data.phone);
        if ($("#purpose option[value='"+data.purpose_id+"']").length)
        {
            $('#purpose').val(data.purpose_id);
        }
        $('#text').val(data.text);
        if (data.country > 0)
        {
            $('#country').val(data.country).change();
        }
        //$('#region').attr('user_val', data.region);
        $('#city_main').attr('user_val', data.city);
    }
}

function profile_submit()
{
    $.ajax({
        type: "POST",
        url: "profile.php",
        data:  {
            'name': $('#name').val(),
            'country': $('#country').val(),
            'city': $('#city_main').val() > 0 ? $('#city_main').val() : $('#city_other').attr('city_id'),
            'birthdate': $('#birthdate').val(),
            'sex': $('#sex').val(),
            'phone': $('#phone').val(),
            'purpose': $('#purpose').val(),
            'text': $('#text').val(),
            'action': 'update_profile_info'
        },
        beforeSend: function () {
            $('form#formProfile').find('button[type=submit]').attr('disabled','disabled');
        },
        success: function(response) {
            if (response.status == 1)
            {
                bootstrap_alert.success('Данные успешно сохранены!', '_form');
            }
            else
            {
                bootstrap_alert.warning(response.statusMessage, '_form');
            }
            setUnchangedF();
        }
    });

    return false;
}

function profile_submit_ajax_handler(response)
{
    $('form#formProfile').find('button[type=submit]').removeAttr('disabled');
}

function countries_process(result)
{
    Vk.set_option_for_select(result.response.items, '#country');
}

/*function regions_process(result)
{
    Vk.set_option_for_select(result.response.items, '#region');
}*/

function cities_process(result)
{
    Vk.set_option_for_select(result.response.items, '#city_main');
}

function cities_other_process(result)
{
    Vk.show_cities_by_name(result.response.items);
}

function city_other_show_names(result)
{
    $('#city_other').val(result.response[0].title);
}

function count_publishing_cost()
{
    var $form_publish = $('#publishQuestionnaire');
    var publish_days = $form_publish.find('#editPublishDays').val();
    var cost_publish = publish_days * 1;
    var balance = $form_publish.find('#balanceValue').text();
    if (!isInt(publish_days) || parseInt(publish_days) <= 0) {
        bootstrap_alert.warning('Количество дней должно быть целое и положительное!', '_days');
        return;
    }
    $form_publish.find('#costBlock').removeClass('hide');
    $form_publish.find('#costValue').text(cost_publish);
    $form_publish.find('#btnPublishingCost').addClass('hide');
    if (cost_publish - balance > 0)
    {
        $form_publish.find('#needPayBlock').removeClass('hide');
        $form_publish.find('#txtPublishDays').text(publish_days);
        $form_publish.find('#needPayValue').text(cost_publish - balance);
        $form_publish.find('#btnRefillBalance').removeClass('hide');
        $form_publish.find('#btnPublish').addClass('hide');
    }
    else
    {
        $form_publish.find('#needPayBlock').addClass('hide');
        $form_publish.find('#btnPublish').removeClass('hide');
        $form_publish.find('#btnRefillBalance').addClass('hide');
    }
}

function show_btn_publishing_cost()
{
    var $form_publish = $('#publishQuestionnaire');
    $form_publish.find('#btnPublishingCost').removeClass('hide');
    $form_publish.find('#btnPublish').addClass('hide');
    $form_publish.find('#btnRefillBalance').addClass('hide');
    $form_publish.find('#costBlock').addClass('hide');
    $form_publish.find('#needPayBlock').addClass('hide');
}
$('.carousel').carousel({
    interval: 3000
});

function carousel_image_remove() {
    if (confirm('Вы действительно хотите удалить это изображение?')) {
        if ($('.item.active').find('img').length > 0 && $($('.item.active').find('img')[0]).attr('id') != undefined) {

            var image_id = $($('.item.active').find('img')[0]).attr('id');
            $.post('profile.php',
                {
                    action: 'image_remove',
                    id: image_id
                }, handle_response).error(ajax_error_handler).handler = image_remove_ajax_handler;
        }
    }
}

function image_remove_ajax_handler(response)
{
    if (response.status == 1)
    {
        load_user_images();
    }
}

function set_main_image()
{
    if ($('.item.active').find('img').length > 0 && $($('.item.active').find('img')[0]).attr('id') != undefined) {
        var image_id = $($('.item.active').find('img')[0]).attr('id');
        $.post('profile.php',
            {
                action: 'set_main',
                id: image_id
            }, handle_response).error(ajax_error_handler).handler = set_main_image_ajax_handler;
    }
}

function set_main_image_ajax_handler(response)
{
    if (response.status == 1)
    {
        $('.carousel_set_main').unbind('click');
        $('.item:not(.active)').find('span.glyphicon:not(.carousel_remove)')
            .addClass('carousel_set_main')
            .addClass('glyphicon-ok')
            .removeClass('main')
            .text('Сделать главной');
        $('.item.active').find('span.glyphicon:not(.carousel_remove)')
            .removeClass('carousel_set_main')
            .removeClass('glyphicon-ok')
            .addClass('main')
            .text('Главная');
        $('.carousel_set_main').bind('click', set_main_image);
    }
}

function show_photo_modal()
{
    $('#pr_status').text('');
    $('#progress')
        .css('width', '0%')
        .attr('aria-valuenow', 0)
        .text('');
    $('#files').empty();
    if ($('#start').data().files != undefined) {
        $('#start').data().files = undefined;
    }
}

function showModalConfirmEmail()
{
    if (Cookie.getCookie(Cookie.cookie_confirm_email))
    {
        $('#needConfirmEmailModal').modal('show');
        Cookie.setCookie(Cookie.cookie_confirm_email, 1, -1); /* delete cookie confirm_email */
    }
}