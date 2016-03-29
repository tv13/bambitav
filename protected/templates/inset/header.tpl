<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>2 Col Portfolio - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->

    <!-- Custom CSS -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="{$HTTP_STATIC_PATH}/css/app.css"/>
    <link rel="stylesheet" type="text/css" href="{$HTTP_STATIC_PATH}/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="{$HTTP_STATIC_PATH}/css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" type="text/css" href="{$HTTP_STATIC_PATH}/css/jquery-ui.min.css"/>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="{$HTTP_STATIC_PATH}/js/alert_custom.js"></script>
    <script src="{$HTTP_STATIC_PATH}/js/common.js" type="text/javascript"></script>
    <script src="{$HTTP_STATIC_PATH}/js/recaptcha.js" type="text/javascript"></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=ReCaptchaCallback&render=explicit&hl=ru" async defer></script>
</head>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->


        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./">Bambi site</a>
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
                    <button type="button" id="filter_btn" class="btn btn-primary bambi_high" data-toggle="modal"
                            data-target="#filterModal" data-whatever="@mdo">Фильтр
                    </button>
                </li>


            </ul>


        </div>


        <!-- Collect the nav links, forms, and other content for toggling -->

        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>


<div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Registration</h4>
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                <h4 class="modal-title" id="exampleModalLabel">Login</h4>
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                <h4 class="modal-title" id="exampleModalLabel">Filter</h4>
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
                        <!--<div class="form-group hide" id="region_filter_div">
                            <label for="region_filter">Область</label>
                            <select id="region_filter" class="filter form-control">
                            </select>
                        </div>-->
                        <div class="form-group hide" id="city_filter_div">
                            <label for="city_filter">Город</label>
                            <select id="city_filter" class="filter form-control">
                            </select>
                        </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label for="age_min_filter">
                                Min age
                            </label>
                            <input id="age_min_filter" class="filter form-control" type="text" />
                        </div>
                        <div class="col-md-6">
                            <label for="age_max_filter">
                                Max age
                            </label>
                            <input id="age_max_filter" class="filter form-control" type="text" />
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
