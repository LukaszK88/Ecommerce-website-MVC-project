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

    public function update($id,$idValue,$currentStock,$quantity){
        $this->_db->updateById('products',$id,$idValue,array('stock'=> $currentStock - $quantity));
    }
    
    public function selectProducts(){
        $products = $this->_db->get('products',array('id','>',0));
        return $products->results();
    }

    public function joinProducts($order_id){
        $products = $this->_db->joinProducts($order_id);
        return $products;
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

    public function selectReviews(){
        $products = $this->_db->joinUsersAndReviews();
        return $products;
    }

    public function insertReview($fields){
        if(!$this->_db->insert('products_reviews',$fields)){

            throw new Exception('There was a problem with your review');
        }
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