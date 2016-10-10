<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 08/10/2016
 * Time: 12:21
 */
class Products extends Model{

    public $_db,
            $stock;


    public function __construct(){
        parent::__construct();
        $this->_db = Database::getInstance();
    }


    
    public function selectProducts(){
    $products = $this->_db->get('products',array('id','>',0));
    return $products->results();
    }

    public function compareSlug($slug){
      
        $result = $this->_db->get('products',array('slug','=',$slug));
         if($result->count()){
             $this->stock = $result->first()->stock;
             return $result->first();

         }
        return false;
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
}