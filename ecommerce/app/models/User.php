<?php

class User extends Model{

    protected $_db,
        $_data,
        $_time,
        $_sessionName,
        $_cookieName,
        $_isLoggedIn,
        $order;



    public function __construct($user = null){
        parent::__construct();
        $this->_db = Database::getInstance();

        $this->_sessionName = config::get('session/session_name');
        $this->_cookieName = config::get('remember/cookie_name');

        if(!$user){
            if(Session::exists($this->_sessionName)){
                $user = Session::get($this->_sessionName);

                if($this->find($user)){
                    $this->_isLoggedIn = true;
                }else{
                    //log out
                }
            }
        }else{
            $this->find($user);
        }


    }
    
    public function create($fields = array()){
        if(!$this->_db->insert('users',$fields)){
                
            throw new Exception('There was a problem creating account');
        }
    }

    public function find($user=null){
        if($user){
            $field=(is_numeric($user)) ? 'id':'username';

            $data = $this->_db->get('users',array($field,'=',$user));

            if($data->count()){
                $this->_data = $data->first();
                return true;
            }
        }
    }

    public function login($username=null,$password=null,$remember=false){

        if(!$username and !$password and $this->exists()){
            Session::put($this->_sessionName,$this->data()->id);
        }else {
            $user = $this->find($username);

            if ($user) {
                if (($this->data()->password === Hash::make($password, $this->data()->salt)) or ($this->data()->temp_password === $password)) {
                    Session::put($this->_sessionName, $this->data()->id);
                    if($this->hasPermission('admin')){
                        Session::put('admin','administrator');
                    }
                    if ($remember) {
                        $hash = Hash::unique();
                        $hashCheck = $this->_db->get('user_sessions', array('user_id', '=', $this->data()->id));

                        if (!$hashCheck->count()) {
                            $this->_db->insert('user_sessions', array(
                                'user_id' => $this->data()->id,
                                'hash' => $hash

                            ));
                        } else {
                            $hash = $hashCheck->first()->hash;
                        }
                        Cookie::put($this->_cookieName, $hash, config::get('remember/cookie_expiry'));
                    }
                    return true;
                }
            }
        }
    }

    public function update($fields=array(),$id=null){

        if(!$id and $this->isLoggedIn()){
            $id=$this->data()->id;
        }
        
        if(!$this->_db->update('users',$id,$fields)){
            throw new Exception('There was a problem updating.');
        }
    }

    public function userIdFromEmail($username){
        $this->_db->action('SELECT id','users',array('username','=',$username));
        return $this->_db->first()->id;
    }

    public function hasPermission($key){
        $group = $this->_db->get('groups',array('id','=',$this->data()->role));

        if($group->count()){
            $permissions= json_decode($group->first()->permission,true);

            if($permissions[$key]==true) {
                return true;

            }
        }
        return false;
    }
    
    public function userExists($username){
        $result = $this->_db->get('users',array('username','=',$username));

        if($result->count()){
           
                return true;
            
        }
        return false;
    }
    
    public function findUserById($customerId){
        $result = $this->_db->get('users',array('id','=',$customerId));
        return $result->results();
    }
    

    public function exists(){
        return(!empty($this->_data)) ?true : false;
    }

    public function data(){
        return $this->_data;
    }

    public function logout(){
        $this->_db->delete('user_sessions',array('user_id','=',$this->data()->id));

        Session::delete($this->_sessionName);
        Session::delete('username');
        Session::delete('default');
        Session::delete('admin');
        Cookie::delete($this->_cookieName);
    }

    public function order(){
        if($this->order == null) {
            $this->order = new Orders();
        }
        return $this->order;

    }

    public function isLoggedIn(){
        return $this->_isLoggedIn;
    }
    public function set($var,$value){
        return $this->{$var}= $value;
    }

    public function get($var){
        return $this->{$var};
    }

}