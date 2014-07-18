<?php
if ($_SERVER['APPLICATION_ENV'] == 'development') {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

chdir(dirname(__DIR__));
include 'library/Zend/Loader/AutoloaderFactory.php';
if (!class_exists('Zend\Loader\AutoloaderFactory')) {
    throw new RuntimeException('No es posible referenciar las Librerías de Zend Framework 2.');
}
Zend\Loader\AutoloaderFactory::factory(array('Zend\Loader\StandardAutoloader' => array('autoregister_zf' => true)));

Zend\Mvc\Application::init(require 'config/application.config.php')->run();
