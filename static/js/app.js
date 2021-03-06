
var isChanged = false;
var login_form = $('#login_form');
var register_form = $('#register_form');
var login = $('#login');
var register = $('#register');

var setUnchanged = function () {
    isChanged = false;
    login.prop('disabled', true);
};
var setUnchangedRegister = function () {
    register.prop('disabled', true);
};
var setChangedRegister = function (e) {
    $('.custom_close').click();
    if (
        ($('#registerPassword').val() != $('#registerPasswordConfirm').val())
        || $('#registerPasswordConfirm').val() == ''
        || $('#registerPassword').val() == ''
    ) {
        setUnchangedRegister();
        if ($('#registerPasswordConfirm').val() != '') {
            bootstrap_alert.warning('Пароли не совпадают', '_r');
        }
    } else {

        register.prop('disabled', false);
    }
};
var setChanged = function () {
    $('.custom_close').click();
    login.prop('disabled', false);
};

login_form.on('change', setChanged);
login_form.find('input').each(function(){
    $(this).keyup(setChanged());
});

register_form.on('keyup', setChangedRegister);

$(document).ready(function () {
    register_form.submit(register_click_handler);
    login_form.submit(login_click_handler);

    $('#log_out').click(logout_click_handler);

    $('#profile_btn').click(profile_click_handler);
    
    showModalResultCheckEmail();

    function login_click_handler() {
        $.ajax({
            url: "login.php",
            type: "POST",
            data: {
                'email': $('#emailLogin').val(),
                'password': $('#passwordLogin').val()
            },
            beforeSend: function () {

            },
            success: function (data) {
                if (data.status == 1) {
                    $('#loginModal').modal('hide')
                    $('#sign_in').hide();
                    $('#registration_btn').hide();
                    $('#profile_btn').show();
                    $('#log_out').show();

                } else {
                    if (data.statusMessage != undefined) {
                        setUnchanged();
                        bootstrap_alert.warning(data.statusMessage, '');
                    }
                    $('#sign_in').show();
                    $('#registration_btn').show();
                }
            }
        });

        return false;
    }

    function register_click_handler() {
        $.ajax({
            url: "registration.php",
            type: "POST",
            data: $('#register_form').serialize(),

            beforeSend: function () {
                preloader_show();
            },
            success: function (data) {
                if (data.status == 1) {
                    $('#registrationModal').modal('hide')
                    $('#sign_in_btn').hide();
                    $('#registration_btn').hide();
                    $('#profile_btn').show();
                    $('#log_out').show();
                    $('#sign_in').hide();
                    document.location.href = 'profile.php';

                } else {
                    setUnchangedRegister();
                    grecaptcha.reset(recaptcha_reg);
                    if (data.statusMessage != undefined) {
                        bootstrap_alert.warning(data.statusMessage, '_r');
                    }
                }
                preloader_hide();
            }
        });

        return false;
    }

    function logout_click_handler() {
        $.ajax({
            url: "logout.php",
            type: "POST",
            data: {},
            beforeSend: function () {

            },
            success: function (data) {
                if (data.status == 1) {
                    $('#sign_in').show();
                    $('#registration_btn').show();
                    $('#profile_btn').hide();
                    $('#log_out').hide();
                    window.location.href = "./";
                } else {
                    alert(data.statusMessage);
                }
            }
        });
    }

    function profile_click_handler() {
        window.location.href = "./profile.php";

    }

    function showModalResultCheckEmail()
    {
        var result_check = Cookie.getCookie(Cookie.cookie_res_check_email);
        var $modal_form = $('#resultCheckEmailModal');
        if (result_check)
        {
            $modal_form.modal('show');
            if (result_check > 0)
            {
                $modal_form.find('.check_email_success').removeClass('hide');
            }
            else
            {
                $modal_form.find('.check_email_fail').removeClass('hide');
            }
            Cookie.setCookie(Cookie.cookie_res_check_email, 1, -1); /* delete cookie res_check_email */
        }
    }
});
