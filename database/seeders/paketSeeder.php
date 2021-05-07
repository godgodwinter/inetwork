<?php

namespace Database\Seeders;


use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class paketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //paket
        //  $faker = Faker::create('fr_FR');
        //  for($i = 1; $i <= 10; $i++){
        //      // insert data ke table products menggunakan Faker
        //      DB::table('paket')->insert([
        //          'harga' => ($faker->numberBetween(1,20)*5000),
        //          'nama' => "Paket ".$faker->city,
        //          'kecepatan' => ($faker->numberBetween(1,20)*1),
        //          'created_at' => Carbon::now(),
        //          'updated_at' => Carbon::now()
        //       ]);
    //  }

         //jenisalat
        //  $faker = Faker::create('en_US');
        //  for($i = 1; $i <= 10; $i++){
        //      // insert data ke table products menggunakan Faker
        //      DB::table('jenisalat')->insert([
        //          'nama' => $faker->state,
        //          'created_at' => Carbon::now(),
        //          'updated_at' => Carbon::now()
        //       ]);
    //  }

         //jenispendapatan
        //  $faker = Faker::create('en_US');
        //  for($i = 1; $i <= 10; $i++){
        //      // insert data ke table products menggunakan Faker
        //      DB::table('jenispendapatan')->insert([
        //         'nama' => $faker->cityPrefix,
        //          'created_at' => Carbon::now(),
        //          'updated_at' => Carbon::now()
        //       ]);
    //  }

         //jenispengeluaran
        //  $faker = Faker::create('en_US');
        //  for($i = 1; $i <= 10; $i++){
        //      // insert data ke table products menggunakan Faker
        //      DB::table('jenispengeluaran')->insert([
        //         'nama' => $faker->citySuffix,
        //          'created_at' => Carbon::now(),
        //          'updated_at' => Carbon::now()
        //       ]);
    //  }
     //letakserver
//      $faker = Faker::create('en_US');
//      for($i = 1; $i <= 10; $i++){
//          // insert data ke table products menggunakan Faker
//          DB::table('letakserver')->insert([
//             'nama' => $faker->secondaryAddress,
//              'created_at' => Carbon::now(),
//              'updated_at' => Carbon::now()
//           ]);
//  }

        //default settings
            DB::table('jenisalat')->insert([
                    'id' => '1',
                    'nama' => 'Lain-lain',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

            DB::table('jenispendapatan')->insert([
                    'id' => '1',
                    'nama' => 'Lain-lain',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

            DB::table('jenispengeluaran')->insert([
                    'id' => '1',
                    'nama' => 'Lain-lain',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

            DB::table('letakserver')->insert([
                    'id' => '1',
                    'nama' => 'Contoh Server',
                    'koordinat' => '-8.12993410627776, 112.4867915739301',
                    'penanggungjawab' => 'Cak Aris',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

    }
}
