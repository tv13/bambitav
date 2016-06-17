<body>

<div id="page-preloader"><span class="spinner"></span></div>

{include file='./inset/header.tpl'}

<link rel="stylesheet" href="{$HTTP_STATIC_PATH}/uploader/css/style.css">
<link rel="stylesheet" href="{$HTTP_STATIC_PATH}/uploader/css/jquery.fileupload.css">

<div class="modal fade" id="needConfirmEmailModal" tabindex="-1" role="dialog" aria-labelledby="confirmEmail">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="confirmEmail">Требуется подтверждение аккаунта</h3>
            </div>
            <div class="modal-body">
                <div>
                    <p>
                        На Ваш email было отправлено письмо.
                        Для подтверждения вашего аккаунта перейдите по ссылке, указанной в письме.
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="wrapper">
    <div class="jumbotron">
        <div class="container container-bambi">
            <div class="row clearfix">
                <div class="col-sm-12 col-md-6 image_content">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel"
                         data-interval="false">
                        <ol id="car_ol" class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox" id="car_inner">
                            <div class="item active no_photo">
                                <div class="carousel-caption">

                                </div>
                            </div>
                        </div>

                        <a class="left carousel-control arrow hide" href="#carousel-example-generic" role="button"
                           data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control arrow hide" href="#carousel-example-generic" role="button"
                           data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <button type="button" id="upload_button" class="btn btn-primary center-block"
                            data-toggle="modal" data-target="#photoModal" data-whatever="@mdo">Загрузить фото
                    </button>
                </div>

                <div class="col-sm-12 col-md-6 clearfix">
                    <form id="formProfile">
                        <fieldset enable>
                            <div class="form-group">
                                <label for="name">Имя*</label>
                                <input type="text" id="name" class="form-control" required>
                            </div>
                            <div class="form-group hide" id="country_div">
                                <label for="country">Страна*</label>
                                <select id="country" class="form-control" required>
                                </select>
                            </div>
                            <div class="form-group hide" id="city_main_div">
                                <label for="city_main">Город*</label>
                                <select id="city_main" class="form-control" required>
                                </select>
                            </div>
                            <div class="form-group hide" id="city_other_div">
                                <label for="city_other">Другой город</label>
                                <input type="text" id="city_other" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="birthdate">Дата рождения*</label>
                                <input type="date" id="birthdate" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="sex">Пол*</label>
                                <select id="sex" class="form-control" required>
                                    <option value="">Не указан</option>
                                    <option value="m">Мужской</option>
                                    <option value="f">Женский</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="phone">Номер телефона</label>
                                <input type="text" id="phone" class="form-control input-medium" data-format="+3 8(0dd) ddd-dddd">
                            </div>
                            <div class="form-group">
                                <label for="purpose">Цель знакомства*</label>
                                <select id="purpose" class="form-control" required>
                                    <option value="">Выберите...</option>
                                    {foreach $purposes_dating as $purpose}
                                        <option value="{$purpose@key}">{$purpose}</option>
                                    {/foreach}
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text">Текст объявления*</label>
                                <textarea class="form-control" id="text" rows="3" required></textarea>
                            </div>
                            <div id="alert_placeholder_form" class="custom_alert">
                            </div>
                            <button type="submit" class="btn btn-primary" id="send_data" disabled>Сохранить</button>
                            <button type="button" class="btn btn-success hide" data-toggle="modal"
                                    data-target="#publishQuestionnaire">Разместить анкету
                            </button>
                        </fieldset>
                    </form>
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
                        <span class="btn btn-success fileinput-button">
                            <i class="glyphicon glyphicon-plus"></i>
                            <span>Добавить изображения...</span>
                            <input id="fileupload" type="file" name="files[]" multiple>
                        </span>
                                <button type="submit" class="btn btn-primary" id="start">
                                    <i class="glyphicon glyphicon-upload"></i>
                                    <span>Start upload</span>
                                </button>
                                <br>
                                <br>
                                <p id="pr_status"></p>
                                <div class="progress">
                                    <div id="progress" class="progress-bar progress-bar-striped active" role="progressbar"
                                         aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                        <span class="sr-only">0%</span>
                                    </div>
                                </div>
                                <div class="container">
                                    <div id="alert_placeholder_image" class="custom_alert">
                                    </div>
                                    <table role="presentation" class="table table-striped table_photo_upload">
                                        <tbody class="files" id="files"></tbody>
                                    </table>

                                    <br>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

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
                                    <div id="alert_placeholder_days" class="custom_alert">
                                    </div>
                                    <button id="btnPublishingCost" type="button" class="btn btn-primary">Расчитать</button>
                                    <button id="btnPublish" type="button" class="btn btn-primary hide">Разместить</button>
                                    <button id="btnRefillBalance" type="button" class="btn btn-primary hide">Пополнить
                                    </button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-push"></div>
</div>
{include file='./inset/bottom.tpl'}
<script src="//i.onthe.io/u.js?{$IMAGES_APP}_24135782"></script>
<script src="{$HTTP_STATIC_PATH}/uploader/js/vendor/jquery.ui.widget.js"></script>
<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<script src="{$HTTP_STATIC_PATH}/uploader/js/jquery.iframe-transport.js"></script>
<script src="{$HTTP_STATIC_PATH}/uploader/js/jquery.fileupload.js"></script>
<script src="{$HTTP_STATIC_PATH}/uploader/js/jquery.fileupload-process.js"></script>
<script src="{$HTTP_STATIC_PATH}/uploader/js/jquery.fileupload-image.js"></script>
<script src="{$HTTP_STATIC_PATH}/uploader/js/jquery.fileupload-validate.js"></script>
<script src="{$HTTP_STATIC_PATH}/js/vk.js"></script>
<script src="{$HTTP_STATIC_PATH}/js/bootstrap-formhelpers-phone.js"></script>
<script src="{$HTTP_STATIC_PATH}/js/bootstrap-formhelpers-datepicker.js"></script>
<script src="{$HTTP_STATIC_PATH}/js/bootstrap-formhelpers-datepicker.en_US.js"></script>
<script src="{$HTTP_STATIC_PATH}/js/profile.js"></script>
<script src="http://api.vk.com/method/database.getCountries?v=5.5&need_all=1&count=1000&callback=countries_process"></script>