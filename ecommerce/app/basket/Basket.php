<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 11/10/2016
 * Time: 07:20
 */

class Basket{

    protected   $storage,
                $product;

    public function __construct(){
        
        require_once '../app/core/Bucket.php';
        require_once '../app/models/Products.php';
        
        $this->product = new Products();
        $this->storage = new Bucket();
    }

    public function add($product,$quantity){

        if ($this->has($product)) {
        
            $quantity = $this->get($product)['quantity'] + $quantity;
             
        }

         $this->update($product, $quantity);
            
    }

    public function has($product){

        return $this->storage->exists($product->id);
    }

    public function update($product,$quantity){

        if(!$this->product->hasStock($quantity)){
           // Message::setMessage('You have exedded maximum quantity','error');
        }

        if($quantity == 0){

            $this->remove($product);
            return;
        }
        
        $this->storage->set($product->id,[
            'product_id' => $product->id,
            'quantity'   => $quantity
        ]);

    }

    public function get($product){

        return $this->storage->get($product->id);

    }

    public function remove($product){

        $this->storage->delete($product->id);
    }

    public function clear(){

        $this->storage->clear();
    }

    public function all(){

        $ids = [];
        $items = [];

        foreach ($this->storage->all() as $product){

            $ids[] = $product['product_id'];

        }

        $products = $this->product->findProducts($ids);
            if($products) {
                foreach ($products as $product) {

                    $product->quantity = $this->get($product)['quantity'];
                    $items[] = $product;
                }

                return $items;

            }
    }

    public function itemCount(){

        return count($this->storage->all());
    }

    public function subTotal(){

        $total = 0;

        foreach ($this->all() as $item){

            if($item->stock == 0){
                continue;
            }

            $total = $total + $item->price * $item->quantity;

        }

        return $total;
    }

    public function refresh(){

        if($this->itemCount()>0) {
            foreach ($this->all() as $item) {

                if ($item->stock <= ($item->quantity)) {

                    $this->update($item, $item->stock);
                } elseif ($item->stock >= 1 && $item->quantity == 0) {

                    $this->update($item, 1);
                }
            }
        }
    }
}