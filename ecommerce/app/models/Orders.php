<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 15/10/2016
 * Time: 11:17
 */
class Orders extends Model{

    public $_db,
            $address,
            $products;


    public function __construct()
    {
        parent::__construct();
        $this->_db = Database::getInstance();
    }

    public function create($fields = array()){
        if(!$this->_db->insert('orders',$fields)){

            throw new Exception('There was a problem setting up your order');
        }
    }


    public function products(){
        if($this->products == null) {
            $this->products = new Products();
        }
        return $this->products;
        
    }

    public function address(){
        if($this->address == null) {
            $this->address = new Address();
        }
        return $this->address;

    }
}