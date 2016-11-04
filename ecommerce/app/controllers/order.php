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
                $address,
                $address1,
                $userAddress = '';

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

        $hash = Hash::bytes('32');


        if($this->address->userAndAddressExists() and $this->user->isLoggedIn()){


            if(Input::exists()){
                if (Token::check(Input::get('token'))) {
                    $validate = new Validation();
                    @$validation = $validate->check($_POST, array(
                        'address_id' => array(
                            'required' => true,
                        )
                    ));
                    if ($validation->passed()) {
                        try {
                            $this->user->order()->create(array(
                                'hash' => $hash,
                                'paid' => false,
                                'total' => $this->basket->subTotal(),
                                'customer_id' => $this->user->data()->id,
                                'address_id' => Input::get('address_id')

                            ));


                        } catch (Exception $e) {
                            die($e->getMessage());
                        }

                        $this->order->selectLastOrder();

                        try {
                            foreach ($this->basket->all() as $item) {

                                $this->order->createOrder(array(
                                    'product_id' => $item->id,
                                    'order_id' => $this->order->data()->id,
                                    'quantity' => $item->quantity,

                                ));

                            }


                        } catch (Exception $e) {
                            die($e->getMessage());
                        }

                        $result = Braintree\Transaction::sale([
                            'amount' => $this->basket->subTotal(),
                            'paymentMethodNonce' => Input::get('payment_method_nonce'),
                            'options' => [
                                'submitForSettlement' => true
                            ]

                        ]);

                        $events = new Event;
                        $events->loadEvent('OrderWasCreated');
                        $event = new OrderWasCreated($this->order, $this->basket, $result);


                        if (!$result->success) {

                            $event->attach($events->loadHandler('RecordFailedPayment'));
                            $event->dispatch();

                            Redirect::to(Url::path() . '/order/index');

                        }

                        if ($result->success) {

                            Email::sendEmail(Input::get('username'), 'Your order summary!',
                                'Your items' . $item->title . 'x' . $item->quantity . '<br>
                                 Total' . $this->basket->subTotal() . ''
                            );
                        }

                        $event->attach([

                            $events->loadHandler('MarkOrderPaid'),
                            $events->loadHandler('RecordSuccessfulPayment'),
                            $events->loadHandler('UpdateStock'),
                            $events->loadHandler('EmptyBasket')

                        ]);

                        $event->dispatch();

                        Redirect::to(Url::path() . '/order/show/' . $hash);
                    }

                }
            }

        }elseif($this->user->isLoggedIn() and $this->address->selectUserAddress()==false){

            if (Input::exists()) {
                if (Token::check(Input::get('token'))) {
                    $validate = new Validation();
                    $validation = $validate->check($_POST, array(
                        'address1' => array(
                            //'unique' => 'addresses',
                            'required' => true,
                            'min' => 4,
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

                        try {
                            $this->address->create(array(
                                'address1' => Input::get('address1'),
                                'address2' => Input::get('address2'),
                                'city' => Input::get('city'),
                                'post_code' => Input::get('post_code'),
                                'customer_id' => $this->user->data()->id

                            ));

                        } catch (Exception $e) {
                            die($e->getMessage());
                        }

                        $this->address->selectLastAddress();

                        try {
                            $this->user->order()->create(array(
                                'hash' => $hash,
                                'paid' => false,
                                'total' => $this->basket->subTotal(),
                                'customer_id' => $this->user->data()->id,
                                'address_id' => $this->address->lastEnteredData()->id

                            ));

                            //email(Input::get('username'),'Your password to log in!','your password is '.Hash::md5(Input::get('username')).'');

                        } catch (Exception $e) {
                            die($e->getMessage());
                        }

                        $this->order->selectLastOrder();

                        try {
                            foreach ($this->basket->all() as $item) {

                                $this->order->createOrder(array(
                                    'product_id' => $item->id,
                                    'order_id' => $this->order->data()->id,
                                    'quantity' => $item->quantity,

                                ));

                            }


                        } catch (Exception $e) {
                            die($e->getMessage());
                        }

                        $result = Braintree\Transaction::sale([
                            'amount' => $this->basket->subTotal(),
                            'paymentMethodNonce' => Input::get('payment_method_nonce'),
                            'options' => [
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
        }else {
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
                            'min' => 3,
                            'max' => 50,
                        ),
                        'address1' => array(
                            //'unique' => 'addresses',
                            'required' => true,
                            'min' => 4,
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


                        try {
                            $this->user->create(array(
                                'username' => Input::get('username'),
                                'name' => Input::get('name'),
                                'temp_password' => Hash::md5(Input::get('username')),
                                'salt' => $salt,
                                'joined' => date('Y-m-d H:i:s'),
                                'role' => 1
                            ));
                            

                            Email::sendEmail(Input::get('username'),'Your password to log in!','your password is '.Hash::md5(Input::get('username')).'');

                        } catch (Exception $e) {
                            die($e->getMessage());
                        }

                        $this->user->selectLastUser();
                        

                        try {
                            $this->address->create(array(
                                'address1' => Input::get('address1'),
                                'address2' => Input::get('address2'),
                                'city' => Input::get('city'),
                                'post_code' => Input::get('post_code'),
                                'customer_id' => $this->user->lastEnteredData()->id

                            ));

                        } catch (Exception $e) {
                            die($e->getMessage());
                        }

                        $this->address->selectLastAddress();

                        try {
                            $this->user->order()->create(array(
                                'hash' => $hash,
                                'paid' => false,
                                'total' => $this->basket->subTotal(),
                                'customer_id' => $this->user->lastEnteredData()->id,
                                'address_id' => $this->address->lastEnteredData()->id

                            ));


                        } catch (Exception $e) {
                            die($e->getMessage());
                        }

                        $this->order->selectLastOrder();

                        try {
                            foreach ($this->basket->all() as $item) {

                                $this->order->createOrder(array(
                                    'product_id' => $item->id,
                                    'order_id' => $this->order->data()->id,
                                    'quantity' => $item->quantity,

                                ));

                            }


                        } catch (Exception $e) {
                            die($e->getMessage());
                        }

                        $result = Braintree\Transaction::sale([
                            'amount' => $this->basket->subTotal(),
                            'paymentMethodNonce' => Input::get('payment_method_nonce'),
                            'options' => [
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

                        if($result->success){

                            Email::sendEmail(Input::get('username'),'Your order summary!',
                                'Your items'.$item->title.'x'.$item->quantity.'<br>
                                 Total'.$this->basket->subTotal() .''
                                );
                        }

                        $event->attach([

                            $events->loadHandler('MarkOrderPaid'),
                            $events->loadHandler('RecordSuccessfulPayment'),
                            $events->loadHandler('UpdateStock'),
                            $events->loadHandler('EmptyBasket')

                        ]);

                        $event->dispatch();


                        Message::setMessage('We have sent you temporary password for your account <br> Upon first login you will need to change your temporary password','success');
                        Redirect::to(Url::path().'/order/show/'.$hash);
                    }

                }

            }
        }


        $this->view('order/index',['user'=>$this->user->data(),'address'=>$this->address]);
    }

    public function show($hash = ''){

       $this->order->selectLastOrder();
        $this->address->selectLastAddress();

        $orderHash = $this->order->data()->hash;


        if($hash != $orderHash){
            Redirect::to(Url::path().'/main/index');
        }

        $products = $this->product->joinProducts($this->order->data()->id);

        if($this->address->userAndAddressExists() and $this->user->isLoggedIn()) {
            $this->address = $this->address->selectAddress($this->order->data()->address_id)[0];
        }elseif($this->user->isLoggedIn() and $this->address->selectUserAddress()==false){
            $this->address = $this->address->dataFirst();
        }else{
            $this->address = $this->address->lastEnteredData();
        }

        $this->view('order/show',['address' => $this->address,'product' => $products,'order' =>$this->order->data()]);
    }

    public function update(){



        $this->view('order/update');
    }


}