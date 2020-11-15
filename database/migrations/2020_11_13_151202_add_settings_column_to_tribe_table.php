<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSettingsColumnToTribeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_tribes', function (Blueprint $table) {
            $table->boolean('use_true_values')->default(true);
            $table->boolean('use_stat_levels')->default(true);
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
            $table->dropColumn(['use_true_values', 'use_stat_levels']);
        });
    }
}
