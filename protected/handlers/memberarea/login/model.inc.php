<?php

class MemberAreaLoginModel extends MainModel
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function action_default()
    {
        if ($this->CustomerAuth->is_logged())
        {
            $this->redirect_to_admin();
        }
    }
    
    public function action_login()
    {
        $this->is_ajax = true;
        
        
        $this->Customer->set_ldap((string)@$_POST['login']);
        /*$this->Customer->set_session_hash(strval($response->attributes()->value));*/
        $this->CustomerAuth->update_sessioned($this->Customer);
        $this->CustomerAuth->login();
        
        $this->Result = array('error' => 0, 'url' => 'admin.php');
    }
    
    public function run()
    {
        parent::run();
        $this->determine_action();
    }
}