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
            throw new ExceptionProcessing(10, 1);
        }
        
        $user_id = $this->_User->login((string)@$_POST['email'], (string)@$_POST['password']);
        $this->Customer->set_name($this->_User->get_name_by_user_id($user_id));
        $this->CustomerAuth->update_sessioned($this->Customer);
        $this->CustomerAuth->login();
        throw new ExceptionProcessing(10, 1);
    }
    
    public function run()
    {
        parent::run();
        $this->determine_action();
    }
}