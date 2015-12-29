<?php

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
    }
};
