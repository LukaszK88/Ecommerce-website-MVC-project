<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 18/10/2016
 * Time: 08:52
 */
class MarkOrderPaid implements Handler{

    public function handle($event)
    {
        $event->order->update($event->order->data()->id,array(
                'paid' => true
            ));
    }

}