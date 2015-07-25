<?php

use Phalcon\Mvc\Model;

class Users extends Model {

    public $id;
    
    public $login;

    public $email;

    public $status;

    public $password;
    
    public function initialize() {}
    
    public function getSource()
    {
        return "Users";
    }
}
