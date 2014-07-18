<?php
return array(
    'view_helpers' => array(
        'invokables' => array(
            'StringToId' => 'Table\View\Helper\StringToId',
        ),
        'factories' => array(
            'table' => function($serviceManager) {
                $router = $serviceManager->getServiceLocator()->get('Router');
                $request = $serviceManager->getServiceLocator()->get('Request');
                return new Table\View\Helper\Table($router->match($request)->getMatchedRouteName());
            },
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    'assets' => array(
        'links' => array(
            '/css/table/tables.css',
        ),
    ),
);
