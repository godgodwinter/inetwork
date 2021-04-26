<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNamaOnrelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('inventaris', function($table) {
            $table->string('jenisalat_nama')->nullable();
        });


        Schema::table('pendapatan', function($table) {
            $table->string('jenispendapatan_nama')->nullable();
        });

        Schema::table('pengeluaran', function($table) {
            $table->string('jenispengeluaran_nama')->nullable();
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
