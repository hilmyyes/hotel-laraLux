<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\type;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Type::orderBy('name')->get();
        //$data = Type::all();
        return view('type.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('type.create');
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

        $data = new Type();
        $data->name = $request->get('name');
        $data->description = $request->get('desc');
        $data->save();

        return redirect('type')->with('status', 'Berhasil Tambah');
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
    public function edit(Type $type)
    {
        //dd($type);
        $data = $type;
        return view('type.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        $updatedData = $type;
        $updatedData->name = $request->name;
        $updatedData->description = $request->desc;
        $updatedData->save();
        return redirect()->route('type.index')->with('status', 'Horray ! Your data is successfully updated !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $user = Auth::user();
        $this->authorize('delete-permission', $user);

        try {
            $deletedData = $type;
            //dd($deletedData);
            $deletedData->delete();
            return redirect()->route('type.index')->with('status', 'Horray ! Your data is successfully deleted !');
        } catch (\PDOException $ex) {

            $msg = "Failed to delete data ! Make sure there is no related data before deleting it";
            return redirect()->route('type.index')->with('status', $msg);
        }
    }

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = Type::find($id);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('type.getEditForm', compact('data'))->render()
        ), 200);
    }

    public function getEditFormB(Request $request)
    {
        $id = $request->id;
        $data = Type::find($id);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('type.getEditFormB', compact('data'))->render()
        ), 200);
    }

    public function saveDataTD(Request $request)
    {
        $id = $request->id;
        $data = Type::find($id);
        $data->name = $request->name;
        $data->description = $request->description;
        $data->save();
        return response()->json(array(
            'status' => 'oke',
            'msg' => 'type data is up-to-date !'
        ), 200);
    }

    public function deleteData(Request $request)
    {
        $id = $request->id;
        $data = Type::find($id);
        $data->delete();
        return response()->json(array(
            'status' => 'oke',
            'msg' => 'type data is removed !'
        ), 200);
    }
}
