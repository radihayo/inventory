<?php

namespace App\Http\Controllers;

use App\Models\jenisModel;
use App\Models\merekModel;
use App\Models\barangModel;
use App\Models\lokasiModel;
use App\Models\satuanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class barangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_jenis = jenisModel::get();
        $data_merek = merekModel::get();
        $data_satuan = satuanModel::get();
        $data_lokasi = lokasiModel::get();
        $data_barang = barangModel::orderBy('nama', 'asc')->get();
        return view(
            'stock_barang.barang',
            [
                'data' => $data_barang,
                'data_jenis' => $data_jenis,
                'data_merek' => $data_merek,
                'data_satuan' => $data_satuan,
                'data_lokasi' => $data_lokasi,
                'title' => 'Stock Barang'
            ]
        );
    }
    public function read()
    {
        $data_barang = barangModel::with('relation_jenis', 'relation_merek', 'relation_satuan', 'relation_lokasi')->orderBy('nama', 'asc')->get();
        return response()->json(['data' => $data_barang]);
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
            'nama_add' => 'required',
            'ukuran_add' => 'required',
            'stock_add' => 'required',
            'id_jenis_add' => 'required',
            'id_merek_add' => 'required',
            'id_satuan_add' => 'required',
            'id_lokasi_add' => 'required'
        ], [
            'required' => 'Inputan Tidak Boleh Kosong'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

        $data_store = barangModel::create([
            'nama' => $request->nama_add,
            'ukuran' => $request->ukuran_add,
            'stock' => $request->stock_add,
            'id_jenis' => $request->id_jenis_add,
            'id_merek' => $request->id_merek_add,
            'id_satuan' => $request->id_satuan_add,
            'id_lokasi' => $request->id_lokasi_add
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
        $data_edit  = barangModel::where($where)->first();
        return Response::json($data_edit);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_edit' => 'required',
            'ukuran_edit' => 'required',
            'stock_edit' => 'required',
            'id_jenis_edit' => 'required',
            'id_merek_edit' => 'required',
            'id_satuan_edit' => 'required',
            'id_lokasi_edit' => 'required'
        ], [
            'required' => 'Inputan Tidak Boleh Kosong'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $data = [
            'nama' => $request->nama_edit,
            'ukuran' => $request->ukuran_edit,
            'stock' => $request->stock_edit,
            'id_jenis' => $request->id_jenis_edit,
            'id_merek' => $request->id_merek_edit,
            'id_satuan' => $request->id_satuan_edit,
            'id_lokasi' => $request->id_lokasi_edit
        ];
        $data_update = barangModel::where('id', $id)->update($data);
        return Response::json($data_update);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (
            barangModel::with('cek_relasi_masuk')
            ->join('data_barang_masuk', 'data_barang_masuk.id_barang', '=', 'data_barang.id')
            ->where('id_barang', '=', $id)
            ->exists() ||
            barangModel::with('cek_relasi_keluar')
            ->join('data_barang_keluar', 'data_barang_keluar.id_barang', '=', 'data_barang.id')
            ->where('id_barang', '=', $id)
            ->exists()
        ) {
            return response()->json(['status' => 'error']);
        }
        $data_destroy = barangModel::where('id', $id)->delete();
        return Response::json($data_destroy);
    }
}
