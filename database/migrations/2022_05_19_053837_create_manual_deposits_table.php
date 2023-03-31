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
        Schema::create('manual_deposits', function (Blueprint $table) {
            $table->id();
            $table->string('status')->index()->default('draft');
            $table->string('symbol')->index();
            $table->string('txid')->index();
            $table->bigInteger('user_id')->index();
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
        Schema::dropIfExists('manual_deposits');
    }
};
