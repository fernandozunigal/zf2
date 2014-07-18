<?php
namespace Album\Form\AlbumForm\Tabs\GeneralDataTab;

use FormBuilder\Element\SubTab;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AditionalSubTab extends SubTab implements ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    
    public function init() {
        
        $this->add(array(
            'name' => 'microsite_data',
            'type' => 'MicrositeDataFieldset',
            'options' => array(
                'label' => 'Microsite Data',
            ),
        ));
        $this->add(array(
            'name' => 'sales_data',
            'type' => 'SalesDataFieldset',
            'options' => array(
                'label' => 'Sales Data',
            ),
        ));
        $this->add(array(
            'name' => 'edition_security',
            'type' => 'EditionSecurityFieldset',
            'options' => array(
                'label' => 'Edition Security',
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