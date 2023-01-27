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
        Schema::create('symbols', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('symbol')->index();
            $table->string('contract')->index()->nullable();
            $table->string('network')->index()->nullable();
            $table->string('coingecko_id')->nullable();
            $table->bigInteger('sort_order')->default(1);
            $table->longText('options')->nullable();
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
        Schema::dropIfExists('symbols');
    }
};
