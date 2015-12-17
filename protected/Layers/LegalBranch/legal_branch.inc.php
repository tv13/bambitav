<?php

class GPayLegalBranch extends EntityWithDB 
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
        $this->create_standart_db_handler('gp_legal_branch');
        $this->create_tuple();
    }
    /////////////////////////////////////////////////////////////////////////////
    
}
/////////////////////////////////////////////////////////////////////////////