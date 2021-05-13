<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Models\settings;

class AdminSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blnthn=date("Y-m");
        $datas = DB::table('settings')->get();
        return view('admin.settings.index',compact('blnthn','datas'));

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
        // dd($request);

        $request->validate([
            'web_nama'=>'required',
            'web_motto'=>'required',
            'web_kordinat'=>'required',
            'tourmenu'=>'required'

        ],
        [
            'web_nama.required'=>'nama harus diisi',
            'web_motto.required'=>'motto harus diisi',
            'web_kordinat.required'=>'kordinat harus diisi',
            'tourmenu.required'=>'menu tour harus diisi'

        ]);
            //web_nama
        settings::where('kunci','web_nama')
            ->update([
                'nilai'=>$request->web_nama
            ]);

            //web_motto
        settings::where('kunci','web_motto')
            ->update([
                'nilai'=>$request->web_motto
            ]);

            //web_kordinat
        settings::where('kunci','web_kordinat')
            ->update([
                'nilai'=>$request->web_kordinat
            ]);

            //tourmenu
        settings::where('kunci','tourmenu')
            ->update([
                'nilai'=>$request->tourmenu
            ]);



            return redirect('/admin/settings')->with('status','Perubahan berhasil disimpan !');
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
