<?php

/**
 * Initialize routers
 */
$router = new \Phalcon\Mvc\Router(false);

$router->add("/", array(
    'controller' => 'index',
    'action'     => 'index'
))->setName('home');

$router->add("/about.html", array(
    'controller' => 'info',
    'action'     => 'info'
))->setName('info');

$router->add("/admin/", array(
    'controller' => 'admin',
    'action'     => 'admin'
))->setName('admin');

$router->add('/pages/{action}/{id}', array(
    'controller' => 'pages',
    'action'     => 1,
    'id'         => 2,
    'lang'       => 3
));

$router->add('/pages/{action}/{id}/{lang}', array(
    'controller' => 'pages',
    'action'     => 1,
    'id'         => 2,
    'lang'       => 3
));

$router->add('/publications/{action}/', array(
    'controller' => 'publications',
    'action'     => 1
));

$router->add("/contacts.html", array(
    'controller' => 'info',
    'action'     => 'contacts'
))->setName('contacts');

$router->add("/search/search", array(
    'controller' => 'search',
    'action'     => 'search',
));

$router->add("/sitemap/", array(
    'controller' => 'sitemap',
    'action'     => 'index'
));

$router->add("/filter/{action}.html", array(
    'controller' => 'filter',
    'action'     => 1
));

$router->add("/login/", array(
    'controller' => 'login',
    'action'     => 'login'
));

$router->add("/login/{action}/", array(
    'controller' => 'login',
    'action'     => 1
));

return $router;