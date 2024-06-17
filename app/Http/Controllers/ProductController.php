<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$products = Product::all();
        $hotels = Hotel::orderBy('name')->get();
        // var_dump($products);exit;
        // dd($products);
        //return view('product.index', [
        //    'products' => $products,
        //    'hotels' => $hotels
        //]);


        $rs = Product::all();
        foreach ($rs as $r) {
            $directory = public_path('product/' . $r->id);
            if (File::exists($directory)) {
                $files = File::files($directory);
                $filenames = [];
                foreach ($files as $file) {
                    $filenames[] = $file->getFilename();
                }
                $r['filenames'] = $filenames;
            }
        }
        return view('product.index', compact('rs', 'hotels'));
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
    public function edit(Product $product)
    {
        //dd($product);
        // Ambil nama hotel dari id hotel_id yang ada di tabel product
        $hotel = Hotel::find($product->hotel_id);

        // Ambil semua data hotels untuk dropdown atau keperluan lainnya
        $datas = Hotel::orderBy('name')->get();

        // Ambil data produk yang sedang diedit
        $data = $product;

        // Mengembalikan view dengan data yang dibutuhkan
        return view('product.edit', compact('data', 'datas', 'hotel'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $updatedData = $product;
        $updatedData->name = $request->name;
        $updatedData->price = $request->price;
        $updatedData->image = $request->image;
        $updatedData->description = $request->desc;
        $updatedData->available_room = $request->room;
        $updatedData->hotel_id = $request->hotel;
        $updatedData->save();
        return redirect()->route('product.index')->with('status', 'Horray ! Your data is successfully updated !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $deletedData = $product;
            //dd($deletedData);
            $deletedData->delete();
            return redirect()->route('product.index')->with('status', 'Horray ! Your data is successfully deleted !');
        } catch (\PDOException $ex) {

            $msg = "Failed to delete data ! Make sure there is no related data before deleting it";
            return redirect()->route('product.index')->with('status', $msg);
        }
    }

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = Product::find($id);
        $hotel = Hotel::find($data->hotel_id);
        $hotels = Hotel::orderBy('name')->get();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('product.getEditForm', compact('data', 'hotel', 'hotels'))->render()
        ), 200);
    }

    public function deleteData(Request $request)
    {
        $id = $request->id;
        $data = Product::find($id);
        $data->delete();
        return response()->json(array(
            'status' => 'oke',
            'msg' => 'type data is removed !'
        ), 200);
    }
    public function uploadPhoto(Request $request)
    {
        $product_id = $request->product_id;
        $product = Product::find($product_id);
        return view('product.formUploadPhoto', compact('product'));
    }


    public function simpanPhoto(Request $request)
    {
        $file = $request->file("file_photo");
        $folder = 'products/' . $request->product_id;
        @File::makeDirectory(public_path() . "/" . $folder);
        $filename = time() . "_" . $file->getClientOriginalName();
        $file->move($folder, $filename);
        return redirect()->route('product.index')->with('status', 'photo terupload');
    }
}
