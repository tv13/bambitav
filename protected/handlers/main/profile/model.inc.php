<?php

require_once LAYERS_DIR . '/Profile/profile.inc.php';
require_once LAYERS_DIR . '/User/user.inc.php';

class MainProfileModel extends MainModel
{
    private $_profileLayer;
    private $_User;
    /////////////////////////////////////////////////////////////////////////////

    public function __construct()
    {
        parent::__construct();
        $this->_profileLayer = new Profile();
        $this->_DBHandler = produce_db();
        $this->_User = new User();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function get_content_data()
    {
        $this->is_ajax = true;
        $this->_DBHandler->exec_query("SELECT name, birthday, city, sex, phone_number, description FROM  tm_users ;");
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
            $this->_DBHandler->exec_query("INSERT INTO tm_users "
             . "(name, birthdate, city, sex, phone, text) "
             . "VALUES ('$_name', '$_birthday', '$_city', '$_sex', '$_phoneNumber', '$_description');");
       $this->Result = true;
    }
    /////////////////////////////////////////////////////////////////////////////

    public function action_default()
    {

    }
    /////////////////////////////////////////////////////////////////////////////

    public function action_file_upload()
    {
        var_dump(@$_FILES['files']);
        var_dump(@$_SERVER['HTTP_CONTENT_DISPOSITION']);
        $upload = @$_FILES['files'];
        $file_name = 'img_' . uniqid();

    }
    /////////////////////////////////////////////////////////////////////////////

    public function get_balance()
    {
        if ($this->is_customer_logged()) {
            return $this->_User->get_balance_by_user_id($this->get_customer_id());
        }
        return 0;
    }
    /////////////////////////////////////////////////////////////////////////////

    public function run()
    {
        parent::run();
        $this->determine_action();
    }
    /////////////////////////////////////////////////////////////////////////////
};
