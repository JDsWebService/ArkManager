<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArkItemMetaInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ark_item_meta_info', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image_url')->nullable();
            $table->text('description')->nullable();
            $table->string('item_id')->nullable();
            $table->string('class_name')->nullable();
            $table->boolean('dlc_status')->default(false);
            $table->string('dlc_name')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('ark_item_meta_info');
    }
}
