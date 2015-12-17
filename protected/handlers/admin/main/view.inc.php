<?php

class AdminMainView extends ViewTemplated
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function fill()
    {
        parent::fill();
        $this->set_template('admin/main.tpl');
    }
}