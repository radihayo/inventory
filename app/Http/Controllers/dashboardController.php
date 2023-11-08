<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\barangModel;
use App\Models\keluarModel;
use App\Models\masukModel;
use App\Models\userModel;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index()
    {
        $barang_masuk = masukModel::whereDate('created_at', Carbon::today())->count();
        $barang_keluar = keluarModel::whereDate('created_at', Carbon::today())->count();
        $barang = barangModel::count();
        $user = userModel::with('data_akun.role_akun')
            ->join('data_akun', 'data_akun.id_user', '=', 'data_user.id')
            ->join('data_role', 'data_role.id', '=', 'data_akun.id_role')
            ->where('role', '=', 'user')
            ->select('data_user.*')
            ->count();

        $barang_masuk_bulan = array();
        $barang_keluar_bulan = array();
        for ($i = 0; $i <= 5; $i++) {
            $get_data_bulan_masuk = masukModel::whereMonth('tanggal_masuk', Carbon::now()->startOfMonth()->subMonth($i))->count();
            $get_data_bulan_keluar = keluarModel::whereMonth('tanggal_keluar', Carbon::now()->startOfMonth()->subMonth($i))->count();
            array_push($barang_masuk_bulan, $get_data_bulan_masuk);
            array_push($barang_keluar_bulan, $get_data_bulan_keluar);
        }

        $bulan_ini_masuk = masukModel::whereMonth('tanggal_masuk', Carbon::now()->startOfMonth()->subMonth(0))->count();
        $bulan_kemarin_masuk = masukModel::whereMonth('tanggal_masuk', Carbon::now()->startOfMonth()->subMonth(1))->count();
        if ($bulan_ini_masuk == null && $bulan_kemarin_masuk == null) {
            $transaksi_masuk = 0;
        } else {
            $transaksi_masuk = (($bulan_ini_masuk - $bulan_kemarin_masuk) / $bulan_ini_masuk) * 100;
        }


        $bulan_ini_keluar = keluarModel::whereMonth('tanggal_keluar', Carbon::now()->startOfMonth()->subMonth(0))->count();
        $bulan_kemarin_keluar = keluarModel::whereMonth('tanggal_keluar', Carbon::now()->startOfMonth()->subMonth(1))->count();
        if ($bulan_ini_keluar == null && $bulan_kemarin_keluar == null) {
            $transaksi_keluar = 0;
        } else {
            $transaksi_keluar = (($bulan_ini_keluar - $bulan_kemarin_keluar) / $bulan_ini_keluar) * 100;
        }


        $barang_baru = barangModel::orderBy('created_at', 'desc')->take(5)->get();
        return view('dashboard.dashboard', [
            'barang_masuk_bulan' => implode(array_reverse($barang_masuk_bulan)),
            'barang_keluar_bulan' => implode(array_reverse($barang_keluar_bulan)),
            'high_data_masuk' => max($barang_masuk_bulan),
            'high_data_keluar' => max($barang_keluar_bulan),
            'total_data_masuk' => array_sum($barang_masuk_bulan),
            'total_data_keluar' => array_sum($barang_keluar_bulan),
            'transaksi_masuk' => $transaksi_masuk,
            'transaksi_keluar' => $transaksi_keluar,
            'barang_masuk' => $barang_masuk,
            'barang_keluar' => $barang_keluar,
            'barang' => $barang,
            'barang_baru' => $barang_baru,
            'user' => $user,
            'title' => 'Dashboard'
        ]);
    }
}
