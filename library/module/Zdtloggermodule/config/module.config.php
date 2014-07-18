<?php
return array(
    'zdt_logger' => array(
        'logger' => 'ZdtLoggerModule\LoggerFactory'
    ),
    'view_manager' => array(
        'template_map' => array(
            'zend-developer-tools/toolbar/jhu-zdt-logger' => __DIR__ . '/../view/zend-developer-tools/toolbar/jhu-zdt-logger.phtml',
        ),
    ),
    'zenddevelopertools' => array(
        'profiler' => array(
            'collectors' => array(
                'jhu_zdt_logger' => 'ZdtLoggerModule\Collector',
            ),
        ),
        'toolbar' => array(
            'entries' => array(
                'jhu_zdt_logger' => 'zend-developer-tools/toolbar/jhu-zdt-logger',
            ),
        ),
    ),
    'view_helpers' => array(
        'factories' => array(
            'log' => function($serviceManager) {
                $logger = $serviceManager->getServiceLocator()->get('zdt_logger');
                return new ZdtLoggerModule\View\Helper\Log($logger);
            },
        ),
    ),
    'controller_plugins' => array(
        'invokables' => array(
            'Log' => 'ZdtLoggerModule\Controller\Plugin\Log',
        )
    ),
);
