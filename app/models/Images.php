<?php

use Phalcon\Mvc\Model;

class Images extends Model {

    public $id;
    
    public $title;
    
    public $url;
    
    public $main;
    
    public $created_at;
    
    public $updated_at;
    
    public function getSource()
    {
        return "images";
    }
}
