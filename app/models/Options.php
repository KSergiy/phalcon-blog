<?php

use Phalcon\Mvc\Model;

class Options extends Model {

    public $option_id;

    public $option_title;

    public $option_short;

    public $option_type;
    
    public $option_dimensions;
    
    public $option_filter;
    
    public $option_sort;
    
    public function initialize()
    {
        $this->hasMany("option_id", "OptionsCatalog", "option_id", array(
            'alias' => 'values'
        ));
    }
    
    public function getOptionsVals()
    {
        return $this->getRelated('values', array(
            'group' => 'value',
            'order' => 'value ASC'
        ));
    }
    
    public function getMax( $token )
    {
        $values = $this->getRelated('values', array(
            'columns'    => 'value',
            'conditions' => "catalog_token = '{$token}'",
            'group'      => 'value',
        ));
        
        $max = max( $values->toArray() );
        
        return $max['value'];
    }
    
    public function getMin( $token )
    {
        $values = $this->getRelated('values', array(
            'columns'    => 'value',
            'conditions' => "catalog_token = {$token}",
            'group'      => 'value',
        ));
        
        $min = min( $values->toArray() );
        
        return $min['value'];
    }
    
    public function getSource()
    {
        return "options";
    }
}
