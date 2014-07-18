<?php
namespace Album\Form\AlbumForm\Tabs\GeneralDataTab;

use FormBuilder\Element\SubTab;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DescriptionSubTab extends SubTab implements ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    
    public function init() {
        
        $this->add(array(
            'name' => 'albums_description',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Description',
            ),
            'attributes' => array(
                'style' => 'width: 98.5%; height: 200px; resize: none;',
            ),
        ));
    }
    
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
        $this->serviceLocator = $serviceLocator->getServiceLocator();
    }

    public function getServiceLocator() {
        return $this->serviceLocator;
    }
}