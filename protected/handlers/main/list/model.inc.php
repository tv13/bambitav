<?php

require_once LAYERS_DIR . '/Promin/promin.inc.php';
require_once LAYERS_DIR . '/Currencies/currencies.inc.php';
require_once LAYERS_DIR . '/PersonalCashAccount/personal_cash_account.inc.php';
require_once LAYERS_DIR . '/PID/PID.inc.php';
require_once LAYERS_DIR . '/CurexOperationsData/cu_operations.inc.php';
require_once dirname(__FILE__) . '/form.inc.php';

class MainListModel extends MainModel
{
    private $ProminLayer;
    private $CurrenciesLayer;
    private $PersonalCashAccount;
    private $CurrencyHelper;
    private $PID;
    private $CurexOperations;
    private $Form;
    ////////////////////////////////////////////////////////////////////////////
    
    public function __construct()
    {
        parent::__construct();
        
        $this->ProminLayer = new ProminLayer();
        $this->CurrenciesLayer = new CurrenciesLayer();
        $this->PersonalCashAccount = new PersonalCashAccount();
        $this->CurrencyHelper = new CurrencyHelper();
        $this->PID = new PID();
        $this->CurexOperations = new CurexOperations();
        $this->Form = new MainListForm();
        $this->Form->set_entity($this->CurexOperations);
    }
    ////////////////////////////////////////////////////////////////////////////
    
    public function get_currencies_list()
    {
        return $this->CurrencyHelper->get_list();
    }
    ////////////////////////////////////////////////////////////////////////////
    
    public function get_curex()
    {
        #return json_encode($this->CurrenciesLayer->get_response());
        $result = array();
        $result[] = array(
            'currA' => '980',
            'currB' => '840',
            'rate1' => '8.155',
            'rate2' => '1.0',
            'nameA' => 'UAH',
            'nameB' => 'USD',
        );
        
        $result[] = array(
            'currA' => '840',
            'currB' => '980',
            'rate1' => '1.0',
            'rate2' => '8.12',
            'nameA' => 'USD',
            'nameB' => 'UAH',
        );
        
        return json_encode($result);
    }
    ////////////////////////////////////////////////////////////////////////////
    
    public function get_pans()
    {
        //return $this->PID->get_response();
        $result = array();
        $result[] = array(
            'REP_PAN' => '5457096945514003',
            'BTC_PROD' => 'GOLD',
            'REP_ACC' => '5457096945514003980',
            'EC8_CCY' => 'UAH',
            'EC8_CCY_ID' => '980',
        );
        
        $result[] = array(
            'REP_PAN' => '4731185505228111',
            'BTC_PROD' => 'INTERNET CARD',
            'REP_ACC' => '4731185505228111840',
            'EC8_CCY' => 'USD',
            'EC8_CCY_ID' => '840',
        );
        return $result;
    }
    ////////////////////////////////////////////////////////////////////////////
    
    public function generate_ref_id()
    {
        mt_srand((double)microtime()*10000);
        
        return substr(md5(uniqid(rand(), true)), 0, 20);
    }
    ////////////////////////////////////////////////////////////////////////////
    
    public function insert_general_data($data)
    {
        $this->Form->set_input_data($data);
        $this->Form->validate();
        if ($this-> Form-> is_done())
        {
            $this->CurexOperations->add();
            header('Location: code.php?code=' . $this->CurexOperations->get_code_value());
            die();
        }
        else
        {
            die('Error has been acquired while form validating!');
        }
    }
    ////////////////////////////////////////////////////////////////////////////
    
    public function action_submit()
    {
        $this->insert_general_data($_POST);
    }
    ////////////////////////////////////////////////////////////////////////////

    public function run()
    {
        
        parent::run();
        $this->determine_action();
    }
    ////////////////////////////////////////////////////////////////////////////
    
}