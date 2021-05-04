<?php

namespace App\Http\Controllers;

use App\Models\letakserver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class AdminletakserverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas=letakserver::all();

         return view('admin.letakserver.index',compact('datas'));
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
            'penanggungjawab'=>'required',
            'koordinat'=>'required'
        ],
        [
            'nama.required'=>'nama harus diisi'
        ]);
       // simpan
       DB::table('letakserver')->insert(
        array(
               'nama'     =>   $request->nama,
               'penanggungjawab'     =>   $request->penanggungjawab,
               'koordinat'     =>   $request->koordinat,
               'created_at'=>date("Y-m-d H:i:s"),
               'updated_at'=>date("Y-m-d H:i:s")
        )
   );
    return redirect(URL::to('/').'/admin/letakserver')->with('status','Data berhasil di tambahkan!');
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
        $datas = DB::table('letakserver')->where('id',$id)->get();
        return view('admin.letakserver.edit',compact('datas'));
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
            'penanggungjawab'=>'required',
            'koordinat'=>'required'
        ],
        [
            'nama.required'=>'nama harus diisi'
        ]);
        letakserver::where('id',$id)
        ->update([
            'nama'=>$request->nama,
            'penanggungjawab'=>$request->penanggungjawab,
            'koordinat'=>$request->koordinat
        ]);
        return redirect('/admin/letakserver')->with('status','Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         letakserver::destroy($id);
         return redirect(URL::to('/').'/admin/letakserver')->with('status','Data berhasil dihapus!');
    }
    public function deletechecked(Request $request)
    {
        //
        // dd($request);
        $ids=$request->ids;
        letakserver::whereIn('id',$ids)->delete();

        // load ulang
        $datas=letakserver::all();
        return view('admin.letakserver.index',compact('datas'));

    }
}
