<?php

class IndexController extends ControllerBase
{
    public function indexAction()
    {
        $this->view->setVar('loginForm', new LoginForm());

        /*
        $_page = new Pages();
        
        $page = $_page::findFirst(array(
                    "conditions" => "name = ?1",
                    "bind"       => array(1 => $url),
                    //"cache"      => array( "key" => 'catalog'.$url, "lifetime" => 172800 )
                ));
        */
        parent::initialize();
    }
    
    public function error404Action()
    {
        $this->response->setHeader('HTTP/1.0 404','Not Found');

        $this->view->pick(array("error/index"));
    }
}