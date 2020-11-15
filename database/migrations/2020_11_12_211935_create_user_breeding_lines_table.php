<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBreedingLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_breeding_lines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tribe_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('ark_dino_id')->index();
            $table->string('mutation_type');
            $table->integer('base_level');
            // True Values (i.e. 12545.1)
            $table->decimal('base_health_true_value', 15, 2)->nullable();
            $table->decimal('base_stamina_true_value', 15, 2)->nullable();
            $table->decimal('base_oxygen_true_value', 15, 2)->nullable();
            $table->decimal('base_food_true_value', 15, 2)->nullable();
            $table->decimal('base_weight_true_value', 15, 2)->nullable();
            $table->decimal('base_damage_true_value', 15, 2)->nullable();
            $table->decimal('base_movement_true_value', 15, 2)
                            ->nullable()
                            ->default(100);
            $table->decimal('base_water_true_value', 15, 2)->nullable();
            $table->decimal('base_torpidity_true_value', 15, 2)->nullable();
            $table->decimal('base_fortitude_true_value', 15, 2)->nullable();
            $table->decimal('base_crafting_true_value', 15, 2)->nullable();
            // Stat Level Count
            $table->integer('base_health_stat_level')->nullable();
            $table->integer('base_stamina_stat_level')->nullable();
            $table->integer('base_oxygen_stat_level')->nullable();
            $table->integer('base_food_stat_level')->nullable();
            $table->integer('base_weight_stat_level')->nullable();
            $table->integer('base_damage_stat_level')->nullable();
            $table->integer('base_movement_stat_level')->nullable();
            $table->integer('base_water_stat_level')->nullable();
            $table->integer('base_torpidity_stat_level')->nullable();
            $table->integer('base_fortitude_stat_level')->nullable();
            $table->integer('base_crafting_stat_level')->nullable();
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
        Schema::dropIfExists('user_breeding_lines');
    }
}
