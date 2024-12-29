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
        Schema::create('closing_daily_cash_blance_histories', function (Blueprint $table) {
            $table->id('closing_daily_cash_blance_history_id');
            $table->float('previous_cash_balance');
            $table->float('current_cash_balance');
            $table->date('closing_date');
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
        Schema::dropIfExists('closing_daily_cash_blance_histories');
    }
};
