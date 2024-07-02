<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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
            $transaction->products()->attach($products[$i], [
                'checkin_date' => $checkIns[$i],
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
        // Clear current products from the transaction
        $transaction->products()->detach();

        // Iterate through each product to update pivot data
        foreach ($request->products as $productData) {
            $product = $productData['product'];
            $checkin_date = $productData['checkin_date'];
            $duration = $productData['duration'];
            $subtotal = $productData['subtotal'];

            // Update pivot data
            $transaction->products()->attach($product, [
                'checkin_date' => $checkin_date,
                'duration' => $duration,
                'subtotal' => $subtotal
            ]);
        }

        // Redirect to index page with success message
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

    public function addToCart($id)
    {
        $product = Product::find($id);
        $cart = session()->get('cart');
        if (!isset($cart[$id])) {
            $cart[$id] = [
                'id' => $id,
                'name' => $product->name,
                'description' => $product->description,
                'checkin_date' => now()->format('d-m-Y'),
                'duration' => 1,
                'price' => $product->price,
                'photo' => $product->image,
            ];
        } else {
            $cart[$id]['duration']++;
        }

        session()->put('cart', $cart);
        return redirect()->back()->with("status", "Produk Telah ditambahkan ke Cart");
    }

    public function getPrice($id)
    {
        dd($id);
        $products = Product::find($id);
        if ($products) {
            return response()->json(['price' => $products->price]);
        } else {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }
}
