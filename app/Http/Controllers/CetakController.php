<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\paket;
use App\Models\letakserver;
use App\Models\pelanggan;
use App\Models\inventaris;

use App\Models\pendapatan;
use App\Models\tagihan;
use App\Models\pengeluaran;
use App\Http\Controllers\Adminrekapcontroller;
use Illuminate\Support\Facades\DB;
use PDF;



class CetakController extends Controller
{
    //cetak paket
    public function cetak_paket()
    {
        $paket = paket::all();

        $pdf = PDF::loadview('admin/paket/cetak_paket',['paket'=>$paket]);
    	return $pdf->download('laporan-paket-pdf'.date("YmdHis").'.pdf');


    }
    //cetak letak server
    public function cetak_letakserver()
    {
        $letakserver = letakserver::all();

        $pdf = PDF::loadview('admin/letakserver/cetak_letakserver',['letakserver'=>$letakserver]);
    	return $pdf->download('laporan-letakserver-pdf'.date("YmdHis").'.pdf');
    }

    //cetak pelanggan
    public function cetak_pelanggan()
    {
        $pelanggan = pelanggan::all();

        $pdf = PDF::loadview('admin/pelanggan/cetak_pelanggan',['pelanggan'=>$pelanggan]);
    	return $pdf->download('laporan-pelanggan-pdf'.date("YmdHis").'.pdf');
    }

    //cetak pelanggan
    public function cetak_inventaris()
    {
        $inventaris = inventaris::all();

        $pdf = PDF::loadview('admin/inventaris/cetak_inventaris',['inventaris'=>$inventaris]);
    	return $pdf->download('laporan-inventaris-pdf'.date("YmdHis").'.pdf');
    }

    public function cetak_tagihan()
    {
        $tagihan = tagihan::all();

        $pdf = PDF::loadview('admin/tagihan/cetak_tagihan',['tagihan'=>$tagihan]);
    	return $pdf->download('laporan-tagihan-pdf'.date("YmdHis").'.pdf');
    }

    public function cetak_pengeluaran()
    {
        $pengeluaran = pengeluaran::all();


        $pdf = PDF::loadview('admin/pengeluaran/cetak_pengeluaran',['pengeluaran'=>$pengeluaran]);
    	return $pdf->download('laporan-pengeluaran-pdf');
    }

    public function cetak_pemasukan()
    {
        $pemasukan = pendapatan::all();


        $pdf = PDF::loadview('admin/pendapatan/cetak_pemasukan',['pemasukan'=>$pemasukan]);
    	return $pdf->download('laporan-pemasukan-pdf'.date("YmdHis").'.pdf');
    }

    public function cetak_rekap(Request $request)
    {


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


        $pdf = PDF::loadview('admin/rekap/cetak_rekap',compact('dpengeluarans','dpendapatans','dtagihans','totaltagihans','totaldapat','totalkeluar','blnthn'));
    	return $pdf->download('rekappdf'.date("YmdHis").'.pdf');
    }

}
