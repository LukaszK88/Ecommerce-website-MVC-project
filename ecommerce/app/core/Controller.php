<?php

class Controller{

    public $model;

    public function model($model){
        if(!file_exists('../app/models/' .$model. '.php')){
            Errors::addError(Errors::errorMsg('2',array($model)));
        }else {
            require_once '../app/models/' . $model . '.php';
            return new $model;
        }

    }
    
    public function view($view, $data=[], $dontIncludeFile = false){
        if(!file_exists('../app/views/' .$view. '.php')){
            Errors::addError(Errors::errorMsg('1',array($view)));
        }elseif ($dontIncludeFile==true){
            require_once '../app/views/' . $view . '.php';
        }
        else {
            require_once '../app/basket/Basket.php';
            $basket = new Basket();

            require_once config::get('default/header_file');
            require_once config::get('default/navbar_top');
            require_once '../app/views/' . $view . '.php';
            require_once config::get('default/footer_file');
            require_once config::get('default/foot_file');
        }
    }
}