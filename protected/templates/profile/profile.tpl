<body>

{include file='./inset/header.tpl'}

<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="{$HTTP_STATIC_PATH}/uploader/js/vendor/jquery.ui.widget.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
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
<script src="{$HTTP_STATIC_PATH}/js/profile.js"></script>

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
                        <div class="form-group not_visible">
                            <label for="country">Страна</label>
                            <select id="country" class="form-control" required>
                            </select>
                        </div>
                        <div class="form-group not_visible">
                            <label for="region">Область</label>
                            <select id="region" class="form-control" required>
                            </select>
                        </div>
                        <div class="form-group not_visible">
                            <label for="city">Город</label>
                            <select id="city" class="form-control" required>
                            </select>
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
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </fieldset>
                </form>

            </div> <!-- /container -->
            <script>
            </script>
        </div>
    </div>
</div>
<hr>
{include file='./inset/bottom.tpl'}