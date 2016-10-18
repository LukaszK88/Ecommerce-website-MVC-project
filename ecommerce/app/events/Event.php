<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 17/10/2016
 * Time: 17:10
 */

namespace ecommerce\app\events;

class Event{

    protected $handlers = [];

    public function attach($handlers){

        if(is_array($handlers)){
            foreach ($handlers as $handler){
                if(!$handler instanceof Handler){
                    continue;

                }
                $this->handlers[] = $handler;
            }
            return;
        }
        if(!$handlers instanceof Handler){
            return;
        }

        $this->handlers[] = $handlers;
    }

    public function dispatch(){

        foreach ($this->handlers as $handler){
            $handler->handle($this);
        }

    }

    public function load($event){
        require_once '../app/models/' . $event . '.php';
        return new $event;
        
    }
}