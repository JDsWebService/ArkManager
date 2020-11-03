<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->decimal('weight', 10, 2);
            $table->decimal('damage', 10, 2);
            $table->decimal('movement', 10, 2);
            $table->decimal('water', 10, 2)->nullable();
            $table->decimal('torpidity', 10, 2)->nullable();
            $table->decimal('fortitude', 10, 2)->nullable();
            $table->decimal('crafting', 10, 2)->nullable();
            $table->string('tamedBy')->nullable();
            $table->string('class')->nullable();
            $table->string('imprintedBy')->nullable();
            $table->unsignedBigInteger('color_id_region_0')->nullable();
            $table->unsignedBigInteger('color_id_region_1')->nullable();
            $table->unsignedBigInteger('color_id_region_2')->nullable();
            $table->unsignedBigInteger('color_id_region_3')->nullable();
            $table->unsignedBigInteger('color_id_region_4')->nullable();
            $table->unsignedBigInteger('color_id_region_5')->nullable();
            $table->timestamps();
        });

        Schema::table('dinos', function (Blueprint $table) {
            // Define Tribe Foreign Key
            $table->foreign('tribe_id')
                ->references('id')
                ->on('tribes')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            // Define Color ID's Foreign Keys
            $table->foreign('color_id_region_0')
                ->references('colorID')
                ->on('colors')
                ->onDelete('SET NULL')
                ->onUpdate('CASCADE');
            $table->foreign('color_id_region_1')
                ->references('colorID')
                ->on('colors')
                ->onDelete('SET NULL')
                ->onUpdate('CASCADE');
            $table->foreign('color_id_region_2')
                ->references('colorID')
                ->on('colors')
                ->onDelete('SET NULL')
                ->onUpdate('CASCADE');
            $table->foreign('color_id_region_3')
                ->references('colorID')
                ->on('colors')
                ->onDelete('SET NULL')
                ->onUpdate('CASCADE');
            $table->foreign('color_id_region_4')
                ->references('colorID')
                ->on('colors')
                ->onDelete('SET NULL')
                ->onUpdate('CASCADE');
            $table->foreign('color_id_region_5')
                ->references('colorID')
                ->on('colors')
                ->onDelete('SET NULL')
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
            $table->dropForeign('dinos_color_id_region_0_foreign');
            $table->dropForeign('dinos_color_id_region_1_foreign');
            $table->dropForeign('dinos_color_id_region_2_foreign');
            $table->dropForeign('dinos_color_id_region_3_foreign');
            $table->dropForeign('dinos_color_id_region_4_foreign');
            $table->dropForeign('dinos_color_id_region_5_foreign');
        });

        Schema::dropIfExists('dinos');
    }
}
