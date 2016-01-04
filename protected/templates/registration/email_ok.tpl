<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bootstrap 3, from LayoutIt!</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    {include file='inset/include.tpl'}

  </head>
  <body>

    {include file='inset/header.tpl'}
      
    <div class="jumbotron">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h3>
                            Поздравляем! Вы успешно зарегистрировались.
                    </h3>
                    <p>
                            Для дальнейшей работы авторизируйтесь в системе.
                    </p>
                    <button type="button" onclick="window.location.href='{$HTTP_ABS_PATH}/login.php'" class="btn btn-primary">
                            Авторизация
                    </button>
                </div>
            </div>
        </div>
    
    {include file='inset/header.tpl'}

    </div>

    <script src="{$HTTP_STATIC_PATH}/js/jquery.min.js"></script>
    <script src="{$HTTP_STATIC_PATH}/libs/bootstrap/js/bootstrap.min.js"></script>
    <script src="{$HTTP_STATIC_PATH}/js/profile.js"></script>
  </body>
</html>