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

    public function __construct(){
        $this->products = $this->model('Products');
    }

    public function index($subCategory = ''){


        $this->productList = $this->products->selectProducts($subCategory);
        if(empty($this->productList)){
            Redirect::to(Url::path().'/main/index');
        }


        $this->view('categories/index',['product'=>$this->productList, 'review'=>$this->products]);
    }

    public function delete($itemId = '',$categorySlug = ''){

        if(!empty($itemId)){
            $this->products->deleteProduct($itemId);

            Message::setMessage('Product deleted','success');
            Redirect::to(Url::path().'/categories/'.$categorySlug);
        }

    }

}