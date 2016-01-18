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
        if ($this->is_customer_logged()) {
            $this->_User->set_data($_POST);
            $this->_User->update_profile_info($this->get_customer_id());
            /*$this->_DBHandler->exec_query("INSERT INTO tm_users "
             . "(name, birthdate, city, sex, phone, text) "
             . "VALUES ('$_name', '$_birthday', '$_city', '$_sex', '$_phoneNumber', '$_description');");
            */
        }
        $this->Result = true;
    }
    /////////////////////////////////////////////////////////////////////////////

    public function action_load_profile_info()
    {
        $this->is_ajax = true;
        if (!$this->is_customer_logged()) {
            throw new ExceptionProcessing(24);
        }
        $this->Result = $this->_User->load_profile_info($this->get_customer_id());
    }
    /////////////////////////////////////////////////////////////////////////////

    public function action_default()
    {

    }
    /////////////////////////////////////////////////////////////////////////////

    public function action_file_upload()
    {

        $this->get_customer_id();
        $query = 'INSERT INTO tm_user_pictures (id, url, userId, key_code, useLocal) VALUES ((select UUID()), \''
            . $_POST['full_size'] . '\', '
            .  '1'//$this->get_customer_id()
            . ', \'' . $_POST['key'] . '\', false);';
        $this->_DBHandler->exec_query($query);

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
