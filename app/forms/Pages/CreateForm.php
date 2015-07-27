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

    private $_langs = [
        '0' => 'en',
        '1' => 'ua',
        '3' => 'ru'
    ];

    private $_locations = [
        '0' => 'Main page'
    ];

    public function initialize($entity = null, $options = null)
    {
        $pages = Pages::getCatalogPages();

        foreach ( $pages as $page ) {
            $this->_locations[ $page->id ] = $page->PagesInfo->title;
        }

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

        $langs = new Select( 'lang', $this->_langs, array( 'class' => 'form-control') );
        $langs->setLabel('Lang');
        $this->add( $langs );

        $pages = new Select( 'location', $this->_locations, array( 'class' => 'form-control') );
        $pages->setLabel('Location');
        $this->add( $pages );

        $content = new TextArea('content', array( 'class' => 'form-control', 'id' => 'areacontent') );
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