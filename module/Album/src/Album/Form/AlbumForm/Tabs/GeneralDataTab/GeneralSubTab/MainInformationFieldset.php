<?php
namespace Album\Form\AlbumForm\Tabs\GeneralDataTab\GeneralSubTab;

use Zend\Form\Fieldset;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MainInformationFieldset extends Fieldset implements ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    
    public function init() {
        $this->add(array(
            'name' => 'albums_title',
            'type' => 'Text',
            'options' => array(
                'label' => 'Title',
            ),
            'attributes' => array(
                'class' => 'full-width',
            ),
        ));
        $this->add(array(
            'name' => 'albums_FK_artists_PK',
            'type' => 'Select',
            'options' => array(
                'label' => 'Artist',
                'empty_option' => '',
                'value_options' => $this->serviceLocator->get('ArtistTable')->getArtistSelect(),
            ),
            'attributes' => array(
                'class' => 'full-width',
            ),
        ));
        $this->add(array(
            'name' => 'albums_FK_companies_record_PK',
            'type' => 'Select',
            'options' => array(
                'label' => 'Company Record',
                'empty_option' => '',
                'value_options' => $this->serviceLocator->get('companyRecordTable')->getCompanyRecordSelect(),
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