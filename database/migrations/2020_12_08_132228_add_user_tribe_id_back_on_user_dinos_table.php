<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserTribeIdBackOnUserDinosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_dinos', function (Blueprint $table) {
            $table->unsignedBigInteger('user_tribe_id')
                    ->after('id')
                    ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_dinos', function (Blueprint $table) {
            $table->dropColumn('user_tribe_id');
        });

    }
}
