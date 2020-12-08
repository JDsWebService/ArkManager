<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropUserTribeIdOnUserDinosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_dinos', function (Blueprint $table) {
            $table->dropForeign('user_dinos_user_tribe_id_foreign');
            $table->dropColumn('user_tribe_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        dd("This migration can not be reversed");
    }
}
