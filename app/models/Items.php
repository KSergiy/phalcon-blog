<?php

use Phalcon\Mvc\Model;

class Items extends Model {

    public $id;
    
    public $url;

    public $owner_id;

    public $translit;

    public $price;
    
    public $artikul;
    
    public $markup;
    
    public $token;
    
    public $createdate;
    
    public function initialize()
    {
        $this->hasOne("token", "ItemsTransleate", "catalog_token", array(
            'alias' => 'info'
        ));
        
        $this->hasOne("markup", "Markup", "id", array(
            'alias' => 'm'
        ));
        
        $this->hasOne("token", "Images", "token", array(
            'alias' => 'img'
        ));
        
        $this->hasMany("token", "Images", "token");
        
        $this->hasMany("token", "OptionsCatalog", "catalog_token", array(
            'alias' => 'options'
        ));
    }
    
    public function getSource()
    {
        return "catalog";
    }
}
