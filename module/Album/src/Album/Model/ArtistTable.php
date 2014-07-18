<?php
namespace Album\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class ArtistTable
{
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }
    
    public function getArtistSelect(){
        $select = new Select('artists');
        $select->columns(array('value' => 'artists_PK', 'label' => 'artists_name'), false);
        $select->order("artists_name ASC");
        $artistTableGateway = new TableGateway('artists', $this->tableGateway->getAdapter());
        $resultSet = $artistTableGateway->selectWith($select);
        return $resultSet->toArray();
    }
}
