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
        Schema::create('terminals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('merchant_id')->index();
            $table->bigInteger('user_id')->index();
            $table->string('api_key')->nullable();
            $table->string('type')->default('crypto');
            $table->string('status')->default('enable');
            $table->string('username')->index()->nullable();
            $table->string('title')->index()->nullable();
            $table->string('callback_url')->index()->nullable();
            $table->string('callback_password')->index()->nullable();
            $table->longText('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('terminals');
    }
};
