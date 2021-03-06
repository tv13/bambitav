
$(window).on('load', function () {
    var $preloader = $('#page-preloader'),
        $spinner   = $preloader.find('.spinner');
    $spinner.fadeOut();
    $preloader.fadeOut('slow');
});
$(document).ready(function(){
    UserProfile.init();
    $('form#form_contact').submit(UserProfile.contact_send_email);
    $('#filter_btn').addClass('hide');
});

var UserProfile = {
    init: function() {

        ProfileBase.load_profile_data();
        ProfileBase.load_user_images();

        $('.carousel').carousel({
            interval: 3000
        });
    },
    contact_send_email: function() {
        $('#form_contact button').attr('disabled','disabled');
        $.post('profile.php',
        {
            email_from              : $('#contact_email').val(),
            user_id_to              : $('#profile_content').data('profile_id'),
            text                    : $('#contact_text').val(),
            'g-recaptcha-response'  : $('#form_contact [name="g-recaptcha-response"]').val(),
            action                  : 'send_email'
        }, handle_response).error(ajax_error_handler).handler = UserProfile.contact_send_email_ajax_handler;
        return false;
    },
    contact_send_email_ajax_handler: function(response) {

        $('#form_contact button').removeAttr('disabled');
        
        if (response.status == 1 && response.data)
        {
            bootstrap_alert.success('Ваше сообщение успешно отправлено!', '_contact_form');
            $('#contact_text').val('');
            grecaptcha.reset(recaptcha_contact);
        }
        else if (!response.status)
        {
            bootstrap_alert.warning(response.statusMessage, '_contact_form');
        }
    }
};
function country_show_name(result)
{
    $('#country').html(result.response[0].title);
}

function city_other_show_names(result)
{
    $('#city').html(result.response[0].title);
}