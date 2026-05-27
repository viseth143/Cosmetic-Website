<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $cart = Cart::firstOrCreate(['customer_id' => Auth::user()->customer_id]);
        } else {
            $cartId = session('cart_id');
            $cart   = $cartId ? Cart::find($cartId) : null;
        }

        $cartItems = $cart
            ? CartItem::with('product.images')->where('cart_id', $cart->cart_id)->get()
            : collect();

        $subtotal = $cartItems->sum(fn($item) => $item->price * $item->quantity);
        $shipping = $subtotal > 50 ? 0 : 5;
        $total    = $subtotal + $shipping;

        return view('payment', compact('cartItems', 'subtotal', 'shipping', 'total'));
    }

    public function success()
    {
        // Clear the cart after successful payment
        if (session('cart_id')) {
            $cart = Cart::find(session('cart_id'));
            if ($cart) {
                CartItem::where('cart_id', $cart->cart_id)->delete();
            }
            session()->forget('cart_id');
        }

        return view('order-success');
    }
}