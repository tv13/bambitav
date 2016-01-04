<?php

require_once LAYERS_DIR . '/User/user.inc.php';

class MemberAreaLoginModel extends MainModel
{
    private $_User;
    
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
        if (isset($_POST['email']) && isset($_POST['password']))
        {
            $user_id = $this->_User->get_user_id_by_email(@$_POST['email']);
            if (@$_POST['password'] == $this->_User->get_password_by_user_id($user_id))
            {
                $this->Customer->set_name($this->_User->get_name_by_user_id($user_id));
                $this->CustomerAuth->update_sessioned($this->Customer);
                $this->CustomerAuth->login();
            }
        }
        $this->redirect_to_main();
    }
    
    public function run()
    {
        parent::run();
        $this->determine_action();
    }
}