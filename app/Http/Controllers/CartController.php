<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::id();
        $carts = Cart::where('user_id', $user_id)->get();
        return view('cart.index', compact('carts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'user_id' => 'required',
                'product_id' => 'required',
                'CheckIn' => 'required',
                'Duration' => 'required',
                'SubTotal' => 'required|numeric|min:0',
            ]);

            $data = new Cart();
            $data->user_id = $validatedData['user_id'];
            $data->product_id = $validatedData['product_id'];
            $data->checkin_date = $validatedData['CheckIn'];
            $data->duration = $validatedData['Duration'];
            $data->subtotal = $validatedData['SubTotal'];
            $data->save();

            return redirect("/product/{$data->product_id}")->with('status', 'Berhasil Tambah');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Error storing cart item: ' . $e->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
            'CheckIn' => 'required',
            'Duration' => 'required',
            'SubTotal' => 'required|numeric|min:0',
        ]);

        $updatedData = $cart;
        $updatedData->user_id = $validatedData['user_id'];
        $updatedData->product_id = $validatedData['product_id'];
        $updatedData->checkin_date = $validatedData['CheckIn'];
        $updatedData->duration = $validatedData['Duration'];
        $updatedData->subtotal = $validatedData['SubTotal'];
        $updatedData->save();
        return redirect()->route('cart.index')->with('status', 'Horray ! Your data is successfully updated !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getAddForm(Request $request)
    {
        $id = $request->id;
        $data = Product::find($id);
        return response()->json(
            array(
                'status' => 'oke',
                'msg' => view('cart.getAddForm', compact('data'))->render()
            ),
            200
        );
    }

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = Cart::find($id);
        return response()->json(
            array(
                'status' => 'oke',
                'msg' => view('cart.getEditForm', compact('data'))->render()
            ), 200);
    }

    public function saveDataTD(Request $request)
    {
        $id = $request->id;
        $data = Cart::find($id);

        $validatedData = $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
            'CheckIn' => 'required',
            'Duration' => 'required',
            'SubTotal' => 'required|numeric|min:0',
        ]);

        $data->user_id = $validatedData['user_id'];
        $data->product_id = $validatedData['product_id'];
        $data->checkin_date = $validatedData['CheckIn'];
        $data->duration = $validatedData['Duration'];
        $data->subtotal = $validatedData['SubTotal'];

        $data->save();
        return response()->json(
            array(
                'status' => 'oke',
                'msg' => 'type data is up-to-date !'
            ), 200);
    }

    public function deleteData(Request $request)
    {
        $id = $request->id;
        $data = Cart::find($id);
        $data->delete();
        return response()->json(
            array(
                'status' => 'oke',
                'msg' => 'type data is removed !'
            ), 200);
    }
}
