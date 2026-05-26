<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        // Get cart
        if (Auth::check()) {
            $cart = Cart::firstOrCreate(['customer_id' => Auth::user()->customer_id]);
        } else {
            $cartId = session('cart_id');
            $cart = $cartId ? Cart::find($cartId) : null;
        }

        $cartItems = $cart
            ? CartItem::with('product.images')->where('cart_id', $cart->cart_id)->get()
            : collect();

        $subtotal = $cartItems->sum(fn($item) => $item->price * $item->quantity);
        $shipping = $subtotal > 50 ? 0 : 5;
        $total    = $subtotal + $shipping;

        return view('checkout', compact('cartItems', 'subtotal', 'shipping', 'total'));
    }
}