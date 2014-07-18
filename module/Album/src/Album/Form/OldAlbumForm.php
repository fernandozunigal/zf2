<?php
namespace Album\Form;

use Zend\Form\Form;
use Album\Model\ArtistTable;
use Album\Model\CompanyRecordTable;
use Album\Model\MusicStylesTable;
use Album\Model\FormatsTable;

class OldAlbumForm extends Form
{
    public function __construct(ArtistTable $artistTable, CompanyRecordTable $companyRecordTable, MusicStylesTable $musicStylesTable, FormatsTable $formatsTable, $name = null){
        parent::__construct('album');
        
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'block-content form');
        $this->setLabel('Albums Form');
        $this->add(array(
            'name' => 'csrf',
            'type' => 'Csrf',
            'options' => array(
                'csrf_options' => array(
                    'timeout' => 600
                )
            )
        ));
        $this->add(array(
            'name' => 'albums_PK',
            'type' => 'Hidden',
        ));
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
                'value_options' => $artistTable->getArtistSelect(),
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
                'value_options' => $companyRecordTable->getCompanyRecordSelect(),
            ),
            'attributes' => array(
                'class' => 'full-width',
            ),
        ));
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
        $this->add(array(
            'name' => 'albums_FK_music_styles_PK',
            'type' => 'Radio',
            'options' => array(
                'label' => 'Music Styles',
                'value_options' => $musicStylesTable->getMusicStylesRadio(),
            ),
        ));
        $this->add(array(
            'name' => 'albums_has_formats',
            'type' => 'MultiCheckbox',
            'options' => array(
                'label' => 'Formats',
                'value_options' => $formatsTable->getFormatsCheck(),
            ),
        ));
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
        $this->add(array(
            'name' => 'albums_description',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Description',
            ),
            'attributes' => array(
                'style' => 'width: 98.5%; height: 200px; resize: none;',
            ),
        ));
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
}