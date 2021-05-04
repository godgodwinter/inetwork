<?php

namespace App\Imports;

use App\Models\paket;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

//IMport Paket
class PaketImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new paket([
            'id'     => $row[0],
            'nama'    => $row[1],
            'harga'    => $row[2],
            'kecepatan'    => $row[3],
            'created_at'    => $row[4],
            'updated_at'    => $row[5],
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }
}

