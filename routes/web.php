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



//halaman admin fixed
Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {
    //dashboard
    Route::resource('dashboard','App\Http\Controllers\AdminDashboardController');
    Route::resource('admin/dashboard','App\Http\Controllers\AdminDashboardController');
    Route::get('admin/dashboardbln', 'App\Http\Controllers\AdminDashboardController@dashboardbln');

    //paket
    Route::resource('admin/paket','App\Http\Controllers\AdminPaketController');
    Route::delete('admin/paket-multidel', 'App\Http\Controllers\AdminPaketController@deletechecked')->name('paket.deleteSelected');
    //menu inventaris
    Route::resource('admin/inventaris','App\Http\Controllers\AdminInventarisController');
    Route::resource('admin/jenisalat','App\Http\Controllers\AdminJenisalatController');
    Route::delete('admin/inventaris-multidel', 'App\Http\Controllers\AdminInventarisController@deletechecked')->name('inventaris.deleteSelected');
    Route::delete('admin/inventaris-multidelkategori', 'App\Http\Controllers\AdminInventarisController@deletecheckedkategori')->name('inventaris.kategori.deleteSelected');
    Route::get('admin/inventarisbln', 'App\Http\Controllers\AdminInventarisController@inventarisbln');

    //menu letakserver
    Route::resource('admin/letakserver','App\Http\Controllers\AdminletakserverController');
    Route::delete('admin/letakserver-multidel', 'App\Http\Controllers\AdminletakserverController@deletechecked')->name('letakserver.deleteSelected');
    //menu pendapatan
    Route::resource('admin/pendapatan','App\Http\Controllers\AdminPendapatanController');
    Route::delete('admin/pendapatan-multidel', 'App\Http\Controllers\AdminPendapatanController@deletechecked')->name('pendapatan.deleteSelected');
    Route::delete('admin/pendapatan-multidelkategori', 'App\Http\Controllers\AdminPendapatanController@deletecheckedkategori')->name('pendapatan.kategori.deleteSelected');
    Route::get('admin/pendapatanbln', 'App\Http\Controllers\AdminPendapatanController@pendapatanbln');
    Route::resource('admin/jenispendapatan','App\Http\Controllers\AdminJenispendapatanController');

    //menu pengeluaran
    Route::resource('admin/pengeluaran','App\Http\Controllers\AdminPengeluaranController');
    Route::resource('admin/jenispengeluaran','App\Http\Controllers\AdminJenispengeluaranController');
    Route::delete('admin/pengeluaran-multidel', 'App\Http\Controllers\AdminPengeluaranController@deletechecked')->name('pengeluaran.deleteSelected');
    Route::delete('admin/pengeluaran-multidelkategori', 'App\Http\Controllers\AdminPengeluaranController@deletecheckedkategori')->name('pengeluaran.kategori.deleteSelected');
    Route::get('admin/pengeluaranbln', 'App\Http\Controllers\AdminPengeluaranController@pengeluaranbln');

    //menu pelanggan
    Route::resource('admin/pelanggan','App\Http\Controllers\AdminPelangganController');
    Route::get('admin/pelangganbln', 'App\Http\Controllers\AdminPelangganController@pelangganbln');
    Route::get('admin/pelanggan/{blnthn}/pelangganbln', 'App\Http\Controllers\AdminPelangganController@showpelangganbln');
    Route::get('admin/pelanggan/{blnthn}/cari', 'App\Http\Controllers\AdminPelangganController@cari')->name('pelanggan-cari');
    Route::get('admin/pelanggan/{blnthn}/{cari}/pelanggan-cari', 'App\Http\Controllers\AdminPelangganController@showcari')->name('pelanggan-cari');


    //menu tagihan
    Route::resource('admin/tagihan','App\Http\Controllers\AdminTagihanController');
    Route::get('admin/tagihan/{id}/bayar', 'App\Http\Controllers\AdminTagihanController@bayar');
    Route::post('admin/tagihan/bayarinternet', 'App\Http\Controllers\AdminTagihanController@bayarinternet');
    Route::post('admin/tagihan/bayarsekarang', 'App\Http\Controllers\AdminTagihanController@bayarsekarang');
    Route::get('admin/tagihan/{id}/detail', 'App\Http\Controllers\AdminTagihanController@detail');
    Route::delete('admin/tagihandetail-multidel', 'App\Http\Controllers\AdminTagihanController@deletechecked')->name('tagihandetail.deleteSelected');
    Route::get('admin/tagihanbln', 'App\Http\Controllers\AdminTagihanController@tagihanbln');
    Route::post('admin/tagihansync', 'App\Http\Controllers\AdminTagihanController@tagihansync')->name('tagihan.sync');
    Route::get('admin/tagihan/{blnthn}/tagihanbln', 'App\Http\Controllers\AdminTagihanController@showtagihanbln');
    Route::get('admin/tagihan/{blnthn}/cari', 'App\Http\Controllers\AdminTagihanController@cari')->name('tagihan-cari');
    Route::get('admin/tagihan/{blnthn}/{cari}/tagihan-cari', 'App\Http\Controllers\AdminTagihanController@showcari')->name('tagihan-cari');




    //menu rekap
    Route::resource('admin/rekap','App\Http\Controllers\Adminrekapcontroller');
    Route::get('admin/rekapbln', 'App\Http\Controllers\Adminrekapcontroller@bln');


    //menu developer
    Route::resource('admin/importspecial','App\Http\Controllers\AdminImportspecialController');

    //Print PDF
    Route::get('admin/cetak/cetak_paket', 'App\Http\Controllers\CetakController@cetak_paket');
    Route::get('admin/cetak/cetak_letakserver', 'App\Http\Controllers\CetakController@cetak_letakserver');
    Route::get('admin/cetak/cetak_inventaris', 'App\Http\Controllers\CetakController@cetak_inventaris');
    Route::get('admin/cetak/cetak_pelanggan', 'App\Http\Controllers\CetakController@cetak_pelanggan')->name("pelanggan-cetakpdf");
    Route::get('admin/cetak/cetak_tagihan', 'App\Http\Controllers\CetakController@cetak_tagihan');
    Route::get('admin/cetak/cetak_pemasukan', 'App\Http\Controllers\CetakController@cetak_pemasukan');
    Route::get('admin/cetak/cetak_pengeluaran', 'App\Http\Controllers\CetakController@cetak_pengeluaran');
    Route::get('/cetak/cetak_rekap', 'App\Http\Controllers\CetakController@cetak_rekap');
    Route::get('admin/cetak/{blnthn}/pendapatan-bulanini', 'App\Http\Controllers\CetakController@pendapatanbulanini');
    Route::get('admin/cetak/{blnthn}/pengeluaran-bulanini', 'App\Http\Controllers\CetakController@pengeluaranbulanini');
    Route::get('admin/cetak/{blnthn}/tagihan-bulanini', 'App\Http\Controllers\CetakController@tagihanbulanini');
    Route::get('/cetak/cetak_rekapnodetail', 'App\Http\Controllers\CetakController@cetak_rekapnodetail');



    //Export
    // Route for export/download tabledata to .csv, .xls or .xlsx
    Route::get('admin/exportpaket/{type}', [ExportImport::class, 'exportpaket'])->name('exportpaket');
    Route::get('admin/exportletakserver/{type}', [ExportImport::class, 'exportletakserver'])->name('exportletakserver');
    Route::get('admin/exportinventaris/{type}', [ExportImport::class, 'exportinventaris'])->name('exportinventaris');
    Route::get('admin/exportpelanggan/{type}', [ExportImport::class, 'exportpelanggan'])->name('exportpelanggan');
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

    //import special
    Route::post('admin/importpelanggangetpaketinet', [ExportImport::class, 'importpelanggangetinet'])->name('importpelanggangetinet');
    Route::post('admin/importpembayaranwhereniknama', [ExportImport::class, 'importpembayaranwhereniknama'])->name('importpembayaranwhereniknama');

});
