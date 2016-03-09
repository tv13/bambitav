<body>

<div id="page-preloader"><span class="spinner"></span></div>

{include file='./inset/header.tpl'}

<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<!-- Generic page styles -->

<div class="jumbotron">
    <div class="container">
        <div class="row clearfix">
            <div class="col-sm-12 col-md-6 image_content">
                <h2>Heading</h2>
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel"
                     data-interval="false">
                    <!-- Indicators -->
                    <ol id="car_ol" class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox" id="car_inner">
                        <div class="item active no_photo">
                            <div class="carousel-caption">

                            </div>
                        </div>
                    </div>

                    <!-- Controls -->
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
            </div>

            <div class="col-sm-12 col-md-6 clearfix jumbotron">
                <h2>Heading</h2>
                <form id="formProfile">
                    <fieldset disabled>
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input type="text" id="name" class="form-control" required>
                        </div>
                        <div class="form-group hide" id="country_div">
                            <label for="country">Страна</label>
                            <select id="country" class="form-control" required>
                            </select>
                        </div>
                        <div class="form-group hide" id="city_main_div">
                            <label for="city_main">Город</label>
                            <select id="city_main" class="form-control" required>
                            </select>
                        </div>
                        <div class="form-group hide" id="city_other_div">
                            <label for="city_other">Другой город</label>
                            <input type="text" id="city_other" class="form-control">
                        </div>
                        <!--<div class="form-group hide" id="region_div">
                            <label for="region">Область</label>
                            <select id="region" class="form-control">
                            </select>
                        </div>-->

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
                            <textarea class="form-control" id="text" rows="3" required></textarea>
                        </div>
                        <div id="alert_placeholder_form" class="custom_alert">
                        </div>
                    </fieldset>
                </form>
            </div> <!-- /container -->
        </div>
    </div>
</div>
<hr>
{include file='./inset/bottom.tpl'}
<script src="//i.onthe.io/u.js?{$IMAGES_APP}_24135782"></script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- The File Upload validation plugin -->
<script src="{$HTTP_STATIC_PATH}/js/vk.js"></script>
<script src="{$HTTP_STATIC_PATH}/js/user_profile.js"></script>
<script src="http://api.vk.com/method/database.getCountries?v=5.5&need_all=1&count=1000&callback=countries_process"></script>