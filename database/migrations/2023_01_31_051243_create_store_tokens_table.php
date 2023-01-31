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
        Schema::create('store_tokens', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('store_id');
            $table->string('title');
            $table->string('coingecko_id');
            $table->string('symbol');
            $table->string('network');
            $table->string('contract');
            $table->string('rate_type')->default('fix');
            $table->string('rate')->default(1);
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
        Schema::dropIfExists('store_tokens');
    }
};
