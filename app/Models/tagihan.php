<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tagihan extends Model
{
    public $table = "tagihan";
    use HasFactory;

    protected $fillable = [
        'nik',
        'paket_id',
        'total_bayar',
        'nama',
        'paket_nama',
        'paket_harga',
        'paket_kecepatan'
    ];
}
