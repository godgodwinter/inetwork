<?php

namespace App\Imports;

use App\Models\letakserver;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

//IMport Paket
class LetakserverImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new letakserver([
            'id'     => $row[0],
            'nama'    => $row[1],
            'penanggungjawab'    => $row[2],
            'koordinat'    => $row[3],
            'created_at'    => $row[4],
            'updated_at'    => $row[5],
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }
}

