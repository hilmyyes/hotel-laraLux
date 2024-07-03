<?php

namespace App\Http\Controllers;

use App\Models\Facilities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacilitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Facilities::orderBy('name')->get();
        //$data = Type::all();
        return view('facilities.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('facilities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        // Type::create($request->all());

        $data = new Facilities();
        $data->name = $request->get('name');
        $data->description = $request->get('desc');
        $data->save();

        return redirect('facilities')->with('status', 'Berhasil Tambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Facilities $facilities)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Facilities $facilities)
    {
        $data = $facilities;
        return view('facilities.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Facilities $facilities)
    {
        $updatedData = $facilities;
        $updatedData->name = $request->name;
        $updatedData->description = $request->desc;
        $updatedData->save();
        return redirect()->route('facilities.index')->with('status', 'Horray ! Your data is successfully updated !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facilities $facilities)
    {

        try {
            $deletedData = $facilities;
            //dd($deletedData);
            $deletedData->delete();
            return redirect()->route('facilities.index')->with('status', 'Horray ! Your data is successfully deleted !');
        } catch (\PDOException $ex) {

            $msg = "Failed to delete data ! Make sure there is no related data before deleting it";
            return redirect()->route('facilities.index')->with('status', $msg);
        }
    }

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = Facilities::find($id);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('facilities.getEditForm', compact('data'))->render()
        ), 200);
    }
}
