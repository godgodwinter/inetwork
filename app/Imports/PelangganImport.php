<?php

namespace App\Imports;

use App\Models\pelanggan;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

//IMport Paket
class PelangganImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new pelanggan([
            'id'     => $row[0],
            'nik'     => $row[1],
            'nama'    => $row[2],
            'alamat'    => $row[3],
            'hp'    => $row[4],
            'tgl_gabung'    => $row[5],
            'user_ppoe'    => $row[6],
            'status_ppoe'    => $row[7],
            'paket_id'    => $row[8],
            'status_langganan'    => $row[9],
            'letakserver_id'    => $row[10],
            'koordinat_rumah'    => $row[11],
            'paket_nama'    => $row[12],
            'letakserver_nama'    => $row[13],
            'letakserver_koordinat'    => $row[14],
            'paket_harga'    => $row[15],
            'paket_kecepatan'    => $row[16],
            'created_at'    => $row[17],
            'updated_at'    => $row[18],
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }
}

