<?php

require_once LAYERS_DIR . '/Currencies/helper.inc.php';
require_once LAYERS_DIR . '/Promin/promin_auth.inc.php';

class CurrenciesLayer extends ProminAuthLayer
{
    /**
     *
     * @var CurrencyHelper 
     */
    private $currencyHelper;
    ////////////////////////////////////////////////////////////////////////////
    
    public function __construct()
    {
        parent::__construct('http://10.1.99.223:9494/de');
        $this->currencyHelper = new CurrencyHelper();
        $this->data = date('Y-m-d');
        $this->branch = 'DNH6';
    }
    ////////////////////////////////////////////////////////////////////////////
    
    /**
     * get_request
     * @return string
     */
    public function get_request()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>
            <deRequest>
                <sid>' . $this->get_sid() . '</sid>
                <reqType>RATESOFEXCHANGE</reqType>
                <bank>PB</bank>
                <operDate>' .  $this->data . '</operDate>
                <branch>' . $this->branch. '</branch>
            </deRequest> ';
    }
    ////////////////////////////////////////////////////////////////////////////
    
    /**
     * get_supported_currencies_id
     * @return array
     */
    public function get_supported_currencies_id()
    {
        return array('980','643','978','840');
    }
    ////////////////////////////////////////////////////////////////////////////
    
    /**
     * is_currency_batch_supported
     * @param type $batch
     * @return bool
     */
    public function is_currency_batch_supported($batch)
    {
        return in_array(
                $batch->currA,
                $this->get_supported_currencies_id()
                )
                &&in_array(
                        $batch->currB,
                        $this->get_supported_currencies_id()
                        );
    }
    ////////////////////////////////////////////////////////////////////////////
    
    /**
     * determine_errors
     * @param SimpleXMLElement $object
     * @throws Exception
     */
    public function determine_errors(SimpleXMLElement $object)
    {
        /*if ($object->prCode != '000000')
        {
            throw new Exception('Exception has been acquired in API: ' . $this->get_api_url());
        }*/
    }
    ////////////////////////////////////////////////////////////////////////////
    
    /**
     * parse SimpleXMLElement response
     * @param SimpleXMLElement $object
     * @return array
     * @throws Exception
     */
    public function parse()
    {
        /*$result = array();
        
        $object = $this->request();
        foreach($object->rateOfExchangeList->baseRate as $row)
        {
            if ($this->is_currency_batch_supported($row))
            {
                $result[] = array(
                    'currA' => strval($row->currA),
                    'currB' => strval($row->currB),
                    'rate1' => strval($row->rate1),
                    'rate2' => strval($row->rate2),
                    'nameA' => $this->currencyHelper->code_to_currency($row->currA),
                    'nameB' => $this->currencyHelper->code_to_currency($row->currB),
                );
            }
        }*/
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
        
        return $result;
    }
    ////////////////////////////////////////////////////////////////////////////
}
