<?php

namespace App\Services;
use App\Models\Product;

class CartService
{
    /**
     * Create a new class instance.
     */
    

    public function add(Product $product, int $quantity = 1): void
    {
        $id = $product->id;
        //gget the cart from session
        $cart = $this->getCart();
        //use the id to check if product in cart
        if(isset($cart[$id])){
            $cart[$id]['quantity'] += $quantity;
        }else{
            //if not
            $cart[$id] = [
                'product_id' => $id,
                'quantity' => $quantity,
                'price' => $product->price,
                'image' => $product->image,
                'name' =>$product->name
            ];
        }
        //save cart
        $this->saveCart($cart);
    }

    public function update($productId, int $quantity = 1)
    {
        $cart = $this->getCart();
    
        if(isset($cart[productId])){
            if($quantity  <1 ){
                $this->remove($productId);
                return;
            }
        }
        $cart[$productId]['quantity'] = $quantity;
        
        $this->saveCart($cart);
    }

    public function remove($id)
    {
        $cart = $this->getCart();
        if(isset($cart[$id])){
            unset($cart[$id]);
        }
        
        $this->saveCart($cart);
    }

    public function clear()
    {
        session()->forget('cart');
    }

    public function getCart()
    {
        return session('cart', []);;
    }

    public function saveCart(array $cart): void
    {
       session()->put('cart', $cart);
    }
    
    public function count()
    {
        
    }
}
