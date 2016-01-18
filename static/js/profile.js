var vk_version = '5.5';
    
$(document).ready(function(){

    load_profile_data();
    $('form#formProfile').submit(profile_submit);
    $('#country').change(load_regions);
    $('#region').change(load_cities);
    $('#btnPublishingCost').click(count_publishing_cost);
    $('#editPublishDays').click(show_btn_publishing_cost).change(count_publishing_cost);

    var url = window.location.hostname === 'blueimp.github.io' ?
            '//jquery-file-upload.appspot.com/' : 'profile.php?action=file_upload';
        $('#start')
            .on('click', function () {
                var $this = $(this),
                    data = $this.data();

                $.ajax({
                    type: "POST",
                    url: "profile.php?action=file_upload",
                    data: {"key":"wjfkb87ulito8hst8","size":"259x194","face":null,"full_size":"https:\/\/i.onthe.io\/wjfkb87ulito8hst8.3cc55de8.jpg","uploaded_before":true},
                    beforeSend: function () {
                        $('#spinner').modal('show');
                    },
                    complete: function () {
                        $('#spinner').modal('hide');
                    }
                });
                $($this.data().files).each(function( index, elem ) {
                        /*io_upload(elem, function(r) {
                        console.log(r);
                    });*/

                });
                $this
                    .off('click')
                    .text('Abort')
                    .on('click', function () {
                        $this.remove();
                        data.abort();
                    });
                data.submit().always(function () {
                    $this.remove();
                });
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
        });
    }).on('fileuploadprocessalways', function (e, data) {
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
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Загрузить')
                .prop('disabled', !!data.files.error);
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
        $('#birsday').val(data.birsday);
        $('#sex').val(data.sex);
        $('#phoneNumber').val(data.phone);
        //$('#description').val();
        $('#country').val(data.country).change();
        $('#region').val();
        $('#city').val();
    }
}

function profile_submit()
{
    $.post('profile.php',
    {
        'name': $('#name').val(),
        'birthday': $('#birsday').val(),
        'sex': $('#sex').val(),
        'phone': $('#phoneNumber').val(),
        'description': $('#description').val(),
        'country': $('#country').val(),
        'region': $('#region').val(),
        'city': $('#city').val(),
        'action': 'update_profile_info'
    }, handle_response).error(ajax_error_handler).handler = profile_submit_ajax_handler;

    return false;
}

function profile_submit_ajax_handler()
{
    console.log('Jrssssssssss');
}

function countries_process(result)
{
    set_option_for_select(result.response.items, '#country', false);
}

function set_option_for_select(response, id_select, is_region)
{
    if (response.length) {
        $(id_select).append('<option value="-1">Выберите...</option>');
        $.each(response, function(i, val) {
            $(id_select).append('<option value="'+val.id+'">' + val.title + '</option>');
        });
        $(id_select + '_div').removeClass('hide');
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