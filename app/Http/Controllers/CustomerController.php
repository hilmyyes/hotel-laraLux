<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = User::where('role', 'guest')->orderBy('name')->get();

        return view('customer.index', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'address' => 'required'
        // ]);

        // // Type::create($request->all());

        // $data = new User();
        // $data->name = $request->get('name');
        // $data->address = $request->get('address');
        // $data->save();

        // return redirect('customer')->with('status', 'Berhasil Tambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $customer)
    {
        $data = $customer;
        return view('customer.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $customer)
    {
        $updatedData = $customer;
        $updatedData->name = $request->name;
        $updatedData->address = $request->address;
        $updatedData->save();
        return redirect()->route('customer.index')->with('status', 'Horray ! Your data is successfully updated !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $customer)
    {
        try {
            $deletedData = $customer;
            //dd($deletedData);
            $deletedData->delete();
            return redirect()->route('customer.index')->with('status', 'Horray ! Your data is successfully deleted !');
        } catch (\PDOException $ex) {

            $msg = "Failed to delete data ! Make sure there is no related data before deleting it";
            return redirect()->route('customer.index')->with('status', $msg);
        }
    }

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = User::find($id);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('customer.getEditForm', compact('data'))->render()
        ), 200);
    }

    public function deleteData(Request $request)
    {
        $id = $request->id;
        $data = User::find($id);
        $data->delete();
        return response()->json(array(
            'status' => 'oke',
            'msg' => 'type data is removed !'
        ), 200);
    }
}
