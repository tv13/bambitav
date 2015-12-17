<?php

require_once dirname(__FILE__).'/generic.inc.php';
require_once LAYERS_DIR . '/Currencies/helper.inc.php';

class FieldCurrency extends FieldGeneric
{
    private $CurrencyHelper;
    ///////////////////////////////////////////////////////////////////////////
    
    function __construct($value = null)
    {
        $this->CurrencyHelper = new CurrencyHelper();
        
        parent::__construct($value);
    }
    ///////////////////////////////////////////////////////////////////////////
    
    public function get_default_value()
    {
         return 0;
    }
    ///////////////////////////////////////////////////////////////////////////
    
    public function set($value)
    {
        $this->value = $this->CurrencyHelper->currency_to_code($value);
    }
    /////////////////////////////////////////////////////////////////////////////

    public function filter_pre()
    {
         $this-> set_value($this->CurrencyHelper->currency_to_code($this-> value));
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function get_currency_name()
    {
        return $this->CurrencyHelper->code_to_currency($this-> value);
    }
    /////////////////////////////////////////////////////////////////////////////
}