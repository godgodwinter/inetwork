<?php

namespace App\Http\Controllers;

use App\Models\inventaris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class AdminInventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas=inventaris::all();

        return view('admin.inventaris.index',compact('datas'));
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
        // dd($request);
        $request->validate([
            'nama'=>'required',
            'harga'=>'required|numeric',
            'letak'=>'required',
            'jenisalat_id'=>'required'

        ],
        [
            'nama.required'=>'nama harus diisi',
            'harga.required'=>'harga harus diisi',
            'letak.required'=>'letak harus diisi'

        ]);
            // dd($request);
        inventaris::create($request->all());
        return redirect(URL::to('/').'/admin/inventaris')->with('status','Data berhasil di tambahkan!');
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
        $datas = DB::table('inventaris')->where('id',$id)->get();
        return view('admin.inventaris.edit',compact('datas'));
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
            'harga'=>'required|numeric',
            'letak'=>'required',
            'jenisalat_id'=>'required'

        ],
        [
            'nama.required'=>'nama harus diisi',
            'harga.required'=>'harga harus diisi',
            'letak.required'=>'letak harus diisi'

        ]);
         //aksi update
        inventaris::where('id',$id)
            ->update([
                'nama'=>$request->nama,
                'harga'=>$request->harga,
                'letak'=>$request->letak,
                'jenisalat_id'=>$request->jenisalat_id
            ]);
            return redirect('/admin/inventaris')->with('status','Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        inventaris::destroy($id);
        return redirect(URL::to('/').'/admin/inventaris')->with('status','Data berhasil dihapus!');
    }
}
