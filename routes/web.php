<?php

use Illuminate\Support\Facades\Route;

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

    Route::resource('admin/paket','App\Http\Controllers\AdminpaketController');
    //menu inventaris
    Route::resource('admin/inventaris','App\Http\Controllers\AdminInventarisController');
    Route::resource('admin/jenisalat','App\Http\Controllers\AdminjenisalatController');
    //menu letakserver
    Route::resource('admin/letakserver','App\Http\Controllers\AdminletakserverController');
    //menu pendapatan
    Route::resource('admin/pendapatan','App\Http\Controllers\AdminpendapatanController');
    Route::resource('admin/jenispendapatan','App\Http\Controllers\AdminjenispendapatanController');

});
