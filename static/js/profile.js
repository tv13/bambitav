var vk_version = '5.5';
    
$(document).ready(function(){

    load_profile_data();
    load_user_images();
    $('form#formProfile').submit(profile_submit);
    $('#country').change(load_regions);
    $('#region').change(load_cities);
    $('#btnPublishingCost').click(count_publishing_cost);
    $('#editPublishDays').click(show_btn_publishing_cost).change(count_publishing_cost);
    $('#photoModal').on('show.bs.modal', show_photo_modal);

    var url = window.location.hostname === 'blueimp.github.io' ?
            '//jquery-file-upload.appspot.com/' : 'profile.php?action=file_upload';

        $('#start')
            .on('click', function () {
                $('#start').attr('disabled',false);
                var $this = $(this),
                    data = $this.data();

                var progress =parseInt(i*100/total);
                $('#progress').css(
                    'width',
                    '0%'
                ).attr(
                    'aria-valuenow',
                    0
                ).html(0 + '%');
                if ($this.data().files != undefined) {

                    $('#pr_status').text('Подождите, идет загрузка...');
                    var total = $this.data().files.length;
                    var i = 0;

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

                            $.ajax({
                                type: "POST",
                                url: "profile.php?action=file_upload",
                                data: response,
                                beforeSend: function () {
                                },
                                success: function(response) {
                                    if (response.status == 1)
                                    {
                                        add_one_image_to_carousel(response.data);
                                        carousel_setFirst_addEvents();
                                        if ($('#start').data().files != undefined) {
                                            $('#start').data().files = undefined;
                                        }
                                        $('#pr_status').text('Файлы успешно загружены!');
                                        $('#photoModal').modal('hide');
                                    }
                                    else
                                    {
                                        alert(response.statusMessage);
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
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {

        if ($('#start').data().files == undefined || $('#start').data().files.length < 5) {

            data.context = $('<tr/>').appendTo('#files');
            $.each(data.files, function (index, file) {

                var node = $('<td/>')
                    .append($('</span>'));
                if (!index) {
                    node
                        .append('<br>');
                }
                node.appendTo(data.context);
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
            });
        }
    }).on('fileuploadprocessalways', function (e, data) {
        if (data.context != undefined) {
            var index = data.index,
                file = data.files[index],
                node = $(data.context.children()[index]);
            if (file.preview) {
                node
                    .prepend('<br>')
                    .prepend(file.preview);
            }
            if (file.error) {
                node
                    .append('<br>')
                    .append($('<span class="text-danger"/>').text(file.error));
            }
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

function add_images_to_carousel(files)
{
    $.each(files, function (i, obj) {
        add_one_image_to_carousel(obj);
    });
    carousel_setFirst_addEvents();
}

function add_one_image_to_carousel(obj)
{
    if (obj.main == 1)
    {
        i = 0;
        $('#car_ol').html('');
        $('#car_inner').html('');
    }
    else
    {
        i = $('#car_ol li').length;
    }
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
        +       'Photo' + (i+1)
        + '</div>'
        + '</div>';
    $('#car_ol').append(content_indi);
    $('#car_inner').append(content_inner);
}

function carousel_setFirst_addEvents()
{
    $('#car_inner .item').first().addClass('active');
    $('#car_indi > li').first().addClass('active');
    $('#carousel-example-generic').carousel('pause');
    $('.carousel_set_main').bind('click', set_main_image);
    $('.carousel_remove').on('click', carousel_image_remove);
    $('a.arrow').addClass('show');
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
        $('#text').val(data.text);
        if (data.country > 0)
        {
            $('#country').val(data.country).change();
        }
        $('#region').attr("val", data.region);
        $('#city').attr("val", data.city);
    }
}

function load_user_images()
{
    $.get('profile.php',
    {
        'action': 'load_user_images',
        'size'  : $('#car_inner').width() + 'x' + Math.round(0.75 * $('#car_inner').width())
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
        $('a.arrow').addClass('hide');
    }
}

function profile_submit()
{
    $('form#formProfile').find('button[type=submit]').attr('disabled','disabled');
    $.post('profile.php',
    {
        'name': $('#name').val(),
        'country': $('#country').val(),
        'region': $('#region').val(),
        'city': $('#city').val(),
        'birthdate': $('#birthdate').val(),
        'sex': $('#sex').val(),
        'phone': $('#phone').val(),
        'text': $('#text').val(),
        'action': 'update_profile_info'
    }, handle_response).error(ajax_error_handler).handler = profile_submit_ajax_handler;

    return false;
}

function profile_submit_ajax_handler(response)
{
    $('form#formProfile').find('button[type=submit]').removeAttr('disabled');
    console.log(response.status);
}

function countries_process(result)
{
    set_option_for_select(result.response.items, '#country', false);
}

function set_option_for_select(response, id_select, is_region)
{
    if (response.length) {
        $(id_select).append('<option value="0">Выберите...</option>');
        $.each(response, function(i, val) {
            $(id_select).append('<option value="'+val.id+'">' + val.title + '</option>');
        });
        $(id_select + '_div').removeClass('hide');
        if ($(id_select).attr('val') > 0)
        {
            $(id_select).val($(id_select).attr('val')).change();
        }
    }
    else if (is_region)  {
        load_cities();
    }
}

function load_regions()
{
    $('#region_div').addClass('hide');
    $('#region').empty();
    $('#city_div').addClass('hide');
    $('#city').empty();
    if ($('#country').val() >= 0)
    {
        addScript('http://api.vk.com/method/database.getRegions?v=' + vk_version
                    + '&need_all=1&offset=0&count=1000&callback=regions_process'
                    + '&country_id=' + $('#country').val());
    }
}

function addScript(src)
{
    var elem = document.createElement("script");
    elem.src = src;
    document.head.appendChild(elem);
}

function regions_process(result)
{
    set_option_for_select(result.response.items, '#region', true);
}

function load_cities()
{
    $('#city_div').addClass('hide');
    $('#city').empty();
    if (!$('#region_div').hasClass('hide') ? $('#region').val() >= 0 : $('#country').val() >= 0)
    {
        addScript('http://api.vk.com/method/database.getCities?v=' + vk_version
                    + '&offset=0&need_all=1&count=1000&callback=cities_process'
                    + '&country_id=' + $('#country').val()
                    + (!$('#region_div').hasClass('hide') ? '&region_id=' + $('#region').val() : ''));
    }
}

function cities_process(result)
{
    set_option_for_select(result.response.items, '#city', false);
}

function count_publishing_cost()
{
    var $form_publish = $('#publishQuestionnaire');
    var publish_days = $form_publish.find('#editPublishDays').val();
    var cost_publish = publish_days * 1;
    var balance = $form_publish.find('#balanceValue').text();
    if (!isInt(publish_days) || parseInt(publish_days) <= 0) {
        alert("Количество дней должно быть целое и положительное!");
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

            var im_id = $($('.item.active').find('img')[0]).attr('id');
            $('.item.active').remove();

            if ($( "#car_inner div:first-child").length < 1) {
                add_images_to_carousel([{url:'/static/img/no-photo.jpg'}]);
                if (!$('#carousel_remove').hasClass('hidden')) {
                    $('#carousel_remove').addClass('hidden');
                }
                if (!$('#carousel_set_main').hasClass('hidden')) {
                    $('#carousel_set_main').addClass('hidden');
                }
            } else {
                $( "#car_inner div:first-child").addClass('active');
            }
            $.ajax({
                type: "POST",
                url: "profile.php?action=file_remove",
                data: {image_id:im_id},
                beforeSend: function () {
                    $('#spinner').modal('show');
                },
                complete: function () {
                    $('#spinner').modal('hide');

                }
            });
        }
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