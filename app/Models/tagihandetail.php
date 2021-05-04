<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tagihandetail extends Model
{
    public $table = "tagihandetail";
    use HasFactory;

    protected $fillable = [
        'tagihan_id',
        'bayar',
        'nik',
        'nama',
        'paket_id',
        'paket_harga',
        'paket_kecepatan',
        'thbln'
    ];
}
