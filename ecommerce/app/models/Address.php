<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 15/10/2016
 * Time: 12:14
 */

class Address extends Model{

    public $_db,
            $data,
            $lastEnteredData,
            $dataFirst,
            $user,
            $count,
            $order;
        


    public function __construct(){
        parent::__construct();
        $this->_db = Database::getInstance();

    }

    public function create($fields = []){
        if(!$this->_db->insert('addresses',$fields)){

            throw new Exception('There was a problem updating address');
        }
    }

    public function selectLastAddress(){
        $addresses = $this->_db->get('addresses',array('id','>',0));
        if($addresses->count()){
            
            $result = $addresses->results();
            $this->lastEnteredData = end($result);

            return true;
        }
    }

    public function selectAddress($id){
        $addresses = $this->_db->get('addresses',array('id','=',$id));
        if($addresses->count()){

            $result = $addresses->results();

            return $result;
        }
    }
    
    public function selectUserAddress(){
        $addresses = $this->_db->get('addresses',array('customer_id','=',$this->user()->data()->id));
        if($addresses->count()){
            $this->count = $addresses->count();
            $this->data = $addresses->results();
            $this->dataFirst = $addresses->first();

            return true;
        }
    }

    public function selectUserAddressByIdAndAddress($address1){
        $addresses = $this->_db->selectMultipleConditions('addresses','address1',$address1,'customer_id',$this->user()->data()->id);
        
            return $addresses;
        
    }

    public function userAndAddressExists(){
        if($this->user()->isLoggedIn() and ($this->selectUserAddress()==true)){
            return true;
        }
    }

    public function userExistsAndNoAddress(){
        if($this->user()->isLoggedIn() and ($this->selectUserAddress()==false)){
            return true;
        }
    }
    
    public function deleteAddress($address){
        $this->_db->delete('addresses',array('id','=',$address));
    }

    public function count(){

        return $this->count;
    }

    public function dataFirst(){

        return $this->dataFirst;
    }

    public function data(){

        return $this->data;
    }
    
    public function lastEnteredData(){
        
        return $this->lastEnteredData;
    }


    public function set($name,$value){
        $this->{$name} = $value;
    }

    public function get($var){
        return $this->{$var};

    }
    
    public function user(){
        if($this->user == null) {
            $this->user = new User();
        }
        return $this->user;

    }

    public function order(){
        if($this->order == null) {
            $this->order = new Orders();
        }
        return $this->order;

    }
}