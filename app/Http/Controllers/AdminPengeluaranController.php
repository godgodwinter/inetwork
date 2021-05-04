<?php

namespace App\Http\Controllers;

use App\Models\jenispengeluaran;
use App\Models\pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class AdminPengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas=pengeluaran::all();
        $datadetails=jenispengeluaran::all();

        // $today = Carbon::now()->isoFormat('D MMMM Y');
        return view('admin.pengeluaran.index',compact('datas','datadetails'));
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
            'nama'=>'required',
            'nominal'=>'required',
            'tgl'=>'required|date',
            'jenispengeluaran_id'=>'required'
        ],
        [
            'nama.required'=>'nama harus diisi',
            'jenispengeluaran_id.required'=>'Buat dan pilih Kategori dahulu'
        ]);
        //ambil nama jenisalat
        $ambilnamakategori = DB::table('jenispengeluaran')->where('id',$request->jenispengeluaran_id)->get();
        foreach($ambilnamakategori as $ambil){
            $namaja=$ambil->nama;
        }
       // simpan
       DB::table('pengeluaran')->insert(
        array(
               'nama'     =>   $request->nama,
               'nominal'     =>   $request->nominal,
               'tgl'     =>   $request->tgl,
               'jenispengeluaran_id'     =>   $request->jenispengeluaran_id,
               'jenispengeluaran_nama'     =>   $namaja,
               'created_at'=>date("Y-m-d H:i:s"),
               'updated_at'=>date("Y-m-d H:i:s")
        )
   );
    return redirect(URL::to('/').'/admin/pengeluaran')->with('status','Data berhasil di tambahkan!');
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
        $datas = DB::table('pengeluaran')->where('id',$id)->get();
        return view('admin.pengeluaran.edit',compact('datas'));
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
        $request->validate([
            'nama'=>'required',
            'nominal'=>'required',
            'tgl'=>'required|date',
            'jenispengeluaran_id'=>'required'
        ],
        [
            'nama.required'=>'nama harus diisi',
            'jenispengeluaran_id.required'=>'Buat dan pilih Kategori dahulu'
        ]);
        //ambil nama jenisalat
        $ambilnamakategori = DB::table('jenispengeluaran')->where('id',$request->jenispengeluaran_id)->get();
        foreach($ambilnamakategori as $ambil){
            $namaja=$ambil->nama;
        }
        // dd($namaja);
        //aksi update
        pengeluaran::where('id',$id)
        ->update([
            'nama'=>$request->nama,
            'nominal'=>$request->nominal,
            'tgl'=>$request->tgl,
            'jenispengeluaran_id'=>$request->jenispengeluaran_id,
            'jenispengeluaran_nama'=>$namaja
        ]);
        return redirect('/admin/pengeluaran')->with('status','Data berhasil diupdate!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        pengeluaran::destroy($id);
        return redirect(URL::to('/').'/admin/pengeluaran')->with('status','Data berhasil dihapus!');
    }
    public function deletechecked(Request $request)
    {
        //
        // dd($request);
        $ids=$request->ids;
        pengeluaran::whereIn('id',$ids)->delete();

        // load ulang
        $datas=pengeluaran::all();
        $datadetails=jenispengeluaran::all();

        // $today = Carbon::now()->isoFormat('D MMMM Y');
        return view('admin.pengeluaran.index',compact('datas','datadetails'));

    }
}
