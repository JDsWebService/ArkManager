<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArkDinoMetaInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ark_dino_meta_info', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ark_id');
            $table->string('name_tag');
            $table->string('type');
            $table->boolean('is_dlc');
            $table->string('dlc_name')->nullable();
            $table->text('description')->nullable();
            $table->string('spawn_command')->nullable();
            $table->string('image_url')->nullable();
            $table->string('image_public_path')->nullable();
            $table->string('image_storage_path')->nullable();
            $table->string('image_filename')->nullable();
            $table->string('image_extension')->nullable();
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
        Schema::dropIfExists('ark_dino_meta_info');
    }
}
