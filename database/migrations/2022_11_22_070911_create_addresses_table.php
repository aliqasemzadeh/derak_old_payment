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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('status')->index()->default('unused');
            $table->string('address')->index();
            $table->string('network')->index();
            $table->string('symbol')->nullable();
            $table->string('private_key')->index()->nullable();
            $table->string('public_key')->index()->nullable();
            $table->bigInteger('user_id')->index();
            $table->bigInteger('terminal_id')->index();
            $table->bigInteger('invoice_id')->index();
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('addresses');
    }
};
