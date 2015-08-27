<?php

use Phalcon\Mvc\Model;

class PagesLangs extends Model {

    public $id;

    public $page_id;

    public $info_id;

    public $lang_id;
    
    public function initialize()
    {
        $this->hasOne('lang_id', 'Langs', 'id');

        $this->belongsTo("lang_id", "Langs", "id", array(
            "lang_id" => array(
                "message" => "The part_id does not exist on the Parts model"
            )
        ));

        $this->hasOne("info_id", "PagesInfo", "id");

        //$this->hasOne("page_id", "Pages", "id");

        $this->belongsTo('info_id', 'PagesInfo', 'id', array(
            'alias' => 'Info',
            "info_id" => array(
                "message" => "The part_id does not exist on the Parts model"
            )
        ));
    }

    public function getLang( $lang = 'en' )
    {
        return $this->getRelated('PagesInfo', array(
            "conditions" => "lang_id = ?1",
            "bind"       => array( 1 => $lang ),
        ));
    }

    public function getSource()
    {
        return "Pages_Lang";
    }
}
