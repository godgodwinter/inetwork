<?php

namespace App\Imports;

use App\Models\pelanggan;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\DB;

//IMport Paket
class PelangganImportgetinet implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $namapaket=$row[7];
        //cek apakah datapaket ada
        $cekambilpaket = DB::table('paket')->where('nama',$namapaket)->count();
        // dd($cekambilpaket);
        if($cekambilpaket>0){
            $ambilpaket = DB::table('paket')->where('nama',$namapaket)->get();
            foreach($ambilpaket as $ambil){
                $id=$ambil->id;
                $paket_harga=$ambil->harga;
                $paket_kecepatan=$ambil->kecepatan;
            }
        }else{
            $id=$row[6];
            $paket_harga=$row[8];
            $paket_kecepatan=$row[9];
        }

        return new pelanggan([
            'id'     => $row[0],
            'nik'     => $row[1],
            'nama'    => $row[2],
            'panggilan'    => $row[3],
            'alamat'    => $row[4],
            'hp'    => $row[5],
            'paket_id'    => $id,
            'paket_nama'    => $row[7],
            'paket_harga'    => $paket_harga,
            'paket_kecepatan'    => $paket_kecepatan,
            'tgl_gabung'    => $row[10],
            'status_langganan'    => $row[11],
            'letakserver_id'    => $row[12],
            'letakserver_nama'    => $row[13],
            'letakserver_koordinat'    => $row[14],
            'kordinat_rumah'    => $row[15],
            'created_at'    => $row[16],
            'updated_at'    => $row[17],
            'user_ppoe'    => $row[18],
            'status_ppoe'    => $row[19],
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }
}

