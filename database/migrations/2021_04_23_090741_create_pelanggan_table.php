<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelangganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->uniqid();
            $table->string('nama')->nullable();
            $table->string('alamat')->nullable();
            $table->string('hp')->nullable();
            $table->string('tgl_gabung')->nullable();
            $table->string('user_ppoe')->nullable();
            $table->string('pass_ppoe')->nullable();
            $table->string('status_ppoe')->nullable();
            $table->string('paket_id')->nullable();
            $table->string('status_langganan')->nullable();
            $table->string('letakserver_id')->nullable();
            $table->string('kordinat_rumah')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelanggan');
    }
}
