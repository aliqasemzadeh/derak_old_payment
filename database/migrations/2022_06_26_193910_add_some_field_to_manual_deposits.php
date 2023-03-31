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
        Schema::table('manual_deposits', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('symbol');
            $table->dropColumn('txid');
            $table->dropColumn('user_id');
            $table->bigInteger('wallet_id')->index();
            $table->double('amount')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('manual_deposits', function (Blueprint $table) {
            $table->dropColumn('wallet_id');
            $table->dropColumn('amount');
        });
    }
};
