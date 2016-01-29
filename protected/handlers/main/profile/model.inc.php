<?php

require_once LAYERS_DIR . '/Profile/profile.inc.php';
require_once LAYERS_DIR . '/User/user.inc.php';
require_once LAYERS_DIR . '/User/image.inc.php';

class MainProfileModel extends MainModel
{
    private $_profileLayer;
    private $_User;
    private $_Image;
    /////////////////////////////////////////////////////////////////////////////

    public function __construct()
    {
        parent::__construct();
        $this->_profileLayer = new Profile();
        $this->_DBHandler = produce_db();
        $this->_User = new User();
        $this->_Image = new Image();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function get_content_data()
    {
        $this->is_ajax = true;
        $this->_DBHandler->exec_query("SELECT name, birthdate, city, sex, phone_number, description FROM  tm_users ;");
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
             . "VALUES ('$_name', '$_birthdate', '$_city', '$_sex', '$_phone', '$_description');");
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
        if (!$this->CustomerAuth->is_logged())
        {
            $this->redirect_to_main();
        }
    }
    /////////////////////////////////////////////////////////////////////////////

    public function action_file_upload()
    {

        $this->get_customer_id();

        if (!empty($_POST['full_size'])) {
            $query = 'INSERT INTO tm_user_pictures (id, url, userId, key_code, useLocal) VALUES ((select UUID()), \''
                . $_POST['full_size'] . '\', '
                .  $this->get_customer_id()
                . ', \'' . $_POST['key'] . '\', false);';
            $this->_DBHandler->exec_query($query);

            if ($_POST['number'] == 0) {

                $this->is_ajax = true;

                $this->_DBHandler->exec_query("SELECT id, url from tm_user_pictures
                            WHERE userId = '".$this->get_customer_id()."'
                                order by created DESC");
                $this->Result = array(
                    'files' => $this->_DBHandler->get_all_data(),
                    'upload' => true
                );
            }
        }
    }
    /////////////////////////////////////////////////////////////////////////////

    public function action_load_user_images()
    {
        $this->is_ajax = true;
        $this->Result = $this->_Image->get_images_by_user_id($this->get_customer_id());
    }
    /////////////////////////////////////////////////////////////////////////////

    public function action_file_remove()
    {
        if (!empty($_POST['image_id'])) {
            $query = 'DELETE FROM tm_user_pictures WHERE id = \''. $_POST['image_id'] . '\'';
            $this->_DBHandler->exec_query($query);
        }
    }
    /////////////////////////////////////////////////////////////////////////////

    public function action_set_main()
    {
        if (!empty($_POST['image_url'])) {

            $query = "UPDATE tm_user_pictures set useLocal=false WHERE userId = '" .$this->get_customer_id()."'";
            $this->_DBHandler->exec_query($query);

            $query = 'UPDATE tm_user_pictures set useLocal=true WHERE id = \''. $_POST['image_id'] . '\'';
            $this->_DBHandler->exec_query($query);
        }
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
