<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('cage_id')->unique();
            $table->integer('width');
            $table->integer('height');
            $table->integer('depth');
            $table->integer('max_parrot')->default(1);
            $table->string('note')->nullable();
            $table->string('photo')->nullable();
            $table->boolean('possibility_add_parrot')->default(false);
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
        Schema::dropIfExists('cages');
    }
}
