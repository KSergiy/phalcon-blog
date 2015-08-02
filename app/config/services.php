<?php
/**
 * Services are globally registered in this file
 *
 * @var \Phalcon\Config $config
 */
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Dispatcher\Exception as DispatchException;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Security;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Forms\Manager as FormsManager;
use Phalcon\Cache\Frontend\Output as OutputFrontend;
use Phalcon\Cache\Frontend\Data as FrontendData;
use Phalcon\Cache\Backend\Memcache as BackendMemcache;


//use phalcon-blog\Auth;
/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();
/**
 * We register the events manager
 */
$di->set('dispatcher', function() use ($di) {
	$eventsManager = new EventsManager;
	/**
	 * Check if the user is allowed to access certain action using the SecurityPlugin
	 */
	//$eventsManager->attach('dispatch:beforeDispatch', new SecurityPlugin);
   
	/**
	 * Handle exceptions and not-found exceptions using NotFoundPlugin
	 */
	$eventsManager->attach('dispatch:beforeException', 
        function($event, $dispatcher, $exception) {
            switch ( $exception->getCode() ) {
                case Dispatcher::EXCEPTION_HANDLER_NOT_FOUND:
                case Dispatcher::EXCEPTION_ACTION_NOT_FOUND:
                    $dispatcher->forward(
                        array(
                            'controller' => 'index',
                            'action' => 'error404',
                        )
                    );
                    return false;
                    break; // for checkstyle
                default:
                    $dispatcher->forward(
                        array(
                            'controller' => 'index',
                            'action' => 'error404',
                        )
                    );
                    return false;
                    break;
            }
        });
        
	$dispatcher = new Dispatcher;
	$dispatcher->setEventsManager($eventsManager);
        
	return $dispatcher;
});
/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->set('url', function () use ($config) {
    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
}, true);

/**
 * Setting up the view component
 */
$di->setShared('view', function () use ($config) {

    $view = new View();

    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines(array(
        '.volt' => function ($view, $di) use ($config) {

            $volt = new VoltEngine($view, $di);

            $volt->setOptions(array(
                'compiledPath' => $config->application->cacheDir,
                'compiledSeparator' => '_'
            ));

            return $volt;
        },
        '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
    ));

    return $view;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->set('db', function () use ($config) {
    return new DbAdapter($config->database->toArray());
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->set('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});

/**
 * Register the flash service with custom CSS classes
 */
$di->set('flash', function(){
    return new FlashSession(array(
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
    ));
});

/**
 * Register a user component
 */
$di->set('elements', function(){
    return new Elements();
});
/**
 * Register auth component
 */
$di->set('auth', function() {
    return new Auth_Auth();
});

// Store it in the Di container
$di->set('config', $config);

/**
 * Register cache for models
 */
$di->set('modelsCache', function(){
    
    // Cache data for one day by default
    $frontCache = new FrontendData(array(
        "lifetime" => 172800
    ));

    // Memcached connection settings
    $cache = new BackendMemcache($frontCache, array(
        "host" => "localhost",
        "port" => "11211"
    ));

    return $cache;
    
});

//Set the views cache service
$di->set('viewCache', function() {

    //Cache data for one day by default
    $frontCache = new OutputFrontend(array(
        "lifetime" => 172800
    ));

    //Memcached connection settings
    $cache = new BackendMemcache($frontCache, array(
        "host" => "localhost",
        "port" => "11211"
    ));

    return $cache;
});
/**
 * Register security module
 */
$di->set('security', function() {
    $security = new Security();

    $security->setWorkFactor(12);

    return $security;
}, true);

$di->set('forms', function() {
    return new FormsManager();
});

/**
 * Mail service uses AmazonSES
 */
$di->set('mail', function() use ($config) {
    return new Mail( $config );
});

$di->set('router', function () {
    return include __DIR__ . '/routes.php';
}, true);