<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItems;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1'
        ]);

        $userId = Auth::id();
        $productId = $validated['id'];
        $quantity = $validated['qty'];

        // Check if the item already exists in the cart
        $cart = DB::table('carts')
            ->where('user_id', $userId)
            ->first();

        if ($cart) {
            
            $item = DB::table('cart_items')
                ->where('product_id', $productId)
                ->where('cart_id', $cart->id)
                ->first();

            
            if ($item) {
                // Update the quantity if the item exists
                DB::table('cart_items')
                    ->where('product_id', $productId)
                    ->where('cart_id', $cart->id)
                    ->update(['quantity' => $item->quantity + $quantity]);
            } else {
                // Insert a new cart item if the product is not in the cart
                DB::table('cart_items')->insert([
                    'cart_id' => $cart->id,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                ]);
            }
            
            
            // Update the quantity if the item exists
            
        } else {
            // Insert a new item into the cart
            $cartId = DB::table('carts')->insertGetId([
                'user_id' => $userId,
            ]);

            DB::table('cart_items')->insert([
                'cart_id' => $cartId,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->route('menu');
    }

    

    public function getCartsWithProducts()
    {
        $cartsWithProducts = DB::table('cart_view')
            ->where('user_id', Auth::id())
            ->get();
        return Inertia::render('Cart', [
            'cart' => $cartsWithProducts,
        ]);
    }

    public function destroy($itemId)
    {
        // Check if the item exists in the cart
        $item = DB::table('cart_items')->where('id', $itemId)->first();

        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        // Delete the item from the database
        DB::table('cart_items')->where('id', $itemId)->delete();

    }




    public function update(Request $request, $id)
{
    // Validate the incoming request
    $request->validate([
        'quantity' => 'required|integer|min:1', // Ensure quantity is valid
    ]);

    // Fetch the cart item using DB facade
    $cartItem = DB::table('cart_items')->where('id', $id)->first();

    // Check if the cart item existsx   
    if (!$cartItem) {
        return response()->json(['message' => 'Cart item not found'], 404);
    }

    // Update the cart item quantity in the database
    DB::table('cart_items')
        ->where('id', $id)
        ->update([
            'quantity' => $request->quantity,
            'updated_at' => now(),
        ]);

    // Recalculate the updated price (assuming 'product_id' is available)
    $product = DB::table('products')->where('id', $cartItem->product_id)->first();

    $updatedPrice = $product->price * $request->quantity;
    return response()->json([
        'message' => 'Quantity updated successfully',
        'quantity' => $request->quantity,
        'updated_price' => $updatedPrice,
    ]);
}



}

