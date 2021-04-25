<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenisalat extends Model
{
    public $table = "jenisalat";
    use HasFactory;

    protected $fillable = [
        'nama'
    ];
}
