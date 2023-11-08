<?php

namespace App\Http\Controllers;

use App\Models\lokasiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class lokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('form.lokasi.lokasi', ['title' => 'Lokasi Barang']);
    }
    public function read()
    {
        $data_lokasi = lokasiModel::orderBy('lokasi', 'asc')->get();
        return response()->json(['data' => $data_lokasi]);
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
            'lokasi_add' => 'required'
        ], [
            'required' => 'Inputan Tidak Boleh Kosong'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

        $data_store = lokasiModel::create([
            'lokasi' => $request->lokasi_add
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
        $data_edit  = lokasiModel::where($where)->first();
        return Response::json($data_edit);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'lokasi_edit' => 'required'
        ], [
            'required' => 'Inputan Tidak Boleh Kosong'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $data = [
            'lokasi' => $request->lokasi_edit
        ];
        $data_update = lokasiModel::where('id', $id)->update($data);
        return Response::json($data_update);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data_destroy = lokasiModel::where('id', $id)->delete();
        return Response::json($data_destroy);
    }
}
