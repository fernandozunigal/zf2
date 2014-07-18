<?php
namespace Album;

use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $event)
    {
        $eventManager = $event->getApplication()->getEventManager();
        $eventManager->attach('render', array($this, 'setLayoutScript'));
        $eventManager->attach('render', array($this, 'setLayoutLink'));
        $eventManager->attach('render', array($this, 'setLayoutMeta'));
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
    
    public function setLayoutLink(MvcEvent $event){
        $moduleConfig = $this->getConfig();
        if(isset($moduleConfig['assets']['links'])){
            $links = $moduleConfig['assets']['links'];
            $headLinkHelper = $event->getApplication()->getServiceManager()->get('viewHelperManager')->get('headLink');
            $links = array_reverse($links);
            foreach ($links as $link) {
                $headLinkHelper->prependStylesheet($link, 'screen');
            }
        }
    }
    
    public function getAutoloaderConfig(){
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(__DIR__ . '/autoload_classmap.php'),
            'Zend\Loader\StandardAutoloader' => array('namespaces' => array(__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__))
        );
    }
    
    public function getConfig(){
        return include __DIR__ . '/config/module.config.php';
    }
}
