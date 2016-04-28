<?php

require_once LAYERS_DIR . '/Entity/entity_with_db.inc.php';

class Image extends EntityWithDB
{
    /////////////////////////////////////////////////////////////////////////////
    
    public function __construct()
    {
        parent::__construct();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function &get_all_fields_instances()
    {
        $result['id']       = new FieldInt();
        $result['user_id']  = new FieldInt();
        $result['key_code'] = new FieldString();
        $result['main']     = new FieldInt();
        $result['dt_create']= new FieldDateTime();
        
        $result['key_code']->set_max_length(40);
        
        return $result;
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function create_child_objects()
    {
        $this->create_standart_db_handler('tm_user_pictures');
        $this->create_tuple();
        $this->DBHandler-> set_primary_key('id');
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function get_images_by_user_id($user_id, $size)
    {
        $this->DBHandler->db->exec_query("SELECT * FROM `" . $this->DBHandler->get_table_name()
                . "` WHERE `user_id` = '$user_id'
                        ORDER BY `id`");
        
        $images = array();
        foreach ($this->DBHandler->db->get_all_data() as $image) {
            $images[] = array(
                            'id'    => $image['id'],
                            'url'   => $this->get_url_by_key_and_size($image['key_code'], $size),
                            'main'  => $image['main']
                        );
        }
        return $images;
    }
    /////////////////////////////////////////////////////////////////////////////

    public function get_url_by_key_and_size($image_key, $size)
    {
        $url = $image_key . '.r' . $size;
        $sign = substr(md5($url . IMAGES_SECRET), 0, 8);

        return IMAGES_SERVER . $url . '.' . $sign . '.jpg';
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function insert_image($user_id, $image_key, $main)
    {
        $this->Fields['user_id']->set($user_id);
        $this->Fields['key_code']->set($image_key);
        $this->Fields['main']->set($main);
        $this->Fields['dt_create']->now();
        $this->DBHandler->insert();
        return $this->DBHandler->get_id_value();
    }
    ////////////////////////////////////////////////////////////////////////////

    public function is_exist_user_images($user_id)
    {
        return $this->_get_user_images_count($user_id) > 0;
    }
    ////////////////////////////////////////////////////////////////////////////

    private function _get_user_images_count($user_id)
    {
        $this->DBHandler->db->exec_query("
            SELECT COUNT(*) FROM " . $this->DBHandler->get_table_name()
            . " WHERE user_id = '$user_id'");
        return $this->DBHandler->db->get_one();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function set_main($user_id, $image_id)
    {
        $this->_check_exist_image_id($image_id);
        $this->_set_main_to_0_4_all_user_images($user_id);
        $this->_set_main_image($image_id);
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _set_main_to_0_4_all_user_images($user_id)
    {
        $query = "UPDATE " . $this->DBHandler->get_table_name() . "
                    SET main = 0
                    WHERE user_id = '$user_id'
                        AND main = 1";
        $this->DBHandler->db->exec_query($query);
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _set_main_image($image_id)
    {
        $query = "UPDATE " . $this->DBHandler->get_table_name() . "
                    SET main = 1
                    WHERE id = '$image_id'";
        $this->DBHandler->db->exec_query($query);
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function delete_image($image_id, $customer_id)
    {
        $user_id = $this->_get_user_id_by_image_id($image_id);
        $this->_check_exist_image_id(null, $user_id);
        $this->_check_user_is_owner_image($customer_id, $user_id);
        $main = $this->_get_main_by_image_id($image_id);
        $this->DBHandler->delete_by_primary();
        if ($main)
        {
            $image_id = $this->_get_id_first_user_image($user_id);
            if (!empty($image_id))
            {
                $this->_set_main_image($image_id);
            }
        }
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _get_id_first_user_image($user_id)
    {
        $query = "SELECT `id`
                    FROM " . $this->DBHandler->get_table_name() . "
                    WHERE `user_id` = '$user_id'
                    ORDER BY `id`
                    LIMIT 1";
        $this->DBHandler->db->exec_query($query);
        return $this->DBHandler->db->get_one();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _check_exist_image_id($image_id, $user_id = null)
    {
        if (!$this->_is_exist_image_id($image_id, $user_id))
        {
            throw new ExceptionProcessing(33);
        }
        return true;
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _is_exist_image_id($image_id, $user_id = null)
    {
        return '' != !isset($user_id) ? $this->_get_user_id_by_image_id($image_id) : $user_id;
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _get_user_id_by_image_id($image_id)
    {
        $this->_load_image_by_id($image_id);
        return $this->Fields['user_id']->get();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    /* Проверяем: это изображение юзера, который хочет его удалить (владельца), или кого-то другого */
    private function _check_user_is_owner_image($customer_id, $user_id)
    {
        if ($user_id != $customer_id)
        {
            throw new ExceptionProcessing(35);
        }
        return true;
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _get_main_by_image_id($image_id)
    {
        $this->_load_image_by_id($image_id);
        return $this->Fields['main']->get();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _load_image_by_id($image_id)
    {
        $this->set_id_value($image_id);
        $this->load();
    }
    /////////////////////////////////////////////////////////////////////////////
}