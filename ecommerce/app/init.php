<?php
session_start();
spl_autoload_register(function($class){
    require_once 'core/'.$class.'.php';
});

require_once '../app/basket/Basket.php';

require_once 'config/init.php';

