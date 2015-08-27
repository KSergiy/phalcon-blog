<?php

defined('APP_PATH') || define('APP_PATH', realpath('.'));

return new \Phalcon\Config(array(
    'database' => array(
        'adapter'     => 'Mysql',
        'host'        => 'localhost',
        'username'    => 'retrobazar_base',
        'password'    => 'winston',
        'dbname'      => 'jinsei',
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
        'publicUrl'      => 'http://jinsei.com.ua',
        'cryptSalt'      => 'eEAfR|_&G&f,+vU]:jFr!!A&+71w1Ms9~8_4L!<@[N@DyaIP_2My|:+.u>/6m,$D'
    ),
    'media' => array(
        'uploadPath'    => APP_PATH . '/public/images/'
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
