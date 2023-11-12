<?php

namespace App\Http\Controllers;

use App\Models\akunModel;
use App\Models\userModel;
use Illuminate\Http\Request;
use App\Rules\Match_Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class pengaturanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_akun = akunModel::where('username', Auth::user()->username)->firstOrFail();
        $data_user = userModel::where('email', Auth::user()->username)->firstOrFail();
        return view('pengaturan.pengaturan', ['data_akun' => $data_akun, 'data_user' => $data_user, 'title' => 'Pengaturan']);
    }
    public function read()
    {
        $data_user = userModel::where('email', Auth::user()->username)->firstOrFail();
        return view('pengaturan.tampil_data', ['data_user' => $data_user]);
    }
    public function reload()
    {
        return view("pengaturan.profil");
    }
    public function reload_sidebar()
    {
        return view("pengaturan.profil_sidebar");
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function upload(Request $request)
    {
        $data_user = userModel::where('email', Auth::user()->username)->firstOrFail();
        $imageName = Auth::user()->data_akun->nama . '-' . uniqid() . '.jpg';
        if (Auth::user()->data_akun->foto == null) {
            $folderPath = public_path('storage/foto/');
            $image_parts = explode(";base64,", $request->image);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $imageFullPath = $folderPath . $imageName;
            file_put_contents($imageFullPath, $image_base64);

            $data = [
                'foto'     => $imageName
            ];
            $data_update = userModel::where('id', $data_user->id)->update($data);
        } else {
            if (Storage::disk('public')->exists('foto/' . $data_user->foto)) {
                Storage::delete('foto/' . $data_user->foto);
                $folderPath = public_path('storage/foto/');
                $image_parts = explode(";base64,", $request->image);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                $imageFullPath = $folderPath . $imageName;
                file_put_contents($imageFullPath, $image_base64);

                $data = [
                    'foto'     => $imageName
                ];
                $data_update = userModel::where('id', $data_user->id)->update($data);
            }
        }

        return Response::json($data_update);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data_akun = akunModel::where('username', Auth::user()->username)->firstOrFail();
        $validator = Validator::make($request->all(), [
            'old_password' => ['required', new Match_Password],
            'new_password'   => 'required|min:8|same:re_new_password',
            're_new_password'   => 'required|min:8|same:new_password'
        ], [
            'required' => 'Inputan Tidak Boleh Kosong',
            'same' => 'Password Baru Dengan Ketik Ulang Password Baru Harus Sama',
            'min' => 'Panjang Password Minimal 8 Karakter'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }
        $data = [
            'password'     => Hash::make($request->new_password)
        ];
        $data_update = akunModel::where('id', $data_akun->id)->update($data);
        return Response::json($data_update);
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
            'nama_update' => 'required|unique:data_user,nama,' . $id,
            'email_update' => 'required|email:rfc,dns|unique:data_user,email,' . $id,
            'jenis_kelamin_update' => 'required',
            'tempat_lahir_update' => 'required',
            'tanggal_lahir_update' => 'required',
            'agama_update' => 'required',
            'no_telp_update' => 'required|size:12',
            'alamat_update' => 'required'
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
            'nama' => $request->nama_update,
            'email' => $request->email_update,
            'jenis_kelamin' => $request->jenis_kelamin_update,
            'tempat_lahir' => $request->tempat_lahir_update,
            'tanggal_lahir' => $request->tanggal_lahir_update,
            'agama' => $request->agama_update,
            'no_telp' => $request->no_telp_update,
            'alamat' => $request->alamat_update
        ];
        $data_update = userModel::where('id', $id)->update($data);

        $data_akun = akunModel::where('username', Auth::user()->username)->firstOrFail();
        $update_akun = [
            'username' => $request->email_update
        ];
        akunModel::where('id', $data_akun->id)->update($update_akun);
        return Response::json($data_update);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
