<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 08/10/2016
 * Time: 12:21
 */
class Products extends Model{

    public  $_db,
            $stock,
            $order,
            $data;


    public function __construct(){
        parent::__construct();
        $this->_db = Database::getInstance();
    }


    
    public function selectProducts(){
        $products = $this->_db->get('products',array('id','>',0));
        return $products->results();
    }

    public function findProducts($value){
      if(!empty($value)) {
          $result = $this->_db->find('products', $value);
          return $result;
      }
    }

    public function compareSlug($slug){
      
        $result = $this->_db->get('products',array('slug','=',$slug));
         if($result->count()){
             $this->stock = $result->first()->stock;
             $this->data  = $result->first();
             return $result->first();

         }
        return false;
    }
    
    public function data(){
        return $this->data;
    }

    public function hasLowStock(){

        if($this->outOfStock()){
            return false;
        }
        return (bool) ($this->stock <= 5);
    }

    public function outOfStock(){

        return $this->stock == 0;
    }

    public function inStock(){

        return $this->stock >=1;
    }

    public function hasStock($quantity){

        return $this->stock >= $quantity;

    }

    public function order(){
        if($this->order == null) {
            $this->order = new Order();
        }
        return $this->order;

    }
}