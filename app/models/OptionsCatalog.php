<?php

use Phalcon\Mvc\Model;

class OptionsCatalog extends Model {

    public $option_id;

    public $value;

    public $catalog_token;

    public function getSource()
    {
        return "catalog_options";
    }
}
