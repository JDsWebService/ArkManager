<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArkDinoColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ark_dino_colors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('colorID')->index();
            $table->string('name');
            $table->string('hex');
            $table->string('rgb');
            $table->decimal('uRed', 7, 6);
            $table->decimal('uGreen', 7, 6);
            $table->decimal('uBlue', 7, 6);
            $table->decimal('uAlpha', 7, 6);
            $table->unsignedInteger('cRed');
            $table->unsignedInteger('cGreen');
            $table->unsignedInteger('cBlue');
            $table->string('iniString');
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
        Schema::dropIfExists('ark_dino_colors');
    }
}
