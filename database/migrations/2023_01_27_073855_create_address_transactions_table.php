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
        Schema::create('address_transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('address_id')->index();
            $table->string('symbol')->index()->nullable();
            $table->string('contract')->index()->nullable();
            $table->string('txid')->index();
            $table->string('from')->index();
            $table->string('to')->index();
            $table->double('value')->default(0);
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
        Schema::dropIfExists('address_transactions');
    }
};
