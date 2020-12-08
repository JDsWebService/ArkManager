<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChangelogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('changelogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('major_version');
            $table->unsignedBigInteger('minor_version');
            $table->unsignedBigInteger('patch_version');
            $table->boolean('prerelease')->default(false);
            $table->unsignedBigInteger('days_since_init')->default(0);
            $table->string('full_version_string');
            $table->string('version_type');
            $table->string('change_type');
            $table->string('category');
            $table->string('description');
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
        Schema::dropIfExists('changelogs');
    }
}
