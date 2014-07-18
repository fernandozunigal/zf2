<?php
return array(
    'router' => array(
        'routes' => array(
            'album' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '[/:locale]/album[/:controller[/:action]]',
                    'constraints' => array(
                        'locale' => '([a-z]{2})',
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Album\Controller',
                        'controller' => 'album',
                        'action' => 'index',
                        'locale' => 'en',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'wildcard' => array(
                        'type' => 'Wildcard',
                        'options' => array(
                            'key_value_delimiter' => '/',
                            'param_delimiter' => '/',
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
        'factories' => array(
            'ArtistTable' => function($serviceManager) {
                $dbAdapter = $serviceManager->get('Zend\Db\Adapter\Adapter');
                $tableGateway = new Zend\Db\TableGateway\TableGateway('artists', $dbAdapter, null);
                $table = new Album\Model\ArtistTable($tableGateway);
                return $table;
            },
            'CompanyRecordTable' => function($serviceManager) {
                $dbAdapter = $serviceManager->get('Zend\Db\Adapter\Adapter');
                $tableGateway = new Zend\Db\TableGateway\TableGateway('companies_record', $dbAdapter, null);
                $table = new Album\Model\CompanyRecordTable($tableGateway);
                return $table;
            },
            'MusicStylesTable' => function($serviceManager) {
                $dbAdapter = $serviceManager->get('Zend\Db\Adapter\Adapter');
                $tableGateway = new Zend\Db\TableGateway\TableGateway('music_styles', $dbAdapter, null);
                $table = new Album\Model\MusicStylesTable($tableGateway);
                return $table;
            },
            'FormatsTable' => function($serviceManager) {
                $dbAdapter = $serviceManager->get('Zend\Db\Adapter\Adapter');
                $tableGateway = new Zend\Db\TableGateway\TableGateway('formats', $dbAdapter, null);
                $table = new Album\Model\FormatsTable($tableGateway);
                return $table;
            },
            'AlbumTable' => function($serviceManager) {
                $dbAdapter = $serviceManager->get('Zend\Db\Adapter\Adapter');
                $tableGateway = new Zend\Db\TableGateway\TableGateway('albums', $dbAdapter, null);
                $table = new Album\Model\AlbumTable($tableGateway);
                return $table;
            },
            'OldAlbumForm' => function($serviceManager) {
                $form = new Album\Form\OldAlbumForm($serviceManager->get('ArtistTable'), $serviceManager->get('CompanyRecordTable'), $serviceManager->get('MusicStylesTable'), $serviceManager->get('FormatsTable'));
                return $form;
            },
        ),
    ),
    'form_elements' => array(
        'invokables' => array(
            'AlbumForm' => 'Album\Form\AlbumForm',
                'Tabs' => 'Album\Form\AlbumForm\Tabs',
                    'GeneralDataTab' => 'Album\Form\AlbumForm\Tabs\GeneralDataTab',
                        'GeneralSubTab' => 'Album\Form\AlbumForm\Tabs\GeneralDataTab\GeneralSubTab',
                            'MainInformationFieldset' => 'Album\Form\AlbumForm\Tabs\GeneralDataTab\GeneralSubTab\MainInformationFieldset',
                            'PublishDateFieldset' => 'Album\Form\AlbumForm\Tabs\GeneralDataTab\GeneralSubTab\PublishDateFieldset',
                        'AditionalSubTab' => 'Album\Form\AlbumForm\Tabs\GeneralDataTab\AditionalSubTab',
                            'MicrositeDataFieldset' => 'Album\Form\AlbumForm\Tabs\GeneralDataTab\AditionalSubTab\MicrositeDataFieldset',
                            'SalesDataFieldset' => 'Album\Form\AlbumForm\Tabs\GeneralDataTab\AditionalSubTab\SalesDataFieldset',
                            'EditionSecurityFieldset' => 'Album\Form\AlbumForm\Tabs\GeneralDataTab\AditionalSubTab\EditionSecurityFieldset',
                        'DescriptionSubTab' => 'Album\Form\AlbumForm\Tabs\GeneralDataTab\DescriptionSubTab',
                        'ImagesSubTab' => 'Album\Form\AlbumForm\Tabs\GeneralDataTab\ImagesSubTab',
                    'LanguagesTab' => 'Album\Form\AlbumForm\Tabs\LanguagesTab',
                    'RelationsTab' => 'Album\Form\AlbumForm\Tabs\RelationsTab',
                'Buttons' => 'Album\Form\AlbumForm\Buttons',
        ),
    ),
    'translator' => array(
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
            array(
                'type' => 'phpArray',
                'base_dir' => __DIR__ . '/../../../data/language',
                'pattern' => '%s/Zend_Validate.php',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Album\Controller\Album' => 'Album\Controller\AlbumController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            'album' => __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    'navigation' => array(
        'default' => array(
            'contents' => array(
                'label' => 'Contents',
                'route' => 'contents',
                'use_route_match' => true,
                'order' => 2,
                'class' => 'hasSubmenu',
                'icon' => '/images/layout/menu-icons/contents.png',
                'pages' => array(
                    'album' => array(
                        'label' => 'Albums',
                        'route' => 'album',
                        'use_route_match' => false,
                        'order' => 1,
                        'pages' => array(
                            'add' => array(
                                'label' => 'Add Album',
                                'route' => 'album',
                                'action' => 'add',
                                'controller' => 'album',
                                'use_route_match' => false,
                                'visible' => false,
                            ),
                            'edit' => array(
                                'label' => 'Edit Album',
                                'route' => 'album/wildcard',
                                'action' => 'edit',
                                'controller' => 'album',
                                'use_route_match' => true,
                                'visible' => false,
                            ),
                            'delete' => array(
                                'label' => 'Delete Album',
                                'route' => 'album/wildcard',
                                'action' => 'delete',
                                'controller' => 'album',
                                'use_route_match' => true,
                                'visible' => false,
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'assets' => array(
        'moduleTitle' => 'Album Administration',
    ),
);
