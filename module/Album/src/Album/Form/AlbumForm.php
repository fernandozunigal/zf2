<?php
namespace Album\Form;

use Zend\Form\Form;

class AlbumForm extends Form
{
    public function init(){
        
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
            'name' => 'tabs',
            'type' => 'Tabs',
        ));
        $this->add(array(
            'name' => 'buttons_group',
            'type' => 'Buttons',
        ));
    }
}