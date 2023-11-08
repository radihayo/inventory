<?php

namespace App\Http\Controllers;

use App\Models\jenisModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class jenisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('form.jenis.jenis', ['title' => 'Jenis Barang']);
    }
    public function read()
    {
        $data_jenis = jenisModel::orderBy('jenis', 'asc')->get();
        return response()->json(['data' => $data_jenis]);
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
            'jenis_add' => 'required|unique:data_jenis,jenis'
        ], [
            'required' => 'Inputan Tidak Boleh Kosong',
            'unique' => 'Data Sudah Ada'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

        $data_store = jenisModel::create([
            'jenis' => $request->jenis_add
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
        $data_edit  = jenisModel::where($where)->first();
        return Response::json($data_edit);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'jenis_edit' => 'required|unique:data_jenis,jenis,' . $id
        ], [
            'required' => 'Inputan Tidak Boleh Kosong',
            'unique' => 'Data Sudah Ada'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $data = [
            'jenis' => $request->jenis_edit
        ];
        $data_update = jenisModel::where('id', $id)->update($data);
        return Response::json($data_update);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data_destroy = jenisModel::where('id', $id)->delete();
        return Response::json($data_destroy);
    }
}
