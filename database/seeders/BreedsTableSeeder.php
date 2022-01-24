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
        \DB::table('breeds')->insert(['name' => 'Caicco']);
        \DB::table('breeds')->insert(['name' => 'Calopsite']);
        \DB::table('breeds')->insert(['name' => 'Cenerino']);
        \DB::table('breeds')->insert(['name' => 'Cocorita']);
        \DB::table('breeds')->insert(['name' => 'Conuro del Sole']);
        \DB::table('breeds')->insert(['name' => 'Conuro Guance Verdi']);
        \DB::table('breeds')->insert(['name' => 'Ecletto']);
        \DB::table('breeds')->insert(['name' => 'Inseparabile Alinere']);
        \DB::table('breeds')->insert(['name' => 'Inseparabile di Fischer']);
        \DB::table('breeds')->insert(['name' => 'Inseparabile Facciarosa']);
        \DB::table('breeds')->insert(['name' => 'Inseparabile Mascherato']);
        \DB::table('breeds')->insert(['name' => 'Kakariki Fronte Rossa']);
        \DB::table('breeds')->insert(['name' => 'Lori Capinero']);
        \DB::table('breeds')->insert(['name' => 'Lori Rosso']);
        \DB::table('breeds')->insert(['name' => 'Lorichetto Arcobaleno']);
        \DB::table('breeds')->insert(['name' => 'Pappagallo Alibronzate']);
        \DB::table('breeds')->insert(['name' => 'Pappagallo Testablu']);
        \DB::table('breeds')->insert(['name' => 'Parrocchetto dal Collare']);
        \DB::table('breeds')->insert(['name' => 'Parrocchetto di Bourke']);
        \DB::table('breeds')->insert(['name' => 'Parrocchetto di Derby']);
        \DB::table('breeds')->insert(['name' => 'Parrocchetto di Lesson']);
        \DB::table('breeds')->insert(['name' => 'Parrocchetto Monaco']);        
    }
}
