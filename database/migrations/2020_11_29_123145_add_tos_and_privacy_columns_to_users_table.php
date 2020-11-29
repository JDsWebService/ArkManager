<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTosAndPrivacyColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('tos_accept')->default(false);
            $table->timestamp('tos_accept_date')->nullable();
            $table->boolean('privacy_accept')->default(false);
            $table->timestamp('privacy_accept_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['tos_accept', 'privacy_accept', 'tos_accept_date', 'privacy_accept_date']);
        });
    }
}
