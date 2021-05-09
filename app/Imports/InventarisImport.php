<?php

namespace App\Imports;

use App\Models\inventaris;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

//IMport Paket
class InventarisImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new inventaris([
            'id'     => $row[0],
            'nama'    => $row[1],
            'harga'    => $row[2],
            'letak'    => $row[3],
            'jenisalat_id'=>$row[4],
            'created_at'    => $row[5],
            'updated_at'    => $row[6],
            'jenisalat_nama'=>$row[7],
            'tgl'=>$row[8],
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }
}

