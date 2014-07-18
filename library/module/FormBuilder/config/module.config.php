<?php
return array(
    'view_helpers' => array(
        'invokables' => array(
            'FormBuilder' => 'FormBuilder\View\Helper\FormBuilder',
            'FormBuilderButtonsGroup' => 'FormBuilder\View\Helper\FormBuilderButtonsGroup',
            'FormBuilderTabsGroup' => 'FormBuilder\View\Helper\FormBuilderTabsGroup',
            'FormBuilderTab' => 'FormBuilder\View\Helper\FormBuilderTab',
            'FormBuilderSubTab' => 'FormBuilder\View\Helper\FormBuilderSubTab',
            'FormBuilderMultiCheckbox' => 'FormBuilder\View\Helper\FormBuilderMultiCheckbox',
            'FormBuilderRadio' => 'FormBuilder\View\Helper\FormBuilderRadio',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'assets' => array(
        'links' => array(
            '/css/form/forms.css',
        ),
    ),
);
