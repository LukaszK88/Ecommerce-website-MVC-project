<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 17/10/2016
 * Time: 16:01
 */
class Payment extends Model{

    public $_db;


    public function __construct()
    {
        parent::__construct();
        $this->_db = Database::getInstance();
    }
    public function create($fields = array()){
        $this->_db->insert('payments',$fields);
    }

    public function update($id,$idValue,$fields = []){
        $this->_db->updateById('payments',$id,$idValue,$fields);
    }
}

