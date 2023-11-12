<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\barangModel;
use App\Models\keluarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class keluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_barang = barangModel::orderBy('nama', 'asc')->get();
        return view('transaksi_barang.barang_keluar.keluar', ['data_barang' => $data_barang, 'title' => 'Barang Keluar']);
    }
    public function read()
    {
        $data_barang_keluar = keluarModel::with('barang')->orderBy('tanggal_keluar', 'desc')->get();
        return response()->json(['data' => $data_barang_keluar]);
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
        $id_stock = $request->id_barang_add;
        if ($id_stock == null) {
            $validator = Validator::make($request->all(), [
                'tanggal_keluar_add' => 'required|before_or_equal:today',
                'id_barang_add' => 'required',
                'jumlah_add' => 'required',
                'keterangan_add' => 'required'
            ], [
                'required' => 'Inputan Tidak Boleh Kosong',
                'before_or_equal' => 'Tanggal Tidak Boleh Melebihi Hari Ini'
            ]);
        } else {
            $data_barang = barangModel::findOrFail($id_stock);
            $jumlah_stock = $data_barang->stock;
            $validator = Validator::make($request->all(), [
                'tanggal_keluar_add' => 'required|before_or_equal:today',
                'id_barang_add' => 'required',
                'jumlah_add' => 'required|lte:' . $jumlah_stock,
                'keterangan_add' => 'required'
            ], [
                'required' => 'Inputan Tidak Boleh Kosong',
                'before_or_equal' => 'Tanggal Tidak Boleh Melebihi Hari Ini',
                'lte' => 'Jumlah Tidak Boleh Melebihi Stock Saat Ini Yaitu = ' . $jumlah_stock
            ]);
        }

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

        $data_store = keluarModel::create([
            'tanggal_keluar' => $request->tanggal_keluar_add,
            'id_barang' => $request->id_barang_add,
            'jumlah' => $request->jumlah_add,
            'keterangan' => $request->keterangan_add
        ]);

        $update_stock = [
            'stock' => $data_barang->stock -= $request->jumlah_add
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
        $data_edit  = keluarModel::where($where)->first();
        return Response::json($data_edit);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_keluar_edit' => 'required|before_or_equal:today',
            'keterangan_edit' => 'required'
        ], [
            'required' => 'Inputan Tidak Boleh Kosong',
            'before_or_equal' => 'Tanggal Tidak Boleh Melebihi Hari Ini'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $data = [
            'tanggal_keluar' => $request->tanggal_keluar_edit,
            'keterangan' => $request->keterangan_edit
        ];
        $data_update = keluarModel::where('id', $id)->update($data);
        return Response::json($data_update);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $id_stock = $request->id_jumlah_restore;
        $data_barang = barangModel::findOrFail($id_stock);
        $update_stock = [
            'stock' => $data_barang->stock += $request->jumlah_restore
        ];
        barangModel::where('id', $id_stock)->update($update_stock);
        $data_destroy = keluarModel::where('id', $id)->delete();
        return Response::json($data_destroy);
    }
}
