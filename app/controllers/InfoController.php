<?php

class InfoController extends ControllerBase
{
    public function contactAction()
    {
        $this->view->form = new ContactForm;
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