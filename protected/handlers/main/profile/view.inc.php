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
        $this->assign('balance_value', $this->Model->get_balance());
    }
};
