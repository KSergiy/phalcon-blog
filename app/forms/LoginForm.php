<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class LoginForm extends Form
{

    public function initialize($entity = null, $options = null)
    {
        // Email
        $email = new Text('email');
        $email->setFilters('email');
        $email->addValidators(array(
            new PresenceOf(array(
                'message' => 'Поле E-mail - нужно заполнить.'
            )),
            new Email(array(
                'message' => 'Поле E-mail - не корректно.'
            ))
        ));
        $this->add($email);

        $password = new Password('password');
        $password->setFilters(array('striptags', 'string'));
        $password->addValidators(array(
            new PresenceOf(array(
                'message' => 'Поле Password - обязательно для заполнения.'
            ))
        ));
        $this->add($password);
    }
}