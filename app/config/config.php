<?php

defined('APP_PATH') || define('APP_PATH', realpath('.'));

return new \Phalcon\Config(array(
    'database' => array(
        'adapter'     => 'Mysql',
        'host'        => 'localhost',
        'username'    => '',
        'password'    => '',
        'dbname'      => '',
        'charset'     => 'utf8',
    ),
    'application' => array(
        'controllersDir' => APP_PATH . '/app/controllers/',
        'modelsDir'      => APP_PATH . '/app/models/',
        'migrationsDir'  => APP_PATH . '/app/migrations/',
        'viewsDir'       => APP_PATH . '/app/views/',
        'pluginsDir'     => APP_PATH . '/app/plugins/',
        'libraryDir'     => APP_PATH . '/app/library/',
        'formsDir'       => APP_PATH . '/app/forms/',
        'cacheDir'       => APP_PATH . '/app/cache/',
        'baseUri'        => '/',
        'publicUrl'      => ''
    ),
    'mail' => array(
        'fromName' => '',
        'fromEmail' => '',
        'smtp' => array(
            'server'	=> 'smtp.yandex.ua',
            'port'      => 465,
            'security'  => 'ssl',
            'username'  => '',
            'password'  => '',
        )
    ),
));
