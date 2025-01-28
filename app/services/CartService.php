<?php

namespace App\Services;

use Darryldecode\Cart\Cart;

class CartService
{
    public function addToCart($id, $product_id, $price, $quantity = 1)
    {
        \Cart::add([
            'id' => $id,
            'product_id' => $product_id,
            'price' => $price,
            'quantity' => $quantity,
        ]);
    }

    public function updateCartItem($id, $quantity)
    {
        \Cart::update($id, [
            'quantity' => $quantity,
        ]);
    }

    public function removeFromCart($id)
    {
        \Cart::remove($id);
    }

    public function getCartItems()
    {
        return \Cart::getContent();
    }

    public function getCartTotal()
    {
        return \Cart::getTotal();
    }

    public function clearCart()
    {
        \Cart::clear();
    }
}
