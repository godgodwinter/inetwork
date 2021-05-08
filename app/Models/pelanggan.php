<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelanggan extends Model
{
    public $table = "pelanggan";
    use HasFactory;

    protected $fillable = [
        'nik',
        'nama',
        'alamat',
        'hp',
        'tgl_gabung',
        'user_ppoe',
        'pass_ppoe',
        'status_ppoe',
        'paket_id',
        'status_langgan',
        'letakserver_id',
        'koordinat_rumah',
        'created_at',
        'updated_at',
        'paket_nama',
        'letakserver_nama',
        'letakserver_koordinat',
        'paket_harga',
        'paket_kecepatan'
    ];
}
