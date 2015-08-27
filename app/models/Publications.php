<?php

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;

class Publications extends Model {

    public $id;

    public $name;

    public $url;

    public $sort;

    public $status;

    public $location;

    public $updated_at;

    public function initialize()
    {
        $this->hasMany("id", "PublicationsInfo", "publication_id");
        
        $this->hasMany("id", "PublicationsLangs", "publication_id");

        $this->hasOne("id", "PublicationsLangs", "publication_id",
            array( "alias" => "Lang"
        ));

        $this->hasOne("id", "PublicationsInfo", "publication_id", array( "alias" => 'Info' ));

        //$this->hasMany("id", "Images", "page_id");
    }

    public function getLocalizationPublications( $lang, $type )
    {
        $builder = new Phalcon\Mvc\Model\Query\Builder();

        return $builder->from('Publications')
            ->columns( 'Publications.id, name, title' )
            ->leftJoin( 'PublicationsLangs', 'Publications.id = PublicationsLangs.publication_id' )
            ->leftJoin( 'Langs', 'PublicationsLangs.lang_id = Langs.id' )
            ->leftJoin( 'PublicationsInfo', 'PublicationsInfo.id = PublicationsLangs.publication_id' )
            ->where( 'location = 0' )
            ->andWhere( 'type = :type:', array( 'type' => $type ) )
            ->andWhere( 'lang_name = :lang: ', array( 'lang' => $lang )  )
            ->getQuery()
            ->execute();
    }

    public function getPublication( $id, $lang )
    {
        $builder = new Phalcon\Mvc\Model\Query\Builder();

        return $builder->from('Publications')
            ->columns( ' Publications.id as id, name, title, PublicationsLangs.lang_id as lang_id, location, content, meta_description, meta_keywords' )
            ->leftJoin( 'PublicationsLangs', 'Publications.id = PublicationsLangs.publication_id' )
            ->leftJoin( 'PublicationsInfo', 'PublicationsInfo.id = PublicationsLangs.info_id' )
            ->where( 'PublicationsInfo.publication_id = :id:', array( 'id' => $id ))
            ->andWhere( "PublicationsLangs.lang_id = :lang:", array( 'lang' => $lang ) )
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
        return "Publications";
    }
}
