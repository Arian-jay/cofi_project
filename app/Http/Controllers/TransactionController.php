<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of transactions for the authenticated user.
     */
    public function index()
    {
        $cartsWithProducts = DB::table('transaction_summary')
            ->where('user_id', Auth::id())
            ->get();
        return Inertia::render('Transactions', [
            'transactions' => $cartsWithProducts,
        ]);
    }

    /**
     * Store a new transaction.
     */
    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'paymentMethod' => 'required|string',
    //         'gcashNumber' => 'nullable|string',
    //         'total' => 'required|numeric',
    //     ]);

    //     // Save the transaction, for example:
    //     Transaction::create($data);

    //     return response()->json($data); // Send a response back to the frontend
    // }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'payment_method' => 'required|string',
            'gcash_no' => 'nullable|string',
            'total' => 'required|numeric',
        ]);
    
        // Create the transaction or handle payment logic
        $transaction = DB::table('transactions')->insert([
            'user_id' => $validated['user_id'],
            'payment_method' => $validated['payment_method'],
            'gcash_no' => $validated['gcash_no'],
            'total' => $validated['total'],
        ]);
    
        return response()->json(['message' => 'Transaction successful!', 'transaction' => $transaction]);
    }
    


    /**
     * Display the specified transaction.
     */
    public function show($id)
    {
        $transaction = Transaction::where('user_id', Auth::id())->findOrFail($id);
        return response()->json($transaction);
    }

    /**
     * Update the specified transaction.
     */
    public function update(Request $request, $id)
    {
        $transaction = Transaction::where('user_id', Auth::id())->findOrFail($id);

        $validatedData = $request->validate([
            'gcash_no' => 'nullable|string|max:20',
            'status' => 'in:pending,completed,canceled',
        ]);

        $transaction->update($validatedData);

        return response()->json(['message' => 'Transaction updated successfully', 'transaction' => $transaction]);
    }

    /**
     * Remove the specified transaction.
     */
    public function destroy($id)
    {
        $transaction = Transaction::where('user_id', Auth::id())->findOrFail($id);
        $transaction->delete();

        return response()->json(['message' => 'Transaction deleted successfully']);
    }
}
