<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
        {include file="inset/header.tpl"}
        {js_init function="login_page_init"}
        <script src="{$HTTP_STATIC_PATH}/js/login.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="wapper">
            <div class="content">
                <div class="login_body">
                    <span class="login_body auth_head">
                        <h1>Аутентификация</h1>
                    </span>
                    <form action="" method="POST">
                        <label for="login">Login: </label><input type="text" name="login"/><br/>
                        <label for="password">Password: </label><input type="password" name="password"/><br/>
                        <span id="error_message"></span>
                        <button id="submit">Вход</button>
                        <input type="hidden" name="go" value="login"/>
                    </form>
                </div>
            </div>
        </div>
        {include file="inset/debug.tpl"}
    </body>
</html>