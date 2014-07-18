<?php
namespace Album\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;
use Zend\Db\Sql\Where;

class AlbumTable
{
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }
    
    public function fetchAll($orderName = null, $orderDirection = null, $paginated = true) {
        $select = new Select('albums');
        $select->columns(array('id' => 'albums_PK', 'albums_title', 'artists_name', 'companies_record_name', 'albums_publication_date', 'albums_release_date'), false);
        $select->join('artists', 'albums_FK_artists_PK = artists_PK', array(), $select::JOIN_LEFT);
        $select->join('companies_record', 'albums_FK_companies_record_PK = companies_record_PK', array(), $select::JOIN_LEFT);
        if($orderName !== null) $select->order("$orderName $orderDirection");
        if($paginated){
            $paginatorAdapter = new DbSelect($select, $this->tableGateway->getAdapter());
            $resultSet = new Paginator($paginatorAdapter);
        } else {
            $albumTableGateway = new TableGateway('albums', $this->tableGateway->getAdapter());
            $resultSet = $albumTableGateway->selectWith($select);
        }
        return $resultSet;
    }
    
    public function getAlbum($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('albums_PK' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("No es posible encontrar el Album $id");
        }
        return $row;
    }
    
    public function saveAlbum(Album $album) {
        $data = array(
            'albums_FK_artists_PK' => $album->albums_FK_artists_PK,
            'albums_title' => $album->albums_title,
        );
        $id = (int)$album->albums_PK;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getAlbum($id)) {
                $this->tableGateway->update($data, array('albums_PK' => $id));
            } else {
                throw new \Exception("No es posible Modificar el Album $id ya que no existe.");
            }
        }
    }
    
    public function deleteAlbum($ids) {
        $where = new Where();
        $where->in('albums_PK', $ids);
        $this->tableGateway->delete($where);
    }
}
