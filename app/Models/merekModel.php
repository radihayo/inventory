<?php

namespace App\Models;

use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class merekModel extends Model
{
    use HasFactory, UUIDAsPrimaryKey;
    protected $fillable = [
        'merek'
    ];
    protected $table = 'data_merek';
}
