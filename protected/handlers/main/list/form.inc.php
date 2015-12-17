<?php

require_once HANDLERS_DIR . '/app_form.inc.php';

class MainListForm extends AppForm
{
    public function get_field_names()
    {
        return array(
            'sell_sum',
            'buy_sum',
            'sell_cur_id',
            'buy_cur_id',
            'outcome_pan_id',
            'income_pan_id',
            );
    }
}
