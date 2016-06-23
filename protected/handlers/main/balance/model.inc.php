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
        if (!$this->is_customer_logged()) {
            throw new ExceptionProcessing(24);
        }
        $this->_User->set_start_publish_data($this->get_customer_id());
        throw new ExceptionProcessing(1, 1);
    }
    /////////////////////////////////////////////////////////////////////////////

    public function action_publish_stop()
    {
        $this->is_ajax = true;
        if ($this->is_customer_logged()) {
            //$dt_publish = $this->_User->get_dt_publish($this->get_customer_id());
            //if ($dt_publish == 0)
            $status = $this->_User->get_status_by_user_id($this->get_customer_id());
            if (!$status)
            {
                throw new ExceptionProcessing(50);
            }
            $balance = $this->_User->get_balance_by_user_id($this->get_customer_id());
            $this->_User->set_stop_publish_data($this->get_customer_id(), $balance - 10);
        }
        throw new ExceptionProcessing(1, 1);
    }
    /////////////////////////////////////////////////////////////////////////////

    public function action_rise_questionnaire()
    {
        if ($this->_get_left_time_to_raising() < 0)
        {
            throw new ExceptionProcessing(0, 0, $this->_get_left_time_to_raising());
        }
        $this->_User->set_dt_publish($this->get_customer_id());
        throw new ExceptionProcessing(0, 1, $this->_get_left_time_to_raising());
    }
    /////////////////////////////////////////////////////////////////////////////

    private function _get_left_time_to_raising()
    {
        return time() - strtotime('+'.FREQUENCY_RISE.' hours', strtotime($this->_User->get_dt_publish($this->get_customer_id())));
    }
    /////////////////////////////////////////////////////////////////////////////

    public function run()
    {
        parent::run();
        $this->determine_action();
    }
    /////////////////////////////////////////////////////////////////////////////
}