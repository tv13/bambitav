<?php

require_once LAYERS_DIR . '/Autocomplete/autocomplete.inc.php';

class AutoCompleteModel extends MainModel
{
    private $_autocomplete;
    /////////////////////////////////////////////////////////////////////////////
    
    public function __construct()
    {
        parent::__construct();
        $this->is_ajax = true;
        $this->_autocomplete = new Autocomplete($this->get_query_string());
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function action_default()
    {
        /*$this->Result = array(
            'error' => 1,
            'message' => 'no action param'
        );*/
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function get_query_string()
    {
        return (string)@$_GET['query'];
    }
    
    /////////////////////////////////////////////////////////////////////////////

    public function action_suggest()
    {
        $this->Result['query'] = $this->get_query_string();
        $this->Result['suggestions'] = '';
        
        foreach ($this->_autocomplete->get_list() as $data_address)
        {
            $this->Result['suggestions'][] = $data_address['entity_address'];
        }
    }
    
    /////////////////////////////////////////////////////////////////////////////
    public function run()
    {
        parent::run();
        $this->determine_action();
    }
}
