<?php

namespace ZdtLoggerModule\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class Log extends AbstractPlugin
{
    public function __invoke($message) {
        $this->getController()->getServiceLocator()->get('zdt_logger')->info($message);
    }
}
