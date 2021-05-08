<?php

namespace App\Imports;

use App\Models\tagihan;
use App\Models\tagihandetail;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\DB;

//IMport Paket
class PembayaranImportwhereniknama implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //ubah format tanggal dari excel ke biasa
        $myString=$row[3];
        if (date('Y-m-d', strtotime($myString)) !== $myString) {

            $unixDate = ($myString - 25569) * 86400;
              $tgl=date("Y-m-d", $unixDate);
          }else{
            // it's a date
            $tgl=$myString;
          }

        //   dd($tgl);
        //ambil data harga
        $harga=$row[7];
        //cek apakah datapaket ada
        $cekambilpaket = DB::table('paket')->where('harga',$harga)->count();
        // dd($cekambilpaket);
        if($cekambilpaket>0){
            $ambilpaket = DB::table('paket')->where('harga',$harga)->get();
            foreach($ambilpaket as $ambil){
                $paket_id=$ambil->id;
                $paket_nama=$ambil->nama;
                $paket_kecepatan=$ambil->kecepatan;
            }
        }else{
            $paket_id=$row[7];
            $paket_nama=$row[9];
            $paket_kecepatan=$row[10];
        }


        //cek apakah data sudah ada

        return new tagihan([
            'id'     => $row[0],
            'nik'     => $row[1],
            'nama'    => $row[2],
            'tgl_bayar'    => $tgl,
            'thbln'    => $row[4],
            'total_bayar'    => $row[5],
            'paket_id'    => $paket_id,
            'paket_harga'    => $harga,
            'paket_nama'    => $paket_nama,
            'paket_kecepatan'    => $paket_kecepatan,
            'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s"),
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }
}

