$(document).ready(function(){
$('#login_form').submit(login_click_handler);
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

        }
    });
    
    return false;
    }