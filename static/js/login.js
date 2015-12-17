function login_page_init()
{
    $('form').submit(login_click_handler);
}

function login_ajax_handler(response)
{
    if (response.error == 0)
    {
        window.location.href = response.url;
    }
}

function login_click_handler()
{
    $.post('login.php',
    {
        'ldap': $(this).find('input[name="login"]').val(),
        'password': $(this).find('input[name="password"]').val(),
        'go': 'login'
    }, handle_response).error(ajax_error_handler).handler = login_ajax_handler;
    
    return false;
}