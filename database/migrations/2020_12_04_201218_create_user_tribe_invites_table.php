<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTribeInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_tribe_invites', function (Blueprint $table) {
            $table->id();
            $table->uuid('token');
            $table->foreignId('tribe_id')
                    ->constrained('user_tribes', 'id')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('sent_to_user_id')
                    ->constrained('users', 'id')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('sent_from_user_id')
                    ->constrained('users', 'id')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->boolean('sent_successfully');
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
        Schema::dropIfExists('user_tribe_invites');
    }
}
