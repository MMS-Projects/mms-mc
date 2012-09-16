<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Model\Rule;
use Admin\Form\RuleForm;

class RulesController extends AbstractActionController
{
    protected $ruleTable;

    public function indexAction()
    {
        return new ViewModel(array(
            'rules' => $this->getRuleTable()->fetchAll(),
        ));
    }

    public function addAction()
    {
        $form = new RuleForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $rule = new Rule();
            $form->setInputFilter($rule->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $rule->exchangeArray($form->getData());
                $this->getRuleTable()->saveRule($rule);

                // Redirect to list of rules
                return $this->redirect()->toRoute('admin', array(
                    'controller' => 'rules'
                ));
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('admin', array(
                'controller' => 'rules', 'action' => 'add'
            ));
        }
        $rule = $this->getRuleTable()->getRule($id);

        $form  = new RuleForm();
        $form->bind($rule);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($rule->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getRuleTable()->saveRule($rule);

                // Redirect to list of rules
                return $this->redirect()->toRoute('admin', array(
                    'controller' => 'rules'
                ));
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('admin', array(
                'controller' => 'rules'
            ));
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getRuleTable()->deleteRule($id);
            }

            // Redirect to list of rules
            return $this->redirect()->toRoute('admin', array(
                'controller' => 'rules'
            ));
        }

        return array(
            'id'    => $id,
            'rule'  => $this->getRuleTable()->getRule($id)
        );
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
