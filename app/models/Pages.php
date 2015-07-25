<?php

use Phalcon\Mvc\Model;

class Pages extends Model {

    public $id;

    public $url;

    public $status;

    public $type;
    
    public $position;
    
    public $location;
    
    public $updated_at;
    
    public function initialize()
    {
        $this->hasOne("token", "PagesInfo", "page_token");
        
        $this->hasMany("id", "Items", "owner_id");
        
        $this->hasMany("token", "Images", "token");
    }
    
    public function getSortedImages()
    {
        return $this->getRelated('Images', array(
            'order' => 'sort ASC'
        ));
    }
    
    public function getCatalogPages()
    {
        return Pages::find(array(
                    "conditions" => "section_id = 0 AND enabled = 1 AND type = 3",
                    'order'      => 'sort',
                ));
    }
    
    public function getSource()
    {
        return "pages";
    }
}
