<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductTransaction;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index()
    {
        //
        $products = Product::all();
        return view('frontend.index', compact('products'));
    }

    public function show($id)
    {
        //
        $product = Product::find($id);
        return view('frontend.product-detail', compact('product'));
    }

    public function cart()
    {
        return view('frontend.cart');
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

    public function changeQuantity(Request $request)
    {
        $id = $request->id;
        $newQuan = $request->newQuan;
        $cart = session()->get('cart');
        $product = Product::find($cart[$id]['id']);

        if (isset($cart[$id])) {
            if ($newQuan <= $product->available_room) {
                $cart[$id]['duration'] = $newQuan;
            } else {
                return redirect()->back()->with('error', 'Jumlah pemesanan melebihi total kamar yang tersedia');
            }
        }

        session()->put('cart', $cart);
    }

    public function editCheckIn(Request $request)
    {
        $id = $request->id;
        $checkin_date = $request->checkin_date;
        $duration = $request->duration;
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            $cart[$id]['checkin_date'] = $checkin_date;
            $cart[$id]['duration'] = $duration;
        }

        session()->put('cart', $cart);
        return response()->json(['status' => 'Check-in date updated successfully']);
    }


    public function deleteFromCart($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
        }
        session()->forget('cart');
        session()->put('cart', $cart);
        return redirect()->back()->with("status", "Produk Telah dibuang dari Cart");
    }

    public function deleteAllCart()
    {
        session()->forget('cart');
        return redirect()->back()->with("status", "Semua Cart telah dihapus");
    }

    public function checkout(Request $request)
    {
        $cart = session('cart');
        $user = Auth::user();

        $t = new Transaction();
        $t->user_id = $user->id;
        $t->customer_id = 1; //need to fix later
        $t->transaction_date = Carbon::now()->toDateTimeString();
        $t->save();

        $transactionId = $t->id;
        session(['transactionId' => $transactionId]);

        foreach ($cart as $c) {
            $newProdTrans = new ProductTransaction();
            $newProdTrans->product_id = $c['id'];
            $newProdTrans->transaction_id = $transactionId;
            $checkinDate = date('Y-m-d', strtotime(str_replace('-', '/', $c['checkin_date'])));
            $newProdTrans->checkin_date = $checkinDate;
            $newProdTrans->duration = $c['duration'];

            $subtotal = $c['duration'] * $c['price'];
            $newProdTrans->subtotal = $subtotal;
            $newProdTrans->save();
        }

        $total = array_reduce($cart, function ($carry, $item) {
            return $carry + $item['duration'] * $item['price'];
        }, 0);

        $transaction = Transaction::findOrFail($transactionId);
        $customer = $user;
        $status = 'Your order on Laralux Reservation System is complete.';

        session()->forget('cart');

        return view('frontend.receipt', compact('cart', 'total', 'transaction', 'customer', 'status'));
    }
}
