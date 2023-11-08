<?php

namespace App\Models;

use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class jenisModel extends Model
{
    use HasFactory, UUIDAsPrimaryKey;
    protected $fillable = [
        'jenis'
    ];
    protected $table = 'data_jenis';
}
