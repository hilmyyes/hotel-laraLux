<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //    $hotel= DB::table('users')->get(); //ini queri bulder 
        //$hotels = Hotel::all();         //ini pake model dimana model nya di create dulu pake php artisan make:model hotel
        //return view("hotel.index", ['hotels' => $hotels]);

        // $products = Hotel::join('products as p', 'hotels.id', '=', 'p.hotel_id')
        //     ->orderBy('hotels.name')
        //     ->select('p.name as product')
        //     ->get();


        $hotels = Hotel::orderBy('hotels.name')
            ->join('types as t', 'hotels.type_id', '=', 't.id')
            ->select('hotels.*', 't.name as type')
            ->get();

        //dd($products, $hotels);

        return view('hotel.index', compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::orderBy('name')->get();
        return view("hotel.create", compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);

        $request->validate([
            'name' => 'required',
            'city' => 'required',
            'type' => 'required',
        ]);

        $data = new Hotel();
        $data->name = $request->get('name');
        $data->address = $request->get('address');
        $data->city = $request->get('city');
        $data->image = $request->get('image');
        $data->type_id = $request->get('type');
        $data->save();

        return redirect('hotel')->with('status', 'Berhasil Tambah');
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


    public function availableHotelRoom()
    {
        $data = Hotel::join('products as p', 'hotels.id', '=', 'p.hotel_id')
            ->select('hotels.id', 'hotels.name', DB::raw('sum(p.available_room) as room'))
            ->groupBy('hotels.id', 'hotels.name')
            ->get();

        //dd($data);

        return view('hotel.availableRoom', compact('data'));
    }

    public function avgPriceByHotelType()
    {
        $data = Hotel::join('products as p', 'hotels.id', '=', 'p.hotel_id')
            ->join('types as t', 'hotels.type_id', '=', 't.id')
            ->select('t.name as type', 'hotels.name as hotel', DB::raw('avg(p.price) as avg_price'))
            ->groupBy('hotels.id', 'hotels.name')
            ->get();

        //dd($data);

        return view('hotel.avgPrice', compact('data'));
    }

    public function showInfo()
    {

        // // masih harus di benerin lagi 
        // $data = Hotel::join('products as p', 'hotels.id', '=', 'p.hotel_id')
        //     ->select('hotels.name as hotel', 'max(p.price) as max')
        //     ->groupBy('hotels.id', 'hotels.name')
        //     ->get();

        $data = Hotel::join('products as p', 'hotels.id', "=", 'p.hotel_id')
            ->orderBy('p.price', 'DESC')
            ->select('hotels.name', 'p.name as product', 'p.price')->first();

        return response()->json(array(
            'status' => 'oke',
            'msg' => "<div class='alert alert-info'>
                        Did you know? <br>
                        The most expensive Hotel is " . $data->name . "<br> 
                        and the product is " . $data->product . " Rp." . $data->price .
                "</div>"
        ), 200);
    }

    public function showProducts()
    {
        $hotel = Hotel::find($_POST['hotel_id']);
        $nama = $hotel->name;
        $data = $hotel->products;
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('hotel.showProducts', compact('nama', 'data'))->render()
        ), 200);
    }
}
