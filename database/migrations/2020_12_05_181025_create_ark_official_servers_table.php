<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArkOfficialServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ark_official_servers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('battlemetricsID');
            $table->unsignedBigInteger('steamID')->nullable();
            $table->string('name');
            $table->ipAddress('ipAddress');
            $table->unsignedInteger('port');
            $table->unsignedInteger('queryPort');
            $table->string('gameMode');
            $table->string('map');
            $table->unsignedInteger('day')->default(0);
            $table->string('status')->default('offline');
            $table->boolean('crossplay')->default(false);
            $table->string('country')->nullable();
            $table->timestamp('bm_created_at')->default(Carbon::now());
            $table->timestamp('bm_updated_at')->default(Carbon::now());
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
        Schema::dropIfExists('ark_official_servers');
    }
}
