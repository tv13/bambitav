<body>

<div id="page-preloader"><span class="spinner"></span></div>

{include file='./inset/header.tpl'}


<div class="wrapper">
    <div class="jumbotron" style="margin-top:40px;">
        <div class="container">
            <div class="row clearfix">
                <div class="col-sm-12 col-md-6 image_content">
                    <div id="carousel-example-generic" class="carousel slide no-control" data-ride="carousel"
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
					
					

					
                </div>

                <div class="col-sm-12 col-md-6 clearfix jumbotron">
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
                            <td><span id="phone" class="bfh-phone" data-format="+3 (0dd) ddd-dddd" data-number="38055555555"></span></td>

                        </tr>
                        <tr>
                            <td><b>Цель знакомства</b></td>
                            <td><span id="purpose"></span></td>
                        </tr>
                        <tr>
                            <td><b>Текст объявления</b></td>
                            <td><span id="text"></span></td>
                        </tr>
                    </table>

            </div>
								            <div class="row clearfix">
                <div class="col-sm-12 col-md-6 clearfix jumbotron">
                    <form id="form_contact">
                        <fieldset enable>
                            <div class="form-group">
                                <label for="contact_email">Ваш Email</label>
                                <input type="text" id="contact_email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="contact_text">Текст сообщение</label>
                                <textarea class="form-control" id="contact_text" rows="3" required></textarea>
                            </div>
                            <div class="form-group" id="recaptcha_contact"></div>
							           
                    <div id="alert_placeholder_contact_form" class="custom_alert">
                    </div>
                            <button type="submit" class="btn btn-primary">Отправить сообщение</button>
                        </fieldset>
                    </form>
					         </div>
                        </div>
        </div>
    </div>
</div>
{include file='./inset/footer.tpl'}
{include file='./inset/bottom.tpl'}
<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<script src="{$HTTP_STATIC_PATH}/js/vk.js"></script>
<script src="{$HTTP_STATIC_PATH}/js/bootstrap-formhelpers-phone.js"></script>
<script src="{$HTTP_STATIC_PATH}/js/profile_base.js"></script>
<script src="{$HTTP_STATIC_PATH}/js/user_profile.js"></script>