<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Product;
use App\Models\ProductTransaction;
use App\Models\Transaction;
use App\Models\User;
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

    public function hotel($id)
    {
        $hotel = Hotel::find($id);
        $products = Product::where('hotel_id', $id)->get();
        return view('frontend.hotel', compact('hotel', 'products'));
    }

    public function show($id)
    {
        $product = Product::find($id);
        $hotel = Hotel::find($product->hotel_id);
        $productFacilities = $product->facilities()->get();
        $productSimilar = Product::where('hotel_id', $hotel->id)
            ->where('id', '!=', $id)
            ->get();
        return view('frontend.product-detail', compact('product', 'productFacilities', 'hotel', 'productSimilar'));
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

    public function shop($id)
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
        return view('frontend.cart');
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
        $total = $request->total;
        $cart = session()->get('cart');

        session()->put('points', 0);

        if (isset($cart[$id])) {
            $cart[$id]['checkin_date'] = $checkin_date;
            $cart[$id]['duration'] = $duration;
        }

        session()->put('cart', $cart);
        return response()->json(['status' => 'Check-in date updated successfully']);
    }

    public function editPoints(Request $request)
    {
        $points = $request->points;
        $total = $request->total;
        $availablePoints = Auth::user()->points;

        if ($points == "") {
            $points = 0;
        }

        if ($points > $availablePoints) {
            $points = $availablePoints;
        }

        if (($points * 100000) > $total) {
            $points = floor($total / 100000);
        }

        session()->put('points', $points);

        return response()->json(['status' => 'Points updated successfully', 'points' => $points]);
    }

    public function deleteFromCart($id)
    {
        session()->put('points', 0);
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
        $customer = $user;

        $points = session('points');

        $total = array_reduce($cart, function ($carry, $item) {
            return $carry + $item['duration'] * $item['price'];
        }, 0);

        $pointsEarned = floor(($total - $points * 100000) / 300000);
        $customer->points += $pointsEarned;
        $customer->points -= $points;
        $customer->save();

        $t = new Transaction();
        $t->user_id = $user->id;
        $t->transaction_date = Carbon::now()->toDateTimeString();
        $t->points_earned = $pointsEarned;
        $t->points_redeemed = $points;
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

        $transaction = Transaction::findOrFail($transactionId);
        $status = 'Your order on Laralux Reservation System is complete.';

        session()->forget('cart');
        session()->put('points', 0);

        return view('frontend.receipt', compact('cart', 'total', 'transaction', 'customer', 'status', 'points'));
    }
}
