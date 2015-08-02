<?php

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

class ControllerBase extends Controller
{
    public $expireDate;

    public $authStatus = FALSE;

    protected function initialize( )
    {
        $expireDate = new DateTime();
        
        $expireDate->modify('+2 months');

        if ( empty( $this->expireDate ) )
        {
            //$this->expireDate = new Time();
        }

        $this->response->setHeader( 'Last-Modified', gmdate("D, d M Y H:i:s", strtotime($this->expireDate)) );
        
        $this->response->setExpires($expireDate);
        
        $this->tag->appendTitle(' - Jinsei');
        
        $this->view->setTemplateAfter('main');
        
        //$staticPages = Pages::query()->where( 'type = 1' )->order( 'position' )->execute();

        //$auth = $this->session->get('auth-identity');

        $this->view->setVars(array(
            'url'  => $this->config->application->publicUrl,
            'auth' => $this->session->get('auth-identity')
            //'staticMenu' => $staticPages,
        ));
    }
    
    protected function beforeExecuteRoute( Dispatcher $dispatcher )
    {
        /*
        $this->authStatus = $this->session->get('auth-identity');

        $controllerName = $dispatcher->getControllerName();

        if ( !$this->authStatus && $controllerName == 'pages' )
        {
            $this->dispatcher->forward(array('controller' => 'index', 'action' => 'index'));
        }
*/
        // Add some local CSS resources
        $this->assets->collection('css')
                ->addCss('css/app.css', true)
                ->join(true)
                ->setTargetUri('temp/app.css')
                ->setTargetPath('temp/app.css')
                ->addFilter(new Phalcon\Assets\Filters\Cssmin());
        
        // and some local javascript resources
        $this->assets
                ->collection('js')
                ->addJs('js/jquery-1.11.2.min.js', true)
                //->addJs('js/jquery-migrate-1.2.1.min.js', true)
                //->addJs('js/jquery-ui.min.js', true)
                ->addJs('js/bootstrap.min.js', true)
                ->addJs('js/app.js', true)
                ->join( true )
                ->setTargetUri('temp/app.js')
                ->setTargetPath('temp/app.js')
                ->addFilter(new Phalcon\Assets\Filters\Jsmin());
    }
    
    protected function forward($uri)
    {
        $uriParts = explode('/', $uri);
        
        $params = array_slice($uriParts, 2);
        
    	return $this->dispatcher->forward(
            array(
                'controller' => $uriParts[0],
                'action' => $uriParts[1],
                'params' => $params
            )
    	);
    }
    
}