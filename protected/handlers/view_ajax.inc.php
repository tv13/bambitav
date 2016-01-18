<?php

class ViewAjax extends ViewTemplated
{
    public function fill()
    {
         parent::fill();
         $this-> set_template('result_ajax.tpl');
         if ($this->Model->is_ajax())
         {
             header('Content-Type: application/json; charset=utf-8;');
         }
         $this-> assign('Result', array(
             'status'    => 1,
             'data'      => $this-> Model-> get_result()
         ));
    }
    ///////////////////////////////////////////////////////////////////////////
}
