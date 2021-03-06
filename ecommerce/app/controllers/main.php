<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 03/10/2016
 * Time: 11:39
 */

class Main extends Controller{

    protected   $user,
                $address = '',
                $product = '',
                $products;

    public function __construct(){
        $this->user = $this->model('User');
        $this->address = $this->model('Address');
        $this->products = $this->model('Products');
    }

    public function index($name = ''){

        $shields = $this->products->selectProductsByMainCategory('Shields');
        $paddings = $this->products->selectProductsByMainCategory('Paddings');
        $armours = $this->products->selectProductsByMainCategory('Armours');
        $others = $this->products->selectProductsByMainCategory('Others');

        $this->view('main/index',['shields'=>$shields,'paddings'=>$paddings,'armours'=>$armours,'others'=>$others]);

    }

    public function register($name = ''){

        $user = $this->user;
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
                    )
                ));
                if ($validation->passed()) {

                    $salt = Hash::salt(32);

                    try {
                        $user->create(array(
                            'username' => Input::get('username'),
                            'temp_password' => Hash::md5(Input::get('username')),
                            'salt' => $salt,
                            'joined' => date('Y-m-d H:i:s'),
                            'role' => 1
                        ));
                        Email::sendEmail(Input::get('username'),'Your password to log in!','your password is '.Hash::md5(Input::get('username')).'');

                    } catch (Exception $e) {
                        die($e->getMessage());
                    }

                    Message::setMessage('We have sent you temporary password , check your inbox <br> Upon first login you will need to set new password','success');
                    Redirect::to(Url::path().'/main/index');


                } 
            }
        }
    
        $this->view('main/register');
    }

    public function login($name = ''){
        $user = $this->user;

        if(Input::exists()){
            if(Token::check(Input::get('token'))){

                $validate = new Validation();
                $validation = $validate->check($_POST,array(
                    'username'=> array(
                        'required'=>true,
                        'email'   =>true
                    ),
                    'password'=> array(
                        'required'=>true
                    )));
                if($validation->passed()){

                    $remember= (Input::get('remember')==='on') ? true : false;
                    $login = $user->login(Input::get('username'),Input::get('password'),$remember);

                    if($login){
                        Session::put('username',$user->data()->username);
                        if($user->data()->temp_password === Hash::md5(Input::get('username'))){
                            Message::setMessage('You have logged in for the first time, change your password','success') ;
                            Redirect::to(Url::path().'/main/settings');

                        }else{
                            Redirect::to(Url::path().'/main/index');
                        }
                    }else{
                        Message::setMessage('Sorry we couldn\'t log you in','error') ;
                    }
                }
            }
        }

        $this->view('main/login');
    }

    public function settings(){
        $user = $this->user;
        if(!$user->isLoggedIn()){
            Redirect::to('index.php');
        }
        if(empty($this->user->data()->temp_password)) {
            if (Input::exists()) {
                if (Token::check(Input::get('token'))) {

                    $validate = new Validation();
                    $validation = $validate->check($_POST, array(
                        'password_current' => array(
                            'required' => true,
                            'min' => 6
                        ),
                        'new_password' => array(
                            'required' => true,
                            'min' => 6
                        ),
                        'new_password_again' => array(
                            'required' => true,
                            'min' => 6,
                            'matches' => 'new_password'
                        )
                    ));
                    if ($validation->passed()) {



                        if ((Hash::make(Input::get('password_current'), $this->user->data()->salt)) === ($this->user->data()->password)) {


                            try {
                                $salt = Hash::salt(32);
                                $user->update(array(
                                    'name' => Input::get('name'),
                                    'password' => Hash::make(Input::get('new_password'), $salt),
                                    'salt' => $salt,
                                    'temp_password' => ''
                                ));

                                Message::setMessage('You have updated your password!', 'success');
                                Redirect::to(Url::path() . '/main/index');

                            } catch (Exception $e) {
                                die($e->getMessage());
                            }

                        } else {
                            Message::setMessage('Invalid Password', 'error');
                        }
                    }
                }
            }
        }else{
            if (Input::exists()) {
                if (Token::check(Input::get('token'))) {

                    $validate = new Validation();
                    $validation = $validate->check($_POST, array(
                        'new_password' => array(
                            'required' => true,
                            'min' => 6
                        ),
                        'new_password_again' => array(
                            'required' => true,
                            'min' => 6,
                            'matches' => 'new_password'
                        )
                    ));
                    if ($validation->passed()) {


                            try {
                                $salt = Hash::salt(32);
                                $user->update(array(
                                    'password' => Hash::make(Input::get('new_password'), $salt),
                                    'salt' => $salt,
                                    'temp_password' => ''
                                ));

                                Message::setMessage('You have updated your password!', 'success');
                                Redirect::to(Url::path() . '/main/index');

                            } catch (Exception $e) {
                                die($e->getMessage());
                            }

                    }
                }
            }

        }

        $this->view('main/settings',['user'=>$user->data()]);
    }

    public function recovery( $name = ''){
        $user = $this->user;
        if(Input::exists()) {
            if (Token::check(Input::get('token'))) {

                $validate = new Validation();
                $validation = $validate->check($_POST,array(
                    'username'=> array(
                        'required'=>true,
                    )
                ));

                if($validation->passed()) {
                    $username =Input::get('username');

                    if($user->userExists($username)) {

                        if ($name == ('username')) {
                            Email::sendEmail(Input::get('username'), 'Your username reminder', $user->data()->username);
                            Message::setMessage('Username has been sent, check your inbox!','success');
                            Redirect::to(Url::path().'/main/login');
                        } else if ($name == ('password')) {
                            $id = $user->userIdFromEmail($username);
                            $user->update(array(
                                'temp_password'=>Hash::md5($username),
                                'password'     => ''
                            ),$id);
                            Email::sendEmail(Input::get('username'), 'Your password reminder', Hash::md5($username));
                            Message::setMessage('Password has been sent, check your inbox!','success');
                            Redirect::to(Url::path().'/main/login');
                        } else {
                            Redirect::to(Url::path().'/main/index');
                        }
                    }else{
                        Message::setMessage('This email address doesn\'t exist in our database, register please','error');
                    }
                }

            }
        }

        

        $this->view('main/recovery');
    }

    public function admin($productId = '',$categorySlug = ''){

        if(!empty($productId)){
            $this->product = $this->products->selectProducts($categorySlug);



            if (Input::exists()) {
                if (Token::check(Input::get('token'))) {
                    $validate = new Validation();
                    $validation = $validate->check($_POST, array(
                        'title' => array(
                            'required' => true,
                            'min' => 4,
                            'max' => 255,
                        ),
                        'slug' => array(
                            'required' => true,
                            'min' => 4,
                            'max' => 255,
                        ),
                        'price' => array(
                            'required' => true,
                            'min' => 1,
                            'max' => 20,
                        ),
                        'main_category' => array(
                            'required' => true,
                            'min' => 4,
                            'max' => 255,
                        ),
                        'category' => array(
                            'required' => true,
                            'min' => 4,
                            'max' => 255,
                        ),
                        'category_slug' => array(
                            'required' => true,
                            'min' => 4,
                            'max' => 255,
                        ),
                        'stock' => array(
                            'max' => 50,
                        ),
                        'description' => array(
                            'required' => true,
                            'min' => 4,
                            'max' => 500,
                        ),
                        'image' => array(
                            'required' => true,
                            'min' => 4,
                            'max' => 255,
                        ),
                    ));
                    if ($validation->passed()) {

                        try {
                            $this->products->updateProduct($productId,array(
                                'title' => Input::get('title'),
                                'slug' => Input::get('slug'),
                                'price' => Input::get('price'),
                                'main_category' => Input::get('main_category'),
                                'category' => Input::get('category'),
                                'category_slug' => Input::get('category_slug'),
                                'description' => Input::get('description'),
                                'stock' => Input::get('stock'),
                                'image' => Input::get('image')
                            ));
                            

                        } catch (Exception $e) {
                            die($e->getMessage());
                        }
                    }

                }
            }


            if(isset($_FILES['photo']['name'])) {
                if(!empty($_FILES['photo']['name'])) {
                    $name = $_FILES['photo']['name'];
                    $tmp_name = $_FILES['photo']['tmp_name'];
                    $location =  'images/';
                    if (move_uploaded_file($tmp_name, $location . $name)) {

                        Message::setMessage('Product updated', 'success');
                        Redirect::to(Url::path() . '/categories/' .$categorySlug);

                    }else{
                        Message::setMessage('Update failed', 'error');
                        Redirect::to(Url::path() . '/categories/' .$categorySlug);
                    }
                }
            }



        }else {


            if (Input::exists()) {
                if (Token::check(Input::get('token'))) {
                    $validate = new Validation();
                    $validation = $validate->check($_POST, array(
                        'title' => array(
                            'required' => true,
                            'min' => 4,
                            'max' => 255,
                        ),
                        'slug' => array(
                            'required' => true,
                            'min' => 4,
                            'max' => 255,
                        ),
                        'price' => array(
                            'required' => true,
                            'min' => 1,
                            'max' => 20,
                        ),
                        'main_category' => array(
                            'required' => true,
                            'min' => 4,
                            'max' => 255,
                        ),
                        'category' => array(
                            'required' => true,
                            'min' => 4,
                            'max' => 255,
                        ),
                        'category_slug' => array(
                            'required' => true,
                            'min' => 4,
                            'max' => 255,
                        ),
                        'stock' => array(
                            'max' => 50,
                        ),
                        'description' => array(
                            'required' => true,
                            'min' => 4,
                            'max' => 500,
                        ),
                        'image' => array(
                            'required' => true,
                            'min' => 4,
                            'max' => 255,
                        ),
                    ));
                    if ($validation->passed()) {

                        try {
                            $this->products->insertProduct(array(
                                'title' => Input::get('title'),
                                'slug' => Input::get('slug'),
                                'price' => Input::get('price'),
                                'main_category' => Input::get('main_category'),
                                'category' => Input::get('category'),
                                'category_slug' => Input::get('category_slug'),
                                'description' => Input::get('description'),
                                'stock' => Input::get('stock'),
                                'image' => Input::get('image')
                            ));

                        } catch (Exception $e) {
                            die($e->getMessage());
                        }
                    }

                }
            }

            if(isset($_FILES['photo']['name'])) {
                if(!empty($_FILES['photo']['name'])) {
                    $name = $_FILES['photo']['name'];
                    $tmp_name = $_FILES['photo']['tmp_name'];
                    $location =  'images/';
                    if (move_uploaded_file($tmp_name, $location . $name)) {

                        Message::setMessage('Product uploaded', 'success');
                        Redirect::to(Url::path() . '/main/admin');

                    }else{
                        Message::setMessage('Upload failed', 'error');
                        Redirect::to(Url::path() . '/main/admin');
                    }
                }
            }
        }
        $this->view('main/admin',['product'=>$this->product,'productId'=>$productId]);
    }


    public function logout($name = ''){
        $user = $this->user;
        $user->logout();
        Redirect::to(Url::path().'/main/index');

        $this->view('main/logout');
    }

    public function profile($name = ''){
        
        $this->address->selectUserAddress();
        if(Input::exists()){
            if(isset($_POST['delete'])) {
                $this->address->deleteAddress($_POST['delete']);
                Redirect::to(Url::path().'/main/profile');
            }elseif (isset($_POST['add'])) {
                if (Token::check(Input::get('token'))) {
                    $validate = new Validation();
                    $validation = $validate->check($_POST, array(
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

                        try {
                            $this->address->create(array(
                                'address1' => Input::get('address1'),
                                'address2' => Input::get('address2'),
                                'city' => Input::get('city'),
                                'post_code' => Input::get('post_code'),
                                'customer_id' => $this->user->data()->id

                            ));

                            Redirect::to(Url::path() . '/main/profile');

                        } catch (Exception $e) {
                            die($e->getMessage());
                        }
                    }
                }

            }

        }
       
        $this->view('main/profile',['user'=>$this->user->data(),'addresses'=>$this->address->data()]);
    }

    public function contact($name = ''){
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                $validate = new Validation();
                $validation = $validate->check($_POST, array(
                    'name' => array(
                        'required' => true,
                        'min' => 3,
                        'max' => 60,
                    ),
                    'last_name' => array(
                        'required' => true,
                        'min' => 4,
                        'max' => 60,
                    ),
                    'email' => array(
                        'required' => true,
                        'email' => true,
                        'min' => 4,
                        'max' => 60,
                    ),
                    'message' => array(
                        'required' => true,
                        'min' => 4,
                        'max' => 500,
                    ),
                ));
                if ($validation->passed()) {

                    Email::sendEmail('lukaskowalpl@yahoo.co.uk','New message from '.Input::get('name').' '.Input::get('email').'', Input::get('message'));
                    Message::setMessage('Message sent <br> We will get back to you ASAP','success');
                    Redirect::to(Url::path() . '/main/index');

                }
            }
        }



        $this->view('main/contact',['user'=>$this->user]);
    }

    public function about(){

        $this->view('main/about');
    }

    public function update($update = ''){

    if($update == 'username') {
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                $validate = new Validation();
                $validation = $validate->check($_POST, array(
                    'username' => array(
                        'required' => true,
                        //'email' => true,
                        'unique' => 'users',
                        'min' => 4,
                        'max' => 60,
                    ),
                ));
                if ($validation->passed()) {
                    try {
                        $this->user->update(array(
                            'username' => Input::get('username')
                        ));

                        Message::setMessage('You have updated your username!','success' );
                        Redirect::to(Url::path().'/main/profile');

                    } catch (Exception $e) {
                        die($e->getMessage());
                    }
                }
            }
        }
    }elseif ($update == 'name'){
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                $validate = new Validation();
                $validation = $validate->check($_POST, array(
                    'name' => array(
                        'required' => true,
                        //'email' => true,
                        'min' => 3,
                        'max' => 60,
                    ),
                ));
                if ($validation->passed()) {
                    try {
                        $this->user->update(array(
                            'name' => Input::get('name')
                        ));

                        Message::setMessage('You have updated your name!','success' );
                        Redirect::to(Url::path().'/main/profile');

                    } catch (Exception $e) {
                        die($e->getMessage());
                    }
                }
            }
        }
    }

        $this->view('main/update',['update'=>$update,'user'=>$this->user->data()]);
    }
    
}