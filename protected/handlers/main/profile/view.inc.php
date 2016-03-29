<?php

require_once LAYERS_DIR . '/User/purpose_dating.inc.php';

class MainProfileView extends ListView
{
    public function __construct()
    {
        parent::__construct();
    }

    public function fill()
    {
        parent::fill();
        if ($this->Model->isMyAccount())
        {
            $this->set_template('profile/profile.tpl');
            $this->assign('purposes_dating', PurposeDating::get_all_purposes());
        }
        else
        {
            $this->set_template('userProfile/user_profile.tpl');
            $this->assign('id', $this->Model->getProfileId());
        }
        $this->assign('IMAGES_APP', IMAGES_APP);
        $this->assign('balance_value', $this->Model->get_balance());
    }
};
