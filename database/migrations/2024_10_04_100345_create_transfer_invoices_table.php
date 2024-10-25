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
        Schema::create('transfer_invoices', function (Blueprint $table) {
            $table->id('transferInvoice_id');
            $table->date('registration_date');
            $table->integer('customer_id');
            $table->integer('batch_id')->nullable();
            $table->integer('product_id');
            $table->string('manufacturer_id',250)->nullable();
            $table->string('order_ref',250)->nullable();
            $table->string('proforma_invoice',250)->nullable();
            $table->string('batch_no',250)->nullable();
            $table->string('packing',150)->nullable();
            $table->string('no_of_packing',150)->nullable();
            $table->string('unit_price',150)->nullable();
            $table->date('invoice_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->integer('delivery_by')->nullable();
            $table->string('remark',350)->nullable();
            $table->string('company',350)->nullable();
            $table->string('discount',150)->nullable();
            $table->boolean('enable_discount')->nullable();
            $table->string('invoice_type',150)->nullable();
            $table->string('invoice_type_category',150)->nullable();
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
        Schema::dropIfExists('transfer_invoices');
    }
};
