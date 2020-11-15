<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUserBreedingLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_breeding_lines', function (Blueprint $table) {
            $table->foreign('tribe_id')
                ->references('id')
                ->on('user_tribes')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->foreign('ark_dino_id')
                ->references('id')
                ->on('ark_dinos')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_breeding_lines', function (Blueprint $table) {
            $table->dropForeign('user_breeding_lines_tribe_id_foreign');
            $table->dropForeign('user_breeding_lines_user_id_foreign');
            $table->dropForeign('user_breeding_lines_ark_dino_id_foreign');
        });
    }
}
