<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class RulesController extends AbstractActionController
{
    protected $ruleTable;
    
    public function indexAction()
    {
        return new ViewModel(array(
            'rules' => $this->getRuleTable()->fetchAll(),
        ));
    }
    
    public function getRuleTable()
    {
        if (!$this->ruleTable) {
            $sm = $this->getServiceLocator();
            $this->ruleTable = $sm->get('Admin\Model\RuleTable');
        }
        return $this->ruleTable;
    }
}
