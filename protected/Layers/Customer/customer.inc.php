<?php 

require_once LAYERS_DIR.'/Walkers/set_input_data.inc.php';
require_once LAYERS_DIR.'/Entity/entity_with_db.inc.php'; 

class GPayCustomer extends EntityWithDB 
{ 
    ///////////////////////////////////////////////////////////////////////////// 

    public function &get_all_fields_instances() 
    {
        $result['name']                             = new FieldString();
        $result['name']->set_max_length(12);
    
        $result['session_hash']                     = new FieldString();
        $result['session_hash']->set_max_length(20);
    
        return $result;
    } 
    ///////////////////////////////////////////////////////////////////////////// 
    
    public function set_name($name)
    {
        $this->Fields['name']->set($name);
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function get_name_value()
    {
        return $this->Fields['name']->get();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function set_session_hash($hash)
    {
        $this->Fields['session_hash']->set($hash);
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function get_session_hash_value()
    {
        return $this->Fields['session_hash']->get();
    }
    /////////////////////////////////////////////////////////////////////////////
}
/////////////////////////////////////////////////////////////////////////////