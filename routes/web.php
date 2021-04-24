<?php

use App\Http\Livewire\Paket;
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

    Route::get('/admin/paket', 'App\Http\Livewire\Paket')->name('paket.index'); //Tambahkan routing ini
    Route::get('/admin/paket/create','App\Http\Livewire\Paket\Create')->name('paket.create'); //Tambahkan routing ini
    Route::get('/admin/paket/edit/{id}', 'App\Http\Livewire\Paket\Index')->name('paket.edit'); //Tambahkan routing ini
    // Route::resource('admin/paket','App\Http\Controllers\AdminpaketController');

});
