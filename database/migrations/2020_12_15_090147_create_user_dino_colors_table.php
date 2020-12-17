<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDinoColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_dino_colors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ark_dino_id');
            $table->unsignedBigInteger('tribe_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('dino_id_one');
            $table->unsignedBigInteger('dino_id_two');
            $table->string('gender');
            $table->integer('level');
            $table->decimal('health', 20, 6);
            $table->decimal('stamina', 20, 6);
            $table->decimal('torpidity', 20, 6);
            $table->decimal('oxygen', 20, 6);
            $table->decimal('food', 20, 6);
            $table->decimal('water', 20, 6);
            $table->decimal('temperature', 20, 6);
            $table->decimal('weight', 20, 6);
            $table->decimal('damage', 20, 6);
            $table->decimal('movement', 20, 6);
            $table->decimal('fortitude', 20, 6);
            $table->decimal('crafting', 20, 6);
            $table->unsignedBigInteger('region_zero_id');
            $table->unsignedBigInteger('region_one_id');
            $table->unsignedBigInteger('region_two_id');
            $table->unsignedBigInteger('region_three_id');
            $table->unsignedBigInteger('region_four_id');
            $table->unsignedBigInteger('region_five_id');
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
        Schema::dropIfExists('user_dino_colors');
    }
}
