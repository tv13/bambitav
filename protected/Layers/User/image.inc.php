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
        $result['id']       = new FieldString();
        $result['url']      = new FieldString();
        $result['userId']   = new FieldString();
        $result['key_code'] = new FieldString();
        $result['useLocal'] = new FieldInt();
        $result['created']  = new FieldDateTime();
        
        $result['id']->set_max_length(36);
        $result['url']->set_max_length(255);
        $result['userId']->set_max_length(36);
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
    
    public function get_images_by_user_id($user_id)
    {
        $this->DBHandler->db->exec_query("SELECT * FROM `" . $this->DBHandler->get_table_name()
                . "` WHERE `userId` = '" . mysql_real_escape_string($user_id) . "'");
        
        $images = array();
        foreach ($this->DBHandler->db->get_all_data() as $image) {
            $images[] = array('url' => $image['url'], 'id' => $image['id']);
        }
        return $images;
    }
    /////////////////////////////////////////////////////////////////////////////
}