<?php

use Phalcon\Mvc\Model;

class PagesInfo extends Model {

    public $id;

    public $page_id;

    public $title;

    public $content;

    public $meta_title;

    public $meta_keywords;
    
    public $meta_description;

    public function initialize()
    {
        $this->hasOne("id", "PagesLangs", "info_id");
    }

    public function getSource()
    {
        return "Page_Info";
    }
}
