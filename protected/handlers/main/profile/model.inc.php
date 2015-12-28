<?php

require_once LAYERS_DIR . '/Profile/profile.inc.php';

class MainProfileModel extends MainModel
{
    private $_profileLayer;
    /////////////////////////////////////////////////////////////////////////////
    
    public function __construct()
    {
        parent::__construct();
        $this->_profileLayer = new Profile();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function action_get_profile_info()
    {
        return $this->_profileLayer->get_info();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function action_update_profile_info()
    {
        
        $_profile_info = array();
        $_profile_info = [
            "name" => (string)@$_POST["name"],
            "birthday" => (string)@$_POST["birthday"],
            "sex" => (string)@$_POST["sex"],
            "phoneNumber" => (string)@$_POST["phoneNumber"],
            "description" => (string)@$_POST["description"]
            ];
       return $this->_profileLayer->update_info();
    }
    /////////////////////////////////////////////////////////////////////////////
         
    public function action_default()
    {
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function run()
    {
        parent::run();
        $this->determine_action();
    }
    /////////////////////////////////////////////////////////////////////////////
};
