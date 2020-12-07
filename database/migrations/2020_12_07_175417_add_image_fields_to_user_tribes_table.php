<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageFieldsToUserTribesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_tribes', function (Blueprint $table) {
            $table->string('image_public_path')->nullable();
            $table->string('image_storage_path')->nullable();
            $table->string('image_filename')->nullable();
            $table->string('image_extension')->nullable();
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
            $table->dropColumn(['image_public_path', 'image_storage_path', 'image_filename', 'image_extension']);
        });
    }
}
