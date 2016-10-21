<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 18/10/2016
 * Time: 08:53
 */
class RecordFailedPayment implements Handler{

    public function handle($event)
    {
        $event->order->payment()->create(array(
            'order_id' => $event->order->data()->id
        ));
     
        $event->order->payment()->update('order_id',$event->order->data()->id,array(
            'failed'        => true
        ));
    }

}