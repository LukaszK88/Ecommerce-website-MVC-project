<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 04/10/2016
 * Time: 17:20
 */
class Categories extends Controller{

    protected $products,
                $productList;
 
    public function index($subCategory = ''){

        $this->products = $this->model('Products');
        $this->productList = $this->products->selectProducts($subCategory);


        $this->view('categories/index',['product'=>$this->productList, 'review'=>$this->products]);
    }

}