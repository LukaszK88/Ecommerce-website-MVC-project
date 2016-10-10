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
    public function shields($name = ''){

        $this->products = $this->model('Products');
        $products = $this->products;
        
        $this->productList = $products->selectProducts();

        $this->view('categories/shields',['product'=>$this->productList]);
    }
    public function index($name = ''){



        $this->view('categories/index');
    }

}