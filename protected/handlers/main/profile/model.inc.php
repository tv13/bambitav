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
        $this->_DBHandler = produce_db();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function action_content_data()
    {
        $this->is_ajax = true;
        $this->_DBHandler->exec_query("SELECT name, birthday, city, sex, phone_number, description FROM  user_info ;");
        $this->Result = true;//$this->_DBHandler->get_all_data();    
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function action_update_profile_info()
    {
        $this->is_ajax = true;
            $_name = (string)@$_POST["name"];
            $_birthday = (string)@$_POST["birthday"];
            $_sex = (string)@$_POST["sex"];
            $_phoneNumber = (string)@$_POST["phoneNumber"];
            $_description = (string)@$_POST["description"];
            $_city = (string)@$_POST["city"];
            $this->_DBHandler->exec_query("INSERT INTO user_info "
             . "(name, birthday, city, sex, phone_number, description) "
             . "VALUES ('$_name', '$_birthday', '$_city', '$_sex', '$_phoneNumber', '$_description');");
       $this->Result = true;
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
