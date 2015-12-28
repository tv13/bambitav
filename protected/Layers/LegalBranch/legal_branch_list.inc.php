<?php
require_once LAYERS_DIR.'/Paging/paged_lister.inc.php';

class LegalBranchList extends PagedLister
{
    /////////////////////////////////////////////////////////////////////////////

    public function get_conditions()
    {
         $result = array();
         return $result;
    }
    ////////////////////////////////////////////////////////////////////////////

    public function get_list()
    {
             $this-> db-> exec_query("
            SELECT * 
            FROM users_bt");
        return $this-> db-> get_all_data();
    }
    ////////////////////////////////////////////////////////////////////////////

    public function get_results_count()
    {
         $this-> db-> exec_query("
         SELECT COUNT(*) FROM `gp_legal_branch`
        ".$this-> get_where_part());
        return $this-> db-> get_one();
    }
    /////////////////////////////////////////////////////////////////////////////

    public function delete($ids)
    {
         $this-> db-> exec_query("
         DELETE  
           FROM `gp_legal_branch`
         WHERE id IN (".$this-> db-> get_in_list($ids).")");
    }
    ////////////////////////////////////////////////////////////////////////////
}