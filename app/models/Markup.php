<?php

use Phalcon\Mvc\Model;

class Markup extends Model {

    public $id;

    public $percent;
    
    public function getSource()
    {
        return "markup";
    }
}
