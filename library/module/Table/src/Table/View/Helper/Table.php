<?php
namespace Table\View\Helper;
 
use Zend\View\Helper\AbstractHelper;

class Table extends AbstractHelper
{
 
    private $_rowSet;
    private $_routeName;
    
    public function __construct($routeName) {
        $this->_routeName = $routeName;
    }
    
    public function all($table)
    {
        $html = $this->view->partial('partial/table.phtml', array('rowSet' => $this->_rowSet, 'table' => $table, 'routeName' => $this->_routeName));
        return $html;
    }
    
    public function controls()
    {
        $html = $this->view->partial('partial/table/controls.phtml', array('rowSet' => $this->_rowSet, 'route'=>$this->_routeName));
        return $html;
    }
    
    public function data($actions)
    {
        $html = $this->view->partial('partial/table/tableData.phtml', array('rowSet' => $this->_rowSet, 'actions' => $actions, 'routeMatch' => $this->_routeName));
        return $html;
    }
    
    public function messages($rowsTitle)
    {
        $html = '';
        if(get_class($this->_rowSet) == 'Zend\Paginator\Paginator'){
            $html .= $this->view->paginationControl($this->_rowSet, 'Sliding', array('partial/table/tableInfo.phtml', 'table'), array("rowsTitle" => $rowsTitle)) . PHP_EOL;
        }
        return $html;
    }
    
    public function setRowSet($rowSet){
        (get_class($rowSet) == 'Zend\Paginator\Paginator')? $rowSet->getIterator()->buffer() : $rowSet->buffer();
        $this->_rowSet = $rowSet;
        return $this;
    }
}