<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private function getOrCreateCart()
    {
        // Use logged-in customer_id or guest session
        if (Auth::check()) {
            $customerId = Auth::user()->customer_id;
            return Cart::firstOrCreate(['customer_id' => $customerId]);
        }

        // Guest: store cart_id in session
        $cartId = session('cart_id');
        if ($cartId) {
            $cart = Cart::find($cartId);
            if ($cart) return $cart;
        }

        $cart = Cart::create(['customer_id' => null]);
        session(['cart_id' => $cart->cart_id]);
        return $cart;
    }

    public function index()
    {
        $cart      = $this->getOrCreateCart();
        $cartItems = CartItem::with('product.images')
                             ->where('cart_id', $cart->cart_id)
                             ->get();

        $subtotal = $cartItems->sum(fn($item) => $item->price * $item->quantity);
        $shipping = $subtotal > 50 ? 0 : 5;
        $total    = $subtotal + $shipping;

        return view('cart', compact('cartItems', 'subtotal', 'shipping', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:Products,product_id',
            'quantity'   => 'integer|min:1',
        ]);

        $product  = Product::findOrFail($request->product_id);
        $cart     = $this->getOrCreateCart();
        $quantity = $request->quantity ?? 1;

        $item = CartItem::where('cart_id', $cart->cart_id)
                        ->where('product_id', $request->product_id)
                        ->first();

        if ($item) {
            $item->increment('quantity', $quantity);
        } else {
            CartItem::create([
                'cart_id'    => $cart->cart_id,
                'product_id' => $request->product_id,
                'quantity'   => $quantity,
                'price'      => $product->price,
            ]);
        }

        return redirect()->back()->with('success', '🛒 Item added to cart!');
    }

    public function remove($id)
    {
        CartItem::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Item removed from cart.');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);
        $item = CartItem::findOrFail($id);
        $item->update(['quantity' => $request->quantity]);
        return redirect()->back();
    }
}