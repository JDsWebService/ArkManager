<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDinosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dinos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tribe_id');
            $table->string('name');
            $table->string('type');
            $table->string('gender');
            $table->unsignedInteger('level');
            $table->decimal('health', 10, 2);
            $table->decimal('stamina', 10, 2);
            $table->decimal('oxygen', 10, 2);
            $table->decimal('food', 10, 2);
            $table->decimal('water', 10, 2);
            $table->decimal('weight', 10, 2);
            $table->decimal('damage', 10, 2);
            $table->decimal('movement', 10, 2);
            $table->decimal('torpidity', 10, 2)->nullable();
            $table->decimal('fortitude', 10, 2)->nullable();
            $table->decimal('crafting', 10, 2)->nullable();
            $table->string('tamedBy')->nullable();
            $table->string('class')->nullable();
            $table->string('imprintedBy')->nullable();
            $table->json('color')->nullable();
            $table->timestamps();
        });

        Schema::table('dinos', function (Blueprint $table) {
            // Define Original Image Key
            $table->foreign('tribe_id')
                ->references('id')
                ->on('tribes')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dinos', function (Blueprint $table) {
            $table->dropForeign('dinos_tribe_id_foreign');
        });

        Schema::dropIfExists('dinos');
    }
}
