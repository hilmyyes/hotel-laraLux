<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\ProductTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$transaction = Transaction::where('user_id', auth()->user()->id)->get();
        $transaction = Transaction::all();
        //$produk_b = $transaction->products;

        foreach ($transaction as $t) {
            $t->total_price = $t->products->sum('pivot.subtotal');
        }

        return view('transaction.index', compact('transaction'));
    }

    /**
     * Show the form for creating a new resource.
     * 
     * 
     */
    public function create()
    {
        $products = Product::all();
        $customers = User::where('role', 'guest')->orderBy('name')->get();
        return view("transaction.create", compact('customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'products.*' => 'required',
            'check_in.*' => 'required',
            'duration.*' => 'required',
            'subtotal.*' => 'required',
        ]);

        // Simpan data transaksi
        $transaction = new Transaction();
        $transaction->transaction_date = now();
        $transaction->user_id = $request->input('customer');
        $transaction->save();

        // Simpan detail produk ke dalam pivot table
        $products = $request->input('products');
        $checkIns = $request->input('check_in');
        $durations = $request->input('duration');
        $subtotals = $request->input('subtotal');

        // Loop untuk menyimpan setiap produk
        for ($i = 0; $i < count($products); $i++) {
            $checkin_date = Carbon::createFromFormat('d-m-Y', explode(' - ', $checkIns[$i])[0])->format('Y-m-d');
            $transaction->products()->attach($products[$i], [
                'checkin_date' => $checkin_date,
                'duration' => $durations[$i],
                'subtotal' => $subtotals[$i],
            ]);
        }

        return redirect()->route('transaction.index')->with('status', 'Berhasil Tambah Transaksi');
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
        $transactionProduct = $transaction->products()->first(); // Mengambil produk dari pivot table

        return view('transaction.edit', compact('data', 'products', 'transactionProduct'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'products.*' => 'required',
            'check_in.*' => 'required',
            'duration.*' => 'required',
            'subtotal.*' => 'required',
        ]);

        // Clear current products from the transaction
        $transaction->products()->detach();

        // Loop untuk menyimpan setiap produk
        $products = $request->input('products');
        $checkIns = $request->input('check_in');
        $durations = $request->input('duration');
        $subtotals = $request->input('subtotal');

        // Loop untuk menyimpan setiap produk
        for ($i = 0; $i < count($products); $i++) {
            $checkin_date = Carbon::createFromFormat('d-m-Y', explode(' - ', $checkIns[$i])[0])->format('d-m-Y');
            $transaction->products()->attach($products[$i], [
                'checkin_date' => $checkin_date,
                'duration' => $durations[$i],
                'subtotal' => $subtotals[$i],
            ]);
        }


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

        return response()->json(array(
            'msg' => view('transaction.showM  odal', compact('data', 'products'))->render()
        ), 200);
    }

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = Transaction::with('products')->find($id); // Load all related products
        $products = Product::all();
        $users = User::orderBy('name')->get();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('transaction.getEditForm', compact('data', 'products', 'users'))->render()
        ));
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



    public function getPrice($id)
    {
        $product = Product::find($id);
        if ($product) {
            return response()->json(['price' => $product->price]);
        } else {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }
}
