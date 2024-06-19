<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductTransaction;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaction = Transaction::all();
        $products = Product::all();
        $users = User::orderBy('name')->get();
        $customers = Customer::orderBy('name')->get();
        return view('transaction.index', compact('transaction', 'users', 'customers', 'products'));
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
        try {
            $data = new Transaction;
            $data->user_id = Auth::id();
            $data->save();

            $transactionId = $data->id;
            $carts = Cart::where('user_id', Auth::id())->get();

            foreach ($carts as $c) {
                $newProdTrans = new ProductTransaction();
                $newProdTrans->product_id = $c['id'];
                $newProdTrans->transaction_id = $transactionId;
                $newProdTrans->checkin_date = $c['checkin_date'];
                $newProdTrans->duration = $c['duration'];
                $newProdTrans->subtotal = $c['subtotal'];
                $newProdTrans->save();
            }

            Cart::where('user_id', Auth::id())->delete();

            return redirect("cart/")->with('status', 'Berhasil Tambah');

        } catch (QueryException $e) {
            return back()->withInput()->withErrors(['error' => 'Error storing cart item: ' . $e->getMessage()]);
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
        $data = $transaction;
        $products = Product::all();
        $users = User::orderBy('name')->get();
        $customers = Customer::orderBy('name')->get();
        $transactionProduct = $transaction->products()->first(); // Mengambil produk dari pivot table

        return view('transaction.edit', compact('data', 'products', 'users', 'customers', 'transactionProduct'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        // Perbarui data transaksi
        $transaction->user_id = $request->user;
        $transaction->customer_id = $request->customer;
        $transaction->save();

        $product = $request->product;
        $quantity = $request->quantity;
        $subtotal = $request->subtotal;

        // Perbarui data pivot
        $transaction->products()->syncWithoutDetaching([
            $product => [
                'quantity' => $quantity,
                'subtotal' => $subtotal,
            ]
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('transaction.index')->with('status', 'Transaction updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        try {
            $deletedData = $transaction;
            //dd($deletedData);
            $deletedData->delete();
            return redirect()->route('transaction.index')->with('status', 'Horray ! Your data is successfully deleted !');
        } catch (\PDOException $ex) {

            $msg = "Failed to delete data ! Make sure there is no related data before deleting it";
            return redirect()->route('transaction.index')->with('status', $msg);
        }
    }

    public function showAjax(Request $request)
    {
        $id = ($request->get('id'));
        $data = Transaction::find($id);
        $products = $data->products;
        return response()->json(
            array(
                'msg' => view('transaction.showModal', compact('data', 'products'))->render()
            ),
            200
        );
    }

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = Transaction::find($id);
        $products = Product::all();
        $users = User::orderBy('name')->get();
        $customers = Customer::orderBy('name')->get();
        $transactionProduct = $data->products()->first();
        return response()->json(
            array(
                'status' => 'oke',
                'msg' => view('transaction.getEditForm', compact('data', 'products', 'users', 'customers', 'transactionProduct'))->render()
            )
        );
    }

    public function deleteData(Request $request)
    {
        $id = $request->id;
        $data = Transaction::find($id);
        $data->delete();
        return response()->json(
            array(
                'status' => 'oke',
                'msg' => 'type data is removed !'
            ),
            200
        );
    }

    public function insertProducts($cart, $user)
    {
        $total = 0;
        foreach ($cart as $c) {
            # code...
            $subtotal = $c['quantity'] * $c['price'];
            $total += $subtotal;
            $this->products()->attach($c['id'], ['quantity' => $c['quantity'], 'subtotal' => $subtotal]);
        }
    }
}
