<?php

class ViewAjax extends ViewTemplated
{
    public function fill()
    {
         parent::fill();
         $this-> set_template('result_ajax.tpl');
         $this-> assign('Result', $this-> Model-> get_result());
    }
    ///////////////////////////////////////////////////////////////////////////
}
