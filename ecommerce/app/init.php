<?php
session_start();
require '../vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();


require_once '../vendor/braintree/braintree_php/lib/Braintree.php';
spl_autoload_register(function($class){
    require_once 'core/' . $class . '.php';
});
require_once '../app/basket/Basket.php';

require_once 'config/init.php';

Braintree\Configuration::environment(getenv('environment'));
Braintree\Configuration::merchantId(getenv('merchantId'));
Braintree\Configuration::publicKey(getenv('publicKey'));
Braintree\Configuration::privateKey(getenv('privateKey'));