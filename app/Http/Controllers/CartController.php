<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cartItems = $user->CartItem()->with('product')->get();

        $subtotal = $cartItems->sum(function($item) {
            return $item->quantity * $item->product->price;
        });

        $shipping = $subtotal > 50 ? 0 : 5.99; // Free shipping over $50
        $tax = $subtotal * 0.1; // 10% tax
        $total = $subtotal + $shipping + $tax;

        return view('cart.index', compact('cartItems', 'subtotal', 'shipping', 'tax', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $user = Auth::user();
        $product = Product::findOrFail($request->product_id);

        // Check stock
        if ($product->stock < $request->quantity) {
            return redirect()->route('products.show', $product->id)
                ->with('error', 'Not enough stock available. Only ' . $product->stock . ' items left.');
        }

        // Check if item already in cart
        $existingCartItem = CartItem::where('user_id', $user->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($existingCartItem) {
            // Update quantity if already in cart
            $newQuantity = $existingCartItem->quantity + $request->quantity;
            
            if ($product->stock < $newQuantity) {
                return redirect()->route('products.show', $product->id)
                    ->with('error', 'Cannot add more items. You already have ' . $existingCartItem->quantity . ' in cart, only ' . $product->stock . ' available.');
            }
            
            $existingCartItem->update(['quantity' => $newQuantity]);
            $message = 'Product quantity updated in cart!';
        } else {
            // Create new cart item
            CartItem::create([
                'user_id' => $user->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
            ]);
            $message = 'Product added to cart successfully!';
        }

        // Check if coming from buy now button
        if ($request->has('buy_now')) {
            return redirect()->route('cart')->with('success', $message);
        }

        return redirect()->route('products.show', $product->id)
            ->with('success', $message);
    }

    public function remove(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:cart_items,id'
        ]);

        CartItem::where('id', $request->item_id)
                ->where('user_id', Auth::id())
                ->delete();

        return redirect()->route('cart')->with('success', 'Item removed from cart successfully!');
    }

   public function update(Request $request)
{
    $request->validate([
        'item_id' => 'required|exists:cart_items,id',
        'quantity' => 'required|integer'
    ]);

    $cartItem = CartItem::with('product')
        ->where('id', $request->item_id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    // 🔥 JIKA QUANTITY < 1 → HAPUS ITEM
    if ($request->quantity < 1) {
        $cartItem->delete();

        return response()->json([
            'success' => true,
            'removed' => true
        ]);
    }

    // 🔒 CEK STOCK
    if ($request->quantity > $cartItem->product->stock) {
        return response()->json([
            'success' => false,
            'message' => 'Not enough stock available'
        ]);
    }

    $cartItem->update([
        'quantity' => $request->quantity
    ]);

    return response()->json([
        'success' => true,
        'quantity' => $cartItem->quantity
    ]);
}


    public function clear()
    {
        CartItem::where('user_id', Auth::id())->delete();
        
        return redirect()->route('cart')->with('success', 'Cart cleared successfully!');
    }
}