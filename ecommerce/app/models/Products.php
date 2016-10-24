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
            $rating,
            $order,
            $data;


    public function __construct(){
        parent::__construct();
        $this->_db = Database::getInstance();
    }

    public function insertProduct($fields){
        if(!$this->_db->insert('products',$fields)){

            throw new Exception('There was a problem with inserting your product');
        }
    }

    public function deleteProduct($productId){
        $this->_db->delete('products',array('id','=',$productId));
    }

    public function updateProduct($id,$fields){
        $this->_db->update('products',$id,$fields);
    }

    public function update($id,$idValue,$currentStock,$quantity){
        $this->_db->updateById('products',$id,$idValue,array('stock'=> $currentStock - $quantity));
    }
    
    public function selectProducts($subcategory){
        $products = $this->_db->get('products',array('category_slug','=',$subcategory));
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
    
    public function countReviews($productId){
        $result = $this->_db->get('products_reviews',array('product_id','=',$productId));
        if($result->count()) {
         
            return $result->count();
        }
        return false;
    }

    public function selectReviewsAndUsers(){
        $products = $this->_db->joinUsersAndReviews();
        return $products;
    }
    
    public function selectReviews($reviewId){
        $result = $this->_db->get('products_reviews',array('id','=',$reviewId));
        if($result->count()) {

            return $result->first();
        }
    }
    
    public function getAverageRating($productId){
        $result = $this->_db->selectAvg('rating','ratingAvg','products_reviews',array('product_id','=',$productId));
       
        return $result->first();
    }

    public function insertReview($fields){
        if(!$this->_db->insert('products_reviews',$fields)){

            throw new Exception('There was a problem with your review');
        }
    }
    
    public function deleteReview($reviewId){
        $this->_db->delete('products_reviews',array('id','=',$reviewId));
    }

    public function updateReview($id,$fields){
        $this->_db->update('products_reviews',$id,$fields);
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