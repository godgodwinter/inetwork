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

        if($myString==null){
            $myString=$row[4]."-01";
        }
        if (date('Y-m-d', strtotime($myString)) !== $myString) {

            $unixDate = ($myString - 25569) * 86400;
              $tgl=date("Y-m-d", $unixDate);
          }else{
            // it's a date
            $tgl=$myString;
          }



          $created_at=$tgl.date(" H:i:s");
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
                $paket_harga=$ambil->harga;
            }
        }else{
            $paket_id=$row[7];
            $paket_nama=$row[9];
            $paket_kecepatan=$row[10];
        }


        //cek apakah data sudah ada
        $cekdatatagihan = DB::table('tagihan')
        ->where('nik',$row[1])
        ->where('nama',$row[2])
        ->where('tgl_bayar',$tgl)
        ->where('thbln',$row[4])
        ->count();
        // dd($cekdatatagihan);

        // dd($tgl);
        if($cekdatatagihan>0){
            //jika sudah ada maka apdet

            DB::table('tagihan')
            ->where('nik',$row[1])
            ->where('nama',$row[2])
            ->where('tgl_bayar',$tgl)
            ->where('thbln',$row[4])
            ->update([
                'paket_id'    => $paket_id,
                'paket_harga'    => $harga,
                'paket_nama'    => $paket_nama,
                'paket_kecepatan'    => $paket_kecepatan,
                'tgl_bayar'    => $tgl,
                'updated_at'=>date("Y-m-d H:i:s"),
            ]);

        }else{
                //jika belum ada maka insert
                  //simpan
                  DB::table('tagihan')->insert(
                    array(
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
                    )
               );


        }

        // dd($tgl);

        //cek apakah nik thbln sudah ada di tabel tagihan detail
        $cekdatatagihandetail = DB::table('tagihandetail')
        ->where('nik',$row[1])
        ->where('thbln',$row[4])
        ->count();

        //ambil tagihan_id
        $ambiltagihan_id = DB::table('tagihan')
        ->where('nik',$row[1])
        ->where('thbln',$row[4])
        ->get();

        foreach($ambiltagihan_id as $atid){
            $tagihan_id=$atid->id;
        }
        // dd(tagihandetail::where('tagihan_id',$tagihan_id)->delete());
        //jika suda maka apdet
        if($cekdatatagihandetail>0){
            //update

            DB::table('tagihandetail')
            ->where('nik',$row[1])
            ->where('thbln',$row[4])
            ->update([
                'nama'    => $row[2],
                'tagihan_id'    => $tagihan_id,
                'thbln'    => $row[4],
                'bayar'    => $row[5],
                'paket_id'    => $paket_id,
                'paket_harga'    => $harga,
                'paket_kecepatan'    => $paket_kecepatan,
                'created_at'=> $created_at,
                'updated_at'=>date("Y-m-d H:i:s"),
            ]);
            // tagihandetail::where('tagihan_id',$tagihan_id)->delete();
            // DB::table('tagihandetail')->where('tagihan_id',$tagihan_id)->delete();
        }else{
 //simpan
            DB::table('tagihandetail')->insert(
                array(
                    'nik'     => $row[1],
                    'nama'    => $row[2],
                    'tagihan_id'    => $tagihan_id,
                    'thbln'    => $row[4],
                    'bayar'    => $row[5],
                    'paket_id'    => $paket_id,
                    'paket_harga'    => $harga,
                    'paket_kecepatan'    => $paket_kecepatan,
                    'created_at'=> $created_at,
                    'updated_at'=> $created_at
                )
            );
        }


        // dd($created_at);
        // dd($row[5]);

     //jika belum tambahkan saja



    }
    public function startRow(): int
    {
        return 2;
    }
}

