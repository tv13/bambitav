
var ReCaptchaCallback = function() {
    var sitekey_value = '6LcuuBsTAAAAAC7okJ7wVz9rAd_OhVgxSY6Vbgwb';
    
    //Render the recaptcha_reg on the element with ID "recaptcha_registration"
    recaptcha_reg = grecaptcha.render('recaptcha_registration', {
        sitekey : sitekey_value,
        theme   : 'light',
        callback: setChangedRegister
    });

    if ($('#recaptcha_contact').length)
    {
        //Render the recaptcha_contact on the element with ID "recaptcha_contact"
        recaptcha_contact = grecaptcha.render('recaptcha_contact', {
            sitekey : sitekey_value,
            theme   : 'light'
        });
    }
};

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