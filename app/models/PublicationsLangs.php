<?php

use Phalcon\Mvc\Model;

class PublicationsLangs extends Model {

    public $id;

    public $publication_id;

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

        $this->hasOne("info_id", "PublicationsInfo", "id");

        //$this->hasOne("page_id", "Pages", "id");

        $this->belongsTo('info_id', 'PublicationsInfo', 'id', array(
            'alias' => 'Info',
            "info_id" => array(
                "message" => "The part_id does not exist on the Parts model"
            )
        ));
    }

    public function getSource()
    {
        return "Publications_Lang";
    }
}
