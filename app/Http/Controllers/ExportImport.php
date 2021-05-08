<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\PaketExport;
use App\Exports\LetakserverExport;
use App\Exports\InventarisExport;
use App\Exports\PendapatanExport;
use App\Exports\PengeluaranExport;
use App\Exports\PelangganExport;
use App\Imports\PaketImport;
use App\Imports\LetakserverImport;
use App\Imports\InventarisImport;
use App\Imports\PendapatanImport;
use App\Imports\PengeluaranImport;
use App\Imports\PelangganImport;
use App\Imports\PelangganImportgetinet;
use App\Imports\PembayaranImportwhereniknama;
use Excel;
use Session;

class ExportImport extends Controller
{
    //EXPORT

    //export paket
    public function exportpaket($type)
    {
        return Excel::download(new PaketExport, 'paketexport.'.$type);
    }
    //export letak server
    public function exportletakserver($type)
    {

        return Excel::download(new LetakserverExport, 'letakserverexport.'.$type);
    }

    //export letak server
    public function exportinventaris($type)
    {
        return Excel::download(new inventarisExport, 'Inventarisexport.'.$type);
    }

     //export Pendapatan
     public function exportpendapatan($type)
     {
         return Excel::download(new PendapatanExport, 'Pendapatanexport.'.$type);
     }

     //export Pengeluaran
     public function exportpengeluaran($type)
     {
         return Excel::download(new PengeluaranExport, 'Pengeluaranexport.'.$type);
     }
     //export pelanggan
     public function exportpelanggan($type)
     {
         return Excel::download(new pelangganExport, 'Pelangganexport.'.$type);
     }


    //IMPORT

    //import paket
    public function importpaket(Request $request)
    {
        Excel::import(new PaketImport,$request->import_file);

        Session::put('success', 'Your file is imported successfully in database.');

        return back();
    }
    //import letakserver
    public function importletakserver(Request $request)
    {
        Excel::import(new LetakserverImport,$request->import_file);

        Session::put('success', 'Your file is imported successfully in database.');

        return back();
    }
    //import letakserver
    public function importinventaris(Request $request)
    {
        Excel::import(new InventarisImport,$request->import_file);

        Session::put('success', 'Your file is imported successfully in database.');

        return back();
    }

    //import Pendapatan
    public function importpendapatan(Request $request)
    {
        Excel::import(new PendapatanImport,$request->import_file);

        Session::put('success', 'Your file is imported successfully in database.');

        return back();
    }

     //import Pengeluaran
     public function importpengeluaran(Request $request)
     {
         Excel::import(new PengeluaranImport,$request->import_file);

         Session::put('success', 'Your file is imported successfully in database.');

         return back();
     }

     //import pelanggan
     public function importpelanggan(Request $request)
     {
         Excel::import(new PelangganImport,$request->import_file);

         Session::put('success', 'Your file is imported successfully in database.');

         return back();
     }


     //import pelanggan
     public function importpelanggangetinet(Request $request)
     {
         Excel::import(new PelangganImportgetinet,$request->import_file);

         Session::put('success', 'Your file is imported successfully in database.');

         return back();
     }

     public function importpembayaranwhereniknama(Request $request)
     {
        //  dd($request);
         Excel::import(new PembayaranImportwhereniknama,$request->import_file);

         Session::put('success', 'Your file is imported successfully in database.');

         return back();
     }
}

