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
        Schema::create('closing_daily_debit_expanses', function (Blueprint $table) {
            $table->id('closing_daily_debit_expense_id');
            $table->integer('blance_type'); // lequide 1, old_stock 2, from submit debit 22
            $table->string('debit_name', 200); 
            $table->float('debit_blance'); 
            $table->date('debit_date'); 
            $table->integer('closing_daily_expense_id'); 
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
        Schema::dropIfExists('closing_daily_debit_expanses');
    }
};
