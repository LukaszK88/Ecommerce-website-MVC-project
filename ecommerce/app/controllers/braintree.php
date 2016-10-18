<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 17/10/2016
 * Time: 13:27
 */
class Braintree extends Controller{

    public function index($token = ''){
        if(1==1) {
            $token = json_encode(array('token' => Braintree\ClientToken::generate()), JSON_FORCE_OBJECT);
            echo $token;
        }

        $this->view('braintree/index','',true);
    }

}