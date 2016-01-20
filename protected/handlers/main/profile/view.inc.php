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
        $this->assign('images', array('https://i.onthe.io/wjfkb82tfgre6ich7.91d8cbb5.jpg', 'https://i.onthe.io/wjfkb87ulito8hst8.3cc55de8.jpg'));
    }
};
