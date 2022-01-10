<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BreedsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('breeds')->insert(['name' => 'Amazzone dell’Amazzonia']);
        \DB::table('breeds')->insert(['name' => 'Amazzone di Cuba']);
        \DB::table('breeds')->insert(['name' => 'Cacatua Bianco']);
    }
}
