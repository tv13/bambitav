<?php

require_once LAYERS_DIR . '/Entity/entity_with_db.inc.php';

class User extends EntityWithDB
{
    /////////////////////////////////////////////////////////////////////////////
    
    public function __construct()
    {
        parent::__construct();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function &get_all_fields_instances()
    {
        $result['id']           = new FieldInt();
        $result['email']        = new FieldString();
        $result['password']     = new FieldString();
        $result['status']       = new FieldInt();
        $result['balance']      = new FieldInt();
        $result['name']         = new FieldString();
        $result['sex']          = new FieldString();
        $result['birthdate']    = new FieldDate();
        $result['services']     = new FieldInt();
        $result['city']         = new FieldString();
        $result['size']         = new FieldInt();
        $result['height']       = new FieldInt();
        $result['weight']       = new FieldInt();
        $result['rating']       = new FieldInt();
        $result['dt_create']    = new FieldDateTime();
        
        $result['email']->set_max_length(100);
        $result['password']->set_max_length(20);
        $result['name']->set_max_length(50);
        $result['sex']->set_max_length(1);
        $result['city']->set_max_length(100);
        
        return $result;
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function create_child_objects()
    {
        $this->create_standart_db_handler('tm_users');
        $this->create_tuple();
        $this->DBHandler-> set_primary_key('id');
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _is_valid_email($email)
    {
        if (!preg_match("/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/", $email))
        {
            return false;
        }
        return true;
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _validate_nick_for_create()
    {
        if ('' != $this->_get_user_account_by_nick($this->_get_data_field('nick')))
        {
            //throw new ExceptionProcessing(4);
        }
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _validate_nick_general()
    {
        if (!preg_match("/^[A-Za-z0-9_\.-]+$/", $this->_get_data_field('nick')))
        {
            //throw new ExceptionProcessing(5);
        }
        if (!preg_match("/^.{4,20}$/", $this->_get_data_field('nick')))
        {
            //throw new ExceptionProcessing(6);
        }
        return true;
    }
    /////////////////////////////////////////////////////////////////////////////
    
    protected function _validate_age($age)
    {
        if (!is_numeric($age) || ((int)$age < 14 || (int)$age > 99))
        {
            throw new ExceptionProcessing(7);
        }
        return true;
    }
    /////////////////////////////////////////////////////////////////////////////
    
    protected function _validate_sex($sex)
    {
        if ($sex == 'm' || $sex == 'f')
        {
            return true;
        }
        throw new ExceptionProcessing(8);
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _set_user_by_id($user_id)
    {
        $this->Fields['user_id']->set($user_id);
        $this->load_by_field('user_id');
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _get_photo_path($user_id)
    {
        return "static/img/$user_id.jpg";
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _get_existing_photo_path($user_id)
    {
        if (file_exists($this->_get_photo_path($user_id)))
        {
            return $this->_get_photo_path($user_id);
        }
        return "";
    }
    /////////////////////////////////////////////////////////////////////////////
}