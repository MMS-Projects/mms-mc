<?php

namespace Admin\Form;

use Zend\Form\Form;

class RuleForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('rule');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        $this->add(array(
            'name' => 'rule',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Rule',
            ),
        ));
        $this->add(array(
            'name' => 'points',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Points',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }
}
