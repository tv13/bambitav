<?php

require_once LAYERS_DIR . '/LegalEntity/legal_entity_list.inc.php';
require_once LAYERS_DIR . '/LegalBranch/legal_branch_list.inc.php';
require_once LAYERS_DIR . '/LegalEntity/legal_entity_all_list.inc.php';

class MainProfileModel extends MainModel
{
    private $_legalBranchList;
    /////////////////////////////////////////////////////////////////////////////
    
    public function __construct()
    {
        parent::__construct();
        $this->_legalBranchList = new LegalBranchList();
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
    /////////////////////////////////////////////////////////////////////////////
    
    public function run()
    {
        parent::run();
        $this->determine_action();
    }
    /////////////////////////////////////////////////////////////////////////////
};
