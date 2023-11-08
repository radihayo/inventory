<?php

namespace App\Models;

use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class akunModel extends Model
{
    use HasFactory, UUIDAsPrimaryKey;
    protected $fillable = [
        'username',
        'password',
        'id_role',
        'id_user'
    ];
    protected $table = 'data_akun';

    public function role_akun()
    {
        return $this->belongsTo(roleModel::class, 'id_role', 'id');
    }
}
