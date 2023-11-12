<?php

namespace App\Http\Controllers;

use App\Models\masukModel;
use App\Models\barangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class masukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_barang = barangModel::orderBy('nama', 'asc')->get();
        return view('transaksi_barang.barang_masuk.masuk', ['data_barang' => $data_barang, 'title' => 'Barang Masuk']);
    }
    public function read()
    {
        $data_barang_masuk = masukModel::with('barang')->orderBy('tanggal_masuk', 'desc')->get();
        return response()->json(['data' => $data_barang_masuk]);
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
            'tanggal_masuk_add' => 'required|before_or_equal:today',
            'id_barang_add' => 'required',
            'jumlah_add' => 'required',
            'keterangan_add' => 'required'
        ], [
            'required' => 'Inputan Tidak Boleh Kosong',
            'before_or_equal' => 'Tanggal Tidak Boleh Melebihi Hari Ini'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

        $data_store = masukModel::create([
            'tanggal_masuk' => $request->tanggal_masuk_add,
            'id_barang' => $request->id_barang_add,
            'jumlah' => $request->jumlah_add,
            'keterangan' => $request->keterangan_add
        ]);

        $id_stock = $request->id_barang_add;
        $data_barang = barangModel::findOrFail($id_stock);
        $update_stock = [
            'stock' => $data_barang->stock += $request->jumlah_add
        ];
        barangModel::where('id', $id_stock)->update($update_stock);

        return Response::json($data_barang);
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
        $data_edit  = masukModel::where($where)->first();
        return Response::json($data_edit);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_masuk_edit' => 'required|before_or_equal:today',
            'keterangan_edit' => 'required'
        ], [
            'required' => 'Inputan Tidak Boleh Kosong',
            'before_or_equal' => 'Tanggal Tidak Boleh Melebihi Hari Ini'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $data = [
            'tanggal_masuk' => $request->tanggal_masuk_edit,
            'keterangan' => $request->keterangan_edit
        ];
        $data_update = masukModel::where('id', $id)->update($data);
        return Response::json($data_update);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $id_stock = $request->id_jumlah_restore;
        $data_barang = barangModel::findOrFail($id_stock);

        $jumlah_restore = $request->jumlah_restore;
        $jumlah_stock = $data_barang->stock;

        if ($jumlah_restore > $jumlah_stock) {
            return response()->json(['status' => 'error']);
        } else {
            $update_stock = [
                'stock' => $jumlah_stock -= $jumlah_restore
            ];
            barangModel::where('id', $id_stock)->update($update_stock);
            $data_destroy = masukModel::where('id', $id)->delete();
        }

        return Response::json($data_destroy);
    }
}
