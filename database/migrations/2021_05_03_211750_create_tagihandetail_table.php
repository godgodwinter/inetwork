<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagihandetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tagihandetail', function (Blueprint $table) {
            $table->id();
            $table->string('tagihan_id')->nullable();
            $table->string('bayar')->nullable();
            $table->string('nik')->nullable();
            $table->string('nama')->nullable();
            $table->string('paket_id')->nullable();
            $table->string('paket_harga')->nullable();
            $table->string('paket_kecepatan')->nullable();
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
        Schema::dropIfExists('detailtagihan');
    }
}
