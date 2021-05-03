<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNamapaketOnTablePelanggan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('pelanggan', function($table) {
            $table->string('paket_nama')->nullable();
            $table->string('letakserver_nama')->nullable();
            $table->string('letakserver_koordinat')->nullable();
            $table->string('paket_harga')->nullable();
            $table->string('paket_kecepatan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
