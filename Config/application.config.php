<?php
return array(
    'modules' => array(
        'Album',
        'Application',
        'Table',
        'FormBuilder',
        'Zenddevelopertools',
        'Bjyprofiler',
        'Zdtloggermodule',
    ),
    'module_listener_options' => array(
        'config_glob_paths' => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
        'module_paths' => array(
            './module',
            './library/module',
        ),
    ),
);