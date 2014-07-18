<?php
namespace Album\Form\AlbumForm\Tabs\GeneralDataTab;

use FormBuilder\Element\SubTab;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class GeneralSubTab extends SubTab implements ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    
    public function init() {
        
        $this->add(array(
            'name' => 'main_information',
            'type' => 'MainInformationFieldset',
            'options' => array(
                'label' => 'Main Information',
            ),
        ));
        $this->add(array(
            'name' => 'publish_date',
            'type' => 'PublishDateFieldset',
            'options' => array(
                'label' => 'Publish Date',
            ),
        ));
        $this->add(array(
            'name' => 'albums_FK_music_styles_PK',
            'type' => 'Radio',
            'options' => array(
                'label' => 'Music Styles',
                'value_options' => $this->serviceLocator->get('musicStylesTable')->getMusicStylesRadio(),
            ),
        ));
        $this->add(array(
            'name' => 'albums_has_formats',
            'type' => 'MultiCheckbox',
            'options' => array(
                'label' => 'Formats',
                'value_options' => $this->serviceLocator->get('formatsTable')->getFormatsCheck(),
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