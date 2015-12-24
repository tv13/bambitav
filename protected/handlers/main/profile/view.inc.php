<?php

class MainProfileView extends ListView
{
    public function __construct()
    {
        parent::__construct();
    }

    public function fill()
    {
        parent::fill();
        $this->set_template('profile/profile.tpl');
        $this->assign('branches', $this->Model->get_branches_list());
        $this->assign('category_id', $this->Model->get_category_id());
	$this->assign('search_string', $this->Model->get_search_string());
        $this->assign('num', $this->Model->get_count_legal_entity());
    }
};
