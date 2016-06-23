///////////////////////////////////////////////////////////////////////////

function handle_response(data, status, jqXHR)
{
    try
    {
        var response = eval(data);

        if (!dispatch_session_expiration(response) && !dispatch_exception(response))
        {
            jqXHR.handler(response);
        }
    }
    catch ($e)
    {
        alert($e);
    }
}
////////////////////////////////////////////////////////////////////////////

function ajax_error_handler(jqXHR, textStatus, errorThrown)
{
    return false;
}
///////////////////////////////////////////////////////////////////////////

var isInt = function(n) { return /^-?[0-9]+$/.test(n) };
////////////////////////////////////////////////////////////////////////////

function dispatch_session_expiration(response)
{
    if (response.status == -1)
    {
        //window.location.href = '';
        return true;
    }
    return false;
}
////////////////////////////////////////////////////////////////////////////

function dispatch_exception(response)
{
}
////////////////////////////////////////////////////////////////////////////

function preloader_show() {
    var $preloader = $('#page-preloader'),
        $spinner   = $preloader.find('.spinner');
    $spinner.fadeIn();
    $preloader.fadeIn('slow');
}

function preloader_hide() {
    var $preloader = $('#page-preloader'),
        $spinner   = $preloader.find('.spinner');
    $spinner.fadeOut();
    $preloader.fadeOut('slow');
}
////////////////////////////////////////////////////////////////////////////