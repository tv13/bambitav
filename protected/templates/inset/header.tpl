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
<script src="{$HTTP_STATIC_PATH}/js/common.js" type="text/javascript"></script>

</head>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Start Bootstrap</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <form id="login_form" class="navbar-form navbar-right">
                        <div class="form-group">
                          <input type="text" id="emailLogin" name="email" placeholder="Email" class="form-control">
                        </div>
                        <div class="form-group">
                          <input type="password" name="password" id="passwordLogin" placeholder="Password" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Sign in</button>
                        
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Registration</button>

                        <a href="profile.php" class="btn btn-primary" role="button">Profile</a>
                    </form>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
            
            

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Registration</h4>
      </div>
        <div class="modal-body">
                            <form role="form" id="register_form">
            <div class="form-group">

                                <label for="exampleInputEmail1">
                                        Email
                                </label>
                                <input name="email" class="form-control" id="registerEmail" type="email" required />
                            </div>
                            <div class="form-group">

                                <label for="exampleInputPassword1">
                                        Пароль
                                </label>
                                <input name="password" class="form-control" id="registerPassword" type="password" required />
                            </div>
                            <div class="form-group">
                                <input id="exampleInputCaptcha" type="hidden" />
                            </div>
                                      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </form>
  </div>

    </div>
  </div>
</div>
    

