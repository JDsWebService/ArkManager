<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            // Who is listing the item
            $table->foreignId('user_id')
                        ->constrained('users', 'id')
                        ->onUpdate('cascade')
                        ->onDelete('cascade');
            // What is being sold
            $table->foreignId('sold_item')
                ->constrained('ark_item_meta_info', 'id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('sold_quantity')->default(1);
            $table->boolean('sold_blueprint')->default(false);
            $table->string('sold_quality')->nullable();
            $table->decimal('sold_armor', 10, 2)->nullable();
            $table->decimal('sold_hypothermic', 10, 2)->nullable();
            $table->decimal('sold_hyperthermic', 10, 2)->nullable();
            $table->decimal('sold_damage', 10, 2)->nullable();
            $table->integer('sold_durability')->nullable();
            // What is the payment
            $table->foreignId('payment_item')
                ->constrained('ark_item_meta_info', 'id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('payment_quantity')->default(1);
            $table->boolean('payment_blueprint')->default(false);
            $table->string('payment_quality')->nullable();
            $table->decimal('payment_armor', 10, 2)->nullable();
            $table->decimal('payment_hypothermic', 10, 2)->nullable();
            $table->decimal('payment_hyperthermic', 10, 2)->nullable();
            $table->decimal('payment_damage', 10, 2)->nullable();
            $table->integer('payment_durability')->nullable();
            // Accept Bartering
            $table->boolean('bartering_allowed')->default(false);
            // Duration of trade (8 hour default)
            $table->integer('duration')->default(28800);
            $table->boolean('promoted')->default(false);
            // Timestamps
            $table->softDeletes();
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
        Schema::dropIfExists('trades');
    }
}
