<?php
namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Album\Model\Album;
use Album\Table\AlbumTable;

class AlbumController extends AbstractActionController
{
    protected $_albumTable;
    protected $_oldAlbumForm;
    protected $_albumForm;
    
    public function indexAction(){
        $orderBy = $this->params()->fromQuery('name', null);
        $orderDirection = $this->params()->fromQuery('order', null);
        $albumTable = new AlbumTable();
        if($orderBy === null){
            $orderBy = $albumTable->orderBy;
            $orderDirection = $albumTable->orderDirection;
        }
        $albums = $this->_getAlbumTable()->fetchAll($orderBy, $orderDirection);
        if(get_class($albums) == 'Zend\Paginator\Paginator'){
            $albums->setCurrentPageNumber((int)$this->params()->fromQuery('page', 1));
            $albums->setItemCountPerPage((int)$this->params()->fromQuery('rows', 10));
            $albums->setPageRange(5);
        }
        if(!$this->getRequest()->isXmlHttpRequest()){
            $viewModel = new ViewModel(array('albums' => $albums, 'albumTable' => $albumTable));
            return $viewModel;
        } else {
            $tableViewHelper = $this->getServiceLocator()->get('viewhelpermanager')->get('table');
            $tableViewHelper->setRowSet($albums);
            $response = array('controls' => $tableViewHelper->controls(),
                              'data' => $tableViewHelper->data($albumTable->actions),
                              'messages' => $tableViewHelper->messages($albumTable->rowsTitle),
                             );
            $jsonModel = new JsonModel($response);
            return $jsonModel;
        }
    }
    
    public function addAction(){
        $form = $this->_getAlbumForm();
        $form->get('submit')->setValue('Create');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $album = new Album();
            $form->setInputFilter($album->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $album->exchangeArray($form->getData());
                $this->_getAlbumTable()->saveAlbum($album);
                return $this->redirect()->toRoute('album', array('locale' => $this->layout()->getVariable('locale')));
            }
        }
        return new ViewModel(array('form' => $form));
    }
    
    public function oldEditAction(){
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('album/wildcard', array('locale' => $this->layout()->getVariable('locale'), 'action' => 'add'));
        }
        try {
            $album = $this->_getAlbumTable()->getAlbum($id);
        } catch (\Exception $ex) {
            return $this->redirect()->toRoute('album', array('locale' => $this->layout()->getVariable('locale')));
        }
        $form = $this->_getOldAlbumForm();
        $form->bind($album);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($album->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->_getAlbumTable()->saveAlbum($album);
                return $this->redirect()->toRoute('album', array('locale' => $this->layout()->getVariable('locale')));
            }
        }
        return new ViewModel(array('id' => $id, 'form' => $form));
    }
    
    public function editAction(){
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('album/wildcard', array('locale' => $this->layout()->getVariable('locale'), 'action' => 'add'));
        }
        try {
            $album = $this->_getAlbumTable()->getAlbum($id);
        } catch (\Exception $ex) {
            return $this->redirect()->toRoute('album', array('locale' => $this->layout()->getVariable('locale')));
        }
        $form = $this->_getAlbumForm();
        $form->bind($album);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($album->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->_getAlbumTable()->saveAlbum($album);
                return $this->redirect()->toRoute('album', array('locale' => $this->layout()->getVariable('locale')));
            }
        }
        return new ViewModel(array('id' => $id, 'form' => $form));
    }
    
    public function deleteAction(){
        $request = $this->getRequest();
        if($request->isXmlHttpRequest() && $request->isPost()){
            $ids = explode(',' ,$request->getPost('ids'));
            if ($ids) {
                $this->_getAlbumTable()->deleteAlbum($ids);
            }
        }
        $jsonModel = new JsonModel(array('error' => false));
        return $jsonModel;
    }
    
    private function _getAlbumTable(){
        if (!$this->_albumTable) {
            $serviceManager = $this->getServiceLocator();
            $this->_albumTable = $serviceManager->get('AlbumTable');
        }
        return $this->_albumTable;
    }
    
    private function _getOldAlbumForm(){
        if (!$this->_oldAlbumForm) {
            $elementManager = $this->getServiceLocator()->get('FormElementManager');
            $this->_oldAlbumForm = $elementManager->get('OldAlbumForm');
        }
        return $this->_oldAlbumForm;
    }
    
    private function _getAlbumForm(){
        if (!$this->_albumForm) {
            $elementManager = $this->getServiceLocator()->get('FormElementManager');
            $this->_albumForm = $elementManager->get('AlbumForm');
        }
        return $this->_albumForm;
    }
}
