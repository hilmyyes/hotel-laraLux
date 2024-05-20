<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        // var_dump($products);exit;
        // dd($products);
        return view('product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $datas = Hotel::orderBy('name')->get();
        return view("product.create", compact('datas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'hotel' => 'required',
        ]);

        $data = new Product();
        $data->name = $request->get('name');
        $data->price = $request->get('price');
        $data->image = $request->get('image');
        $data->description = $request->get('desc');
        $data->available_room = $request->get('room');
        $data->hotel_id = $request->get('hotel');
        $data->save();

        return redirect('product')->with('status', 'Berhasil Tambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Product::find($id);
        //dd($data); ini untuk nampilin data nya
        return view("product.show", compact('data'));
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
