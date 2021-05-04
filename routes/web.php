<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\ExportImport;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('beranda');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


//halaman admin fixed
Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {
    //paket
    Route::resource('admin/paket','App\Http\Controllers\AdminPaketController');
    Route::delete('admin/paket', 'App\Http\Controllers\AdminPaketController@deletechecked')->name('paket.deleteSelected');
    //menu inventaris
    Route::resource('admin/inventaris','App\Http\Controllers\AdminInventarisController');
    Route::resource('admin/jenisalat','App\Http\Controllers\AdminJenisalatController');
    //menu letakserver
    Route::resource('admin/letakserver','App\Http\Controllers\AdminletakserverController');
    //menu pendapatan
    Route::resource('admin/pendapatan','App\Http\Controllers\AdminPendapatanController');

    //Print PDF
    Route::get('admin/cetak/cetak_paket', 'App\Http\Controllers\CetakController@cetak_paket');
    Route::get('admin/cetak/cetak_letakserver', 'App\Http\Controllers\CetakController@cetak_letakserver');
    Route::get('admin/cetak/cetak_inventaris', 'App\Http\Controllers\CetakController@cetak_inventaris');
    Route::get('admin/cetak/cetak_pelanggan', 'App\Http\Controllers\CetakController@cetak_pelanggan');
    Route::get('admin/cetak/cetak_tagihan', 'App\Http\Controllers\CetakController@cetak_tagihan');
    Route::get('admin/cetak/cetak_pemasukan', 'App\Http\Controllers\CetakController@cetak_pemasukan');
    Route::get('admin/cetak/cetak_pengeluaran', 'App\Http\Controllers\CetakController@cetak_pengeluaran');

    Route::resource('admin/jenispendapatan','App\Http\Controllers\AdminJenispendapatanController');

    //menu pengeluaran
    Route::resource('admin/pengeluaran','App\Http\Controllers\AdminPengeluaranController');
    Route::resource('admin/jenispengeluaran','App\Http\Controllers\AdminJenispengeluaranController');

    //menu pengeluaran
    Route::resource('admin/pelanggan','App\Http\Controllers\AdminPelangganController');


    //menu tagihan
    Route::resource('admin/tagihan','App\Http\Controllers\AdminTagihanController');
    Route::get('admin/tagihan/{id}/bayar', 'App\Http\Controllers\AdminTagihanController@bayar');
    Route::post('admin/tagihan/bayarinternet', 'App\Http\Controllers\AdminTagihanController@bayarinternet');
    Route::post('admin/tagihan/bayarsekarang', 'App\Http\Controllers\AdminTagihanController@bayarsekarang');


    //menu rekap
    Route::resource('admin/rekap','App\Http\Controllers\Adminrekapcontroller');
    Route::get('admin/rekapbln', 'App\Http\Controllers\Adminrekapcontroller@bln');



    //Export
    // Route for export/download tabledata to .csv, .xls or .xlsx
    Route::get('admin/exportpaket/{type}', [ExportImport::class, 'exportpaket'])->name('exportpaket');
    Route::get('admin/exportletakserver/{type}', [ExportImport::class, 'exportletakserver'])->name('exportletakserver');
    Route::get('admin/exportinventaris/{type}', [ExportImport::class, 'exportinventaris'])->name('exportinventaris');
    Route::get('admin/exportpelanggan/{type}', [ExportImport::class, 'exportpelanngan'])->name('exportpelanggan');
    Route::get('admin/exportpendapatan/{type}', [ExportImport::class, 'exportpendapatan'])->name('exportpendapatan');
    Route::get('admin/exportpengeluaran/{type}', [ExportImport::class, 'exportpengeluaran'])->name('exportpengeluaran');
    Route::get('admin/exportrekap/{type}', [ExportImport::class, 'exportrekap'])->name('exportrekap');
    //Import
    // Route for import excel data to database.
    Route::post('admin/importpaket', [ExportImport::class, 'importpaket'])->name('importpaket');
    Route::post('admin/importletakserver', [ExportImport::class, 'importletakserver'])->name('importletakserver');
    Route::post('admin/importinventaris', [ExportImport::class, 'importinventaris'])->name('importinventaris');
    Route::post('admin/importpelanggan', [ExportImport::class, 'importpelanggan'])->name('importpelanggan');
    Route::post('admin/importpendapatan', [ExportImport::class, 'importpendapatan'])->name('importpendapatan');
    Route::post('admin/importpengeluaran', [ExportImport::class, 'importpengeluaran'])->name('importpengeluaran');
    Route::post('admin/importrekap', [ExportImport::class, 'importrekap'])->name('importrekap');

});
