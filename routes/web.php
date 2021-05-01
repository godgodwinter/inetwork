<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CetakController;

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

    Route::resource('admin/paket','App\Http\Controllers\AdminPaketController');
    //menu inventaris
    Route::resource('admin/inventaris','App\Http\Controllers\AdminInventarisController');
    Route::resource('admin/jenisalat','App\Http\Controllers\AdminJenisalatController');
    //menu letakserver
    Route::resource('admin/letakserver','App\Http\Controllers\AdminletakserverController');
    //menu pendapatan
    Route::resource('admin/pendapatan','App\Http\Controllers\AdminPendapatanController');

    //Route::get('admin/cetak_pdf', 'CetakController@cetak_pdf');
    Route::get('admin/cetak/cetak_paket', 'App\Http\Controllers\CetakController@cetak_paket');
    Route::get('admin/cetak/cetak_letakserver', 'App\Http\Controllers\CetakController@cetak_letakserver');

    Route::resource('admin/jenispendapatan','App\Http\Controllers\AdminJenispendapatanController');

    //menu pengeluaran
    Route::resource('admin/pengeluaran','App\Http\Controllers\AdminPengeluaranController');
    Route::resource('admin/jenispengeluaran','App\Http\Controllers\AdminJenispengeluaranController');

    //menu pengeluaran
    Route::resource('admin/pelanggan','App\Http\Controllers\AdminPelangganController');


    //menu tagihan
    Route::resource('admin/tagihan','App\Http\Controllers\AdminTagihanController');
    Route::get('admin/tagihan/{id}/bayar', 'App\Http\Controllers\AdminTagihanController@bayar');


    //menu rekap
    Route::resource('admin/rekap','App\Http\Controllers\Adminrekapcontroller');
    Route::get('admin/rekapbln', 'App\Http\Controllers\Adminrekapcontroller@bln');





});
