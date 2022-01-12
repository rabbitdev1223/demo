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
        \DB::table('breeds')->insert(['name' => 'Amazzone di Hispaniola']);
        \DB::table('breeds')->insert(['name' => 'Amazzone Farinosa']);
        \DB::table('breeds')->insert(['name' => 'Amazzone Fronte Blu']);
        \DB::table('breeds')->insert(['name' => 'Amazzone Fronte Gialla']);
        \DB::table('breeds')->insert(['name' => 'Ara Aliverdi']);
        \DB::table('breeds')->insert(['name' => 'Ara Fronte Rossa']);
        \DB::table('breeds')->insert(['name' => 'Ara Giacinto']);
        \DB::table('breeds')->insert(['name' => 'Ara Gialloblu']);
        \DB::table('breeds')->insert(['name' => 'Cacatua Bianco']);
        \DB::table('breeds')->insert(['name' => 'Cacatua Crestagialla']);
        \DB::table('breeds')->insert(['name' => 'Cacatua delle Tanimbar']);
    }
}
