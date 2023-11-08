<?php

namespace App\Models;

use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class barangModel extends Model
{
    use HasFactory, UUIDAsPrimaryKey;
    protected $fillable = [
        'nama',
        'ukuran',
        'stock',
        'id_jenis',
        'id_merek',
        'id_satuan',
        'id_lokasi'
    ];
    protected $table = 'data_barang';

    public function relation_jenis()
    {
        return $this->belongsTo(jenisModel::class, 'id_jenis', 'id');
    }
    public function relation_merek()
    {
        return $this->belongsTo(merekModel::class, 'id_merek', 'id');
    }
    public function relation_satuan()
    {
        return $this->belongsTo(satuanModel::class, 'id_satuan', 'id');
    }
    public function relation_lokasi()
    {
        return $this->belongsTo(lokasiModel::class, 'id_lokasi', 'id');
    }
    public function cek_relasi_masuk()
    {
        return $this->hasMany(masukModel::class, 'id_barang', 'id');
    }
    public function cek_relasi_keluar()
    {
        return $this->hasMany(keluarModel::class, 'id_barang', 'id');
    }
}
