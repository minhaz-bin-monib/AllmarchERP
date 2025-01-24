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
        Schema::create('customer_forward_blances', function (Blueprint $table) {
            $table->id('customer_forward_blance_id');
            $table->integer('customer_id');
            $table->decimal('opening_forward_invoice_amount',20, 2);
            $table->decimal('opening_forward_given_amount', 20, 2);
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
        Schema::dropIfExists('customer_forward_blances');
    }
};
