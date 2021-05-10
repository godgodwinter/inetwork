<?php

namespace App\Http\Controllers;

use App\Models\pendapatan;
use App\Models\pengeluaran;
use App\Models\tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class Adminrekapcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $lastName  = Input::get('blnthn') ;
        // dd($lastName);
        $blnthn=date("Y-m");

        $dpendapatans = DB::table('pendapatan')
        ->whereMonth('tgl', '=', date("m"))
        ->whereYear('tgl', '=', date("Y"))
        ->get();
            $totaldapat = DB::table('pendapatan')
            ->whereMonth('tgl', '=', date("m"))
            ->whereYear('tgl', '=', date("Y"))
            ->sum('nominal');

        $dpengeluarans = DB::table('pengeluaran')
        ->whereMonth('tgl', '=', date("m"))
        ->whereYear('tgl', '=', date("Y"))
        ->get();
            $totalkeluar = DB::table('pengeluaran')
            ->whereMonth('tgl', '=', date("m"))
            ->whereYear('tgl', '=', date("Y"))
            ->sum('nominal');

        $dtagihans = DB::table('tagihan')
        ->where('thbln', '=', $blnthn)
        ->get();

            $totaltagihans = DB::table('tagihan')
            ->where('thbln', '=', $blnthn)
            ->sum('total_bayar');

        // $today = Carbon::now()->isoFormat('D MMMM Y');
        return view('admin.rekap.index',compact('dpengeluarans','dpendapatans','dtagihans','totaltagihans','totaldapat','totalkeluar','blnthn'));
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
    }

    public function bln(Request $request)
    {
        // $lastName  = Input::get('blnthn') ;
        // dd($request);
        $blnthn=$request->blnthn;

        $dpendapatans = DB::table('pendapatan')
        ->whereMonth('tgl', '=', date("m",strtotime($blnthn)))
        ->whereYear('tgl', '=', date("Y",strtotime($blnthn)))
        ->get();

        $totaldapat = DB::table('pendapatan')
        ->whereMonth('tgl', '=', date("m",strtotime($blnthn)))
        ->whereYear('tgl', '=', date("Y",strtotime($blnthn)))
        ->sum('nominal');

        $dpengeluarans = DB::table('pengeluaran')
        ->whereMonth('tgl', '=', date("m",strtotime($blnthn)))
        ->whereYear('tgl', '=', date("Y",strtotime($blnthn)))
        ->get();

        $totalkeluar = DB::table('pengeluaran')
        ->whereMonth('tgl', '=', date("m",strtotime($blnthn)))
        ->whereYear('tgl', '=', date("Y",strtotime($blnthn)))
        ->sum('nominal');

        $dtagihans = DB::table('tagihan')
        ->where('thbln', '=', $blnthn)
        ->get();

        $totaltagihans = DB::table('tagihan')
        ->where('thbln', '=', $blnthn)
        ->sum('total_bayar');

        // $today = Carbon::now()->isoFormat('D MMMM Y');
        return view('admin.rekap.index',compact('dpengeluarans','dpendapatans','dtagihans','totaltagihans','totaldapat','totalkeluar','blnthn'));
    }
}
