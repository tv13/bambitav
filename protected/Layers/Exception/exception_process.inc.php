<?php

class ExceptionProcessing extends Exception
{
    private $_tpl;
    private $_Data_exception;
    
    const TPL_PATH = 'inset/exception.tpl';
    /////////////////////////////////////////////////////////////////////////////
    
    public function __construct($message_code, $status = 0, $message = null)
    {
        if (!$message)
        {
            $this->_tpl = produce_tpl();
            $this->_Data_exception = $this->_parse_tpl($this->_get_template_data());
        }
        parent::__construct(
                PROJECT_NAME . (!$message ? $this->_get_message($message_code) : $message),
                ($status ? 1 : 0));
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _get_template_data()
    {
        return $this->_tpl->fetch(self::TPL_PATH);
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _parse_tpl($tpl_text)
    {
        $Data_exception = array();
        foreach (explode("\n", $tpl_text) as $line)
        {
            preg_match('/(\d+\s*): (.*)/', $line, $Code_mes);
            if (count($Code_mes) == 3)
            {
                $Data_exception[(int)@$Code_mes[1]] = trim((string)@$Code_mes[2]);
            }
        }
        return $Data_exception;
    }
    /////////////////////////////////////////////////////////////////////////////
    
    private function _get_message($code)
    {
        return (string)@$this->_Data_exception[$code];
    }
    /////////////////////////////////////////////////////////////////////////////
}