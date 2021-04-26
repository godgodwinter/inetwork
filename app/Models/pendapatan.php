<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pendapatan extends Model
{
    public $table = "pendapatan";
    use HasFactory;

    protected $fillable = [
        'nama',
        'nokminal',
        'tgl',
        'jenispendapatan_id',
        'jenispendapatan_nama'
    ];
}
