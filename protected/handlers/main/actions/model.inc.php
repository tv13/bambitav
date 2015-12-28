<?php

require_once LAYERS_DIR . '/LegalEntity/legal_entity_list.inc.php';
require_once LAYERS_DIR . '/LegalBranch/legal_branch_list.inc.php';
require_once LAYERS_DIR . '/LegalEntity/legal_entity_all_list.inc.php';
class ActionsModel extends MainModel
{
    private $_legalBranchList;
    /////////////////////////////////////////////////////////////////////////////
    
    public function __construct()
    {
        parent::__construct();
        $this->is_ajax = true;
                $this->_legalBranchList = new LegalBranchList();
    }
    
    /////////////////////////////////////////////////////////////////////////////
    public function run()
    {
        parent::run();
        $this->determine_action();
    }
    
    public function action_list()
    {
        $result = array();
        foreach($this->_legalBranchList->get_list() as $row)
        {
            $result[] = array();
        }
        $this->Result=$this->_legalBranchList->get_list();
    }
}
