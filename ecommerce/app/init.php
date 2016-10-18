<?php
session_start();
require_once '../vendor/braintree/braintree_php/lib/Braintree.php';
spl_autoload_register(function($class){
    require_once 'core/'.$class.'.php';
});
require_once '../app/basket/Basket.php';
require_once 'config/init.php';

Braintree\Configuration::environment('sandbox');
Braintree\Configuration::merchantId('b359sbcv6qfrwnkk');
Braintree\Configuration::publicKey('g65prjxps7h3jgr8');
Braintree\Configuration::privateKey('b25214a5d7a5af396b08305e8d32cbbc');