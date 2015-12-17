<?php

class GPayLegalCKEA extends EntityWithDB 
{ 
    ///////////////////////////////////////////////////////////////////////////// 

    public function &get_all_fields_instances() 
    {
        $result['id']           = new FieldId();
        $result['name']         = new FieldString();
        $result['name']->set_max_length(255);
    
        return $result;
    } 
    /////////////////////////////////////////////////////////////////////////////
    
    public function create_child_objects()
    {
        $this->create_standart_db_handler('gp_legal_ckea');
        $this->create_tuple();
    }
    ///////////////////////////////////////////////////////////////////////////// 
    
    private function load_by_id($id)
    {
        $this->DBHandler->set_id_value($id);
        $this->DBHandler->load_by_id();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function get_name_value()
    {
        return $this->Fields['name']->get();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function get_name_by_id($id)
    {
        $this->load_by_id($id);
        return $this->get_name_value();
    }
    /////////////////////////////////////////////////////////////////////////////
}
/////////////////////////////////////////////////////////////////////////////