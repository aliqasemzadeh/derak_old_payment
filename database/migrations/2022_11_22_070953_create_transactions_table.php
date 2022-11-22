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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('type')->index(); // Deposit, Withdraw, Invoice, Terminal
            $table->bigInteger('user_id')->index();
            $table->bigInteger('wallet_id')->index();
            $table->bigInteger('terminal_id')->nullable();
            $table->bigInteger('address_id')->nullable();
            $table->bigInteger('invoice_id')->nullable();
            $table->double('amount')->default(0);
            $table->double('rate')->default(1);
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
        Schema::dropIfExists('transactions');
    }
};
