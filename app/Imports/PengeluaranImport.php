<?php

namespace App\Imports;

use App\Models\pengeluaran;

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

        $myString=$row[3];
        if (date('Y-m-d', strtotime($myString)) !== $myString) {

            $unixDate = ($myString - 25569) * 86400;
              $tgl=date("Y-m-d", $unixDate);
          }else{
            // it's a date
            $tgl=$myString;
          }
        return new pengeluaran([
            'id'     => $row[0],
            'nama'    => $row[1],
            'nominal'    => $row[2],
            'tgl'    => $tgl,
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

