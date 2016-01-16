var vk_version = '5.5';
    
$(document).ready(function(){

    $('form').submit(profile_click_handler);
    $('#country').change(load_regions);
    $('#region').change(load_cities);
    $('#btnPublishingCost').click(count_publishing_cost);
    $('#editPublishDays').click(show_btn_publishing_cost);
    $('#editPublishDays').change(count_publishing_cost);

    var url = window.location.hostname === 'blueimp.github.io' ?
            '//jquery-file-upload.appspot.com/' : 'profile.php?action=file_upload',
        uploadButton = $('<button/>')
            .addClass('btn btn-primary')
            .prop('disabled', true)
            .text('Processing...')
            .on('click', function () {
                var $this = $(this),
                    data = $this.data();
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
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
        data.context = $('<tr/>').appendTo('#files');
        $.each(data.files, function (index, file) {
            console.log(1);

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
            var node = $('<td/>');
            if (!index) {
                node
                    .append('<br>')
                    .append(uploadButton.clone(true).data(data));
            }
            node.appendTo(data.context);
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
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            if (file.url) {
                var link = $('<a>')
                    .attr('target', '_blank')
                    .prop('href', file.url);
                $(data.context.children()[index])
                    .wrap(link);
            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
        });
    }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index) {
            var error = $('<span class="text-danger"/>').text('Загрузка файла не удалась.');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});


function profile_click_handler()
{
    $.post('profile.php',
        {
            'name': $('#name').val(),
            'birthday': $('#birsday').val(),
            'sex': $('#sex').val(),
            'phoneNumber': $('#phoneNumber').val(),
            'description': $('#description').val(),
            'city': $('#city').val(),
            'go': 'update_profile_info'
        }, handle_response).error(ajax_error_handler).handler = login_ajax_handler;

    return false;
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