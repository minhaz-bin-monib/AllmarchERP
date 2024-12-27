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
        Schema::create('openning_daily_cash_blances', function (Blueprint $table) {
            $table->id('openning_daily_cash_balance_id');
            $table->integer('cash_blance_type'); // lequide 1, old_stock 2
            $table->string('cush_blance_type_name',350);
            $table->string('cush_blance_type_name_for_not_shown',350)->nullable();;
            $table->float('previous_cash_blance');
            $table->float('current_cash_blance');
            $table->date('previous_Update_date');
            $table->date('current_Update_date');
            $table->string('action_type',50)->nullable();
            $table->string('user_id',200)->nullable();
            $table->date('action_date')->nullable();
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
        Schema::dropIfExists('openning_daily_cash_blances');
    }
};
