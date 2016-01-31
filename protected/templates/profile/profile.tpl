<body>

{include file='./inset/header.tpl'}

<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<!-- Generic page styles -->
<link rel="stylesheet" href="{$HTTP_STATIC_PATH}/uploader/css/style.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="{$HTTP_STATIC_PATH}/uploader/css/jquery.fileupload.css">
<style>
    .carousel-inner > .item {
        height: 500px;
    }
</style>
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
                            <ol id="car_ol" class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox" id="car_inner">
                                <div class="item active">
                                    <img src="{$HTTP_STATIC_PATH}/img/no-photo.jpg" alt="">
                                    <div class="carousel-caption">
                                        Photo
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
                            <a class="carousel-control top" href="#" role="button"
                               data-slide="next" id="carousel_remove">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true">Удалить</span>
                                <span class="sr-only">Remove</span>
                            </a>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <button type="button" id="upload_button" class="btn btn-primary center-block"
                                data-toggle="modal" data-target="#photoModal" data-whatever="@mdo">Загрузить фото
                        </button>
                    </div>
                </div>


                <div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel">Upload photo</h4>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                        <span class="btn btn-success fileinput-button">
                            <i class="glyphicon glyphicon-plus"></i>
                            <span>Добавить изображения...</span>
                            <!-- The file input field used as target for the file upload widget -->
                            <input id="fileupload" type="file" name="files[]" multiple>
                        </span>
                                    <button type="submit" class="btn btn-primary" id="start">
                                        <i class="glyphicon glyphicon-upload"></i>
                                        <span>Start upload</span>
                                    </button>
                                    <br>
                                    <br>
                                    <!-- The global progress bar -->
                                    <p id="pr_status"></p>
                                    <div class="progress">
                                        <div id="progress" class="progress-bar progress-bar-striped active" role="progressbar"
                                             aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                            <span class="sr-only">0%</span>
                                        </div>
                                    </div>
                                    <!-- The container for the uploaded files -->
                                    <table role="presentation" class="table table-striped">
                                        <tbody class="files" id="files"></tbody>
                                    </table>

                                    <br>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
            <div class="col-md-6">
                <h2>Heading</h2>
                <form id="formProfile">
                    <fieldset enable>
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input type="text" id="name" class="form-control" required>
                        </div>
                        <div class="form-group hide" id="country_div">
                            <label for="country">Страна</label>
                            <select id="country" class="form-control" required>
                            </select>
                        </div>
                        <div class="form-group hide" id="region_div">
                            <label for="region">Область</label>
                            <select id="region" class="form-control">
                            </select>
                        </div>
                        <div class="form-group hide" id="city_div">
                            <label for="city">Город</label>
                            <select id="city" class="form-control">
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="birthdate">Дата рождения</label>
                            <input type="date" id="birthdate" class="form-control" required>
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
                            <label for="phone">Номер телефона</label>
                            <input type="text" id="phone" class="form-control" required>

                        </div>
                        <div class="form-group">
                            <label for="text">Текст объявления</label>
                            <textarea class="form-control" id="text" rows="3"></textarea>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                        <button type="button" class="btn btn-success" data-toggle="modal"
                                data-target="#publishQuestionnaire">Разместить анкету
                        </button>
                    </fieldset>
                </form>


            </div> <!-- /container -->

            <!-- publish questionnaire -->
            <div class="modal fade" id="publishQuestionnaire" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Размещение анкеты</h4>
                        </div>
                        <div class="modal-body">
                            <h4>
                                Ваш баланс составляет <span id="balanceValue">{$balance_value}</span> <span
                                        id="balanceCurrency"></span>
                            </h4>
                            <!--<form role="form" id="publish_form">-->
                            <div class="form-group">
                                <label for="publishDays">
                                    Укажите количество дней, на которое Вы хотите разместить анкету
                                </label>
                                <input name="namePublishDays" class="form-control" id="editPublishDays" type="text"
                                       required/>
                                <p id="costBlock" class="modal-title hide">Стоимость: <span id="costValue"></span> <span
                                            id="costCurrency"></span></p>
                                <p id="needPayBlock" class="modal-title hide">Для размещения анкеты на <span
                                            id="txtPublishDays"></span> дня(ей) Вы должны пополнить свой баланс на <span
                                            id="needPayValue"></span> <span id="needPayCurrency"></span></p>
                            </div>
                            <div class="modal-footer">
                                <button id="btnPublishingCost" type="button" class="btn btn-primary">Расчитать</button>
                                <button id="btnPublish" type="button" class="btn btn-primary hide">Разместить</button>
                                <button id="btnRefillBalance" type="button" class="btn btn-primary hide">Пополнить
                                </button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                            <!--</form>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
{include file='./inset/bottom.tpl'}
<script src="//i.onthe.io/u.js?wjfkb8_24135782"></script>
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
<script src="http://api.vk.com/method/database.getCountries?v=5.5&need_all=1&count=1000&callback=countries_process"></script>