<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHomeServerIdToUserTribesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_tribes', function (Blueprint $table) {
            $table->foreignId('home_server_id')
                ->nullable()
                ->constrained('ark_official_servers', 'id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_tribes', function (Blueprint $table) {
            $table->dropForeign('user_tribes_home_server_id_foreign');
            $table->dropColumn('home_server_id');
        });
    }
}
