<?php

class MemberAreaRegistrationView extends ViewTemplated
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function fill()
    {
        $this->set_template('registration/registration.tpl');
    }
}
