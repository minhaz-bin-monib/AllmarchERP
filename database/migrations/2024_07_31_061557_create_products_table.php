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
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id'); // product_id as primary key
            $table->date('registration_date');
            $table->string('product_name', 500);
            $table->string('product_code', 150)->nullable();
            $table->string('product_unit_type',20)->nullable();
            $table->double('product_unit_price',8,2)->nullable();
            $table->double('product_actual_price',8,2)->nullable();
            $table->double('product_unit_price_c',8,2)->nullable();
            $table->double('product_net_price',8,2)->nullable();
            $table->double('atv_rate',8,2)->nullable();
            $table->double('material_description',500)->nullable();
            $table->double('product_packing',8,2)->nullable();
            $table->string('import_information',500)->nullable();
            $table->string('h_s_code',200)->nullable();
            $table->integer('low_stock_alert')->nullable();
            $table->string('product_description',500)->nullable();
            $table->string('product_generic',200)->nullable();
            $table->string('product_category',200)->nullable();
            $table->string('product_brand',200)->nullable();
            $table->string('product_grouping',200)->nullable();
            $table->string('product_image',500)->nullable();
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
        Schema::dropIfExists('products');
    }
};
