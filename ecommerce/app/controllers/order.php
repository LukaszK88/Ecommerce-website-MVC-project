<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 11/10/2016
 * Time: 15:49
 */

require_once '../app/events/Event.php';

class Order extends Controller{

    protected   $basket,
                $user,
                $order,
                $product,
                $item,
                $address;

    public function __construct(){

        $this->basket   = new Basket();
        $this->product  = $this->model('Products');
        $this->user     = $this->model('User');
        $this->address  = $this->model('Address');
        $this->order    = $this->model('Orders');
        $this->model('Payment');




    }

    public function index($name = ''){


        $this->basket->refresh();

        if(!$this->basket->subTotal()){
            Redirect::to(Url::path().'/main/index');
        }

        /*if(!Input::get('payment_method_nonce')){
            Redirect::to(Url::path().'/order/index');
        }*/
        
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

                        $login = $this->user->login(Input::get('username'), Hash::md5(Input::get('username')));
                        if ($login) {
                            Session::put('username', $this->user->data()->username);
                        }

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

                    $this->address->selectLastAddress();

                    try {
                        $this->user->order()->create(array(
                            'hash' => $hash,
                            'paid' => false,
                            'total'=> $this->basket->subTotal(),
                            'customer_id' => $this->user->data()->id,
                            'address_id' => $this->address->data()->id

                        ));

                        //email(Input::get('username'),'Your password to log in!','your password is '.Hash::md5(Input::get('username')).'');

                    } catch (Exception $e) {
                        die($e->getMessage());
                    }

                    $this->order->selectLastOrder();

                    try {
                        foreach ($this->basket->all() as $item){

                            $this->order->createOrder(array(
                                'product_id' => $item->id,
                                'order_id'   => $this->order->data()->id,
                                'quantity'   => $item->quantity,

                            ));

                        }


                    } catch (Exception $e) {
                        die($e->getMessage());
                    }

                   $result = Braintree\Transaction::sale([
                       'amount' => $this->basket->subTotal(),
                       'paymentMethodNonce' => Input::get('payment_method_nonce'),
                       'options' =>[
                           'submitForSettlement' => true
                       ]

                   ]);

                    $events= new Event;
                    $events->loadEvent('OrderWasCreated');
                    $event = new OrderWasCreated($this->order,$this->basket,$result);

                    if(!$result->success){
                        $event->attach($events->loadHandler('RecordFailedPayment'));
                        $event->dispatch();
                        
                         Redirect::to(Url::path().'/order/index');
                    }


                    $event->attach([
                        $events->loadHandler('MarkOrderPaid'),
                        $events->loadHandler('RecordSuccessfulPayment'),
                        $events->loadHandler('UpdateStock'),
                        $events->loadHandler('EmptyBasket')
                    ]);

                    $event->dispatch();

                    Redirect::to(Url::path().'/order/show/'.$hash);

                }

            }

        }
        
        $this->view('order/index');
    }
    
    public function show($hash = ''){

        $this->order->selectLastOrder();
        $this->address->selectLastAddress();

        $orderHash = $this->order->data()->hash;


        if($hash != $orderHash){
            Redirect::to(Url::path().'/main/index');
        }
        
        $address = $this->address->data();
        $orderId = $this->order->data()->id;
        $products = $this->order->select($orderId);

        foreach ($products as $product){

        }
        $productsArray[] = $this->product->joinProducts($product->product_id);
        foreach ($productsArray as $product){
            $this->item = $product;
        }

        $this->view('order/show',['address' => $address,'product' => $this->item,'order' =>$this->order->data()]);
    }

   }