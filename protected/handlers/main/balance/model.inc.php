<?php

require_once LAYERS_DIR . '/User/user.inc.php';

class MainBalanceModel extends MainModel
{
    private $_User;
    /////////////////////////////////////////////////////////////////////////////

    public function __construct()
    {
        parent::__construct();
        $this->_User = new User();
    }
    /////////////////////////////////////////////////////////////////////////////

    public function action_default()
    {
    }
    /////////////////////////////////////////////////////////////////////////////

    public function action_publish_start()
    {
        $this->is_ajax = true;
        if ($this->is_customer_logged()) {
            $this->_User->set_dt_publish($this->get_customer_id());
        }
        throw new ExceptionProcessing(1, 1);
    }
    /////////////////////////////////////////////////////////////////////////////

    public function action_publish_stop()
    {
        $this->is_ajax = true;
        if ($this->is_customer_logged()) {
            $dt_publish = $this->_User->get_dt_publish($this->get_customer_id());
            if ($dt_publish == 0)
            {
                throw new ExceptionProcessing(30);
            }
            $balance = $this->_User->get_balance_by_user_id($this->get_customer_id());
            $this->_User->set_dt_publish($this->get_customer_id(), false);
        }
        throw new ExceptionProcessing(1, 1);
    }
    /////////////////////////////////////////////////////////////////////////////

    public function run()
    {
        parent::run();
        $this->determine_action();
    }
    /////////////////////////////////////////////////////////////////////////////
}