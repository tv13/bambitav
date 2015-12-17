<?php

require_once HANDLERS_DIR . '/admin_model.inc.php';

class AdminMainModel extends AdminModel
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function run()
    {
        if (parent::run())
        {
            $this->determine_action();
        }
    }
}