<?php

require_once LAYERS_DIR.'/Paging/paged_lister.inc.php';

class LegalEntityAllList extends PagedLister
{
    /////////////////////////////////////////////////////////////////////////////

    public function get_conditions()
    {
         return array();
    }
    ////////////////////////////////////////////////////////////////////////////

    public function get_results_count()
    {
        $this-> db-> exec_query("
             SELECT COUNT(*) FROM `gp_legal_entity`
            ".$this-> get_where_part());
        return $this-> db-> get_one();
    }
    ////////////////////////////////////////////////////////////////////////////
}