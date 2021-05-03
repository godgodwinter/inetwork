<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\PaketExport;
use App\Exports\LetakserverExport;
use App\Exports\InventarisExport;
use App\Imports\PaketImport;
use App\Imports\LetakserverImport;
use App\Imports\InventarisImport;
use Excel;
use Session;

class ExportImport extends Controller
{
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
        return Excel::download(new inventarisExport, 'Inventarisexport'.$type);
    }


    /**
    * @return \Illuminate\Support\Collection
    */
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
}

