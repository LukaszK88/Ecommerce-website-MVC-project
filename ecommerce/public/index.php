<?php
require_once '../app/init.php';

function phpErrors(){
    if(config::get('logging/enable_php_errors')==true){
        ini_set('display_errors', 1);
    }
}

function appErrors(){
    if(config::get('logging/enable')==true){
        Errors::displayErrors();
    }
}


$app = new App();


appErrors();