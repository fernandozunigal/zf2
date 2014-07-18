<?php
namespace Album\Form\AlbumForm\Tabs\GeneralDataTab\AditionalSubTab;

use Zend\Form\Fieldset;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SalesDataFieldset extends Fieldset implements ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    
    public function init() {
        $this->add(array(
            'name' => 'albums_copies_sold',
            'type' => 'Number',
            'options' => array(
                'label' => 'Copies Sold',
            ),
            'attributes' => array(
                'class' => 'full-width',
            ),
        ));
        $this->add(array(
            'name' => 'albums_estimated_concerts',
            'type' => 'Range',
            'options' => array(
                'label' => 'Estimated Concerts',
            ),
            'attributes' => array(
                'class' => 'full-width',
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