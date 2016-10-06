<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 03/10/2016
 * Time: 11:39
 */

class Main extends Controller{

    protected $user;

    public function __construct(){
        $this->user = $this->model('User');
    }

    public function index($name = ''){

        $user = $this->user;


        $this->view('main/index');
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
                        //email(Input::get('username'),'Your password to log in!','your password is '.Hash::md5(Input::get('username')).'');

                    } catch (Exception $e) {
                        die($e->getMessage());
                    }

                    $remember = (Input::get('remember') === 'on') ? true : false;
                    $login = $user->login(Input::get('username'), Hash::md5(Input::get('username')), $remember);

                    if ($login) {
                        Session::put('username',$user->data()->username);
                        if ($user->data()->temp_password === Hash::md5(Input::get('username'))) {
                            Message::setMessage('You have logged in for the first time, change your password','success') ;
                            Redirect::to(Url::path().'/main/index');

                        } else {
                            Session::flash('success', 'You are logged in!');
                            Redirect::to(Url::path().'/main/index');
                        }
                    } else {
                        Message::setMessage('Sorry we couldn\'t log you in','error') ;
                    }

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
                            Redirect::to(Url::path().'/main/update');

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
        if(Input::exists()){
            if(Token::check(Input::get('token'))){

                $validate = new Validation();
                $validation = $validate->check($_POST,array(
                    'name'=>array(
                        'required'=> true,
                        'min'=> 4,
                        'max'=> 50
                    ),
                    'password_current'=>array(
                        'required'=> true,
                        'min'=> 6
                    ),
                    'new_password'=>array(
                        'required'=> true,
                        'min'=> 6
                    ),
                    'new_password_again'=>array(
                        'required'=> true,
                        'min'=> 6,
                        'matches'=>'new_password'
                    )
                ));
                if($validation->passed()) {

                    if (((Input::get('password_current')) === ($user->data()->temp_password))){

                        try {
                            $salt= Hash::salt(32);
                            $user->update(array(
                                'name' => Input::get('name'),
                                'password' => Hash::make(Input::get('new_password'),$salt),
                                'salt' => $salt,
                                'temp_password' => ''
                            ));

                            Message::setMessage('You have updated your details!','success' );
                            Redirect::to('index.php');

                        } catch (Exception $e) {
                            die($e->getMessage());
                        }

                    }else{
                        Message::setMessage('Invalid Password','error');
                    }
                }
            }
        }

        $this->view('main/settings',['temp_password'=>$user->data()->temp_password]);
    }

    public function logout($name = ''){
        $user = $this->user;
        $user->logout();
        Redirect::to(Url::path().'/main/index');

        $this->view('main/logout');
    }

}