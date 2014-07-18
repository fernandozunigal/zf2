<?php
namespace Album\Form\AlbumForm\Tabs\GeneralDataTab\AditionalSubTab;

use Zend\Form\Fieldset;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MicrositeDataFieldset extends Fieldset implements ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    
    public function init() {
        $this->add(array(
            'name' => 'albums_microsite_url',
            'type' => 'Url',
            'options' => array(
                'label' => 'Url',
            ),
            'attributes' => array(
                'class' => 'full-width',
            ),
        ));
        $this->add(array(
            'name' => 'albums_microsite_background_color',
            'type' => 'Color',
            'options' => array(
                'label' => 'Background Color',
            ),
        ));
        $this->add(array(
            'name' => 'albums_email',
            'type' => 'Email',
            'options' => array(
                'label' => 'Email Info',
            ),
            'attributes' => array(
                'class' => 'full-width',
            ),
        ));
        $this->add(array(
            'name' => 'albums_publish',
            'type' => 'Checkbox',
            'options' => array(
                'label' => 'Publish',
                'use_hidden_element' => false,
            ),
            'attributes' => array(
                'class' => 'switch',
                'style' => 'display: none;',
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