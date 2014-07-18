<?php
return array(
    'router' => array(
        'routes' => array(
            'contents' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/[:locale]/contents',
                    'constraints' => array(
                        'locale' => '([a-z]{2})',
                    ),
                    'defaults' => array(
                        'locale' => 'en',
                    ),
                ),
            ),
            'home' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/[:locale]',
                    'constraints' => array(
                        'locale' => '([a-z]{2})',
                    ),
                    'defaults' => array(
                        'locale' => 'en',
                        'controller' => 'Application\Controller\Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '[/]',
                            'defaults' => array(
                                'controller' => 'Application\Controller\Index',
                                'action' => 'index',
                            ),
                        ),
                    ),
                ),
            ),
            'application' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '[/:locale]/application',
                    'constraints' => array(
                        'locale' => '([a-z]{2})',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                        'locale' => 'en',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/][:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController'
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
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    'navigation' => array(
        'default' => array(
            'home' => array(
                'label' => 'Home',
                'route' => 'home',
                'use_route_match' => true,
                'order' => 1,
                'icon' => '/images/layout/menu-icons/home.png',
            ),
        ),
    ),
    'assets' => array(
        'moduleTitle' => 'Zend Framework 2 Course',
        'links' => array(
            '/css/reset.css',
            '/css/layout/layout.css',
            '/css/application/style.css',
            '/css/application/colorbox/default/colorbox.css',
        ),
        'scripts' => array(
            '/js/application/jquery-2.0.2.min.js',
            '/js/application/custom.jquery.colorbox.min.js',
            '/js/application/main.js',
        ),
        'metas' => array(
            'Content-Type' => 'text/html; charset=UTF-8',
        ),
    ),
);
