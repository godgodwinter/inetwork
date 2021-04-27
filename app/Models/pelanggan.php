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
        'letakserver_id',
        'koordinat_rumah'
    ];
}
