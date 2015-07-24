<?php

class CatalogController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Наша продукция');
        
        $this->view->setVars(array(
            'keywords'      => 'Главная',
            'description'   => 'Главная',
            'active'        => ''
        ));
        
        parent::initialize();
    }

    public function listAction( $url )
    {
        $page = Pages::findFirst(array(
                    "conditions" => "url = ?1",
                    "bind"       => array(1 => $url)
                ));

        if ( !empty( $page ) )
        {
            $this->response->setStatusCode(200);

            $this->expireDate = $page->updated_at;

            $this->tag->setTitle( $page->PagesInfo->title );

            $this->view->setVars(array(
                'keywords'      => $page->PagesInfo->keywords,
                'description'   => $page->PagesInfo->description,
                'title'         => $page->PagesInfo->title,
                'content'       => $page->PagesInfo->content,
                'active'        => $url,
                'page'          => $page
            ));
        }
        else
        {
            $this->response->setStatusCode(404, "Not Found");
            
            $this->dispatcher->forward(
                    array(
                        'controller' => 'index',
                        'action'     => 'error404'
                    ));
        }
        
        parent::initialize();
    }
}