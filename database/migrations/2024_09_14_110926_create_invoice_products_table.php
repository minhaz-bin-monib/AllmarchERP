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
        Schema::create('invoice_products', function (Blueprint $table) {
            $table->id('salesInvoiceProduct_id');
            $table->date('registration_date');
            $table->integer('salesInvoice_id');
            $table->integer('product_id');
            $table->integer('batch_id');
            $table->string('batch_no',250)->nullable();
            $table->integer('packing')->nullable();
            $table->integer('no_of_packing')->nullable();
            $table->float('unit_price')->nullable();
            $table->float('discount')->nullable();
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
        Schema::dropIfExists('sales_invoice_products');
    }
};
