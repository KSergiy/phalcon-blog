<?php

use Phalcon\Mvc\Model;

class Messages extends Model {
    /**
     * Message id
     * 
     * @var type 
     */
    public $id;
    /**
     * user name
     * 
     * @var type 
     */
    public $uname;
    /**
     * user phone
     * 
     * @var type 
     */
    public $uphone;
    /**
     * user mail
     * 
     * @var type 
     */
    public $umail;
    /**
     * user message
     * 
     * @var type 
     */
    public $umessage;
    
    public $status;
    
    public $created_at;
    
    public $updated_at;
    
    public function getSource()
    {
        return "messages";
    }
}
