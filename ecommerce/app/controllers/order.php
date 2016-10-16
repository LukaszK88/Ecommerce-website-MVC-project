<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 11/10/2016
 * Time: 15:49
 */
class Order extends Controller{

    protected $basket,
                $user,
               // $order,
                $address;

    public function __construct(){

        $this->basket = new Basket();
        $this->user = $this->model('User');
        $this->address = $this->model('Address');
          $this->model('Orders');


    }

    public function index($name = ''){

        $this->basket->refresh();

        if(!$this->basket->subTotal()){
            Redirect::to(Url::path().'/main/index');
        }

        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                $validate = new Validation();
                $validation = $validate->check($_POST, array(
                    'username' => array(
                        'required' => true,
                        'min' => 4,
                        'max' => 50,
                        'unique' => 'users',
                        'email' => true
                    ),
                    'name' => array(
                        'required' => true,
                        'min' => 4,
                        'max' => 50,
                    ),
                    'address1' => array(
                        //'unique' => 'addresses',
                        'required' => true,
                        'min' => 10,
                        'max' => 150,
                    ),
                    'city' => array(
                        'required' => true,
                        'min' => 4,
                        'max' => 50,
                    ),
                    'post_code' => array(
                        'required' => true,
                        'min' => 3,
                        'max' => 10,     
                )
                ));
                if ($validation->passed()) {

                    $salt = Hash::salt(32);
                    $hash = Hash::bytes('32');

                    try {
                         $this->user->create(array(
                            'username' => Input::get('username'),
                            'temp_password' => Hash::md5(Input::get('username')),
                            'salt' => $salt,
                            'joined' => date('Y-m-d H:i:s'),
                            'role' => 1
                        ));


                        //email(Input::get('username'),'Your password to log in!','your password is '.Hash::md5(Input::get('username')).'');

                    } catch (Exception $e) {
                        die($e->getMessage());
                    }

                    try {
                        $this->address->create(array(
                            'address1' => Input::get('address1'),
                            'address2' => Input::get('address2'),
                            'city' => Input::get('city'),
                            'post_code' => Input::get('post_code')

                        ));
                        //email(Input::get('username'),'Your password to log in!','your password is '.Hash::md5(Input::get('username')).'');

                    } catch (Exception $e) {
                        die($e->getMessage());
                    }

                    try {
                        $this->user->order()->create(array(
                            'hash' => $hash,
                            'paid' => false,
                            'total'=> $this->basket->subTotal(),
                            'address_id' => $this->address->id

                        ));

                        //email(Input::get('username'),'Your password to log in!','your password is '.Hash::md5(Input::get('username')).'');

                    } catch (Exception $e) {
                        die($e->getMessage());
                    }

                }

            }
        }
       
        $this->view('order/index');
    }

   }