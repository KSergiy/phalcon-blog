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

class Publications_LocalizationForm extends Form
{
    private $_langs = [];

    private function formLangs( $langsPage )
    {
        $allLangs = Langs::find();

        $langInDb = FALSE;

        foreach ( $allLangs as $lang )
        {
            foreach ( $langsPage as $pageLang )
            {
                if ( $pageLang->lang_id == $lang->id )
                {
                    $langInDb = TRUE;

                    break;
                }
            }

            if ( $langInDb )
            {
                $langInDb = FALSE;

                continue;
            }

            $this->_langs[ $lang->id ] = $lang->lang_title;
        }
    }

    public function initialize($entity = null, $edit = false)
    {
        $this->formLangs( $entity );

        $this->setAction('publications/addlocalization/');

        $this->add(new Hidden('page_id'));

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

        $langs = new Select( 'lang', $this->_langs, array( 'class' => 'form-control') );
        $langs->setLabel('Lang');
        $this->add( $langs );

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

        $submit = new Submit('add', array('value' => 'Add localization', 'class' => 'btn btn-lg btn-primary btn-block'));

        $this->add( $submit );
    }
}