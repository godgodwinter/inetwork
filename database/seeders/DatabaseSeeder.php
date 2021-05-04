<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
         // insert data ke table products menggunakan Faker
         DB::table('settings')->insert([
            'kunci' => 'menu_dashboard',
            'nilai' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);


         DB::table('settings')->insert([
            'kunci' => 'menu_paket',
            'nilai' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

         DB::table('settings')->insert([
            'kunci' => 'menu_letakserver',
            'nilai' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

         DB::table('settings')->insert([
            'kunci' => 'menu_jenisalat',
            'nilai' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

         DB::table('settings')->insert([
            'kunci' => 'menu_jenispendapatan',
            'nilai' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

         DB::table('settings')->insert([
            'kunci' => 'menu_jenispengeluaran',
            'nilai' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

}
}
