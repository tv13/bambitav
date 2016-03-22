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
                <div id="carousel-example-generic" class="carousel slide no-control" data-ride="carousel"
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
                <table class="table table-striped" id="profile_content" data-profile_id="{$id}">
                    <tr>
                        <td><b>Имя</b></td>
                        <td><span id="name"></span></td>
                    </tr>
                    <tr>
                        <td><b>Страна</b></td>
                        <td><span id="country">Страна не указана</span></td>
                    </tr>
                    <tr>
                        <td><b>Город</b></td>
                        <td><span id="city">Город не указан</span></td>

                    </tr>
                    <tr>
                        <td><b>Дата рождения</b></td>
                        <td><span id="age"></span></td>

                    </tr>
                    <tr>
                        <td><b>Пол</b></td>
                        <td><span id="sex"></span></td>
                    </tr>
                    <tr>
                        <td><b>Номер телефона</b></td>
                        <td><span id="phone"></span></td>

                    </tr>
                    <tr>
                        <td><b>Текст объявления</b></td>
                        <td><span id="text"></span></td>

                    </tr>
                </table>
            </div> <!-- /container -->
        </div>
    </div>
</div>
<hr>
{include file='./inset/bottom.tpl'}
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- The File Upload validation plugin -->
<script src="{$HTTP_STATIC_PATH}/js/vk.js"></script>
<script src="{$HTTP_STATIC_PATH}/js/profile_base.js"></script>
<script src="{$HTTP_STATIC_PATH}/js/user_profile.js"></script>