<?php

namespace App\Models;

use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class userModel extends Model
{
    use HasFactory, UUIDAsPrimaryKey;
    protected $fillable = [
        'id',
        'nama',
        'email',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'no_telp',
        'alamat'
    ];
    protected $table = 'data_user';
    public $incrementing = false;

    public function data_akun()
    {
        return $this->hasOne(akunModel::class, 'id_user', 'id');
    }
}
