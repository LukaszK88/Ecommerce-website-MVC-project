<?php

require_once '../app/init.php';

function appErrors(){
    if(config::get('logging/enable')==true){
        Errors::displayErrors();
    }
}

$app = new App();


appErrors();