<?php
/**
 * This file is placed here for compatibility with ZendFramework 2's ModuleManager.
 * It allows usage of this module even without composer.
 * The original Module.php is in 'src/Jhu/ZdtLoggerModule' in order to respect PSR-0
 */

namespace ZdtLoggerModule;

use ZdtLoggerModule\ServiceFactory;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\InitProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\ModuleManagerInterface;

/**
 * @since   0.1
 * @author  Jérémy Huet <jeremy.huet@gmail.com>
 * @link    https://github.com/jhuet/JhuZdtLoggerModule
 * @package Jhu\ZdtLoggerModule
 * @license MIT
 */
class Module implements
    AutoloaderProviderInterface,
    BootstrapListenerInterface,
    ConfigProviderInterface,
    ServiceProviderInterface,
    InitProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function init(ModuleManagerInterface $manager)
    {
        $events = $manager->getEventManager();
        // Initialize logger collector once the profiler is initialized itself
        $events->attach('profiler_init', function(EventInterface $e) use ($manager) {
            $manager->getEvent()->getParam('ServiceManager')->get('ZdtLoggerModule\Collector');
        } );
    }

    /**
     * {@inheritDoc}
     */
    public function onBootstrap(EventInterface $e)
    {
        $application = $e->getParam('application');
        $config = $application->getServiceManager()->get('Config');

        // If the default logger is different and ZDT's toolbar is activated,
        // we initialize ours to add our functionalities
        if (
            $config['jhu']['zdt_logger']['logger'] != 'Zend\Log\Logger' &&
            $config['zenddevelopertools']['toolbar']['enabled'] == true
        ) {
            $application->getServiceManager()->get('zdt_logger');
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * {@inheritDoc}
     */
    public function getServiceConfig()
    {
        return array(
            'invokables' => array(
                'ZdtLoggerModule\Writer'    => 'ZdtLoggerModule\Writer\Stack',
                'ZdtLoggerModule\Logger'    => 'ZdtLoggerModule\Logger\ZdtLogger',
                'Zend\Log\Logger'           => 'Zend\Log\Logger',
            ),

            'factories' => array(
                'ZdtLoggerModule\LoggerFactory'    => new ServiceFactory\LoggerFactory(),
                'ZdtLoggerModule\Collector'        => new ServiceFactory\CollectorFactory(),
                'ZdtLoggerModule\Options'          => new ServiceFactory\ModuleOptionsFactory(),
            ),

            'aliases' => array(
                'zdt_logger' => 'ZdtLoggerModule\LoggerFactory',
            ),
        );
    }
}

