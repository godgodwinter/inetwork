<?php

namespace App\Imports;

use App\Models\pendapatan;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

//IMport Paket
class PengeluaranImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new pendapatan([
            'id'     => $row[0],
            'nama'    => $row[1],
            'nominal'    => $row[2],
            'tgl'    => $row[3],
            'jenispengeluaran_id'=>$row[4],
            'created_at'    => $row[5],
            'updated_at'    => $row[6],
            'jenispengluaran_nama'=>$row[7],
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }
}

