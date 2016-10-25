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
            $_data,
            $dataFirst,
            $payment,
            $products;


    public function __construct()
    {
        parent::__construct();
        $this->_db = Database::getInstance();
    }
    

    public function select($orderId){
        $result = $this->_db->select('orders_products',array('order_id','=',$orderId));
        return $result->results();
    }
   
    public function create($fields = array()){
        if(!$this->_db->insert('orders',$fields)){

            throw new Exception('There was a problem setting up your order');
        }
    }

    public function createOrder($fields = array()){
        if(!$this->_db->insert('orders_products',$fields)){

            throw new Exception('There was a problem putting your order together');
        }
    }

    public function update($id,$fields=[]){
        $this->_db->update('orders',$id,$fields);
    }
    

    public function selectLastOrder(){
        $orders = $this->_db->get('orders',array('id','>',0));
        if($orders->count()){

            $this->dataFirst = $orders->first();
            $result = $orders->results();
            $this->_data = end($result);

            return true;
        }
    }

    public function data(){

        return $this->_data;
    }

    public function dataFirst(){

        return $this->dataFirst;
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

    public function payment(){
        if($this->payment == null) {
            $this->payment = new Payment();
        }
        return $this->payment;

    }
}