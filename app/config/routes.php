<?php

/**
 * Initialize routers
 */
$router = new \Phalcon\Mvc\Router(false);

$router->add("/search/search", array(
    'controller' => 'search',
    'action'     => 'search',
));

$router->add("/{page}[/]", array(
    'controller' => 'index',
    'action'     => 'index'
));

$router->add("/contacts/send/", array(
    'controller' => 'info',
    'action'     => 'send'
));

$router->add("/sitemap/", array(
    'controller' => 'sitemap',
    'action'     => 'index'
));

$router->add("/filter/{action}.html", array(
    'controller' => 'filter',
    'action'     => 1
));

return $router;