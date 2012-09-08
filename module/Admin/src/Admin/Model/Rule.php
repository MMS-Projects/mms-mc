<?php

namespace Admin\Model;

class Rule
{
    public $id;
    public $rule;
    public $points;

    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id'])) ? $data['id'] : null;
        $this->rule   = (isset($data['rule'])) ? $data['rule'] : null;
        $this->points = (isset($data['points'])) ? $data['points'] : null;
    }
}
