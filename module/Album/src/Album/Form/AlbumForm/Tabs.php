<?php
namespace Album\Form\AlbumForm;

use FormBuilder\Element\TabsGroup;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Tabs extends TabsGroup implements ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    
    public function init(){        
        $this->add(array(
            'name' => 'general_data',
            'type' => 'GeneralDataTab',
            'options' => array(
                'label' => 'General Data',
            ),
        ));
        $this->add(array(
            'name' => 'languages',
            'type' => 'LanguagesTab',
            'options' => array(
                'label' => 'Languages',
            ),
        ));
        $this->add(array(
            'name' => 'relations',
            'type' => 'RelationsTab',
            'options' => array(
                'label' => 'Relations',
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