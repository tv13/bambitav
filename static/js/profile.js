$(document).ready(function(){

    load_countries();
    $('form').submit(profile_click_handler);
});

function profile_click_handler()
{
    $.post('profile.php',
    {
        'name': $('#name').val(),
        'birthday': $('#birsday').val(),
        'sex': $('#sex').val(),
        'phoneNumber': $('#phoneNumber').val(),
        'description': $('#description').val(),
        'city': $('#city').val(),
        'go': 'update_profile_info'
    }, handle_response).error(ajax_error_handler).handler = login_ajax_handler;
    
    return false;
}

function load_countries()
{
    $.get('vk.php?action=get_countries'
    , handle_response).error(ajax_error_handler).handler = load_countries_ajax_handler;
}

function load_countries_ajax_handler(response)
{
    console.log(response);
}