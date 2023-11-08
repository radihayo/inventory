<?php

namespace App\Http\Controllers;

use App\Models\merekModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class merekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('form.merek.merek', ['title' => 'Merek Barang']);
    }
    public function read()
    {
        $data_merek = merekModel::orderBy('merek', 'asc')->get();
        return response()->json(['data' => $data_merek]);
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
        $validator = Validator::make($request->all(), [
            'merek_add' => 'required|unique:data_merek,merek'
        ], [
            'required' => 'Inputan Tidak Boleh Kosong',
            'unique' => 'Data Sudah Ada'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

        $data_store = merekModel::create([
            'merek' => $request->merek_add
        ]);
        return Response::json($data_store);
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
        $where = array('id' => $id);
        $data_edit  = merekModel::where($where)->first();
        return Response::json($data_edit);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'merek_edit' => 'required|unique:data_merek,merek,' . $id
        ], [
            'required' => 'Inputan Tidak Boleh Kosong',
            'unique' => 'Data Sudah Ada'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $data = [
            'merek' => $request->merek_edit
        ];
        $data_update = merekModel::where('id', $id)->update($data);
        return Response::json($data_update);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data_destroy = merekModel::where('id', $id)->delete();
        return Response::json($data_destroy);
    }
}
