<?php

namespace App\Http\Controllers;

use App\Models\jenispendapatan;
use App\Models\pendapatan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class AdminPendapatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas=pendapatan::all();
        $datadetails=jenispendapatan::all();

        // $today = Carbon::now()->isoFormat('D MMMM Y');
        return view('admin.pendapatan.index',compact('datas','datadetails'));
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
            'jenispendapatan_id'=>'required'
        ],
        [
            'nama.required'=>'nama harus diisi'
        ]);
       // simpan
       DB::table('pendapatan')->insert(
        array(
               'nama'     =>   $request->nama,
               'nominal'     =>   $request->nominal,
               'tgl'     =>   $request->tgl,
               'jenispendapatan_id'     =>   $request->jenispendapatan_id,
               'jenispendapatan_nama'     =>   $request->jenispendapatan_nama,
               'created_at'=>date("Y-m-d H:i:s"),
               'updated_at'=>date("Y-m-d H:i:s")
        )
   );
    return redirect(URL::to('/').'/admin/pendapatan')->with('status','Data berhasil di tambahkan!');
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
