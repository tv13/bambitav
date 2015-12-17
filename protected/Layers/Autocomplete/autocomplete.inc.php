<?php

require_once LAYERS_DIR.'/Paging/paged_lister.inc.php';

class Autocomplete extends PagedLister
{
    private $_address_str;
    /////////////////////////////////////////////////////////////////////////////
    
    public function __construct($address_str)
    {
        parent::__construct();
        $this->_address_str = $address_str;
    }
    /////////////////////////////////////////////////////////////////////////////

    public function get_conditions()
    {
        return array('`gp_legal_entity`.`entity_address` LIKE "%' . $this->_address_str . '%"');
    }
    ////////////////////////////////////////////////////////////////////////////

    public function get_list()
    {
        $this-> db-> exec_query("
            SELECT `entity_address` 
            FROM `gp_legal_entity`
        ".$this-> get_where_part().' LIMIT 0,10');
        return $this-> db-> get_all_data();
    }
    ////////////////////////////////////////////////////////////////////////////
}