<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('provider');
            $table->string('provider_id');
            $table->string('username');
            $table->string('discriminator');
            $table->string('fullusername');
            $table->string('avatar')->nullable();
            $table->string('email')->nullable();
            $table->boolean('email_verified');
            $table->string('locale');
            $table->boolean('twofactor');
            $table->boolean('admin')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
