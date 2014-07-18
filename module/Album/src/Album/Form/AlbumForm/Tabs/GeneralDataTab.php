<?php
namespace Album\Form\AlbumForm\Tabs;

use FormBuilder\Element\Tab;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class GeneralDataTab extends Tab implements ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    
    public function init() {
        $this->add(array(
            'name' => 'general',
            'type' => 'GeneralSubTab',
            'options' => array(
                'label' => 'General',
            ),
        ));
        $this->add(array(
            'name' => 'aditional',
            'type' => 'AditionalSubTab',
            'options' => array(
                'label' => 'Aditional',
            ),
        ));
        $this->add(array(
            'name' => 'description',
            'type' => 'DescriptionSubTab',
            'options' => array(
                'label' => 'Description',
            ),
        ));
        $this->add(array(
            'name' => 'images',
            'type' => 'ImagesSubTab',
            'options' => array(
                'label' => 'Images',
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