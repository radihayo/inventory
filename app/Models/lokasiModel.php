<?php

namespace App\Models;

use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class lokasiModel extends Model
{
    use HasFactory, UUIDAsPrimaryKey;
    protected $fillable = [
        'lokasi'
    ];
    protected $table = 'data_lokasi';
}
