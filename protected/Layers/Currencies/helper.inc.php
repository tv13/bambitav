<?php

class CurrencyHelper
{
    private $code2currency;
    
    public function __construct()
    {
        $this->code2currency = array(
            '980' => 'UAH',
            #'643' => 'RUB',
            #'978' => 'EUR',
            '840' => 'USD',
        );
    }
    
    public function get_currency_list()
    {
        return array_values($this->code2currency);
    }
    
    public function get_list()
    {
        return $this->code2currency;
    }
    
    public function code_to_currency($code)
    {
        return (string)@$this->code2currency[strval($code)];
    }
    
    public function currency_to_code($currency)
    {
        $result = array_flip($this->code2currency);
        return (string)@$result[strtoupper($currency)];
    }
};
