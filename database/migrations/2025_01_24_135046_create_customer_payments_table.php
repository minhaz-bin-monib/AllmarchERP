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
        Schema::create('customer_payments', function (Blueprint $table) {
            $table->id('customer_payment_id');
            $table->date('receive_date')->nullable();
            $table->integer('customer_id');
            $table->decimal('diposit_dmount', 20, 2);
            $table->integer('diposit_method_id')->nullable();
            $table->date('honour_date')->nullable();
            $table->string('reference', 300)->nullable();
            $table->integer('bank_name_id')->nullable();
            $table->string('payment_type');
            $table->string('action_type', 50)->nullable();
            $table->string('user_id', 200)->nullable();
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
        Schema::dropIfExists('customer_payments');
    }
};
