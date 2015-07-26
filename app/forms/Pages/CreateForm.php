<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class Pages_CreateForm extends Form
{

    private $_types = [
        '0' => 'Select',
        '1' => 'Single',
        '2' => 'Catalog'
    ];

    public function initialize($entity = null, $options = null)
    {
        $this->setAction('pages/add/');

        // Name
        $title = new Text( 'title', array( 'class' => 'form-control') );
        $title->setLabel('Title');
        $title->setFilters(array('striptags', 'string'));
        $title->addValidators(array(
            new PresenceOf(array(
                'message' => 'Row title - required'
            ))
        ));
        $this->add($title);// Name

        $name = new Text( 'name', array( 'class' => 'form-control') );
        $name->setLabel('Name');
        $name->setFilters(array('striptags', 'string'));
        $name->addValidators(array(
            new PresenceOf(array(
                'message' => 'Row name - required'
            ))
        ));
        $this->add($name);

        $types = new Select( 'type', $this->_types, array( 'class' => 'form-control') );
        $types->setLabel('Type');
        $this->add($types);

        $content = new TextArea('content', array( 'class' => 'form-control') );
        $content->setLabel('Content');
        $content->setFilters(array('striptags', 'string'));
        $content->addValidators(array(
            new PresenceOf(array(
                'message' => 'Row content - required.'
            ))
        ));
        $this->add($content);

        $metaDescription = new TextArea('metaDescription', array( 'class' => 'form-control') );
        $metaDescription->setLabel('Meta description');
        $metaDescription->setFilters(array('striptags', 'string'));
        $metaDescription->addValidators(array(
            new PresenceOf(array(
                'message' => 'Row meta description - required.'
            ))
        ));
        $this->add($metaDescription);

        $metaKeywords = new Text( 'metaKeywords', array( 'class' => 'form-control') );
        $metaKeywords->setLabel('Meta keywords');
        $metaKeywords->setFilters(array('striptags', 'string'));
        $metaKeywords->addValidators(array(
            new PresenceOf(array(
                'message' => 'Row meta keywords - required'
            ))
        ));
        $this->add($metaKeywords);

        $submit = new Submit('create', array('value' => 'Create', 'class' => 'btn btn-lg btn-primary btn-block'));
        $this->add( $submit );
    }
}