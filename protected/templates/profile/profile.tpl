<body>

{include file='./inset/header.tpl'}
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<!-- Generic page styles -->
<link rel="stylesheet" href="{$HTTP_STATIC_PATH}/uploader/css/style.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="{$HTTP_STATIC_PATH}/uploader/css/jquery.fileupload.css">
<div class="jumbotron">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Heading</h2>
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel"
                             data-interval="false">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                    <img src="http://placehold.it/600x600" alt="">
                                    <div class="carousel-caption">
                                        Photo1
                                    </div>
                                </div>
                                <div class="item">
                                    <img src="http://placehold.it/600x600" alt="">
                                    <div class="carousel-caption">
                                        Photo2
                                    </div>
                                </div>
                                <div class="item">
                                    <img src="http://placehold.it/600x600" alt="">
                                    <div class="carousel-caption">
                                        Photo3
                                    </div>
                                </div>
                            </div>

                            <!-- Controls -->
                            <a class="left carousel-control" href="#carousel-example-generic" role="button"
                               data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" role="button"
                               data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h2>Heading</h2>
                <form onsubmit="return false">
                    <fieldset enable>
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input type="text" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="city">Город</label>
                            <input type="text" id="city" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="birsday">Дата рождения</label>
                            <input type="date" id="birsday" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="sex">Пол</label>
                            <select id="sex" class="form-control" required>
                                <option value="">Не указан</option>
                                <option value="m">Мужской</option>
                                <option value="f">Женский</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="phoneNumber">Номер телефона</label>
                            <input type="text" id="phoneNumber" class="form-control" required>

                        </div>
                        <div class="form-group">
                            <label for="description">Текст объявления</label>
                            <textarea class="form-control" id="description" rows="3"></textarea>
                        </div>
                        <div class="container">
                        <span class="btn btn-success fileinput-button">
                            <i class="glyphicon glyphicon-plus"></i>
                            <span>Добавить изображения...</span>
                            <!-- The file input field used as target for the file upload widget -->
                            <input id="fileupload" type="file" name="files[]" multiple>
                        </span>
                            <br>
                            <br>
                            <!-- The global progress bar -->
                            <div id="progress" class="progress">
                                <div class="progress-bar progress-bar-success"></div>
                            </div>
                            <!-- The container for the uploaded files -->
                            <table role="presentation" class="table table-striped">
                                <tbody class="files" id="files"></tbody>
                            </table>
                            <br>
                        </div>
                        <hr>

            </div> <!-- /container -->

            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
            <script src="{$HTTP_STATIC_PATH}/uploader/js/vendor/jquery.ui.widget.js"></script>
            <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
            <script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
            <!-- The Canvas to Blob plugin is included for image resizing functionality -->
            <script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
            <!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
            <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
            <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
            <script src="{$HTTP_STATIC_PATH}/uploader/js/jquery.iframe-transport.js"></script>
            <!-- The basic File Upload plugin -->
            <script src="{$HTTP_STATIC_PATH}/uploader/js/jquery.fileupload.js"></script>
            <!-- The File Upload processing plugin -->
            <script src="{$HTTP_STATIC_PATH}/uploader/js/jquery.fileupload-process.js"></script>
            <!-- The File Upload image preview & resize plugin -->
            <script src="{$HTTP_STATIC_PATH}/uploader/js/jquery.fileupload-image.js"></script>
            <!-- The File Upload validation plugin -->
            <script src="{$HTTP_STATIC_PATH}/uploader/js/jquery.fileupload-validate.js"></script>
            <script>
                /*jslint unparam: true, regexp: true */
                /*global window, $ */
                $(function () {
                    'use strict';
                    // Change this to the location of your server-side upload handler:
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
            </script>
            <button type="submit" class="btn btn-primary">Сохранить</button>
            </fieldset>
            </form>
        </div>
    </div>
</div>
<hr>
{include file='./inset/bottom.tpl'}