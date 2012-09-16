<?php

namespace Admin\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;

class RuleTable extends AbstractTableGateway
{
    protected $table = 'rules';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Rule());
        $this->initialize();
    }

    public function fetchAll()
    {
        $resultSet = $this->select();
        return $resultSet;
    }

    public function getRule($id)
    {
        $id  = (int) $id;
        $rowset = $this->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveRule(Rule $rule)
    {
        $data = array(
            'rule'    => $rule->rule,
            'points'  => $rule->points,
        );
        $id = (int)$rule->id;
        if ($id == 0) {
            $this->insert($data);
        } else {
            if ($this->getRule($id)) {
                $this->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteRule($id)
    {
        $this->delete(array('id' => $id));
    }
}
