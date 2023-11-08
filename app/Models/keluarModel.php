<?php

namespace App\Models;

use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class keluarModel extends Model
{
    use HasFactory, UUIDAsPrimaryKey;

    protected $fillable = [
        'tanggal_keluar',
        'jumlah',
        'keterangan',
        'id_barang'
    ];
    protected $table = 'data_barang_keluar';

    public function barang()
    {
        return $this->belongsTo(barangModel::class, 'id_barang', 'id');
    }
}
