<?php

namespace App\Http\Controllers;

use App\Models\tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class AdminTagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas=tagihan::all();

        // $today = Carbon::now()->isoFormat('D MMMM Y');
        return view('admin.tagihan.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        tagihan::destroy($id);
        return redirect(URL::to('/').'/admin/tagihan')->with('status','Data berhasil dihapus!');
    }

    public function bayar($id)
    {
        // dd($id);
        // ambil data pelanggan
            $datas = DB::table('pelanggan')->where('nik',$id)->get();

            foreach ($datas as $data){

                //cek apakah paket id ada di tabel paket
                $jmldata = DB::table('paket')
                ->where('id', '=', $data->paket_id)
                ->count();

                //jika paket internet tidak ada
                if($jmldata==0){

                    return redirect('/admin/pelanggan')->with('status','Paket Internet tidak ditemukan, Periksa dan ubah dahulu!');
                }

                //jika status langganan tidak aktif
                if(($data->status_langganan)!="Aktif"){

                    return redirect('/admin/pelanggan')->with('status','Status Langganan <b>Tidak Aktif, Periksa dan ubah dahulu!');
                }

                //ambil harga paket
            $dataspaket = DB::table('paket')->where('id',$data->paket_id)->get();
            foreach ($dataspaket as $dp){
                    $paket_nama=$dp->nama;
                    $paket_kecepatan=$dp->kecepatan;
                    $paket_harga=$dp->harga;
            }

                //periksa apakah nik sudah bayar
                $cariapakahsudahbayar = DB::table('tagihan')
                ->where('nik', '=', $data->nik)
                ->whereYear('tgl_bayar', '=', date("Y"))
                ->whereMonth('tgl_bayar', '=', date("m"))
                ->count();

                //jika data sudah ada/sudah bayar tagihan
                if($cariapakahsudahbayar>0){
                    //update
                    // dd('update');
                return redirect('/admin/pelanggan')->with('status','Pembayaran gagal, Pelanggan sudah membayar pada bulan ini!');
                }else{
                    //simpan
                    DB::table('tagihan')->insert(
                        array(
                               'nik'     =>   $data->nik,
                               'paket_id'     =>   $data->paket_id,
                               'total_bayar'     =>   $paket_harga,
                               'tgl_bayar'     =>   date("Y-m-d H:i:s"),
                               'nama'     =>   $data->nama,
                               'paket_nama'     =>   $paket_nama,
                               'paket_kecepatan'     =>   $paket_kecepatan,
                               'paket_harga'     =>   $paket_harga,
                               'created_at'=>date("Y-m-d H:i:s"),
                               'updated_at'=>date("Y-m-d H:i:s")
                        )
                   );
                }
                return redirect('/admin/tagihan')->with('status','Pembayaran Tagihan Berhasil ditambahkan!');
//penutup data pelanggan
            }

        //jika tidak ada maka kembali

        // jika ada lanjut
        // simpan tagihan

    }
}
