<?php

use Phalcon\Mvc\Model;

class ItemsTransleate extends Model {

    public $id;

    public $lang;

    public $title;

    public $catalog_token;
    
    public function getSource()
    {
        return "catalog_trans";
    }
}
