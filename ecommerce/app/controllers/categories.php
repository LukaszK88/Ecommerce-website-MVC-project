<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 04/10/2016
 * Time: 17:20
 */
class Categories extends Controller{

    protected   $products,
                $user,
                $productList;

    public function __construct(){
        $this->products = $this->model('Products');
        $this->user = $this->model('User');
    }

    public function index($subCategory = ''){

        $this->productList = $this->products->selectProducts($subCategory);
        if(empty($this->productList)){

            $this->productList = $this->products->selectProductsByMainCategory($subCategory);

        }
        if(empty($this->productList)) {

            Message::setMessage('There is no items in this category', 'error');
            Redirect::to(Url::path() . '/main/index');
        }


        $this->view('categories/index',['product'=>$this->productList, 'review'=>$this->products, 'user'=>$this->user , 'urlCategory' => $subCategory]);
    }

    public function delete($itemId = '',$categorySlug = ''){

        if(!empty($itemId)){
            $this->products->deleteProduct($itemId);

            Message::setMessage('Product deleted','success');
            Redirect::to(Url::path().'/categories/'.$categorySlug);
        }

    }

}