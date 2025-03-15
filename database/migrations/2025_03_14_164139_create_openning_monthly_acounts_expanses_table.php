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
        Schema::create('openning_monthly_acounts_expanses', function (Blueprint $table) {
            $table->id('openning_monthly_acounts_expanses_id');
            $table->date('opening_date');
            $table->integer('opening_monthly_id');
            $table->integer('montly_acounts_id');
            $table->integer('montly_categories_id');
            $table->string('company_name')->nullable();
            $table->string('payment_type')->nullable();
            $table->decimal('opening_amount',20,2);
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
        Schema::dropIfExists('openning_monthly_acounts_expanses');
    }
};
