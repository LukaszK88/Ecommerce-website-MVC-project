<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 15/10/2016
 * Time: 12:14
 */

class Address extends Model{

    public $_db,
            $_data,
            $user,
            $order;
        


    public function __construct(){
        parent::__construct();
        $this->_db = Database::getInstance();

    }

    public function create($fields = array()){
        if(!$this->_db->insert('addresses',$fields)){

            throw new Exception('There was a problem updating address');
        }
    }
    
    public function user(){
        if($this->user == null) {
            $this->user = new User();
        }
        return $this->user;

    }

    public function order(){
        if($this->order == null) {
            $this->order = new Orders();
        }
        return $this->order;

    }
}