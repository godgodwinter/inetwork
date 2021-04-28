<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenispengeluaran extends Model
{
    public $table = "jenispengeluaran";
    use HasFactory;

    protected $fillable = [
        'nama'
    ];
}
