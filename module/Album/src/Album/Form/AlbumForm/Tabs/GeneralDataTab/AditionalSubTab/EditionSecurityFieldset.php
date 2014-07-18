<?php
namespace Album\Form\AlbumForm\Tabs\GeneralDataTab\AditionalSubTab;

use Zend\Form\Fieldset;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class EditionSecurityFieldset extends Fieldset implements ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    
    public function init() {
        $this->add(array(
            'name' => 'albums_edit_password',
            'type' => 'Password',
            'options' => array(
                'label' => 'Password',
            ),
            'attributes' => array(
                'class' => 'full-width',
            ),
        ));
        $this->add(array(
            'name' => 'albums_edit_password_verify',
            'type' => 'Password',
            'options' => array(
                'label' => 'Password Verify',
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