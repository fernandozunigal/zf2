<?php

namespace ZdtLoggerModule\Logger;

use Zend\Log\Logger;
use Zend\Debug\Debug;

class ZdtLogger extends Logger
{
    
    public function log($priority, $message, $extra = array()) {
        $message = Debug::dump($message, null, false);
        parent::log($priority, $message, $extra);
    }
    
}
