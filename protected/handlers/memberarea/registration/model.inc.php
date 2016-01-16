<?php

require_once LAYERS_DIR . '/User/user.inc.php';

class MemberAreaRegistrationModel extends MainModel
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
            throw new ExceptionProcessing(20, 1);
        }
        $this->_User->set_data($_POST);
        $this->_User->registration();
        throw new ExceptionProcessing(10, 1);
    }
    
    public function run()
    {
        parent::run();
        $this->determine_action();
    }
}