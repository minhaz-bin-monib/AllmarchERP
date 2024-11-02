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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id('salesInvoice_id');
            $table->date('registration_date');
            $table->integer('customer_id');
            $table->integer('batch_id');
            $table->integer('product_id');
            $table->string('manufacturer_id',250)->nullable();
            $table->string('order_ref',250)->nullable();
            $table->string('batch_no',250)->nullable();
            $table->integer('packing')->nullable();
            $table->integer('no_of_packing')->nullable();
            $table->float('unit_price')->nullable();
            $table->date('invoice_date')->nullable();
            $table->integer('delivery_by')->nullable();
            $table->string('remark',350)->nullable();
            $table->float('discount')->nullable();
            $table->string('company',350)->nullable();
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
        Schema::dropIfExists('sales_invoices');
    }
};
