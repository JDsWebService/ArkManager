<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDinosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_dinos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_tribe_id')
                ->constrained('user_tribes', 'id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('user_id')
                ->constrained('users', 'id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('dino_meta_info_id')
                ->constrained('ark_dino_meta_info', 'id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            // UUID refers to the entire breeding line
            $table->uuid('uuid')->index();
            // Slug refers to a specific dino
            $table->string('slug')->unique()->index();
            $table->string('name');
            $table->string('mutation_type');
            $table->integer('mutation_count');
            $table->integer('level');
            $table->decimal('health', 20, 1)->default(0);
            $table->decimal('stamina', 20, 1)->default(0);
            $table->decimal('torpidity', 20, 1)->default(0);
            $table->decimal('oxygen', 20, 1)->default(0);
            $table->decimal('food', 20, 1)->default(0);
            $table->decimal('water', 20, 1)->default(100);
            $table->decimal('temperature', 20, 1)->default(0);
            $table->decimal('weight', 20, 1)->default(0);
            $table->decimal('damage', 20, 1)->default(0);
            $table->decimal('movement', 20, 1)->default(100);
            $table->decimal('fortitude', 20, 1)->default(0);
            $table->decimal('crafting', 20, 1)->default(0);
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
        Schema::dropIfExists('user_dinos');
    }
}
