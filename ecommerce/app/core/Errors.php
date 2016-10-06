<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 20/09/2016
 * Time: 17:59
 */
class Errors{

    public static $_errors = [];


    public static function addError($error){
        self::$_errors[] = $error;
    }

    public static function errorMsg($id,$parmArray = array()){
        if ($id == 1) {
            return "Error [1]: No View: " . $parmArray[0] . " found.";
        }elseif ($id == 2){
            return "Error [2]: No Model: " . $parmArray[0] . " found.";
        }
    }

    public static function displayErrors(){
        foreach (self::error() as $error) {
            echo "$error <br>";
        }
    }
    
    public static function error(){
        return self::$_errors;
    }

}