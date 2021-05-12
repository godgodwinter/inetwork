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
         DB::table('settings')->insert([
            'kunci' => 'tourmenu',
            'nilai' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

         DB::table('settings')->insert([
            'kunci' => 'web_nama',
            'nilai' => 'iNetwork',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

         DB::table('settings')->insert([
            'kunci' => 'web_motto',
            'nilai' => 'Beast Aggresive Effective',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

         DB::table('settings')->insert([
            'kunci' => 'web_logo',
            'nilai' => 'logo.png',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

}
}
