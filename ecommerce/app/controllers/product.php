<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 10/10/2016
 * Time: 13:50
 */
class Product extends Controller{

    protected $products;

    public function index($name = ''){
        $this->products = $this->model('Products');

        $product = $this->products->compareSlug($name);
       
        
        if(!$product){
            Redirect::to(Url::path().'/main/index');
        }

        $this->view('product/index',['product'=>$product,'products'=>$this->products]);
    }


}