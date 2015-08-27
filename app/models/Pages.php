<?php

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;

class Pages extends Model {

    public $id;

    public $name;

    public $type;

    public $status;

    public $position;

    public $location;

    public $updated_at;

    public function initialize()
    {
        $this->hasMany("id", "PagesInfo", "page_id");
        
        $this->hasMany("id", "PagesLangs", "page_id");

        $this->hasOne("id", "PagesLangs", "page_id",
            array( "alias" => "Lang"
        ));

        $this->hasOne("id", "PagesInfo", "page_id", array( "alias" => 'Info' ));

        //$this->hasMany("id", "Images", "page_id");
    }

    public function getInfo( $lang = 'en' )
    {
        return $this->getRelated('Info', array(
            "conditions" => "lang_name = ?1",
            "bind"       => array(1 => $lang),
        ));
    }

    public function getLang( $lang )
    {
        return $this->getRelated('Lang', array(
            "conditions" => "lang_id = ?1",
            "bind"       => array( 1 => $lang ),
        ));
    }

    public function getLocalizationPages( $lang, $type )
    {
        $builder = new Phalcon\Mvc\Model\Query\Builder();

        return $builder->from('Pages')
            ->columns( 'Pages.id, name, title' )
            ->leftJoin( 'PagesLangs', 'Pages.id = PagesLangs.page_id' )
            ->leftJoin( 'Langs', 'PagesLangs.lang_id = Langs.id' )
            ->leftJoin( 'PagesInfo', 'PagesInfo.id = PagesLangs.info_id' )
            ->where('location = 0')
            //->andWhere( 'type = :type:', array( 'type' => $type ) )
            ->andWhere( 'lang_name = :lang: ', array( 'lang' => $lang )  )
            ->getQuery()
            ->execute();
    }

    public function getPageByName( $name, $lang = 'en' )
    {
        $builder = new Phalcon\Mvc\Model\Query\Builder();

        return $builder->from('Pages')
            ->columns( ' Pages.id as id, name, title, type, PagesLangs.lang_id as lang_id, location, content, meta_description, meta_keywords' )
            ->leftJoin( 'PagesLangs', 'Pages.id = PagesLangs.page_id' )
            ->leftJoin( 'PagesInfo', 'PagesInfo.id = PagesLangs.info_id' )
            ->leftJoin( 'Langs', 'PagesLangs.lang_id = Langs.id' )
            ->where( 'Pages.name = :name:', array( 'name' => $name ))
            ->andWhere( "lang_name = :lang:", array( 'lang' => $lang ) )
            ->getQuery()
            ->getSingleResult();
    }

    public function getPage( $id, $lang )
    {
        $builder = new Phalcon\Mvc\Model\Query\Builder();

        return $builder->from('Pages')
            ->columns( ' Pages.id as id, name, title, type, PagesLangs.lang_id as lang_id, location, content, meta_description, meta_keywords' )
            ->leftJoin( 'PagesLangs', 'Pages.id = PagesLangs.page_id' )
            ->leftJoin( 'PagesInfo', 'PagesInfo.id = PagesLangs.info_id' )
            ->where( 'PagesInfo.page_id = :id:', array( 'id' => $id ))
            ->andWhere( "PagesLangs.lang_id = :lang:", array( 'lang' => $lang ) )
            ->getQuery()
            ->getSingleResult();
    }

    public function getStaticPages()
    {
        return Pages::find(array(
                    "conditions" => "location = 0 AND type = 1",
                    'order'      => 'position',
                ));
    }

    /**
     * This model is mapped to the table Pages
     */
    public function getSource()
    {
        return "Pages";
    }
}
