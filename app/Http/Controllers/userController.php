<?php

namespace App\Http\Controllers;

use App\Models\akunModel;
use App\Models\roleModel;
use App\Models\userModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('data_user.user', ['title' => 'Data User']);
    }
    public function read()
    {
        $data_user = userModel::with('data_akun.role_akun')
            ->join('data_akun', 'data_akun.id_user', '=', 'data_user.id')
            ->join('data_role', 'data_role.id', '=', 'data_akun.id_role')
            ->where('role', '=', 'user')
            ->select('data_user.*')
            ->orderBy('nama', 'asc')
            ->get();
        return response()->json(['data' => $data_user]);
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
            'nama_add' => 'required|unique:data_user,nama',
            'email_add' => 'required|email:rfc,dns|unique:data_user,email',
            'jenis_kelamin_add' => 'required',
            'tempat_lahir_add' => 'required',
            'tanggal_lahir_add' => 'required',
            'agama_add' => 'required',
            'no_telp_add' => 'required|size:12',
            'alamat_add' => 'required'
        ], [
            'required' => 'Inputan Tidak Boleh Kosong',
            'unique' => 'Data Sudah Ada',
            'size' => 'Panjang Data Harus 12 Angka',
            'email' => 'Harus Format Email'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $uuid = Str::uuid();
        $data_store = userModel::create([
            'id' => $uuid,
            'nama' => $request->nama_add,
            'email' => $request->email_add,
            'jenis_kelamin' => $request->jenis_kelamin_add,
            'tempat_lahir' => $request->tempat_lahir_add,
            'tanggal_lahir' => $request->tanggal_lahir_add,
            'agama' => $request->agama_add,
            'no_telp' => $request->no_telp_add,
            'alamat' => $request->alamat_add
        ]);

        $data_role = roleModel::where('role', 'user')->firstOrFail();
        akunModel::create([
            'username' => $request->email_add,
            'password' => Hash::make($request->no_telp_add),
            'id_role' => $data_role->id,
            'id_user' => $uuid
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
        $data_edit  = userModel::where($where)->first();
        return Response::json($data_edit);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_edit' => 'required|unique:data_user,nama,' . $id,
            'email_edit' => 'required|email:rfc,dns|unique:data_user,email,' . $id,
            'jenis_kelamin_edit' => 'required',
            'tempat_lahir_edit' => 'required',
            'tanggal_lahir_edit' => 'required',
            'agama_edit' => 'required',
            'no_telp_edit' => 'required|size:12',
            'alamat_edit' => 'required'
        ], [
            'required' => 'Inputan Tidak Boleh Kosong',
            'unique' => 'Data Sudah Ada',
            'size' => 'Panjang Data Harus 12 Angka',
            'email' => 'Harus Format Email'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $data = [
            'nama' => $request->nama_edit,
            'email' => $request->email_edit,
            'jenis_kelamin' => $request->jenis_kelamin_edit,
            'tempat_lahir' => $request->tempat_lahir_edit,
            'tanggal_lahir' => $request->tanggal_lahir_edit,
            'agama' => $request->agama_edit,
            'no_telp' => $request->no_telp_edit,
            'alamat' => $request->alamat_edit
        ];
        $data_update = userModel::where('id', $id)->update($data);
        return Response::json($data_update);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $email = $request->email;
        $data_role = akunModel::where('username', $email)->firstOrFail();
        akunModel::where('id', $data_role->id)->delete();

        $data_destroy = userModel::where('id', $id)->delete();
        return Response::json($data_destroy);
    }
}
