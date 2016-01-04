<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bootstrap 3, from LayoutIt!</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    {include file='inset/header.tpl'}

  </head>
  <body>

    {include file='inset/header_body.tpl'}
      
    <div class="jumbotron">
        <div class="container-fluid">
                <div class="row">
                        <div class="col-md-12">
                                <h3>
                                    Регистрация
                                </h3>
                                <form role="form" method="post">
                                        <div class="form-group">

                                                <label for="exampleInputEmail1">
                                                        Email
                                                </label>
                                                <input name="email" class="form-control" id="exampleInputEmail1" type="email" required />
                                        </div>
                                        <div class="form-group">

                                                <label for="exampleInputPassword1">
                                                        Пароль
                                                </label>
                                                <input name="password" class="form-control" id="exampleInputPassword1" type="password" required />
                                        </div>
                                        <div class="form-group">

                                                <input id="exampleInputCaptcha" type="hidden" />
                                        </div>
                                        <button type="submit" class="btn btn-default">
                                                Зарегистрироваться
                                        </button>
                                </form>
                        </div>
                </div>
        </div>
        
        {include file='inset/header.tpl'}

    </div> <!-- /container -->

    <script src="{$HTTP_STATIC_PATH}/js/jquery.min.js"></script>
    <script src="{$HTTP_STATIC_PATH}/libs/bootstrap/js/bootstrap.min.js"></script>
    <script src="{$HTTP_STATIC_PATH}/js/profile.js"></script>
  </body>
</html>