<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 18/10/2016
 * Time: 08:55
 */
class UpdateStock implements Handler{

    public function handle($event)
    {

        foreach ($event->basket->all() as $product){
            $event->order->products()->compareSlug($product->slug);

            $event->order->products()->update('id',$product->id,$event->order->products()->data()->stock,$product->quantity);
        }

    }

}