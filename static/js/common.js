///////////////////////////////////////////////////////////////////////////

function handle_response(data, status, jqXHR)
{
    try
    {
        eval("var response ="+data);

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
////////////////////////////////////////////////////////////////////////////
