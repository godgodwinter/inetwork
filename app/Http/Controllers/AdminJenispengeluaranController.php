<?php

namespace App\Http\Controllers;

use App\Models\jenispengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class AdminJenispengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
                'nama'=>'required'
            ],
            [
                'nama.required'=>'nama harus diisi'
            ]);
        // simpan
        DB::table('jenispengeluaran')->insert(
            array(
                'nama'     =>   $request->nama,
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s")
            )
        );
        return redirect(URL::to('/').'/admin/pengeluaran#kategori')->with('status','Data berhasil di tambahkan!');

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
        //validasi
        $request->validate([
            'nama'=>'required'
        ],
        [
            'nama.required'=>'nama harus diisi'
        ]);
            //aksi update
            jenispengeluaran::where('id',$id)
            ->update([
                'nama'=>$request->nama
            ]);
            return redirect('/admin/pengeluaran#kategori')->with('status','Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        jenispengeluaran::destroy($id);
       return redirect(URL::to('/').'/admin/pengeluaran#kategori')->with('status','Data berhasil dihapus!');
    }
}
