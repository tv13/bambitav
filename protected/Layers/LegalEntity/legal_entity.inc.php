<?php

class GPayLegalEntity extends EntityWithDB 
{ 
    ///////////////////////////////////////////////////////////////////////////// 

    public function &get_all_fields_instances() 
    {
        $result['entity_ekb_id']        = new FieldId();
        $result['CEO_ekb_id']           = new FieldInt();
        $result['inn']                  = new FieldInt();
        $result['entity_name']          = new FieldString();
        $result['entity_name']->set_max_length(255);
        $result['entity_address']       = new FieldString();
        $result['entity_address']->set_max_length(255);
        $result['ckea_id']              = new FieldInt();
        $result['branch_id']            = new FieldInt();
    
        return $result;
    } 
    /////////////////////////////////////////////////////////////////////////////
    
    public function create_child_objects()
    {
        $this->create_standart_db_handler('gp_legal_entity');
        $this->create_tuple();
    }
    ///////////////////////////////////////////////////////////////////////////// 
    
    public function set_branch_id($branch_id)
    {
        $this->Fields['branch_id']->set($branch_id);
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function get_records_by_branch($branch_id)
    {
        $this->set_branch_id($branch_id);
        return $this->DBHandler->get_all_data_by_field('branch_id',
                        array(
                            'entity_name',
                            'entity_address',
                            'ckea_id'
                        ));
    }
    /////////////////////////////////////////////////////////////////////////////
}
/////////////////////////////////////////////////////////////////////////////