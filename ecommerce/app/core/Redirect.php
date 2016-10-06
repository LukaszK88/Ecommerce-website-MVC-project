<?php
class Redirect{

    public static function to($location){
        if($location){
            if(is_null($location)){
                switch($location){
                    case 404:
                        header('HTTP/1.0 404 Not found');
                        include 'includes/errors/404php.php';
                        exit();
                     break;
                }
            }
            header('Location:'.$location);
            exit();
        }
    }
}