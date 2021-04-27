<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\paket;
use App\Models\letakserver;
use PDF;



class CetakController extends Controller
{
    //
    public function cetak_paket()
    {
        $paket = paket::all();

        $pdf = PDF::loadview('admin/paket/cetak_paket',['paket'=>$paket]);
    	return $pdf->download('laporan-paket-pdf');


    }

    public function cetak_letakserver()
    {
        $letakserver = letakserver::all();

        $pdf = PDF::loadview('admin/letakserver/cetak_letakserver',['letakserver'=>$letakserver]);
    	return $pdf->download('laporan-letakserver-pdf');


    }
}
