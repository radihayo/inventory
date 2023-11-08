<?php

namespace App\Models;

use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class satuanModel extends Model
{
    use HasFactory, UUIDAsPrimaryKey;
    protected $fillable = [
        'satuan'
    ];
    protected $table = 'data_satuan';
}
