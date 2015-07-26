<?php

use Phalcon\Mvc\User\Component;

class Auth_Auth extends Component
{
    public function __construct() {}

    public function check( $credentials )
    {
        // Check if the user exist
        $user = Users::findFirst(array(
            "(email = :email: OR login = :email:) AND status = '1'",
            'bind' => array('email' => $credentials['email'])
        ));

        if ( !$user )
        {
            $this->flash->error('Wrong email/password');

            //$this->registerUserThrottling(0);

            return FALSE;
        }
        // Check the password
        if ( !$this->security->checkHash( $credentials['password'], $user->password ) )
        {
            //$this->registerUserThrottling($user->id);

            $this->flash->error('Wrong email/password combination');

            return FALSE;
        }
        // Check if the user was flagged
        //$this->checkUserFlags($user);
        // Register the successful login
        //$this->saveSuccessLogin($user);
        // Check if the remember me was selected
        if (isset($credentials['remember']))
        {
            $this->createRememberEnviroment($user);
        }

        $this->session->set('auth-identity', array(
            'id' => $user->id,
            'name' => $user->login,
            //'profile' => $user->profile->name
        ));

        return TRUE;
    }

    public function saveSuccessLogin($user)
    {
        $successLogin = new SuccessLogins();
        $successLogin->usersId = $user->id;
        $successLogin->ipAddress = $this->request->getClientAddress();
        $successLogin->userAgent = $this->request->getUserAgent();
        if (!$successLogin->save())
        {
            $messages = $successLogin->getMessages();
            throw new Exception($messages[0]);
        }
    }

    public function registerUserThrottling($userId)
    {
        $failedLogin = new FailedLogins();
        $failedLogin->usersId = $userId;
        $failedLogin->ipAddress = $this->request->getClientAddress();
        $failedLogin->attempted = time();
        $failedLogin->save();
        $attempts = FailedLogins::count(array(
            'ipAddress = ?0 AND attempted >= ?1',
            'bind' => array(
                $this->request->getClientAddress(),
                time() - 3600 * 6
            )
        ));
        switch ($attempts) {
            case 1:
            case 2:
                // no delay
                break;
            case 3:
            case 4:
                sleep(2);
                break;
            default:
                sleep(4);
                break;
        }
    }

    public function createRememberEnviroment(Users $user)
    {
        $userAgent = $this->request->getUserAgent();
        $token = md5($user->email . $user->password . $userAgent);
        $remember = new RememberTokens();
        $remember->usersId = $user->id;
        $remember->token = $token;
        $remember->userAgent = $userAgent;
        if ($remember->save() != false)
        {
            $expire = time() + 86400 * 8;
            $this->cookies->set('RMU', $user->id, $expire);
            $this->cookies->set('RMT', $token, $expire);
        }
    }

    public function hasRememberMe()
    {
        return $this->cookies->has('RMU');
    }

    public function loginWithRememberMe()
    {
        $userId = $this->cookies->get('RMU')->getValue();
        $cookieToken = $this->cookies->get('RMT')->getValue();
        $user = Users::findFirstById($userId);
        if ($user)
        {
            $userAgent = $this->request->getUserAgent();
            $token = md5($user->email . $user->password . $userAgent);
            if ($cookieToken == $token)
            {
                $remember = RememberTokens::findFirst(array(
                    'usersId = ?0 AND token = ?1',
                    'bind' => array(
                        $user->id,
                        $token
                    )
                ));
                if ($remember)
                {
                    // Check if the cookie has not expired
                    if ((time() - (86400 * 8)) < $remember->createdAt)
                    {
                        // Check if the user was flagged
                        $this->checkUserFlags($user);
                        // Register identity
                        $this->session->set('auth-identity', array(
                            'id' => $user->id,
                            'name' => $user->name,
                            'profile' => $user->profile->name
                        ));
                        // Register the successful login
                        $this->saveSuccessLogin($user);
                        return $this->response->redirect('users');
                    }
                }
            }
        }
        $this->cookies->get('RMU')->delete();
        $this->cookies->get('RMT')->delete();
        return $this->response->redirect('session/login');
    }

    public function checkUserFlags(Users $user)
    {
        if ($user->active != '1') {
            throw new Exception('The user is inactive');
        }
    }

    public function getIdentity()
    {
        return $this->session->get('auth-identity');
    }

    public function getName()
    {
        $identity = $this->session->get('auth-identity');
        return $identity['name'];
    }

    public function remove()
    {
        if ($this->cookies->has('RMU'))
        {
            $this->cookies->get('RMU')->delete();
        }
        if ($this->cookies->has('RMT'))
        {
            $this->cookies->get('RMT')->delete();
        }
        $this->session->remove('auth-identity');
    }

    public function authUserById($id)
    {
        $user = Users::findFirstById($id);
        if ($user == false)
        {
            throw new Exception('The user does not exist');
        }
        $this->checkUserFlags($user);
        $this->session->set('auth-identity', array(
            'id' => $user->id,
            'name' => $user->login,
            //'profile' => $user->profile->name
        ));
    }

    public function getUser()
    {
        $identity = $this->session->get('auth-identity');
        if (isset($identity['id']))
        {
            $user = Users::findFirstById($identity['id']);
            if ($user == false)
            {
                throw new Exception('The user does not exist');
            }
            return $user;
        }
        return false;
    }
}
