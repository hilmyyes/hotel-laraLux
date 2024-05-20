<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaction = Transaction::all();
        return view('transaction.index', ['data' => $transaction]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * 
     */
    public function create()
    {
        $products = Product::all();
        $users = User::orderBy('name')->get();
        $customers = Customer::orderBy('name')->get();
        return view("transaction.create", compact('users', 'customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'user' => 'required',
            'customer' => 'required',
            'product' => 'required',
            'quantity' => 'required',
            'subtotal' => 'required',
        ]);

        $data = new Transaction();
        $data->transaction_date = now();
        $data->user_id = $request->get('user');
        $data->customer_id = $request->get('customer');
        $data->save();

        $product = $request->get('product');
        $quantity = $request->get('quantity');
        $subtotal = $request->get('subtotal');

        // Simpan data produk ke tabel pivot
        $data->products()->attach($product, [
            'quantity' => $quantity,
            'subtotal' => $subtotal,
        ]);

        return redirect('transaction')->with('status', 'Berhasil Tambah');
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


    public function showAjax(Request $request)
    {
        $id = ($request->get('id'));
        $data = Transaction::find($id);
        $products = $data->products;
        return response()->json(array(
            'msg' => view('transaction.showModal', compact('data', 'products'))->render()
        ), 200);
    }
}
