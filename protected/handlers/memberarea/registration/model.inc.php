<?php

require_once LAYERS_DIR . '/User/user.inc.php';
require_once LIB_DIR . '/ReCaptcha/autoload.php';

class MemberAreaRegistrationModel extends MainModel
{
    private $_User;
    private $_ReCaptcha;
    
    public function __construct()
    {
        parent::__construct();
        $this->_User = new User();
        $this->_ReCaptcha = new \ReCaptcha\ReCaptcha(RECAPTCHA_GOOGLE_SECRET);
    }
    
    public function action_default()
    {
        if (!isset($_POST['g-recaptcha-response']))
        {
            throw new ExceptionProcessing(2);
        }
        if ($this->CustomerAuth->is_logged())
        {
            throw new ExceptionProcessing(20, 1);
        }
        
        if (empty($_POST['g-recaptcha-response']))
        {
            throw new ExceptionProcessing(12);
        }
        if (!$this->_ReCaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']))
        {
            throw new ExceptionProcessing(13);
        }
        
        $this->_User->set_data($_POST);
        $this->_User->registration();
        $user_id = $this->_User->login((string)@$_POST['email'], (string)@$_POST['password']);
        $this->Customer->set_id($user_id);
        $this->Customer->set_name($this->_User->get_name_by_user_id($user_id));
        $this->CustomerAuth->update_sessioned($this->Customer);
        $this->CustomerAuth->login();
        throw new ExceptionProcessing(11, 1);
    }
    
    public function run()
    {
        parent::run();
        $this->determine_action();
    }
}