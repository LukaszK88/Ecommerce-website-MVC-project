<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 17/10/2016
 * Time: 17:11
 */


class OrderWasCreated extends Event {

    public  $order,
            $result,
            $basket;

    public function __construct($order,$basket,$result){

        $this->order = $order;
        $this->basket= $basket;
        $this->result= $result;
    }
}