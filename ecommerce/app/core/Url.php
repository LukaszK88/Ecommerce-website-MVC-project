<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 19/09/2016
 * Time: 13:37
 */
class Url{
    
    public static function path(){
        return config::get('path/URL');
    }
}