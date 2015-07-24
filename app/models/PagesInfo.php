<?php

use Phalcon\Mvc\Model;

class PagesInfo extends Model {

    public $id;

    public $title;
    
    public $content;
    
    public $keywords;
    
    public $description;
    
    public function getSource()
    {
        return "pages_trans";
    }
}
