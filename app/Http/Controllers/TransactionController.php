<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = SpladeTable::for(Transaction::class)
        ->column('reference_no', sortable:true)
        ->column('price', sortable:true, as: fn ($price) => "Rp" . str_replace(",",".", number_format($price)))
        ->column('quantity', sortable:true)
        ->column('payment_amount', sortable:true, as: fn ($price) => "Rp" . str_replace(",",".", number_format($price)))
        ->withGlobalSearch(columns: ['reference_no', 'price', 'quantity', 'payment_amount'])
        ->paginate(8);

        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::pluck('name', 'id')->toArray();
        return view('transactions.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required',
        ]);
        $product = Product::whereId($request->product_id)->first();
        $stock = $product->stock;
        $price = $product->price;
        $quantity = $request->quantity;
        $payment_amount = $price * $quantity;
        if ($quantity > $stock) {
            Toast::warning("Out of stock, " . $stock . " left");
            return redirect()->route('transaction.create');
        }
        try {
            $response = Http::withHeaders([
                'X-Api-Key' => 'DATAUTAMA',
            ])->post('https://pay.saebo.id/test-dau/api/v1/transactions', [
                'quantity' => $quantity,
                'price' => $price,
                'payment_amount' => $payment_amount,
            ])->json();
            $reference_no = $response['data']['reference_no'];

            $product->update([
                'stock' => $stock - $quantity
            ]);
            Transaction::create([
                'product_id' => $request->product_id,
                'reference_no' => $reference_no,
                'quantity' => $quantity,
                'price' => $price,
                'payment_amount' => $payment_amount,
            ]);
            Toast::title('Your transaction was created!');
            return redirect()->route('transaction.index');
        } catch (\Exception $e) {
            Toast::warning($e);
            return redirect()->route('transaction.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
