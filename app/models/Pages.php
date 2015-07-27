<?php

use Phalcon\Mvc\Model;

class Pages extends Model {

    public $id;

    public $name;

    public $type;

    public $status;

    public $position;

    public $location;

    public $page_id;

    public $updated_at;
    
    public function initialize()
    {
        $this->hasOne("id", "PagesInfo", "page_id");
        
        //$this->hasMany("id", "Items", "owner_id");
        
        //$this->hasMany("id", "Images", "page_id");
    }

    public function getCatalogPages()
    {
        return Pages::find(array(
                    "conditions" => "page_id = 0 AND type = 2",
                    'order'      => 'position',
                ));
    }
    
    public function getSource()
    {
        return "pages";
    }
}
