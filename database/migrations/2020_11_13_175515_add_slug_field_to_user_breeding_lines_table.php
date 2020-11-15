<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugFieldToUserBreedingLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_breeding_lines', function (Blueprint $table) {
            $table->string('slug')->after('ark_dino_id');
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
            $table->dropColumn('slug');
        });
    }
}
