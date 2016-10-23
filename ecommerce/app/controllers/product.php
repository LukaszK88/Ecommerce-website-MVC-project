<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 10/10/2016
 * Time: 13:50
 */
class Product extends Controller{

    protected $products,
                $user;

    public function __construct(){
        $this->products = $this->model('Products');
        $this->user = $this->model('User');
    }

    public function index($slug = ''){


        $product = $this->products->compareSlug($slug);

        if(!$product){
            Redirect::to(Url::path().'/main/index');
        }
        
        $reviews = $this->products->selectReviews();

        

        $this->view('product/index',['product'=>$product,'products'=>$this->products,'reviews'=>$reviews]);
    }

    public function review($slug = ''){

        $product = $this->products->compareSlug($slug);

        if(!$product){
            Redirect::to(Url::path().'/main/index');
        }
        
        if(!$this->user->isLoggedIn()){
            Message::setMessage('You must be logged in to leave a review','error');
            Redirect::to(Url::path().'/product/'.$product->slug);
        }else {
            if (Input::exists()) {
                if (Token::check(Input::get('token'))) {
                    $validate = new Validation();
                    $validation = $validate->check($_POST, array(
                        'rating' => array(
                            'required' => true,
                            'min' => 0.5,
                            'max' => 5,
                        ),
                        'review' => array(
                            'required' => true,
                            'min' => 10,
                            'max' => 500,
                        )
                    ));
                    if ($validation->passed()) {

                        try {
                            $this->products->insertReview(array(
                                'rating' => Input::get('rating'),
                                'review' => Input::get('review'),
                                'product_id' => $product->id,
                                'customer_id' => $this->user->data()->id
    
                            ));

                            Message::setMessage('Thank you','success');
                            Redirect::to(Url::path().'/product/'.$product->slug);
    
                        } catch (Exception $e) {
                            die($e->getMessage());
                        }
                    }
                }
            }
        }

        $this->view('product/review',['product'=>$product,'products'=>$this->products]);
    }

}