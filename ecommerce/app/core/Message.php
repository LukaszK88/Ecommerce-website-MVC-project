<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 04/10/2016
 * Time: 13:38
 */
class Message{

    public static function setMessage($message,$type){
        if($type == 'error'){
            $_SESSION['errorMsg'] = $message;
        }else{
            $_SESSION['successMsg'] = $message;
        }
    }

    public static function displayMessage(){
        if(isset($_SESSION['errorMsg'])){
            echo '<div class="alert alert-danger">'.$_SESSION['errorMsg'].'</div>';
            unset($_SESSION['errorMsg']);
        }
        if(isset($_SESSION['successMsg'])){
            echo '<div class="alert alert-success">'.$_SESSION['successMsg'].'</div>';
            unset($_SESSION['successMsg']);
        }
    }
}