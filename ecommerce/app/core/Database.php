<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 19/09/2016
 * Time: 13:21
 */
class Database extends PDO {

    protected static $_instance;
    protected $_pdo,
        $_query,
        $_error= false,
        $_results,
        $_row,
        $_count= 0;
    public function __construct(){
        try{
            $this->_pdo= new PDO('mysql:host='.config::get('mysql/host').';dbname='.config::get('mysql/db'),config::get('mysql/username'),config::get('mysql/password'));

        } catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public static function getInstance(){
        if(!isset(self::$_instance)){
            self::$_instance= new Database();
        }
        return self::$_instance;
    }

    public function query($sql,$params=array()){
        $this->_error=false;
        if($this->_query = $this->_pdo->prepare($sql)){
            $x = 1;
            if(count($params)){
                foreach($params as $param){
                    $this->_query->bindValue($x,$param);
                    $x++;
                }
            }
            if($this->_query->execute()){
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            }else{
                $this->_error = true;
            }
        }
        return $this;

    }
    public function action($action, $table, $where = array()){
        if(count($where)===3){
            $operators = array('=','>','<','>=','<=');

            $field    = $where[0];
            $operator = $where[1];
            $value    = $where[2];
            if(in_array($operator,$operators)){
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

                if(!$this->query($sql,array($value))->error()){
                    return $this;
                }
            }

        }
        return false;

    }

    public function find($table, $value){

        
        foreach ($value as $item)
        {
            $new_elements[] = "id = ".$item;
        }

        $value = implode(' OR ', $new_elements);


        $sql= "SELECT * FROM ".$table." WHERE ".$value."";
        $results = $this->_pdo->query($sql);
        $rows = $results->fetchAll(PDO::FETCH_OBJ);

        $num_rows = count($rows);

        if($num_rows>=1) {
            return $rows;
        }
    }
    
    public function joinProducts($order_id){

        $sql= "SELECT orders_products.*, products.*
        FROM orders_products
        INNER JOIN products
        ON products.id=orders_products.product_id AND orders_products.order_id={$order_id}";

        $results = $this->_pdo->query($sql);
        $rows = $results->fetchAll(PDO::FETCH_OBJ);
        $num_rows = count($rows);

        if($num_rows>=1) {
            return $rows;
        }
        
    }

    public function joinUsersAndReviews(){

        $sql= "SELECT users.*, products_reviews.*
        FROM users
        INNER JOIN products_reviews
        ON users.id = products_reviews.customer_id AND products_reviews.id >= 0";

        $results = $this->_pdo->query($sql);
        $rows = $results->fetchAll(PDO::FETCH_OBJ);
        $num_rows = count($rows);

        if($num_rows>=1) {
            return $rows;
        }

    }

    public function selectMultipleConditions($table,$column1,$value1,$column2,$value2){
        $sql = "SELECT * FROM {$table} WHERE {$column1} = '$value1' AND {$column2} = {$value2}";
       
        $results = $this->_pdo->query($sql);
        $rows = $results->fetchAll(PDO::FETCH_OBJ);
        $num_rows = count($rows);

        if($num_rows>=1) {
            return $rows;
        }
    }
    
    public function selectAvg($columnName,$what,$table,$where){
        return $this->action('SELECT AVG('.$columnName.') AS '.$what.'', $table, $where);
    }
    
    
    public function select($table, $where){
        return $this->action('SELECT *', $table, $where);
    }

    public function selectColumn($column,$table, $where){
        return $this->action('SELECT '.$column.'', $table, $where);
    }

    public function delete($table, $where){
        return $this->action('DELETE', $table, $where);
    }

    public function get($table, $where){
        return $this->action('SELECT *', $table, $where);
    }

    public function insert($table,$fields=array()){
        $keys = array_keys($fields);
        $values = '';
        $x = 1;

        foreach($fields as $field){
            $values .='?';
            if($x < count($fields)){
                $values .= ', ';
            }
            $x++;
        }

        $sql = "INSERT INTO {$table} (".implode(',',$keys).") VALUES ({$values})";

        if(!$this->query($sql, $fields)->error()) {
            return true;
        }
        return false;
    }

    public function update($table,$id,$fields){
        $set = '';
        $x = 1;

        foreach ($fields as $name => $value) {
            $set .= "{$name} = ?";
            if ($x < count($fields)) {
                $set .= ', ';
            }
            $x++;
        }

        $sql="UPDATE {$table} SET {$set} WHERE id = {$id}";

        if(!$this->query($sql, $fields)->error()) {
            return true;
        }
        return false;
    }

    public function updateById($table,$id,$idValue,$fields){
        $set = '';
        $x = 1;

        foreach ($fields as $name => $value) {
            $set .= "{$name} = ?";
            if ($x < count($fields)) {
                $set .= ', ';
            }
            $x++;
        }

        $sql="UPDATE {$table} SET {$set} WHERE {$id} = {$idValue}";

        if(!$this->query($sql, $fields)->error()) {
            return true;
        }
        return false;
    }

    public function results(){
        return $this->_results;
    }

    public function first(){
        return $this->results()[0];
    }

    public function error(){
        return $this->_error;
    }
    public function count(){
        return $this->_count;
    }
}