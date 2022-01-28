<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoupleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('couple', function (Blueprint $table) {
            $table->id();
            $table->string('couple_id')->unique();
            $table->foreignId('male_id')
                    ->constrained("parrots")
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('female_id')
                    ->constrained("parrots")
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->string('birth_date_of_couple');
            $table->string('expected_date_of_birth')->nullable();
            $table->string('note')->nullable();

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
        Schema::dropIfExists('couple');
    }
}
