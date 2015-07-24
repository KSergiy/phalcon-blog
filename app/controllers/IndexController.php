<?php

class IndexController extends ControllerBase
{
    public function indexAction( $url = 'start' )
    {
        $_page = new Pages();
        
        $page = $_page::findFirst(array(
                    "conditions" => "name = ?1",
                    "bind"       => array(1 => $url),
                    "cache"      => array( "key" => 'catalog'.$url, "lifetime" => 172800 )
                ));
        
        if ( !empty( $page ) )
        {
            switch( $page->type )
            {
                case '5':
                    $this->start($page, $_page);
                    break;
                case '1':
                    $this->info($page);
                    break;
                case '4':
                    $this->contacts($page);
                    break;
                case '3':
                    $this->catalog($page, $_page);
                    break;
            }
        }
        else
        {
            $this->dispatcher->forward(
                    array(
                        'controller' => 'index',
                        'action'     => 'error404'
                    ));
        }
        
        parent::initialize();
    }
    
    public function start( $page, $_page )
    {
        $this->response->setStatusCode(200);
            
        $this->expireDate = $page->updated_at;

        $this->tag->setTitle( $page->PagesInfo->title );

        $options = Options::find(array(
            'conditions' => "option_filter = '1'",
        ));

        $this->view->setVars(array(
            'keywords'      => $page->PagesInfo->keywords,
            'description'   => $page->PagesInfo->description,
            'title'         => $page->PagesInfo->title,
            'content'       => $page->PagesInfo->content,
            'images'        => $page->getSortedImages(),
            'options'       => $options,
            'catalog'       => $_page->getCatalogPages(),
            'items'         => Items::find(array( 'conditions' => "show_main = '1'" )),
            'active'        => 'main'
        ));
    }
    
    public function catalog( $page, $_page )
    {
        $this->response->setStatusCode(200);
            
        $this->expireDate = $page->updated_at;

        $this->tag->setTitle( $page->PagesInfo->title );

        $options = Options::find(array(
            'conditions' => "option_filter = 1",
            'order'      => 'option_sort ASC',
            "cache"      => array( "key" => 'options', "lifetime" => 172800 )
            ));

        foreach ( $options as $option )
        {
            if ( $option->option_type == 'int' )
            {
                $values[$option->option_id] = [];
                
                foreach ( $page->items as $item )
                {
                    foreach ( $item->options as $value ) 
                    {
                        $values[$value->option_id][] = $value->value;
                    }
                }
                
                $min[$option->option_id] = min( $values[$option->option_id] );
        
                $max[$option->option_id] = max( $values[$option->option_id] );
            }
        }

        $this->view->setVars(array(
            'keywords'      => $page->PagesInfo->keywords,
            'description'   => $page->PagesInfo->description,
            'title'         => $page->PagesInfo->title,
            'content'       => $page->PagesInfo->content,
            'page'          => $page,
            'images'        => $page->getSortedImages(),
            'options'       => $options,
            'items'         => $page->items,
            'values'        => $values,
            'max'           => $max,
            'min'           => $min
        ));
        
        $this->view->pick(array('catalog/list'));
    }
    
    public function info( $page )
    {
        $this->response->setStatusCode(200);
            
        $this->expireDate = $page->updated_at;

        $this->tag->setTitle( $page->PagesInfo->title );
        
        $this->view->setVars(array(
            'keywords'      => $page->PagesInfo->keywords,
            'description'   => $page->PagesInfo->description,
            'title'         => $page->PagesInfo->title,
            'content'       => $page->PagesInfo->content,
            'images'        => $page->getSortedImages(),
        ));
        
        $this->view->pick(array('info/about'));
    }
    
    public function contacts( $page )
    {
        $this->response->setStatusCode(200);
            
        $this->expireDate = $page->updated_at;

        $this->tag->setTitle( $page->PagesInfo->title );
        
        $this->view->setVars(array(
            'keywords'      => $page->PagesInfo->keywords,
            'description'   => $page->PagesInfo->description,
            'title'         => $page->PagesInfo->title,
            'content'       => $page->PagesInfo->content,
            'images'        => $page->getSortedImages(),
        ));
        
        $this->view->form = new ContactForm;
        
        $this->view->pick(array('info/contact'));
    }
    
    public function error404Action()
    {
        $this->response->setHeader('HTTP/1.0 404','Not Found');

        $this->view->pick(array("error/index"));
    }
}