<?php

namespace App\Models;

use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class roleModel extends Model
{
    use HasFactory, UUIDAsPrimaryKey;
    protected $fillable = [
        'nama'
    ];
    protected $table = 'data_role';

    public function akun()
    {
        return $this->hasMany(akunModel::class, 'id_role', 'id');
    }
}
