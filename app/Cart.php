<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    private $totalQuantity = 0;
    private $totalPrice = 0;
    private $products;

    public function getTotalQuantity()
    {
        return $this->totalQuantity;
    }

    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function __construct($carts){
        if ($carts) {
            $this->products = $carts->products;
            $this->totalPrice = $carts->totalPrice;
            $this->totalQuantity = $carts->totalQuantity;
        }
    }

    // public function __construct($cart)
    // {
    //     if ($cart) {
    //         $this->products = $cart->products;
    //         $this->totalPrice = $cart->totalPrice;
    //         $this->totalQuantity = $cart->totalQuantity;
    //     }
    // }

    public function add($product, $quantity, $size, $color)
    {
        // $newProduct = ['quantity' => 0,'price' => $product->price, 'productInfo' => $product];
        // if($this->products){
        //     if(array_key_exists($id, $product)){
        //         $newProduct = $product[$id];
        //     }
        // }
        // $newProduct['quantity']++;
        // $newProduct['price'] = $newProduct['quantity'] * $product->price;
        // $this->products[$id] = $newProduct;
        // $this->totalPrice += $product->price;
        // $this->totalQuantity++;

        $cartInfo = [
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $quantity,
            'price' => $product->price,
            'avatar' => asset($product->avatar),
            'size' => $size,
            'color' => $color,
            'sale' => $product->sale,

        ];

    }
}
