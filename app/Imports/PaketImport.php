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
        if($row[4]==null){
            $created_at=date("Y-m-d H:i:s");
        }else{
            $created_at=$row[4];
        }
        if($row[5]==null){
            $updated_at=date("Y-m-d H:i:s");
        }else{
            $updated_at=$row[5];
        }

        if(($row[1]!=null)AND($row[2]!=null)AND($row[3]!=null)){

            return new paket([
                'id'     => $row[0],
                'nama'    => $row[1],
                'harga'    => $row[2],
                'kecepatan'    => $row[3],
                'created_at'    => $created_at,
                'updated_at'    => $updated_at,
            ]);

        }else{

        }
    }
    public function startRow(): int
    {
        return 2;
    }
}

