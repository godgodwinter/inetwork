<?php

namespace App\Http\Controllers;

use App\Models\pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class AdminPelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas=pelanggan::all();

        // $today = Carbon::now()->isoFormat('D MMMM Y');
        return view('admin.pelanggan.index',compact('datas'));
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
        $request->validate([
            'nik'=>'required',
            'nama'=>'required',
            'alamat'=>'required',
            'hp'=>'required',
            'paket_id'=>'required',
            'tgl_gabung'=>'required',
            'status_langganan'=>'required',
            'kordinat_rumah'=>'required',
            'letakserver_id'=>'required'
        ],
        [
            'nik.required'=>'nik harus diisi',
        ]);
        //ambil nama PAKET
        $ambilpaket = DB::table('paket')->where('id',$request->paket_id)->get();
        foreach($ambilpaket as $ambil){
            $paket_nama=$ambil->nama;
        }
        
        //ambil nama letakserver
        $ambilnamas4rver = DB::table('letakserver')->where('id',$request->letakserver_id)->get();
        foreach($ambilnamas4rver as $ambil2){
            $letakserver_nama=$ambil2->nama;
            $letakserver_koordinat=$ambil2->koordinat;
        }
       // simpan
       DB::table('pelanggan')->insert(
        array(
               'nik'     =>   $request->nik,
               'nama'     =>   $request->nama,
               'alamat'     =>   $request->alamat,
               'hp'     =>   $request->hp,
               'tgl_gabung'     =>   $request->tgl_gabung,
               'paket_id'     =>   $request->paket_id,
               'paket_nama'     =>   $paket_nama,
               'kordinat_rumah'     =>   $request->kordinat_rumah,
               'letakserver_id'     =>   $request->letakserver_id,
               'status_langganan'     =>   $request->status_langganan,
               'letakserver_nama'     =>   $letakserver_nama,
               'letakserver_koordinat'     =>   $letakserver_koordinat,
               'created_at'=>date("Y-m-d H:i:s"),
               'updated_at'=>date("Y-m-d H:i:s")
        )
   );
    return redirect(URL::to('/').'/admin/pelanggan')->with('status','Data berhasil di tambahkan!');
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
    }
}
