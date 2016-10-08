<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 04/10/2016
 * Time: 17:20
 */
class Categories extends Controller{

    protected $product;

    public function shields($name = ''){

        $this->product = $this->model('Product');
        $product = $this->product;

      echo $product->selectAll();



        $this->view('categories/shields');
    }
    public function kaka($name = ''){



        $this->view('categories/kaka');
    }

}