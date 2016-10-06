<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 19/09/2016
 * Time: 14:41
 */
class Model{

    public $db;

    public function __construct(){
        $this->initDb();
    }

    public function initDb() {
        $this->db = Database::getInstance();
    }
}