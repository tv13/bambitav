<?php


class MainListView extends ViewTemplated
{
    public function __construct()
    {
        parent::__construct();
    }
    ////////////////////////////////////////////////////////////////////////////
    
    public function fill()
    {
        parent::fill();
        $this->set_template('main/main.tpl');
        $this->assign('currencies_list', $this->Model->get_currencies_list());
        $this->assign('curex', $this->Model->get_curex());
        $this->assign('pans', $this->Model->get_pans());
    }
    ////////////////////////////////////////////////////////////////////////////
}
