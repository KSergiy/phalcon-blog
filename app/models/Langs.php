<?php

use Phalcon\Mvc\Model;

class Langs extends Model {

    public $id;

    public $lang_name;

    public $lang_title;

    public $updated_at;
    
    public function initialize()
    {
        $this->hasOne('id', 'PagesLangs', 'lang_id', array('alias' => 'pLang'));

        $this->belongsTo('lang_id', 'PagesLangs', 'id');
    }
    
    public function getSource()
    {
        return "Lang";
    }
}
