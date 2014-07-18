<?php
return array(
    'db' => array(
        'driver' => 'Pdo',
        'dsn' => 'mysql:dbname=zend2;host=localhost',
        'username' => 'zend2',
        'password' => 'zend2123Z',
        'driver_options' => array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"),
    ),
);
