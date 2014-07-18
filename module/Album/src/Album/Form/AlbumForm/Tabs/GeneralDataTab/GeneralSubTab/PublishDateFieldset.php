<?php
namespace Album\Form\AlbumForm\Tabs\GeneralDataTab\GeneralSubTab;

use Zend\Form\Fieldset;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PublishDateFieldset extends Fieldset implements ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    
    public function init() {
        $this->add(array(
            'name' => 'albums_release_date',
            'type' => 'DateSelect',
            'options' => array(
                'label' => 'Release Date',
                'create_empty_option' => true,
                'min_year' => date('Y') - 30,
                'max_year' => date('Y') + 20,
            ),
        ));
        $this->add(array(
            'name' => 'albums_publication_date',
            'type' => 'DateSelect',
            'options' => array(
                'label' => 'Publication Date',
                'create_empty_option' => true,
                'min_year' => date('Y') - 30,
                'max_year' => date('Y') + 20,
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