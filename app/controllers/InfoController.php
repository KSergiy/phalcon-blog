<?php

class InfoController extends ControllerBase
{
    public function infoAction( $url )
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
                'keywords'      => $page->PagesInfo->meta_keywords,
                'description'   => $page->PagesInfo->meta_descriptions,
                'title'         => $page->PagesInfo->title,
                'content'       => $page->PagesInfo->content,
                'active'        => $url
            ));

            if ( $url == 'contact' )
            {
                $this->view->form = new ContactForm;
            }

            $this->view->pick(array('info/'.$url));
        
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
    
    public function sendAction()
    {
        if ($this->request->isPost() != true)
        {
            return $this->forward('/contacts/');
        }
        
        $form = new ContactForm;
       
        // Validate the form
        $data = $this->request->getPost();
        
        if ( !$form->isValid( $this->request->getPost() ) )
        {
            foreach ($form->getMessages() as $key => $message) 
            {
                $this->flash->error($message);
            }
            
            return $this->dispatcher->forward(["action" => "info", 'params' => array('contact') ]);
            
            return $this->forward('/contacts/');
        }
        
        $this->getDI()->getMail()->send( 'info@tdp.com.ua', 'Сообщение на 3Dfreza.com.ua', 'confirmation', $data );
        
        $this->flash->success('Благодарим за интерес к нашей продукции. Ваше письмо успешно отправлено.');

        return $this->forward('/contacts/');
    }
    
}