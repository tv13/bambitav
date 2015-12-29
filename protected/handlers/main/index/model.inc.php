<?php

require_once LAYERS_DIR . '/LegalEntity/legal_entity_list.inc.php';
require_once LAYERS_DIR . '/LegalBranch/legal_branch_list.inc.php';
require_once LAYERS_DIR . '/LegalEntity/legal_entity_all_list.inc.php';

class MainIndexModel extends MainModel
{
    private $_legalBranchList;
    /////////////////////////////////////////////////////////////////////////////
    
    public function __construct()
    {
        parent::__construct();
        $this->_legalBranchList = new LegalBranchList();
                $this->_DBHandler = produce_db();

    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function get_category_id()
    {
        return (int)@$_GET['category'];
    }
    /////////////////////////////////////////////////////////////////////////////

    public function get_search_string()
    {
	return preg_replace('/\s\s+/', ' ', (string)@$_GET['q']);
    }
    /////////////////////////////////////////////////////////////////////////////

    public function get_lister_instance()
    {
        return new LegalEntityList(
		$this->get_category_id(),
		$this->get_search_string()
	);
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function get_count_all_legal_entity()
    {
        $LegalEntityAllList = new LegalEntityAllList();
        return $LegalEntityAllList->get_results_count();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function get_count_legal_entity()
    {
        if (!$this->get_category_id())
        {
            return strval($this->get_count_all_legal_entity());
        }
        return '';
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function get_branches_list()
    {
        return $this->_legalBranchList->get_list();
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function action_default()
    {
    }
    
    public function action_content_data()
    {
        $this->is_ajax = true;
        $this->_DBHandler->exec_query("SELECT * FROM  tm_users ;");
        $this->Result = array("data" => $this->_DBHandler->get_all_data());    
    }
    
    
    public function action_list()
    {
        $array = array();
        $array[] = $this->_legalBranchList->get_list();
        return json_encode($array);
    }
    
    /////////////////////////////////////////////////////////////////////////////
    
    public function run()
    {
        parent::run();
        $this->determine_action();
    }
    /////////////////////////////////////////////////////////////////////////////
};
