<?php

namespace ZdtLoggerModule\View\Helper;

use Zend\View\Helper\AbstractHelper;

class Log extends AbstractHelper
{
    private $_logger;
    
    public function __construct($logger) {
        $this->_logger = $logger;
    }
    
    public function __invoke($message)
    {
        $this->_logger->info($message);
    }
}
