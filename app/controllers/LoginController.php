<?php

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
    public function loginAction()
    {
        $form = new LoginForm();

        $this->view->setVar('loginForm', $form);

        $this->tag->setTitle('Login');

        parent::initialize();
    }
    /**
     * Checks posted by user email and password. If all ok then log in user in other case - shows error message
     *
     * @return mixed
     */
    public function authAction()
    {
        if ( $this->request->isPost() == true )
        {
            $form = new LoginForm();

            if ( !$form->isValid( $this->request->getPost() ) )
            {
                foreach ( $form->getMessages() as $key => $message ) {
                    $this->flash->error($message);
                }

                return $this->dispatcher->forward(["controller" => "login", "action" => "login"]);
            }

            $status = $this->auth->check([
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password')
            ]);

            if ( $status )
            {
                return $this->response->redirect('index');
            }
            else
            {
                $this->flash->error('Wrong email/password');

                return $this->dispatcher->forward(["controller" => "login", "action" => "login"]);
            }
        }
        return $this->response->redirect('index');
    }

    public function logoutAction()
    {
        $this->auth->remove();

        return $this->response->redirect('index');
    }

    /**
     *  Register function
     */
    /*
    public function registerAction()
    {
        $user = new Users();

        $login = 'koblua.sergiy@gmail.com'; //$this->request->getPost('email');

        $password = 'Draco_05'; //$this->request->getPost('password');

        $user->login = $login;

        $user->email = $login;

        $user->password = $this->security->hash($password);

        $user->save();
    }
    */
}