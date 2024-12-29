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
        Schema::create('closing_daily_expanses', function (Blueprint $table) {
            $table->id('closing_daily_expense_id');
            $table->date('openning_date')->nullable();
            $table->date('closing_date')->nullable();
            $table->float('openning_blance')->nullable();
            $table->float('closing_blance')->nullable();
            $table->float('total_debit_blance')->nullable();
            $table->float('total_credit_blance')->nullable();
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
        Schema::dropIfExists('closing_daily_expanses');
    }
};
