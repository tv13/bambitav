<?php

require_once LAYERS_DIR . '/Profile/profile.inc.php';
require_once LAYERS_DIR . '/User/user.inc.php';
require_once LAYERS_DIR . '/User/image.inc.php';

class MainProfileModel extends MainModel
{
    private $_profileLayer;
    private $_User;
    private $_Image;
    private $_id;
    /////////////////////////////////////////////////////////////////////////////

    public function __construct()
    {
        parent::__construct();
        $this->_profileLayer = new Profile();
        $this->_DBHandler = produce_db();
        $this->_User = new User();
        $this->_Image = new Image();
        $this->_id = null;
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function get_content_data()
    {
        $this->is_ajax = true;
        $this->_DBHandler->exec_query("SELECT name, birthdate, city, sex, phone_number, description FROM  tm_users
        WHERE id=" . (string)@$_GET['size']);
        $this->Result = true;//$this->_DBHandler->get_all_data();    
    }
    /////////////////////////////////////////////////////////////////////////////

    public function action_update_profile_info()
    {
        $this->is_ajax = true;
        $this->_User->set_data($_POST);
        $this->_User->update_profile_info($this->get_customer_id());
        /*$this->_DBHandler->exec_query("INSERT INTO tm_users "
         . "(name, birthdate, city, sex, phone, text) "
         . "VALUES ('$_name', '$_birthdate', '$_city', '$_sex', '$_phone', '$_description');");
        */
        $this->Result = true;
    }
    /////////////////////////////////////////////////////////////////////////////

    public function action_load_profile_info()
    {
        $this->is_ajax = true;
        $this->Result = $this->_User->load_profile_info((string)@$_GET['id'] ? (string)@$_GET['id'] : $this->getProfileId());
    }
    /////////////////////////////////////////////////////////////////////////////

    public function action_default()
    {
        if (isset($_GET['id'])) {
            $this->setProfileId((string)@$_GET['id']);
        }

        if (!$this->getProfileId() && !$this->CustomerAuth->is_logged())
        {
            $this->redirect_to_main();
        }
    }
    /////////////////////////////////////////////////////////////////////////////

    public function action_file_upload()
    {
        $this->is_ajax = true;

        if (empty($_POST['key']))
        {
            throw new ExceptionProcessing(2);
        }
        
        $key = (string)@$_POST['key'];
        $main_image = $this->_Image->is_exist_user_images($this->get_customer_id()) ? 0 : 1;
        $image_id = $this->_Image->insert_image($this->get_customer_id(), $key, $main_image);
        
        $this->Result = array(
                            'id'    => $image_id,
                            'url'   => $this->_Image->get_url_by_key_and_size($key, (string)@$_POST['size']),
                            'main'  => $main_image
                        );
    }
    /////////////////////////////////////////////////////////////////////////////

    public function action_load_user_images()
    {
        $this->is_ajax = true;
        $this->Result = $this->_Image->get_images_by_user_id((string)@$_GET['id'] ? (string)@$_GET['id'] : $this->getProfileId(), (string)@$_GET['size']);
    }
    /////////////////////////////////////////////////////////////////////////////

    public function action_image_remove()
    {
        $this->is_ajax = true;
        if (empty($_POST['id']))
        {
            throw new ExceptionProcessing(2);
        }
        $this->_Image->delete_image((string)@$_POST['id']);
        throw new ExceptionProcessing(1, 1);
    }
    /////////////////////////////////////////////////////////////////////////////

    public function action_set_main()
    {
        $this->is_ajax = true;
        if (empty($_POST['id']))
        {
            throw new ExceptionProcessing(2);
        }
        
        $this->_Image->set_main($this->get_customer_id(), (string)@$_POST['id']);
        
        throw new ExceptionProcessing(1, 1);
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
        if (!$this->is_customer_logged() && $this->get_action_name() != 'default' && is_null($this->getProfileId()))
        {
            throw new ExceptionProcessing(24);
        }
        $this->determine_action();
    }
    /////////////////////////////////////////////////////////////////////////////

    public function isMyAccount()
    {
        return $this->get_customer_id() == (string)@$_GET['id'];
    }

    /////////////////////////////////////////////////////////////////////////////
    public function getProfileId()
    {
        return $this->_id ? $this->_id : $this->get_customer_id();
    }

    /////////////////////////////////////////////////////////////////////////////
    public function setProfileId($id)
    {
        $this->_id = $id;
    }
};
