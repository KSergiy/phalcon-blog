<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class ContactForm extends Form
{

    public function initialize($entity = null, $options = null)
    {
        // Name
        $name = new Text('name');
        $name->setLabel('Ваше имя');
        $name->setFilters(array('striptags', 'string'));
        $name->addValidators(array(
            new PresenceOf(array(
                'message' => 'Поле Ваше имя - обязательно для заполнения.'
            ))
        ));
        $this->add($name);

        // Email
        $email = new Text('email');
        $email->setLabel('E-Mail');
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

        $comments = new TextArea('comments');
        $comments->setLabel('Текст сообщения');
        $comments->setFilters(array('striptags', 'string'));
        $comments->addValidators(array(
            new PresenceOf(array(
                'message' => 'Поле Текст сообщения - обязательно для заполнения.'
            ))
        ));
        $this->add($comments);
    }
}