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
        if($this->Model->isMyAccount())
        {
            $this->set_template('profile/profile.tpl');
            $this->assign('balance_value', $this->Model->get_balance());
            $this->assign('IMAGES_APP', IMAGES_APP);
        } else {
            $this->set_template('userProfile/user_profile.tpl');
            $this->assign('balance_value', $this->Model->get_balance());
            $this->assign('IMAGES_APP', IMAGES_APP);
        }
    }
};
