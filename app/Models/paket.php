<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paket extends Model
{
    public $table = "paket";
    use HasFactory;

    protected $fillable = [
        'nama',
        'harga',
        'kecepatan'
    ];
}
