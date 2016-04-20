
var ReCaptchaCallback = function() {
    //Render the recaptcha_reg on the element with ID "recaptcha_registration"
    recaptcha_reg = grecaptcha.render('recaptcha_registration', {
        sitekey : '6LddWxYTAAAAAHhtSr_UIRK-YsTziAEkiG_8aoDd',
        theme   : 'light',
        callback: setChangedRegister
    });

    if ($('#recaptcha_contact').length)
    {
        //Render the recaptcha_contact on the element with ID "recaptcha_contact"
        recaptcha_contact = grecaptcha.render('recaptcha_contact', {
            sitekey : '6LddWxYTAAAAAHhtSr_UIRK-YsTziAEkiG_8aoDd',
            theme   : 'light'
        });
    }
};

function preloader_close() {
    var $preloader = $('#page-preloader'),
        $spinner   = $preloader.find('.spinner');
    $spinner.fadeOut();
    $preloader.fadeOut('slow');
}