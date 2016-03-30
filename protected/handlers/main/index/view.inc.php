<?php

require_once LAYERS_DIR . '/User/purpose_dating.inc.php';

class MainIndexView extends ListView
{
    public function __construct()
    {
        parent::__construct();
    }

    public function fill()
    {
        parent::fill();
        $this->set_template('main/index.tpl');
        $this->assign('purposes_dating', PurposeDating::get_all_purposes());
        $this->assign('PROJECT_NAME', PROJECT_NAME);
    }
};
