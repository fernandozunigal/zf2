<?php
namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Validator\AbstractValidator;
use Zend\ModuleManager\ModuleEvent;
use Zend\ModuleManager\ModuleManager;

class Module
{
    private $_moduleConfig;
    
    public function init(ModuleManager $moduleManager)
    {
        $events = $moduleManager->getEventManager();
        $events->attach(ModuleEvent::EVENT_LOAD_MODULES_POST, array($this, 'setModuleConfig'));
    }
    
    public function setModuleConfig(ModuleEvent $event){
        $this->_moduleConfig = $event->getConfigListener()->getMergedConfig(false);
    }
    
    public function onBootstrap(MvcEvent $event)
    {
        $eventManager = $event->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        $eventManager->attach(MvcEvent::EVENT_ROUTE, array($this, 'setTranslatorLocale'));
        $eventManager->attach(MvcEvent::EVENT_RENDER, array($this, 'setLayoutLink'));
        $eventManager->attach(MvcEvent::EVENT_RENDER, array($this, 'setLayoutTitle'));
        $eventManager->attach(MvcEvent::EVENT_RENDER, array($this, 'setLayoutScript'));
        $eventManager->attach(MvcEvent::EVENT_RENDER, array($this, 'setLayoutMeta'));
    }

    public function setTranslatorLocale(MvcEvent $event) {
        $translator = $event->getApplication()->getServiceManager()->get('translator');
        ($event->getRouteMatch()->getParam('locale'))? $locale = $event->getRouteMatch()->getParam('locale') : $locale = 'en';
//        $translator->setLocale($locale);
        $event->getViewModel()->setVariable('locale', $locale);
        AbstractValidator::setDefaultTranslator($translator);
    }
    
    public function setLayoutLink(MvcEvent $event){
        $moduleConfig = $this->_moduleConfig;
        if(isset($moduleConfig['assets']['links'])){
            $links = $moduleConfig['assets']['links'];
            $headLinkHelper = $event->getApplication()->getServiceManager()->get('viewHelperManager')->get('headLink');
            $links = array_reverse($links);
            foreach ($links as $link) {
                $headLinkHelper->prependStylesheet($link, 'screen');
            }
        }
    }
    
    public function setLayoutScript(MvcEvent $event){
        $moduleConfig = $this->getConfig();
        if(isset($moduleConfig['assets']['scripts'])){
            $scripts = $moduleConfig['assets']['scripts'];
            $headScriptHelper = $event->getApplication()->getServiceManager()->get('viewHelperManager')->get('headScript');
            $scripts = array_reverse($scripts);
            foreach ($scripts as $script) {
                $headScriptHelper->prependFile($script, $type = 'text/javascript');
            }
        }
    }
    
    public function setLayoutMeta(MvcEvent $event){
        $moduleConfig = $this->getConfig();
        ($event->getRouteMatch() !== null && $event->getRouteMatch()->getParam('locale'))? $locale = $event->getRouteMatch()->getParam('locale') : $locale = 'en';
        $headMetaHelper = $event->getApplication()->getServiceManager()->get('viewHelperManager')->get('headMeta');
        $headMetaHelper->appendHttpEquiv('Content-Language', $locale);
        if(isset($moduleConfig['assets']['metas'])){
            $metas = $moduleConfig['assets']['metas'];
            $metas = array_reverse($metas);
            foreach ($metas as $metaName => $metaValue) {
                $headMetaHelper->appendHttpEquiv($metaName, $metaValue);
            }
        }
    }
    
    public function setLayoutTitle(MvcEvent $event){
        $moduleConfig = $this->getConfig();
        if(isset($moduleConfig['assets']['moduleTitle'])){
            $siteName = $moduleConfig['assets']['moduleTitle'];
            $headTitleHelper = $event->getApplication()->getServiceManager()->get('viewHelperManager')->get('headTitle');
            $headTitleHelper->setSeparator(' - ');
            $headTitleHelper->prepend($siteName);
        }
    }
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

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
}
