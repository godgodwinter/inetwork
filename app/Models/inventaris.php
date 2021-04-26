<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventaris extends Model
{
    public $table = "inventaris";
    use HasFactory;

    protected $fillable = [
        'nama',
        'harga',
        'letak',
        'jenisalat_id'
    ];
}
