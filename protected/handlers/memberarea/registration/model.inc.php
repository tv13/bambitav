<?php

require_once LAYERS_DIR . '/User/user.inc.php';

class MemberAreaRegistrationModel extends MainModel
{
    public function __construct()
    {
        parent::__construct();
        $this->_User = new User();
    }
    
    public function action_default()
    {
        if ($this->CustomerAuth->is_logged())
        {
            $this->redirect_to_main();
        }
        if (isset($_POST['email'])) {
            $this->_User->set_data($_POST);
            $user_id = $this->_User->create();
            $this->_User->send_validate_email($user_id);
            $this->redirect_to_sended_verification_email();
        }
    }
    
    public function run()
    {
        parent::run();
        $this->determine_action();
    }
}