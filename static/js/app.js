$(document).ready(function(){
    $('#login_form').submit(login_click_handler);
    $('#register_form').submit(register_click_handler);
    $('#log_out').click(logout_click_handler);
    $('#profile_btn').click(profile_click_handler);
});

function login_click_handler()
{
    $.ajax({
        url:"login.php",
        type:"POST",
        data:{
             'email': $('#emailLogin').val(),
             'password':$('#passwordLogin').val()
        },
        beforeSend: function () {

        },
        success: function(data){
            if(data.status == 1)
            {
                $('#loginModal').modal('hide')
                $('#sign_in').hide();
                $('#registration_btn').hide();
                $('#profile_btn').show();
                $('#log_out').show();
                
            } else 
            {
                $('#sign_in').show();
                $('#registration_btn').show();
            }
        }
    });
    
    return false;
}

function register_click_handler()
{
    $.ajax({
        url:"registration.php",
        type:"POST",
        data: $('#register_form').serialize(),

        beforeSend: function () {

        },
        success: function(data){
            if(data.status == 1)
            {
                $('#registrationModal').modal('hide')
                $('#sign_in_btn').hide();
                $('#registration_btn').hide();
                $('#profile_btn').show();
                $('#log_out').show();
                $('#sign_in').hide();
                
            } else 
            {
               alert(data.statusMessage); 
            }
        }
    });
    
    return false;
}

function logout_click_handler()
{
        $.ajax({
        url:"logout.php",
        type:"POST",
        data:{
        },
        beforeSend: function () {

        },
        success: function(data){
            if(data.status == 1)
            {
                $('#sign_in').show();
                $('#registration_btn').show();
                $('#profile_btn').hide();
                $('#log_out').hide();
                window.location.href = "./";
            } else 
            {
               alert(data.statusMessage); 
            }
        }
    });
}
function profile_click_handler()
{
    window.location.href = "./profile.php";

}