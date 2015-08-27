<?php

use Phalcon\Mvc\Model;

class PublicationsInfo extends Model {

    public $id;

    public $publication_id;

    public $title;

    public $content;

    public $meta_title;

    public $meta_keywords;
    
    public $meta_description;

    public function initialize()
    {
        $this->hasOne("id", "PublicationsLangs", "info_id");

        $this->belongsTo('publication_id', 'Publications', 'id');
    }

    public function getSource()
    {
        return "Publication_Info";
    }
}
