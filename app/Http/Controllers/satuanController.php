<?php

namespace App\Http\Controllers;

use App\Models\satuanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class satuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('form.satuan.satuan', ['title' => 'Satuan Barang']);
    }
    public function read()
    {
        $data_satuan = satuanModel::orderBy('satuan', 'asc')->get();
        return response()->json(['data' => $data_satuan]);
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
            'satuan_add' => 'required|unique:data_satuan,satuan'
        ], [
            'required' => 'Inputan Tidak Boleh Kosong',
            'unique' => 'Data Sudah Ada'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

        $data_store = satuanModel::create([
            'satuan' => $request->satuan_add
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
        $data_edit  = satuanModel::where($where)->first();
        return Response::json($data_edit);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'satuan_edit' => 'required|unique:data_satuan,satuan,' . $id
        ], [
            'required' => 'Inputan Tidak Boleh Kosong',
            'unique' => 'Data Sudah Ada'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $data = [
            'satuan' => $request->satuan_edit
        ];
        $data_update = satuanModel::where('id', $id)->update($data);
        return Response::json($data_update);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data_destroy = satuanModel::where('id', $id)->delete();
        return Response::json($data_destroy);
    }
}
