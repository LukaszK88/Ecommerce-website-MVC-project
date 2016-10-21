<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 17/10/2016
 * Time: 17:32
 */
class EmptyBasket implements Handler{

    public function handle($event)
    {
        
        $event->basket->clear();
    }

}