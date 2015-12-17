<?php 

require_once LAYERS_DIR.'/Walkers/set_input_data.inc.php';
require_once LAYERS_DIR.'/Entity/entity_with_db.inc.php'; 

class GPayCustomer extends EntityWithDB 
{ 
    ///////////////////////////////////////////////////////////////////////////// 

    public function &get_all_fields_instances() 
    {
        $result['ldap']                             = new FieldString();
        $result['ldap']->set_max_length(12);
    
        $result['session_hash']                     = new FieldString();
        $result['session_hash']->set_max_length(20);
    
        return $result;
    } 
    ///////////////////////////////////////////////////////////////////////////// 
    
    public function set_ldap($ldap)
    {
        $this->Fields['ldap']->set($ldap);
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function get_ldap_value()
    {
        return $this->Fields['ldap']->get();
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