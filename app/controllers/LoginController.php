<?php

use Phalcon\Validataion;

/**
 * Created by PhpStorm.
 * User: Sergiy
 * Date: 25.07.2015
 * Time: 18:53
 *
 * Main LoginController. Uses for log in | register new user.
 */
class LoginController extends ControllerBase
{
    private function _registerSession( $user )
    {
        $this->session->set('auth', array(
            'id' => $user->id,
            'name' => $user->login
        ));
    }

    /**
     * Checks posted by user email and password. If all ok then log in user in other case - shows error message
     *
     * @return mixed
     */
    public function loginAction()
    {
        if ($this->request->isPost() != true)
        {
            //return $this->forward('/');
        }

        $this->tag->setTitle( 'hi' );

        $form = new LoginForm();

        if ( !$form->isValid( $this->request->getPost() ) )
        {
            foreach ( $form->getMessages() as $key => $message )
            {
                $this->flash->error( $message );
            }

            print_r( $form->getMessages() );

            //return $this->dispatcher->forward(["action" => "info", 'params' => array('contact') ]);

            //return $this->forward('/');
        }

        $this->tag->setTitle( 'hi' );

        $email = $this->request->getPost('email');

        $password = $this->request->getPost('password');

        $user = Users::findFirst(array(
            "(email = :email: OR login = :email:) AND status = '1'",
            'bind' => array('email' => $email)
        ));

        if ( $user )
        {
            if ( $this->security->cackHash( $password, $user->password ) )
            {
                $this->_registerSession( $user );
            }
        }

        $this->flash->error('Wrong email/password');
    }

    public function registerAction()
    {
        $user = new Users();

        $login = $this->request->getPost('email');

        $password = $this->request->getPost('password');

        $user->login = $login;

        $user->email = $login;

        $user->password = $this->security->hash($password);

        $user->save();
    }
}