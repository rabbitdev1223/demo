<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parots', function (Blueprint $table) {
            $table->id();
            $table->string('parot_id')->unique();
            $table->string('name');
            $table->string('date_of_birth');
            $table->foreignId('breed_id')
                    ->constrained("breeds")
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->string('photo')->nullable();
            $table->string('color');
            $table->foreignId('registered_by')
                    ->constrained("users")
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('parots');
    }
}
