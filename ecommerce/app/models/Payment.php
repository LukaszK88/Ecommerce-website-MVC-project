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
}