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
        Schema::create('transfer_invoice_products', function (Blueprint $table) {
            $table->id('transferInvoiceProduct_id');
            $table->date('registration_date');
            $table->integer('transferInvoice_id');
            $table->integer('product_id');
            $table->integer('batch_id')->nullable();
            $table->string('batch_no',250)->nullable();
            $table->string('packing',150)->nullable();
            $table->string('no_of_packing',150)->nullable();
            $table->string('unit_price',150)->nullable();
            $table->string('discount',150)->nullable();
            $table->boolean('enable_discount')->nullable();
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
        Schema::dropIfExists('transfer_invoice_products');
    }
};
