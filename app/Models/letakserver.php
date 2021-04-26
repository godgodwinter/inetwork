<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class letakserver extends Model
{
    public $table = "letakserver";
    use HasFactory;

    protected $fillable = [
        'nama',
        'penanggungjawab',
        'koordinat'
    ];
}
