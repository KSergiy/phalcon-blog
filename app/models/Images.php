<?php

use Phalcon\Mvc\Model;

class Images extends Model {

    public $id;

    public $ovner_id;

    public $url;
    
    public $position;

    public $main;

    public $created_at;
    
    public $updated_at;
    
    public function getSource()
    {
        return "Images";
    }
}
