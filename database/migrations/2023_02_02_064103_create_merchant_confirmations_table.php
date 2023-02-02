<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_confirmations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('merchant_id');
            $table->string('document');
            $table->string('description')->nullable();
            $table->string('comment')->nullable();
            $table->string('status')->default('check');
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
        Schema::dropIfExists('merchant_confirmations');
    }
};
