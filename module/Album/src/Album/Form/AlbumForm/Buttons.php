<?php
namespace Album\Form\AlbumForm;

use FormBuilder\Element\ButtonsGroup;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Buttons extends ButtonsGroup implements ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    
    public function init() {
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Save',
                'id' => 'submitbutton',
                'class' => 'green',
            ),
        ));
        $this->add(array(
            'name' => 'reset',
            'type' => 'Button',
            'options' => array(
                'label' => 'Reset',
            ),
            'attributes' => array(
                'value' => 'Reset',
                'id' => 'resetbutton',
                'subType' => 'Reset',
            ),
        ));
        $this->add(array(
            'name' => 'cancel',
            'type' => 'Button',
            'options' => array(
                'label' => 'Cancel',
            ),
            'attributes' => array(
                'id' => 'cancelbutton',
                'class' => 'red',
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