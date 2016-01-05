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
       $this->is_ajax = true;
        $data = array();
        if ($this->CustomerAuth->is_logged())
        {
            $data = array("statusCode" => "1", "statusMessage" => "user is logged");
        }
        $email = (string)@$_POST['email'];
        $password = (string)@$_POST['password'];
        if (!empty($email) && !empty($password))
        {
            $user_id = $this->_User->get_user_id_by_email(@$_POST['email']);
            if (@$_POST['password'] == $this->_User->get_password_by_user_id($user_id))
            {
                $this->Customer->set_name($this->_User->get_name_by_user_id($user_id));
                $this->CustomerAuth->update_sessioned($this->Customer);
                $this->CustomerAuth->login();
                $data = array("statusCode" => "1", "statusMessage" => "user is logged");
            }
            else 
                {
                    $data = array("statusCode" => "0", "statusMessage" => "wrong emeail or password");
                }
        } else 
        {
                    $data = array("statusCode" => "0", "statusMessage" => "email or password is empty");
        }
        $this->Result = array("data" => $data);    
    }
    
    public function run()
    {
        parent::run();
        $this->determine_action();
    }
}