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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('number')->nullable();
            $table->bigInteger('user_id')->index();
            $table->bigInteger('address_id')->index()->nullable();
            $table->bigInteger('terminal_id')->index()->nullable();
            $table->double('total');
            $table->string('email')->nullable();
            $table->string('name')->nullable();
            $table->longText('address')->nullable();
            $table->string('phone')->nullable();
            $table->longText('description')->nullable();
            $table->longText('user_description')->nullable();
            $table->longText('options')->nullable();
            $table->longText('symbols')->nullable();
            $table->expirable();
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
        Schema::dropIfExists('invoices');
    }
};
