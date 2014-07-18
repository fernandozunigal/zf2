<?php
namespace Album\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class MusicStylesTable
{
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }
    
    public function getMusicStylesRadio(){
        $select = new Select('music_styles');
        $select->columns(array('value' => 'music_styles_PK', 'label' => 'music_styles_name'), false);
        $select->order("music_styles_name ASC");
        $musicStylesTableGateway = new TableGateway('music_styles', $this->tableGateway->getAdapter());
        $resultSet = $musicStylesTableGateway->selectWith($select);
        return $resultSet->toArray();
    }
}
