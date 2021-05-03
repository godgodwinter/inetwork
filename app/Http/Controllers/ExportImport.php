<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\PaketExport;
use App\Imports\PaketImport;
use Excel;

class ExportImport extends Controller
{
    public function exportpaket($type)
    {
        return Excel::download(new PaketExport, 'paketexport.'.$type);
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function importpaket(Request $request)
    {
        Excel::import(new PaketImport,$request->import_file);

        Session::put('success', 'Your file is imported successfully in database.');

        return back();
    }
}

