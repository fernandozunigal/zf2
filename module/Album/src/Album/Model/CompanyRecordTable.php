<?php
namespace Album\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class CompanyRecordTable
{
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }
    
    public function getCompanyRecordSelect(){
        $select = new Select('companies_record');
        $select->columns(array('value' => 'companies_record_PK', 'label' => 'companies_record_name'), false);
        $select->order("companies_record_name ASC");
        $artistTableGateway = new TableGateway('companies_record', $this->tableGateway->getAdapter());
        $resultSet = $artistTableGateway->selectWith($select);
        return $resultSet->toArray();
    }
}
