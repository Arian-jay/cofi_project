<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function submitPayment(Request $request)
    {
        $validated = $request->validate([
            'paymentMethod' => 'required|string',
            'gcashNumber' => 'nullable|string',
            'total' => 'required|numeric|min:0',
        ]);
        $userId = Auth::id(); // Get authenticated user's ID

        try {
            DB::beginTransaction();
            $cartItems = DB::table('cart_items')
                ->join('carts', 'cart_items.cart_id', '=', 'carts.id')
                ->where('carts.user_id', $userId)
                ->get();

                if ($cartItems->isEmpty()) {
                    throw new \Exception('No items found in the cart for this user.');
                }                 

            $transactionId = DB::table('transactions')->insertGetId([
                'user_id' => $userId,
                'total_amount' => $validated['total'],
                'gcash_no' => $validated['gcashNumber'],
                'payment_method' => $validated['paymentMethod'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            foreach ($cartItems as $cartItem) {
                DB::table('transaction_items')->insert([
                    'transaction_id' => $transactionId,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'total_amount' => $validated['total'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            // DB::table('transaction_items')->insert([
            //     'transaction_id' => $transactionId,
            //     'product_id' => $cartItems->product_id,
            //     'quantity' => $cart_items->quantity,
            //     'total_amount' => $transactionId->total_amount,
            // ]);
            // Insert the transaction record
            
            // Clear the user's cart
            DB::table('cart_items')
                ->whereIn('cart_items.cart_id', function ($query) use ($userId) {
                    $query->select('id')
                        ->from('carts')
                        ->where('user_id', $userId);
                })
                ->delete();


            DB::commit();

            return Inertia::render('Cart');
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Payment failed, please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
