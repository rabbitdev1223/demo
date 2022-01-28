<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGenderToParrotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parrots', function (Blueprint $table) {
            //
            $table->integer('gender')->after('photo')->default(0);//0:unknown;1:male;2:female
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parrots', function (Blueprint $table) {
            //
        });
    }
}
