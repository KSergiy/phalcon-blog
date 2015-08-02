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
            array( "alias" => "Local"
        ));

        $this->hasOne("id", "PagesInfo", "page_id", array( "alias" => 'Info' ));

        //$this->hasMany("id", "Images", "page_id");
    }

    public function getLocalizationPages( $lang, $type )
    {
        $builder = new Phalcon\Mvc\Model\Query\Builder();

        return $builder->from('Pages')
            ->join( 'PagesLangs', 'Pages.id = PagesLangs.page_id' )
            ->join( 'Langs', 'PagesLangs.lang_id = Langs.id' )
            ->join( 'PagesInfo', 'PagesInfo.id = PagesLangs.info_id' )
            ->where('location = 0 AND type = :type:', array( 'type' => $type ))
            ->andWhere( 'lang_name = :lang: ', array( 'lang' => $lang )  )
            ->getQuery()
            ->execute();
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
