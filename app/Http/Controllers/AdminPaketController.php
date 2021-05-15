<?php

namespace App\Http\Controllers;

use App\Models\paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class AdminPaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas=paket::all();

         return view('admin.paket.index',compact('datas'));
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
        $request->validate([
            'nama'=>'required',
            'harga'=>'required|numeric',
            'kecepatan'=>'required|numeric'

        ],
        [
            'nama.required'=>'nama harus diisi',
            'harga.required'=>'harga harus diisi',
            'kecepatan.required'=>'kecepatan harus diisi'

        ]);
            // dd($request);
        paket::create($request->all());
        return redirect(URL::to('/').'/admin/paket')->with('status','Data berhasil di tambahkan!');
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
        $datas = DB::table('paket')->where('id',$id)->get();
        return view('admin.paket.edit',compact('datas'));
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
        $request->validate([
            'nama'=>'required',
            'harga'=>'required|numeric',
            'kecepatan'=>'required|numeric'

        ],
        [
            'nama.required'=>'nama harus diisi',
            'harga.required'=>'harga harus diisi',
            'kecepatan.required'=>'kecepatan harus diisi'

        ]);
         //aksi update

        paket::where('id',$id)
            ->update([
                'nama'=>$request->nama,
                'harga'=>$request->harga,
                'kecepatan'=>$request->kecepatan
            ]);
            return redirect('/admin/paket')->with('status','Data berhasil diupdate!');
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
        paket::destroy($id);
        return redirect(URL::to('/').'/admin/paket')->with('status','Data berhasil dihapus!');
    }
    public function deletechecked(Request $request)
    {
        //
        // dd($request);
        $ids=$request->ids;
        paket::whereIn('id',$ids)->delete();

        // load ulang
        $datas=paket::all();
        return view('admin.paket.index',compact('datas'));

    }
    public function empty()
    {
        //
        // dd($request);
        paket::truncate();

        // load ulang
        $datas=paket::all();
        return view('admin.paket.index',compact('datas'));

    }
}
