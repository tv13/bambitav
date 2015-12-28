$(document).ready(function(){

	
$('form').submit(login_click_handler);
});

function login_click_handler()
{
    $.post('profile.php',
    {
        'name': $('#name').val(),
        'birthday': $('#birsday').val(),
        'sex': $('#sex').val(),
        'phoneNumber': $('#phoneNumber').val(),
        'description': $('#description').val(),
        'go': 'update_profile_info'
    }, handle_response).error(ajax_error_handler).handler = login_ajax_handler;
    
    return false;
}