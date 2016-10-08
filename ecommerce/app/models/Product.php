<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 08/10/2016
 * Time: 12:21
 */
class Product extends Model{

    public $_db;

    public function __construct(){
        parent::__construct();
        $this->_db = Database::getInstance();
    }


    
    public function selectAll(){
        $products = $this->_db->get('products',array('id','>',0));
       //print_r( $products);
        return $products->first()->title;
    }
    
}