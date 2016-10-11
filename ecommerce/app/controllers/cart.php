<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 10/10/2016
 * Time: 19:30
 */
class Cart extends Controller{

    protected $products,
                $basket;

    public function __construct(){
        $this->basket = new Basket();

        $this->products = $this->model('Products');
    }

    public function index($name = ''){

        $this->basket->refresh();

        $this->view('cart/index');
    }

    public function add($slug = '',$quantity = ''){


        $product = $this->products->compareSlug($slug);

        if(!$product){
            Redirect::to(Url::path().'/main/index');
        }

        $this->basket->add($product,$quantity);

        Redirect::to(Url::path().'/cart/index');



         $this->view('cart/add');
    }

}