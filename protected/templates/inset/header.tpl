<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bambitax</title>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="{$HTTP_STATIC_PATH}/css/app.css"/>
    <link rel="stylesheet" type="text/css" href="{$HTTP_STATIC_PATH}/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="{$HTTP_STATIC_PATH}/css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" type="text/css" href="{$HTTP_STATIC_PATH}/css/jquery-ui.min.css"/>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
	<script src="{$HTTP_STATIC_PATH}/js/googleanalitics.js"></script>
    <script src="{$HTTP_STATIC_PATH}/js/alert_custom.js"></script>
    <script src="{$HTTP_STATIC_PATH}/js/common.js" type="text/javascript"></script>
    <script src="{$HTTP_STATIC_PATH}/js/recaptcha.js" type="text/javascript"></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=ReCaptchaCallback&render=explicit&hl=ru" async defer></script>
</head>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" style="font-family: cursive;font-size: 250%;" href="./">Bambitax</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


            <ul class="nav navbar-nav navbar-right">
                <li>
                    <button type="button" id="sign_in" class="btn btn-primary bambi_high" data-toggle="modal"
                            data-target="#loginModal" data-whatever="@mdo" {if $is_logged}style="display:none"{/if}>Войти
                    </button>
                </li>
                <li>
                    <button type="button" id="log_out" class="btn btn-primary bambi_high"
                            {if !$is_logged}style="display:none"{/if}>Выйти
                    </button>
                </li>
                <li>
                    <button type="button" id="registration_btn" class="btn btn-primary bambi_high" data-toggle="modal"
                            data-target="#registrationModal" data-whatever="@mdo"
                            {if $is_logged}style="display:none"{/if}>Регистрация
                    </button>
                </li>
                <li>
                    <button type="button" id="profile_btn" class="btn btn-primary bambi_high"
                            {if !$is_logged}style="display:none"{/if}>Профиль
                    </button>
                </li>
                <li>
                    <button type="button" id="filter_btn" class="btn btn-primary bambi_high hide" data-toggle="modal"
                            data-target="#filterModal" data-whatever="@mdo">Фильтр
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>


<div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Регистрация</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="register_form">
                    <div id="alert_placeholder_r">
                    </div>
                    <div class="form-group">
                        <label for="registerEmail">
                            Email
                        </label>
                        <input name="email" class="form-control" id="registerEmail" type="email" required/>
                    </div>
                    <div class="form-group">
                        <label for="registerPassword">
                            Пароль
                        </label>
                        <input name="password" class="form-control" id="registerPassword" type="password" required/>
                    </div>
                    <div class="form-group">
                        <label for="registerPasswordConfirm">
                            Подтверждение пароля
                        </label>
                        <input name="passwordConfirm" class="form-control" id="registerPasswordConfirm" type="password"
                               required/>
                    </div>
                    <div class="form-group" id="recaptcha_registration"></div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="register" disabled>Зарегистрироваться</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Войти</h4>
            </div>
            <div class="modal-body">
                    <div id="alert_placeholder">
                    </div>
                <form role="form" id="login_form">
                    <div class="form-group">

                        <label for="exampleInputEmail1">
                            Email
                        </label>
                        <input name="email" class="form-control" id="emailLogin" type="email" required/>
                    </div>
                    <div class="form-group">

                        <label for="exampleInputPassword1">
                            Пароль
                        </label>
                        <input name="password" class="form-control" id="passwordLogin" type="password" required/>
                    </div>
                    <div class="form-group">
                        <input id="exampleInputCaptcha" type="hidden"/>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="login" disabled>Войти</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
    

<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Фильтр</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="filter_form">
                    <div id="alert_placeholder_r">
                    </div>
                        <div class="form-group hide" id="country_filter_div">
                            <label for="country_filter">Страна</label>
                            <select id="country_filter" class="filter form-control" required>
                            </select>
                        </div>
                        <div class="form-group hide" id="city_filter_div">
                            <label for="city_filter">Город</label>
                            <select id="city_filter" class="filter form-control">
                            </select>
                        </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label for="age_min_filter">
                                Возраст от
                            </label>
                            <input id="age_min_filter" min="18" max="100" type="number" class="filter form-control"/>
                        </div>
                        <div class="col-md-6">
                            <label for="age_max_filter">
                                до
                            </label>
                            <input id="age_max_filter" min="18" max="100" type="number" class="filter form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sex_filter">Пол</label>
                        <select id="sex_filter" class="filter form-control">
                            <option value="">Не указан</option>
                            <option value="m">Мужской</option>
                            <option value="f">Женский</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="purpose_filter">Цель знакомства</label>
                        <select id="purpose_filter" class="filter form-control">
                            <option value="0">Не указана</option>
                            {foreach $purposes_dating as $purpose}
                                <option value="{$purpose@key}">{$purpose}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="form-group checkbox">
                        <label>
                            <input id="with_photo_filter" type="checkbox" class="filter" />
                            Только с фото
                        </label>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Применить</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="pp" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="pp-header modal-header">
                <h3> Вам уже есть 18?</h3>
            </div>
            <div class="pp-footer modal-footer">
                <input type="button" class="btn btn-danger" value="Нет" id="18_years_false" />
                <input type="button"  class="btn btn-success" value="Да" id="18_years_true" />
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="resultCheckEmailModal" tabindex="-1" role="dialog" aria-labelledby="successConfirmEmail">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="successConfirmEmail">
                    Активация аккаунта
                </h4>
            </div>
            <div class="modal-body">
                <div>
                    <p class="check_email_success hide">
                        Поздравляем! Вы успешно активировали свой аккаунт!
                    </p>
                    <p class="check_email_fail hide">
                        Не удалось активировать Ваш аккаунт. Повторите попытку позже.
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>

<div id="pp-bg"></div>