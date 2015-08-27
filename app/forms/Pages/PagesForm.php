<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Logger\Adapter\File as FileAdapter;

class Pages_PagesForm extends Form
{

    private $_types = [
        '0' => 'Select',
        '1' => 'Single',
        '2' => 'Catalog'
    ];

    private $_langs = [];

    private $_locations = [
        '0' => 'Main page'
    ];

    public function initialize($entity = null, $edit = false)
    {
        $langs = Langs::find();

        foreach ($langs as $lang) {
            $this->_langs[ $lang->id ] = $lang->lang_title;
        }

        try {
            $pages = Pages::getLocalizationPages( 'en', '2' );

            if (count($pages) >= 1)
            {
                foreach ($pages as $page) {
                    $this->_locations[$page->id] = $page->PagesInfo->title;
                }
            }
        }
        catch ( Exception $e )
        {
            $logger = new FileAdapter(APP_PATH . "/app/logs/db.log");
            $logger->error("Section: Pages/CreateForm; Error:" . $e->getMessage() );
        }

        if ( (bool)$edit )
        {
            $this->setAction('pages/save/');

            $this->add(new Hidden('id', array( 'id' => 'id' )));
        }
        else
        {
            $this->setAction('pages/add/');
        }

        // Name
        $title = new Text( 'title', array( 'class' => 'form-control', 'id' => 'title' ) );
        $title->setLabel('Title');
        $title->setFilters(array('striptags', 'string'));
        $title->addValidators(array(
            new PresenceOf(array(
                'message' => 'Row title - required'
            ))
        ));
        $this->add($title);// Name

        $name = new Text( 'name', array( 'class' => 'form-control', 'id' => 'name') );
        $name->setLabel('Url');
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

        if ( (bool)$edit )
        {
            $submit = new Submit('save', array('value' => 'Save', 'class' => 'btn btn-sm btn-primary'));
        }
        else
        {
            $submit = new Submit('create', array('value' => 'Create', 'class' => 'btn btn-sm btn-primary'));
        }

        $this->add( $submit );
    }
}