<?php
namespace Album\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class FormatsTable
{
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }
    
    public function getFormatsCheck(){
        $select = new Select('formats');
        $select->columns(array('value' => 'formats_PK', 'label' => 'formats_name'), false);
        $select->order("formats_name ASC");
        $formatsTableGateway = new TableGateway('formats', $this->tableGateway->getAdapter());
        $resultSet = $formatsTableGateway->selectWith($select);
        return $resultSet->toArray();
    }
}
