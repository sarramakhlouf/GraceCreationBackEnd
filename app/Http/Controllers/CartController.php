<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'product_id' => 'required|integer',
            'price' => 'required|numeric',
            'quantity' => 'nullable|integer|min:1', 
        ]);

        $this->cartService->addToCart(
            $request->id,
            $request->product_id,
            $request->price,
            $request->quantity ?? 1
        );

        return response()->json(['message' => 'Item added to cart!']);
    }

    public function getCartItems()
    {
        $items = $this->cartService->getCartItems();

        return response()->json($items);
    }

    public function removeFromCart($id)
    {
        $items = $this->cartService->removeFromCart($id);

        return response()->json($items);
    }

    public function updateCartItem($id, $quantity)
    {
    $items = $this->cartService->updateCartItem($id, $quantity);

        return response()->json($items);
    }

    public function getCartTotal()
    {
        $total = $this->cartService->getCartTotal();

        return response()->json(['total' => $total]);
    }

    public function clearCart()
    {
        $result = $this->cartService->clearCart();

        return response()->json($result);
    }
}
