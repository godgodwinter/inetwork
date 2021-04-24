<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekapbulananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekapbulanan', function (Blueprint $table) {
            $table->id();
            $table->string('pendapatan')->nullable();
            $table->string('tagihan')->nullable();
            $table->string('pengeluaran')->nullable();
            $table->string('bersih')->nullable();
            $table->string('belumbayar')->nullable();
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
        Schema::dropIfExists('rekapbulanan');
    }
}
